<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Laravel') }} — {{ __('Login') }}</title>
        <script src="https://cdn.tailwindcss.com"></script>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        <style>
            * { font-family: 'Inter', sans-serif; }
            body { background: #0a0a0f; }
            ::-webkit-scrollbar { width: 6px; }
            ::-webkit-scrollbar-track { background: #0a0a0f; }
            ::-webkit-scrollbar-thumb { background: linear-gradient(180deg, #00d4ff, #7b2ff7); border-radius: 3px; }
            .glass-card {
                background: rgba(255, 255, 255, 0.03);
                backdrop-filter: blur(16px);
                -webkit-backdrop-filter: blur(16px);
                border: 1px solid rgba(255, 255, 255, 0.06);
                border-radius: 24px;
            }
            .cta-btn {
                position: relative;
                overflow: hidden;
                transition: all 0.4s ease;
            }
            .cta-btn::before {
                content: '';
                position: absolute;
                top: 0; left: -100%;
                width: 100%; height: 100%;
                background: linear-gradient(90deg, transparent, rgba(255,255,255,0.15), transparent);
                transition: left 0.6s ease;
            }
            .cta-btn:hover::before { left: 100%; }
        </style>
    </head>
    <body class="font-sans text-white antialiased min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
        <div class="fixed inset-0 pointer-events-none overflow-hidden z-0">
            <div class="absolute w-[500px] h-[500px] bg-blue-500/20 top-[-10%] left-[-5%] rounded-full blur-[80px] opacity-40"></div>
            <div class="absolute w-[400px] h-[400px] bg-purple-500/15 bottom-[-5%] right-[-5%] rounded-full blur-[80px] opacity-40"></div>
        </div>
        <div class="relative z-10 w-full sm:max-w-md px-4">
            <div class="text-center mb-8">
                <a href="{{ route('home') }}" class="inline-flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-blue-400 to-purple-600 flex items-center justify-center text-white font-bold">A</div>
                    <span class="text-white font-semibold text-xl">APS<span class="bg-gradient-to-r from-blue-400 to-purple-500 bg-clip-text text-transparent"> PROJECT</span></span>
                </a>
            </div>
            <div class="glass-card p-8">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
