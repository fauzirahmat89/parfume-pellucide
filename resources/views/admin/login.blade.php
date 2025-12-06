<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Pellucide</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&family=Playfair+Display:wght@400;500;600;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#0f0f0f] text-white min-h-screen flex items-center justify-center px-4">
    <div class="glass-panel w-full max-w-md rounded-3xl p-8 border border-white/10">
        <div class="text-center mb-6">
            <div class="brand-script text-4xl">Pellucide</div>
            <p class="text-sm text-gray-300 mt-2">Admin Login</p>
        </div>
        @if ($errors->any())
            <div class="mb-4 bg-red-500/10 border border-red-500/40 text-red-200 px-4 py-3 rounded-lg">
                {{ $errors->first() }}
            </div>
        @endif
        <form method="POST" action="{{ route('admin.login.submit') }}" class="space-y-4">
            @csrf
            <div>
                <label class="text-sm text-gray-300">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required
                    class="mt-2 w-full bg-black/60 border border-white/10 rounded-xl px-4 py-3 focus:outline-none focus:border-red-400">
            </div>
            <div>
                <label class="text-sm text-gray-300">Password</label>
                <input type="password" name="password" required
                    class="mt-2 w-full bg-black/60 border border-white/10 rounded-xl px-4 py-3 focus:outline-none focus:border-red-400">
            </div>
            <div class="flex items-center justify-between text-sm text-gray-300">
                <label class="flex items-center gap-2">
                    <input type="checkbox" name="remember" class="accent-red-500">
                    <span>Ingat saya</span>
                </label>
                <span class="text-xs text-gray-500">URL rahasia: /pellucide-admin-secret</span>
            </div>
            <button class="w-full cta-btn cta-primary">Login</button>
        </form>
    </div>
</body>
</html>
