<!DOCTYPE html>
<html lang="bn">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title', config('app.name', 'Price Bond Bangladesh'))</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles
    </head>
    <body class="min-h-screen antialiased">
        <div class="pointer-events-none fixed inset-0 soft-grid opacity-30"></div>
        <div class="pointer-events-none fixed -left-24 top-24 h-72 w-72 rounded-full bg-emerald-400/20 blur-3xl"></div>
        <div class="pointer-events-none fixed right-0 top-40 h-80 w-80 rounded-full bg-rose-500/15 blur-3xl"></div>

        <div class="relative flex min-h-screen flex-col">
            <header class="portal-shell pt-6">
                <div class="glass-card flex flex-col gap-5 px-5 py-4 sm:px-6 lg:flex-row lg:items-center lg:justify-between">
                    <a href="{{ route('home') }}" class="flex items-center gap-3">
                        <span class="flex h-12 w-12 items-center justify-center rounded-2xl bg-gradient-to-br from-emerald-300 via-lime-200 to-amber-200 text-slate-950 shadow-lg shadow-emerald-950/30">
                            <span class="text-lg font-black">PB</span>
                        </span>
                        <span>
                            <span class="block text-sm font-semibold uppercase tracking-[0.3em] text-emerald-100/80">Price Bond</span>
                            <span class="block text-lg font-bold text-white">বাংলাদেশ নাগরিক পোর্টাল</span>
                        </span>
                    </a>

                    <nav class="flex flex-wrap items-center gap-3 text-sm font-medium text-slate-200/90">
                        <a href="{{ route('home') }}" class="rounded-full px-4 py-2 transition hover:bg-white/10">Home</a>
                        @auth
                            <a href="{{ route('dashboard') }}" class="rounded-full px-4 py-2 transition hover:bg-white/10">Dashboard</a>
                            <a href="{{ route('dashboard.result-verify') }}" class="rounded-full px-4 py-2 transition hover:bg-white/10">Result Verify</a>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="rounded-full px-4 py-2 transition hover:bg-white/10">Logout</button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="rounded-full px-4 py-2 transition hover:bg-white/10">Login</a>
                            <a href="{{ route('register') }}" class="rounded-full px-4 py-2 transition hover:bg-white/10">Registration</a>
                        @endauth
                    </nav>
                </div>
            </header>

            <main class="flex-1">
                @yield('content')
            </main>

            <footer class="portal-shell pb-8 pt-12">
                <div class="glass-card flex flex-col gap-3 px-5 py-5 text-sm text-slate-300 sm:px-6 md:flex-row md:items-center md:justify-between">
                    <p>নাগরিকদের জন্য সহজে price bond register, draw check, এবং winner lookup.</p>
                    <p>Design direction: Bangladesh-first, bilingual-ready, admin-friendly.</p>
                </div>
            </footer>
        </div>

        @livewireScripts
    </body>
</html>
