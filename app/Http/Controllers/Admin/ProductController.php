<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    protected array $categories = ['Cream', 'Cleanser', 'Toner', 'Serum'];

    public function index()
    {
        $products = Product::orderBy('sort_order')->paginate(10);

        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = $this->categories;

        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $this->validateProduct($request);

        $payload = $this->buildProductPayload($validated, $request);

        $product = Product::create($payload);

        $this->syncImages($product, $request);

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit(Product $product)
    {
        $categories = $this->categories;

        $product->load('images');

        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $this->validateProduct($request);

        $payload = $this->buildProductPayload($validated, $request);

        $product->update($payload);

        $this->syncImages($product, $request);

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(Product $product)
    {
        $product->load('images');

        foreach ($product->images as $image) {
            if ($image->path && !str_starts_with($image->path, 'http')) {
                Storage::disk('public')->delete($image->path);
            }
        }

        if ($product->image && !str_starts_with($product->image, 'http')) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Produk berhasil dihapus.');
    }

    public function toggleHot(Product $product)
    {
        $product->update(['is_hot' => !$product->is_hot]);

        return response()->json([
            'success' => true,
            'is_hot' => $product->is_hot,
            'message' => $product->is_hot
                ? 'Produk ditandai sebagai HOT'
                : 'Status HOT produk dihapus',
        ]);
    }

    public function toggleActive(Product $product)
    {
        $product->update(['is_active' => !$product->is_active]);

        return response()->json([
            'success' => true,
            'is_active' => $product->is_active,
            'message' => $product->is_active
                ? 'Produk diaktifkan'
                : 'Produk dinonaktifkan',
        ]);
    }

    protected function validateProduct(Request $request): array
    {
        return $request->validate([
            'name' => 'required|string|max:255',
            'size' => 'required|string|max:50',
            'price' => 'required|numeric|min:0',
            'category' => 'required|string|max:100',
            'description' => 'nullable|string',
            'benefits' => 'nullable|string',
            'image_files' => 'nullable|array',
            'image_files.*' => 'nullable|image|max:2048',
            'image_urls' => 'nullable|array',
            'image_urls.*' => 'nullable|url',
            'delete_images' => 'nullable|array',
            'delete_images.*' => 'integer',
            'is_hot' => 'sometimes|boolean',
            'is_active' => 'sometimes|boolean',
            'shopee_link' => 'nullable|url',
            'tokopedia_link' => 'nullable|url',
            'whatsapp_number' => 'nullable|string|max:20',
            'sort_order' => 'nullable|integer',
        ]);
    }

    protected function buildProductPayload(array $validated, Request $request): array
    {
        $payload = collect($validated)
            ->except(['image_files', 'image_urls', 'delete_images'])
            ->toArray();

        $payload['benefits'] = $this->formatBenefits($request->input('benefits'));
        $payload['is_hot'] = $request->boolean('is_hot');
        $payload['is_active'] = $request->boolean('is_active', true);
        $payload['sort_order'] = $payload['sort_order'] ?? 0;

        return $payload;
    }

    protected function formatBenefits(?string $benefits): ?array
    {
        if (!$benefits) {
            return null;
        }

        return array_values(array_filter(array_map('trim', preg_split('/\r\n|\r|\n/', $benefits))));
    }

    protected function syncImages(Product $product, Request $request): void
    {
        $deleteIds = array_filter($request->input('delete_images', []));

        if (!empty($deleteIds)) {
            $imagesToDelete = $product->images()->whereIn('id', $deleteIds)->get();
            foreach ($imagesToDelete as $image) {
                if ($image->path && !str_starts_with($image->path, 'http')) {
                    Storage::disk('public')->delete($image->path);
                }
            }

            $product->images()->whereIn('id', $deleteIds)->delete();
        }

        $order = 0;
        foreach ($product->images()->orderBy('sort_order')->get() as $image) {
            $image->update(['sort_order' => $order++]);
        }

        $newImages = [];

        foreach (($request->file('image_files', []) ?? []) as $file) {
            if (!$file) {
                continue;
            }

            $newImages[] = [
                'path' => $file->store('products', 'public'),
                'sort_order' => $order++,
            ];
        }

        foreach ($request->input('image_urls', []) ?? [] as $url) {
            if (!$url) {
                continue;
            }

            $newImages[] = [
                'path' => $url,
                'sort_order' => $order++,
            ];
        }

        if (!empty($newImages)) {
            $product->images()->createMany($newImages);
        }

        $primaryPath = $product->images()->orderBy('sort_order')->value('path');

        if ($primaryPath) {
            $product->update(['image' => $primaryPath]);
        }
    }
}
