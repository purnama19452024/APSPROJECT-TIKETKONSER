<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>APS PROJECT — Live Music Experience</title>
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
    .glass { background: rgba(255, 255, 255, 0.04); backdrop-filter: blur(20px); border: 1px solid rgba(255, 255, 255, 0.06); }
    .glass-card {
      background: rgba(255, 255, 255, 0.03);
      backdrop-filter: blur(16px);
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
    .gradient-orb { position: absolute; border-radius: 50%; filter: blur(80px); pointer-events: none; opacity: 0.4; }
    .hero-gradient {
      background: radial-gradient(ellipse 80% 50% at 50% 0%, rgba(0, 212, 255, 0.12) 0%, transparent 70%),
                  radial-gradient(ellipse 50% 40% at 20% 80%, rgba(123, 47, 247, 0.10) 0%, transparent 70%),
                  radial-gradient(ellipse 50% 40% at 80% 80%, rgba(168, 85, 247, 0.08) 0%, transparent 70%);
    }
    .bg-grid {
      background-image: linear-gradient(rgba(0, 212, 255, 0.03) 1px, transparent 1px),
                        linear-gradient(90deg, rgba(0, 212, 255, 0.03) 1px, transparent 1px);
      background-size: 60px 60px;
    }
    @keyframes float { 0%,100% { transform: translateY(0px); } 50% { transform: translateY(-20px); } }
    @keyframes floatSlow { 0%,100% { transform: translateY(0px); } 33% { transform: translateY(-15px); } 66% { transform: translateY(5px); } }
    @keyframes pulseGlow { 0%,100% { opacity: 0.4; transform: scale(1); } 50% { opacity: 0.8; transform: scale(1.05); } }
    @keyframes shimmer { 0% { background-position: -200% 0; } 100% { background-position: 200% 0; } }
    @keyframes spin { to { transform: rotate(360deg); } }
    .animate-float { animation: float 6s ease-in-out infinite; }
    .animate-float-slow { animation: floatSlow 8s ease-in-out infinite; }
    .animate-pulse-glow { animation: pulseGlow 3s ease-in-out infinite; }
    .shimmer-text {
      background: linear-gradient(90deg, #fff 0%, #00d4ff 25%, #a855f7 50%, #00d4ff 75%, #fff 100%);
      background-size: 200% auto;
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
      animation: shimmer 4s linear infinite;
    }
    .cta-btn { position: relative; overflow: hidden; transition: all 0.4s ease; }
    .cta-btn::before {
      content: ''; position: absolute; top: 0; left: -100%; width: 100%; height: 100%;
      background: linear-gradient(90deg, transparent, rgba(255,255,255,0.15), transparent);
      transition: left 0.6s ease;
    }
    .cta-btn:hover::before { left: 100%; }
    .nav-link { position: relative; color: rgba(255,255,255,0.6); transition: color 0.3s ease; }
    .nav-link::after { content: ''; position: absolute; bottom: -2px; left: 0; width: 0; height: 2px; background: linear-gradient(90deg, #00d4ff, #7b2ff7); transition: width 0.3s ease; }
    .nav-link:hover { color: #fff; }
    .nav-link:hover::after { width: 100%; }
    .loading-screen { position: fixed; inset: 0; z-index: 9999; display: flex; align-items: center; justify-content: center; background: #0a0a0f; transition: opacity 0.6s ease, visibility 0.6s ease; }
    .loading-screen.hidden { opacity: 0; visibility: hidden; }
    .loader-ring { width: 60px; height: 60px; border-radius: 50%; border: 3px solid rgba(255,255,255,0.03); border-top-color: #00d4ff; border-right-color: #7b2ff7; animation: spin 1s linear infinite; }
    .loader-text { position: absolute; margin-top: 80px; font-size: 14px; letter-spacing: 6px; text-transform: uppercase; background: linear-gradient(135deg, #00d4ff, #7b2ff7); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; }
    .reveal { opacity: 0; transform: translateY(60px); transition: all 0.8s cubic-bezier(0.23, 1, 0.32, 1); }
    .reveal.active { opacity: 1; transform: translateY(0); }
    .reveal-scale { opacity: 0; transform: scale(0.85); transition: all 0.8s cubic-bezier(0.23, 1, 0.32, 1); }
    .reveal-scale.active { opacity: 1; transform: scale(1); }
    .reveal-left { opacity: 0; transform: translateX(-60px); transition: all 0.8s cubic-bezier(0.23, 1, 0.32, 1); }
    .reveal-left.active { opacity: 1; transform: translateX(0); }
    .reveal-right { opacity: 0; transform: translateX(60px); transition: all 0.8s cubic-bezier(0.23, 1, 0.32, 1); }
    .reveal-right.active { opacity: 1; transform: translateX(0); }
    @media (max-width: 768px) { .hero-title { font-size: 2.5rem !important; } }
  </style>
</head>
<body>

  <div class="loading-screen" id="loadingScreen">
    <div class="relative flex items-center justify-center">
      <div class="loader-ring"></div>
      <span class="loader-text">Loading</span>
    </div>
  </div>

  <div class="fixed inset-0 pointer-events-none overflow-hidden z-0">
    <div class="gradient-orb w-[500px] h-[500px] bg-blue-500/20 top-[-10%] left-[-5%] animate-pulse-glow"></div>
    <div class="gradient-orb w-[400px] h-[400px] bg-purple-500/15 bottom-[-5%] right-[-5%] animate-pulse-glow" style="animation-delay: 1.5s;"></div>
    <div class="gradient-orb w-[300px] h-[300px] bg-cyan-400/10 top-[40%] left-[60%] animate-pulse-glow" style="animation-delay: 3s;"></div>
    <div class="gradient-orb w-[350px] h-[350px] bg-violet-600/10 top-[60%] left-[10%] animate-pulse-glow" style="animation-delay: 2s;"></div>
  </div>

  <nav class="fixed top-4 left-1/2 -translate-x-1/2 z-50 w-[95%] max-w-6xl glass rounded-2xl px-6 py-3">
    <div class="flex items-center justify-between">
      <a href="{{ route('home') }}" class="flex items-center gap-3">
        <div class="w-9 h-9 rounded-lg bg-gradient-to-br from-blue-400 to-purple-600 flex items-center justify-center text-white font-bold text-sm">A</div>
        <span class="text-white font-semibold text-lg tracking-tight">APS<span class="neon-text"> PROJECT</span></span>
      </a>
      <div class="hidden md:flex items-center gap-6">
        <a href="#hero" class="nav-link text-sm font-medium">Home</a>
        <a href="#concerts" class="nav-link text-sm font-medium">Concerts</a>
        <a href="#features" class="nav-link text-sm font-medium">Features</a>
        <a href="{{ route('concerts.index') }}" class="nav-link text-sm font-medium">All Events</a>
        @auth
          <a href="{{ route('bookings.history') }}" class="nav-link text-sm font-medium">My Bookings</a>
          <a href="{{ route('admin.dashboard') }}" class="nav-link text-sm font-medium">Admin</a>
          <form method="POST" action="{{ route('logout') }}" class="inline">
            @csrf
            <button type="submit" class="nav-link text-sm font-medium">Logout</button>
          </form>
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
        <a href="#hero" class="text-gray-400 hover:text-white text-sm py-1">Home</a>
        <a href="#concerts" class="text-gray-400 hover:text-white text-sm py-1">Concerts</a>
        <a href="#features" class="text-gray-400 hover:text-white text-sm py-1">Features</a>
        <a href="{{ route('concerts.index') }}" class="text-gray-400 hover:text-white text-sm py-1">All Events</a>
        @auth
          <a href="{{ route('bookings.history') }}" class="text-gray-400 hover:text-white text-sm py-1">My Bookings</a>
          <a href="{{ route('admin.dashboard') }}" class="text-gray-400 hover:text-white text-sm py-1">Admin</a>
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="text-gray-400 hover:text-white text-sm py-1">Logout</button>
          </form>
        @else
          <a href="{{ route('login') }}" class="text-gray-400 hover:text-white text-sm py-1">Login</a>
          <a href="{{ route('register') }}" class="text-gray-400 hover:text-white text-sm py-1">Register</a>
        @endauth
      </div>
    </div>
  </nav>

  <section id="hero" class="relative min-h-screen flex items-center justify-center overflow-hidden hero-gradient pt-20">
    <div class="absolute inset-0 bg-grid"></div>

    <div class="absolute top-1/4 left-[10%] w-20 h-20 rounded-full border border-blue-400/20 animate-float-slow"></div>
    <div class="absolute top-[60%] right-[15%] w-14 h-14 rounded-full bg-purple-500/5 border border-purple-400/20 animate-float" style="animation-delay: 1s;"></div>
    <div class="absolute top-[30%] right-[25%] w-8 h-8 rounded-full bg-cyan-400/10 animate-float" style="animation-delay: 2s;"></div>
    <div class="absolute bottom-[25%] left-[20%] w-16 h-16 rounded-full border border-cyan-400/15 animate-float-slow" style="animation-delay: 0.5s;"></div>

    <div class="relative z-10 text-center px-4 max-w-5xl mx-auto">
      <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/5 border border-white/10 mb-8 text-sm text-gray-300">
        <span class="w-2 h-2 rounded-full bg-green-400 animate-pulse"></span>
        Live Music, Unforgettable Nights
      </div>

      <h1 class="hero-title text-5xl md:text-7xl lg:text-8xl font-extrabold leading-[1.05] tracking-tight mb-6">
        <span class="text-white">Feel the</span><br>
        <span class="shimmer-text">Music.</span>
      </h1>

      <p class="text-lg md:text-xl text-gray-400 max-w-2xl mx-auto mb-10 leading-relaxed">
        Discover and book tickets for the most exciting concerts in your city. From intimate acoustic sets to stadium-filling tours — experience live music like never before.
      </p>

      <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
        <a href="{{ route('concerts.index') }}" class="group inline-flex items-center gap-2 px-8 py-4 rounded-2xl text-base font-semibold text-white bg-gradient-to-r from-blue-500 via-purple-600 to-violet-600 hover:from-blue-400 hover:via-purple-500 hover:to-violet-500 transition-all duration-300 shadow-lg shadow-blue-500/25 hover:shadow-blue-500/50 cta-btn">
          Browse Concerts
          <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
        </a>
        <a href="#concerts" class="group inline-flex items-center gap-2 px-8 py-4 rounded-2xl text-base font-medium text-white/80 glass hover:text-white transition-all duration-300 border border-white/10">
          Upcoming Shows
        </a>
      </div>
    </div>

    <div class="absolute bottom-8 left-1/2 -translate-x-1/2 flex flex-col items-center gap-2 text-gray-500">
      <span class="text-xs tracking-widest uppercase">Scroll</span>
      <div class="w-5 h-8 rounded-full border border-gray-600 flex justify-center pt-1.5">
        <div class="w-1 h-2 rounded-full bg-gradient-to-b from-blue-400 to-purple-500 animate-bounce"></div>
      </div>
    </div>
  </section>

  <section id="concerts" class="relative py-24 md:py-32">
    <div class="max-w-6xl mx-auto px-4">
      <div class="text-center mb-16 reveal">
        <span class="text-xs tracking-[4px] uppercase text-blue-400 font-medium">Concerts</span>
        <h2 class="text-3xl md:text-5xl font-bold mt-4 mb-4">Upcoming <span class="neon-text">Events</span></h2>
        <p class="text-gray-400 max-w-xl mx-auto">Don't miss out on the hottest live shows coming to a venue near you.</p>
      </div>

      <div class="grid md:grid-cols-3 gap-6 lg:gap-8" id="concertsList">
      </div>

      <div class="text-center mt-10 reveal">
        <a href="{{ route('concerts.index') }}" class="inline-flex items-center gap-2 px-6 py-3 rounded-xl text-sm font-medium text-white bg-gradient-to-r from-blue-500 to-purple-600 hover:from-blue-400 hover:to-purple-500 transition-all duration-300 cta-btn">
          View All Concerts
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
        </a>
      </div>
    </div>
  </section>

  <section id="features" class="relative py-24 md:py-32">
    <div class="max-w-6xl mx-auto px-4">
      <div class="text-center mb-16 reveal">
        <span class="text-xs tracking-[4px] uppercase text-blue-400 font-medium">Why Choose Us</span>
        <h2 class="text-3xl md:text-5xl font-bold mt-4 mb-4">The Ultimate <span class="neon-text">Experience</span></h2>
      </div>

      <div class="grid md:grid-cols-3 gap-6 lg:gap-8">
        <div class="glass-card p-8 reveal-scale" style="transition-delay: 0.1s;">
          <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-blue-500/20 to-purple-500/20 border border-blue-500/10 flex items-center justify-center mb-6">
            <svg class="w-7 h-7 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16.5 6v.75m0 3v.75m0 3v.75m0 3V18m-6.75-1.5a3 3 0 01-3 3h-1.5a3 3 0 01-3-3v-1.5a3 3 0 013-3h1.5a3 3 0 013 3v1.5zm0 0A3 3 0 0012 15.75h1.5a3 3 0 003-3V12"/></svg>
          </div>
          <h3 class="text-xl font-semibold mb-3 text-white">Easy Booking</h3>
          <p class="text-gray-400 text-sm leading-relaxed">Book your tickets in seconds with our streamlined checkout process. No queues, no hassle.</p>
        </div>

        <div class="glass-card p-8 reveal-scale" style="transition-delay: 0.2s;">
          <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-purple-500/20 to-pink-500/20 border border-purple-500/10 flex items-center justify-center mb-6">
            <svg class="w-7 h-7 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/></svg>
          </div>
          <h3 class="text-xl font-semibold mb-3 text-white">Secure Payments</h3>
          <p class="text-gray-400 text-sm leading-relaxed">Your transactions are protected with bank-grade encryption. Book with confidence every time.</p>
        </div>

        <div class="glass-card p-8 reveal-scale" style="transition-delay: 0.3s;">
          <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-cyan-500/20 to-blue-500/20 border border-cyan-500/10 flex items-center justify-center mb-6">
            <svg class="w-7 h-7 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z"/></svg>
          </div>
          <h3 class="text-xl font-semibold mb-3 text-white">24/7 Support</h3>
          <p class="text-gray-400 text-sm leading-relaxed">Our dedicated support team is always ready to help with any questions or concerns.</p>
        </div>
      </div>
    </div>
  </section>

  <section class="relative py-24 md:py-32">
    <div class="max-w-4xl mx-auto px-4 text-center reveal">
      <div class="glass-card p-12 md:p-16 neon-glow">
        <span class="text-xs tracking-[4px] uppercase text-blue-400 font-medium">Get Started</span>
        <h2 class="text-3xl md:text-5xl font-bold mt-4 mb-4">Ready for an <span class="neon-text">Unforgettable</span> Night?</h2>
        <p class="text-gray-400 max-w-lg mx-auto mb-10">Join thousands of music lovers who book their concert tickets with APS PROJECT.</p>
        <a href="{{ route('register') }}" class="inline-flex items-center gap-2 px-8 py-4 rounded-2xl text-base font-semibold text-white bg-gradient-to-r from-blue-500 via-purple-600 to-violet-600 hover:from-blue-400 hover:via-purple-500 hover:to-violet-500 transition-all duration-300 shadow-lg shadow-blue-500/25 hover:shadow-blue-500/50 cta-btn">
          Create Free Account
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
        </a>
      </div>
    </div>
  </section>

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
            <li><a href="#hero" class="text-gray-500 hover:text-gray-300 text-sm transition">Home</a></li>
          </ul>
        </div>
        <div>
          <h4 class="text-white text-sm font-semibold mb-4">Account</h4>
          <ul class="space-y-3">
            @auth
              <li><a href="{{ route('bookings.history') }}" class="text-gray-500 hover:text-gray-300 text-sm transition">My Bookings</a></li>
              <li><form method="POST" action="{{ route('logout') }}">@csrf<button type="submit" class="text-gray-500 hover:text-gray-300 text-sm transition">Logout</button></form></li>
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

  <script>
    window.addEventListener('load', () => {
      setTimeout(() => document.getElementById('loadingScreen').classList.add('hidden'), 800);
      loadConcerts();
    });

    function toggleMenu() { document.getElementById('mobileMenu').classList.toggle('hidden'); }

    document.querySelectorAll('a[href^="#"]').forEach(a => {
      a.addEventListener('click', function(e) {
        const h = this.getAttribute('href');
        if (h === '#') return;
        e.preventDefault();
        const t = document.querySelector(h);
        if (t) t.scrollIntoView({ behavior: 'smooth' });
      });
    });

    const revealElements = document.querySelectorAll('.reveal, .reveal-left, .reveal-right, .reveal-scale');
    const revealObserver = new IntersectionObserver((entries) => {
      entries.forEach(e => { if (e.isIntersecting) e.target.classList.add('active'); });
    }, { threshold: 0.1, rootMargin: '0px 0px -50px 0px' });
    revealElements.forEach(el => revealObserver.observe(el));

    async function loadConcerts() {
      try {
        const res = await fetch('{{ route("concerts.index") }}?format=json');
        const html = await res.text();
      } catch(e) {}
      try {
        const res = await fetch('/api/concerts/upcoming');
        const data = await res.json();
        const list = document.getElementById('concertsList');
        if (data.length === 0) {
          list.innerHTML = '<div class="col-span-3 text-center py-12 text-gray-500"><div class="text-5xl mb-4 opacity-30">🎵</div><p>No upcoming concerts at the moment.</p></div>';
          return;
        }
        list.innerHTML = data.slice(0, 3).map(c => `
          <div class="glass-card overflow-hidden group">
            <div class="p-6">
              <div class="flex items-center gap-2 mb-2">
                <span class="text-xs px-2 py-1 rounded-full bg-blue-500/10 text-blue-400 border border-blue-500/20">${new Date(c.date).toLocaleDateString('en-GB', {day:'numeric', month:'short', year:'numeric'})}</span>
                <span class="text-xs text-gray-500">${c.time}</span>
              </div>
              <h3 class="text-lg font-semibold text-white mb-1">${c.title}</h3>
              <p class="text-sm text-gray-400 mb-1">${c.artist}</p>
              <p class="text-xs text-gray-500 mb-4">${c.venue}, ${c.city}</p>
              <div class="flex items-center justify-between">
                <span class="text-xl font-bold neon-text">Rp ${Number(c.price).toLocaleString('id-ID')}</span>
                <a href="/concerts/${c.id}" class="px-4 py-2 rounded-xl text-sm font-medium text-white bg-gradient-to-r from-blue-500 to-purple-600 hover:from-blue-400 hover:to-purple-500 transition-all duration-300 cta-btn">Book Now</a>
              </div>
            </div>
          </div>
        `).join('');
      } catch(e) {
        document.getElementById('concertsList').innerHTML = '<div class="col-span-3 text-center py-12 text-gray-500"><p>Loading concerts...</p></div>';
      }
    }
  </script>
</body>
</html>
