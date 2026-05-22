<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'APS PROJECT') — APS PROJECT</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Poppins', sans-serif;
            background: #0a0a0f;
            color: #fff;
            overflow-x: hidden;
        }
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: #0a0a0f; }
        ::-webkit-scrollbar-thumb { background: linear-gradient(180deg, #00d4ff, #7b2ff7); border-radius: 3px; }
        .glass {
            background: rgba(255, 255, 255, 0.04);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.06);
        }
        .glass-card {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.06);
            border-radius: 24px;
            transition: all 0.5s cubic-bezier(0.23, 1, 0.32, 1);
        }
        .glass-card:hover {
            background: rgba(255, 255, 255, 0.06);
            border-color: rgba(0, 212, 255, 0.25);
            transform: translateY(-8px) scale(1.01);
            box-shadow: 0 20px 60px rgba(0, 212, 255, 0.12);
        }
        .neon-text {
            background: linear-gradient(135deg, #00d4ff 0%, #7b2ff7 50%, #a855f7 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .neon-glow {
            box-shadow: 0 0 30px rgba(0, 212, 255, 0.15), 0 0 60px rgba(123, 47, 247, 0.08);
        }
        .gradient-orb {
            position: absolute;
            border-radius: 50%;
            filter: blur(80px);
            pointer-events: none;
            opacity: 0.4;
        }
        @keyframes pulseGlow {
            0%, 100% { opacity: 0.4; transform: scale(1); }
            50% { opacity: 0.8; transform: scale(1.05); }
        }
        .animate-pulse-glow { animation: pulseGlow 3s ease-in-out infinite; }
        .nav-link {
            position: relative;
            color: rgba(255,255,255,0.6);
            transition: color 0.3s ease;
        }
        .nav-link::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 2px;
            background: linear-gradient(90deg, #00d4ff, #7b2ff7);
            transition: width 0.3s ease;
        }
        .nav-link:hover { color: #fff; }
        .nav-link:hover::after { width: 100%; }
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
        .bg-grid {
            background-image:
                linear-gradient(rgba(0, 212, 255, 0.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(0, 212, 255, 0.03) 1px, transparent 1px);
            background-size: 60px 60px;
        }
    </style>
</head>
<body>
    <div class="fixed inset-0 pointer-events-none overflow-hidden z-0">
        <div class="gradient-orb w-[500px] h-[500px] bg-blue-500/20 top-[-10%] left-[-5%] animate-pulse-glow"></div>
        <div class="gradient-orb w-[400px] h-[400px] bg-purple-500/15 bottom-[-5%] right-[-5%] animate-pulse-glow" style="animation-delay: 1.5s;"></div>
        <div class="gradient-orb w-[300px] h-[300px] bg-cyan-400/10 top-[40%] left-[60%] animate-pulse-glow" style="animation-delay: 3s;"></div>
    </div>

    <nav class="fixed top-4 left-1/2 -translate-x-1/2 z-50 w-[95%] max-w-6xl glass rounded-2xl px-6 py-3">
        <div class="flex items-center justify-between">
            <a href="{{ route('home') }}" class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-lg bg-gradient-to-br from-blue-400 to-purple-600 flex items-center justify-center text-white font-bold text-sm">A</div>
                <span class="text-white font-semibold text-lg tracking-tight">APS<span class="neon-text"> PROJECT</span></span>
            </a>
            <div class="hidden md:flex items-center gap-6">
                <a href="{{ route('concerts.index') }}" class="nav-link text-sm font-medium">Concerts</a>
                @auth
                    <a href="{{ route('bookings.history') }}" class="nav-link text-sm font-medium">My Bookings</a>
                    <a href="{{ route('user.dashboard') }}" class="nav-link text-sm font-medium">Dashboard</a>

                    <div class="relative" id="notifContainer">
                        <button onclick="document.getElementById('notifDropdown').classList.toggle('hidden')" class="relative p-2 text-gray-400 hover:text-white transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0"/></svg>
                            @php $unread = Auth::user()->unreadNotifications->count(); @endphp
                            @if ($unread > 0)
                                <span class="absolute -top-0.5 -right-0.5 w-4 h-4 rounded-full bg-red-500 text-white text-[10px] font-bold flex items-center justify-center">{{ $unread > 9 ? '9+' : $unread }}</span>
                            @endif
                        </button>
                        <div id="notifDropdown" class="hidden absolute right-0 mt-2 w-80 glass rounded-2xl border border-white/10 shadow-2xl overflow-hidden z-50">
                            <div class="p-3 border-b border-white/5">
                                <span class="text-sm font-semibold text-white">Notifications</span>
                            </div>
                            <div class="max-h-72 overflow-y-auto">
                                @forelse (Auth::user()->notifications()->take(5)->get() as $notification)
                                    <div class="px-4 py-3 border-b border-white/5 hover:bg-white/5 transition {{ $notification->read_at ? '' : 'bg-blue-500/5' }}">
                                        <p class="text-sm text-gray-300">{{ $notification->data['message'] ?? 'Notification' }}</p>
                                        <p class="text-xs text-gray-500 mt-1">{{ $notification->created_at->diffForHumans() }}</p>
                                    </div>
                                @empty
                                    <div class="px-4 py-8 text-center">
                                        <p class="text-sm text-gray-500">No notifications</p>
                                    </div>
                                @endforelse
                            </div>
                            @if (Auth::user()->notifications()->count() > 0)
                                <div class="p-3 border-t border-white/5 text-center">
                                    <form method="POST" action="{{ route('notifications.read') }}">
                                        @csrf
                                        <button type="submit" class="text-xs text-blue-400 hover:text-blue-300 transition">Mark all as read</button>
                                    </form>
                                </div>
                            @endif
                        </div>
                    </div>
                    <script>
                        document.addEventListener('click', function(e) {
                            var container = document.getElementById('notifContainer');
                            var dropdown = document.getElementById('notifDropdown');
                            if (container && !container.contains(e.target)) {
                                dropdown.classList.add('hidden');
                            }
                        });
                    </script>

                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="nav-link text-sm font-medium">Logout</button>
                    </form>
                    <span class="text-sm text-gray-400">{{ Auth::user()->name }}</span>
                @else
                    <a href="{{ route('login') }}" class="nav-link text-sm font-medium">Login</a>
                    <a href="{{ route('register') }}" class="px-5 py-2 rounded-xl text-sm font-semibold text-white bg-gradient-to-r from-blue-500 to-purple-600 hover:from-blue-400 hover:to-purple-500 transition-all duration-300 cta-btn">Register</a>
                @endauth
            </div>
            <button class="md:hidden text-white p-2" onclick="document.getElementById('mobileMenu').classList.toggle('hidden')">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
            </button>
        </div>
        <div class="hidden md:hidden mt-4 pt-4 border-t border-white/5" id="mobileMenu">
            <div class="flex flex-col gap-3 pb-3">
                <a href="{{ route('concerts.index') }}" class="text-gray-400 hover:text-white transition text-sm py-1">Concerts</a>
                @auth
                    <a href="{{ route('bookings.history') }}" class="text-gray-400 hover:text-white transition text-sm py-1">My Bookings</a>
                    <a href="{{ route('user.dashboard') }}" class="text-gray-400 hover:text-white transition text-sm py-1">Dashboard</a>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="text-gray-400 hover:text-white transition text-sm py-1">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-gray-400 hover:text-white transition text-sm py-1">Login</a>
                    <a href="{{ route('register') }}" class="text-gray-400 hover:text-white transition text-sm py-1">Register</a>
                @endauth
            </div>
        </div>
    </nav>

    <div class="relative z-10 pt-16">
        @if (session('success'))
            <div class="max-w-4xl mx-auto px-4 mt-4">
                <div class="px-4 py-3 rounded-xl bg-green-500/10 border border-green-500/20 text-green-400 text-sm">
                    {{ session('success') }}
                </div>
            </div>
        @endif
        @yield('content')
    </div>

    <footer class="relative border-t border-white/5 pt-16 pb-8">
        <div class="max-w-6xl mx-auto px-4">
            <div class="grid md:grid-cols-4 gap-10 mb-12">
                <div class="md:col-span-1">
                    <div class="flex items-center gap-3 mb-4">
                    <div class="w-9 h-9 rounded-lg bg-gradient-to-br from-blue-400 to-purple-600 flex items-center justify-center text-white font-bold text-sm">A</div>
                    <span class="text-white font-semibold text-lg tracking-tight">APS<span class="neon-text"> PROJECT</span></span>
                    </div>
                    <p class="text-gray-500 text-sm leading-relaxed">Your premier destination for live music experiences.</p>
                </div>
                <div>
                    <h4 class="text-white text-sm font-semibold mb-4">Links</h4>
                    <ul class="space-y-3">
                        <li><a href="{{ route('concerts.index') }}" class="text-gray-500 hover:text-gray-300 text-sm transition">Concerts</a></li>
                        <li><a href="{{ route('home') }}" class="text-gray-500 hover:text-gray-300 text-sm transition">Home</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-white text-sm font-semibold mb-4">Account</h4>
                    <ul class="space-y-3">
                        @auth
                            <li><a href="{{ route('bookings.history') }}" class="text-gray-500 hover:text-gray-300 text-sm transition">My Bookings</a></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="text-gray-500 hover:text-gray-300 text-sm transition">Logout</button>
                                </form>
                            </li>
                        @else
                            <li><a href="{{ route('login') }}" class="text-gray-500 hover:text-gray-300 text-sm transition">Login</a></li>
                            <li><a href="{{ route('register') }}" class="text-gray-500 hover:text-gray-300 text-sm transition">Register</a></li>
                        @endauth
                    </ul>
                </div>
                <div>
                    <h4 class="text-white text-sm font-semibold mb-4">Legal</h4>
                    <ul class="space-y-3">
                        <li><a href="#" class="text-gray-500 hover:text-gray-300 text-sm transition">Privacy</a></li>
                        <li><a href="#" class="text-gray-500 hover:text-gray-300 text-sm transition">Terms</a></li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-white/5 pt-8 text-center">
                <p class="text-gray-600 text-xs">&copy; {{ date('Y') }} APS PROJECT. All rights reserved.</p>
            </div>
        </div>
    </footer>
</body>
</html>
