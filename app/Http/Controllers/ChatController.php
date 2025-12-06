<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class ChatController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'message' => ['required', 'string', 'max:1000'],
        ]);

        $apiKey = config('services.glm.key');
        $endpoint = config('services.glm.endpoint', 'https://api.z.ai/api/paas/v4/chat/completions');
        $model = config('services.glm.model') ?: 'GLM-4-32B-0414-128K';

        if (!$apiKey) {
            return response()->json([
                'message' => 'Chat service is not configured yet.',
            ], 503);
        }

        // Persist conversation in session; only send catalog on first message per session.
        $messages = $request->session()->get('chat.thread', []);

        if (empty($messages)) {
            $messages[] = [
                'role' => 'system',
                'content' => 'You are Pellucide, a friendly skincare assistant. Answer concisely in Indonesian, stay on brand, avoid medical claims, and keep replies under 80 words.',
            ];

            if ($catalog = $this->cachedProductContext()) {
                $messages[] = [
                    'role' => 'system',
                    'content' => $catalog,
                ];
            }
        }

        $messages[] = [
            'role' => 'user',
            'content' => $validated['message'],
        ];

        $payload = [
            'model' => $model,
            'messages' => $messages,
            'temperature' => 0.7,
        ];

        try {
            $response = Http::timeout(2000)
                ->withHeaders([
                    'Authorization' => 'Bearer ' . $apiKey,
                    'Content-Type' => 'application/json',
                ])
                ->post($endpoint, $payload)
                ->throw();
        } catch (RequestException $e) {
            $status = $e->response?->status() ?? 500;
            $body = $e->response?->json() ?? $e->response?->body();

            Log::warning('Chat request failed', [
                'status' => $status,
                'body' => $body,
                'message' => $validated['message'],
            ]);

            return response()->json([
                'message' => $body['error']['message'] ?? $body['message'] ?? 'Maaf, layanan chat sedang bermasalah.',
            ], $status >= 400 && $status < 600 ? $status : 500);
        } catch (\Throwable $e) {
            Log::error('Chat request unexpected error', [
                'error' => $e->getMessage(),
                'message' => $validated['message'],
            ]);

            return response()->json([
                'message' => 'Terjadi kesalahan tak terduga.',
            ], 500);
        }

        $data = $response->json();
        $reply = $data['choices'][0]['message']['content'] ?? null;
        $usage = $data['usage'] ?? null;

        if (!$reply) {
            return response()->json([
                'message' => 'Jawaban tidak tersedia saat ini.',
            ], 502);
        }

        $messages[] = [
            'role' => 'assistant',
            'content' => $reply,
        ];

        $request->session()->put('chat.thread', $this->trimHistory($messages));

        return response()->json([
            'reply' => $reply,
            'usage' => $usage,
        ]);
    }

    /**
     * Build a compact product context for the model.
     */
    protected function productContext(): string
    {
        $products = Product::active()
            ->select('name', 'category', 'size', 'price', 'description', 'shopee_link', 'tokopedia_link', 'whatsapp_number', 'benefits')
            ->orderBy('sort_order')
            ->limit(12)
            ->get();

        if ($products->isEmpty()) {
            return '';
        }

        $lines = $products->map(function (Product $p) {
            $benefits = collect($p->benefits ?? [])->take(2)->implode('; ');
            $desc = Str::limit(trim($p->description ?? ''), 80, '...');

            return sprintf(
                '- %s | %s | %s | %s | %s',
                $p->name,
                $p->category,
                $p->size,
                $p->formatted_price ?? $p->price,
                $benefits ?: ($desc ?: 'n/a')
            );
        })->implode("\n");

        return "Katalog ringkas Pellucide (jangan tampilkan mentah; jawab singkat):\n" . $lines;
    }

    /**
     * Cache catalog so it is fetched once and reused across requests.
     */
    protected function cachedProductContext(): ?string
    {
        return Cache::remember('chat:product_context', 600, function () {
            $context = $this->productContext();

            return $context ?: null;
        });
    }

    /**
     * Keep system prompts and trim long threads to avoid runaway token usage.
     */
    protected function trimHistory(array $messages, int $limit = 10): array
    {
        $system = array_values(array_filter($messages, fn ($m) => $m['role'] === 'system'));
        $rest = array_values(array_filter($messages, fn ($m) => $m['role'] !== 'system'));

        $rest = array_slice($rest, max(count($rest) - $limit, 0));

        return array_merge($system, $rest);
    }
}
