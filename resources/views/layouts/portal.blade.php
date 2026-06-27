<!DOCTYPE html>
<html lang="bn">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title', config('app.name', 'Price Bond Bangladesh'))</title>
        <link rel="icon" type="image/webp" href="{{ asset('images/logo-mark.webp') }}">

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles
    </head>
    <body class="min-h-screen antialiased surface-app">
        <div class="pointer-events-none fixed inset-0 soft-grid opacity-40"></div>

        <div class="relative flex min-h-screen flex-col">
            <header class="sticky top-0 z-40 border-b border-slate-200/80 bg-white/80 backdrop-blur-lg">
                <div class="portal-shell">
                    <div class="flex h-16 items-center justify-between gap-4" x-data="{ open: false }">
                        <a href="{{ route('home') }}" class="flex items-center gap-3">
                            <img src="{{ asset('images/logo-mark.webp') }}" alt="Price Bond" class="h-14 w-auto object-contain">
                            <span class="hidden sm:block">
                                <span class="block text-[10px] font-bold uppercase tracking-[0.22em] text-indigo-600">Price Bond</span>
                                <span class="block text-base font-bold text-slate-900 leading-tight">নাগরিক পোর্টাল</span>
                            </span>
                        </a>

                        <nav class="hidden md:flex items-center gap-1">
                            <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'nav-link-active' : 'nav-link' }}">হোম</a>
                            <a href="{{ route('results.public') }}" class="{{ request()->routeIs('results.public') ? 'nav-link-active' : 'nav-link' }}">ফলাফল</a>
                            <a href="{{ route('help') }}" class="{{ request()->routeIs('help') ? 'nav-link-active' : 'nav-link' }}">সহায়িকা</a>
                            @auth
                                <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'nav-link-active' : 'nav-link' }}">ড্যাশবোর্ড</a>
                                <a href="{{ route('dashboard.result-verify') }}" class="{{ request()->routeIs('dashboard.result-verify') ? 'nav-link-active' : 'nav-link' }}">যাচাই</a>
                            @endauth
                        </nav>

                        <div class="flex items-center gap-2">
                            @auth
                                <div class="hidden sm:flex items-center gap-2 rounded-full bg-slate-100 px-3 py-1.5">
                                    <span class="flex h-7 w-7 items-center justify-center rounded-full bg-gradient-to-br from-indigo-500 to-violet-600 text-xs font-bold text-white">
                                        {{ mb_strtoupper(mb_substr(auth()->user()->name, 0, 1)) }}
                                    </span>
                                    <span class="text-sm font-medium text-slate-700">{{ auth()->user()->name }}</span>
                                </div>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn-ghost text-sm">
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                        </svg>
                                        <span class="hidden sm:inline">লগআউট</span>
                                    </button>
                                </form>
                            @else
                                <a href="{{ route('login') }}" class="hidden sm:inline-flex btn-ghost text-sm">লগইন</a>
                                <a href="{{ route('register') }}" class="btn-primary text-sm py-2">রেজিস্ট্রেশন</a>
                            @endauth

                            <button @click="open = !open" class="md:hidden inline-flex h-10 w-10 items-center justify-center rounded-lg border border-slate-200 text-slate-600 hover:bg-slate-50">
                                <svg x-show="!open" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                                <svg x-show="open" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display:none"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                            </button>
                        </div>

                        <div x-show="open" x-transition class="absolute left-0 right-0 top-16 md:hidden border-b border-slate-200 bg-white shadow-lg" style="display:none">
                            <div class="portal-shell py-3 flex flex-col gap-1">
                                <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'nav-link-active' : 'nav-link' }}">হোম</a>
                                <a href="{{ route('results.public') }}" class="{{ request()->routeIs('results.public') ? 'nav-link-active' : 'nav-link' }}">ফলাফল</a>
                                <a href="{{ route('help') }}" class="{{ request()->routeIs('help') ? 'nav-link-active' : 'nav-link' }}">সহায়িকা</a>
                                @auth
                                    <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'nav-link-active' : 'nav-link' }}">ড্যাশবোর্ড</a>
                                    <a href="{{ route('dashboard.result-verify') }}" class="{{ request()->routeIs('dashboard.result-verify') ? 'nav-link-active' : 'nav-link' }}">ফলাফল যাচাই</a>
                                @else
                                    <a href="{{ route('login') }}" class="nav-link">লগইন</a>
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <main class="flex-1">
                @yield('content')
            </main>

            <footer class="mt-20 border-t border-slate-200 bg-white">
                <div class="portal-shell py-12">
                    <div class="grid gap-10 sm:grid-cols-[1.5fr_1fr_1fr]">
                        <div>
                            <div class="flex items-center gap-3">
                                <img src="{{ asset('images/logo-mark.webp') }}" alt="Price Bond" class="h-12 w-auto object-contain">
                                <span class="text-lg font-bold text-slate-900">Price Bond বাংলাদেশ</span>
                            </div>
                            <p class="mt-4 max-w-sm text-sm leading-7 text-slate-600">
                                নাগরিকদের জন্য নিজের প্রাইজ বন্ড নম্বর সংরক্ষণ, ড্র ফলাফলের সাথে স্বয়ংক্রিয় মিল যাচাই, এবং বিজয়ী শনাক্তকরণের একটি সহজ সেলফ-সার্ভিস টুল।
                            </p>
                        </div>

                        <div>
                            <p class="text-xs font-bold uppercase tracking-[0.18em] text-slate-400">এক্সপ্লোর</p>
                            <nav class="mt-4 flex flex-col gap-2.5 text-sm text-slate-600">
                                <a href="{{ route('home') }}" class="hover:text-indigo-600 transition">হোম</a>
                                <a href="{{ route('results.public') }}" class="hover:text-indigo-600 transition">পাবলিক ফলাফল</a>
                                <a href="{{ route('help') }}" class="hover:text-indigo-600 transition">সহায়িকা</a>
                                @auth
                                    <a href="{{ route('dashboard') }}" class="hover:text-indigo-600 transition">ড্যাশবোর্ড</a>
                                @else
                                    <a href="{{ route('login') }}" class="hover:text-indigo-600 transition">লগইন</a>
                                    <a href="{{ route('register') }}" class="hover:text-indigo-600 transition">রেজিস্ট্রেশন</a>
                                @endauth
                            </nav>
                        </div>

                        <div>
                            <p class="text-xs font-bold uppercase tracking-[0.18em] text-slate-400">কীভাবে কাজ করে</p>
                            <ol class="mt-4 space-y-2.5 text-sm text-slate-600">
                                <li class="flex gap-2"><span class="font-semibold text-indigo-600">১.</span> অ্যাকাউন্ট খুলুন</li>
                                <li class="flex gap-2"><span class="font-semibold text-indigo-600">২.</span> বন্ড নম্বর সংরক্ষণ করুন</li>
                                <li class="flex gap-2"><span class="font-semibold text-indigo-600">৩.</span> ফলাফল যাচাই করুন</li>
                            </ol>
                        </div>
                    </div>

                    <div class="mt-10 border-t border-slate-200 pt-6 flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4 text-xs text-slate-500">
                        <p class="max-w-2xl">এটি নাগরিকদের ব্যক্তিগত bond ট্র্যাকিং সহায়ক টুল — সরকারি অফিসিয়াল ঘোষণার বিকল্প নয়। চূড়ান্ত ফলাফলের জন্য সরকারি সূত্র যাচাই করুন।</p>
                        <div class="flex flex-wrap items-center gap-3">
                            <span>© {{ date('Y') }} <a href="https://nayem.com.bd" target="_blank" rel="noopener" class="font-semibold text-slate-700 hover:text-indigo-600 transition">Md Nayem</a>. All rights reserved.</span>
                            <span class="hidden sm:inline text-slate-300">·</span>
                            <a href="https://github.com/rofequl/price-bond-checker" target="_blank" rel="noopener" class="inline-flex items-center gap-1 hover:text-indigo-600 transition">
                                <svg class="h-3.5 w-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 .297c-6.63 0-12 5.373-12 12 0 5.303 3.438 9.8 8.205 11.385.6.113.82-.258.82-.577 0-.285-.01-1.04-.015-2.04-3.338.724-4.042-1.61-4.042-1.61C4.422 18.07 3.633 17.7 3.633 17.7c-1.087-.744.084-.729.084-.729 1.205.084 1.838 1.236 1.838 1.236 1.07 1.835 2.809 1.305 3.495.998.108-.776.417-1.305.76-1.605-2.665-.3-5.466-1.332-5.466-5.93 0-1.31.465-2.38 1.235-3.22-.135-.303-.54-1.523.105-3.176 0 0 1.005-.322 3.3 1.23.96-.267 1.98-.399 3-.405 1.02.006 2.04.138 3 .405 2.28-1.552 3.285-1.23 3.285-1.23.645 1.653.24 2.873.12 3.176.765.84 1.23 1.91 1.23 3.22 0 4.61-2.805 5.625-5.475 5.92.42.36.81 1.096.81 2.22 0 1.606-.015 2.896-.015 3.286 0 .315.21.69.825.57C20.565 22.092 24 17.592 24 12.297c0-6.627-5.373-12-12-12"/></svg>
                                Source
                            </a>
                            <span class="hidden sm:inline text-slate-300">·</span>
                            <a href="https://github.com/rofequl/price-bond-checker/blob/main/LICENSE" target="_blank" rel="noopener" class="hover:text-indigo-600 transition">MIT License</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>

        @livewireScripts
    </body>
</html>
