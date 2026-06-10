@extends('layouts.portal')

@section('title', 'Price Bond Bangladesh | Home')

@section('content')
    <!-- Hero Section with Modern Gradient Background -->
    <section class="relative overflow-hidden portal-shell pt-12 sm:pt-20 lg:pt-24 pb-16">
        <!-- Decorative elements -->
        <div class="absolute inset-0 -z-10">
            <div class="absolute top-20 left-10 w-72 h-72 bg-emerald-500/10 rounded-full blur-3xl"></div>
            <div class="absolute bottom-10 right-5 w-96 h-96 bg-blue-500/5 rounded-full blur-3xl"></div>
        </div>

        <div class="grid gap-12 lg:grid-cols-[1.15fr_0.85fr] lg:items-center">
            <!-- Left Content -->
            <div class="space-y-8">
                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-emerald-500/10 border border-emerald-500/30 backdrop-blur-sm w-fit">
                    <div class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></div>
                    <span class="text-sm font-medium text-emerald-300">বাংলাদেশি ডিজিটাল প্রাইজ বন্ড</span>
                </div>

                <div class="space-y-5">
                    <h1 class="max-w-3xl text-4xl sm:text-5xl lg:text-6xl font-black leading-tight bg-clip-text text-transparent bg-gradient-to-r from-white via-emerald-100 to-emerald-200">
                        আপনার বন্ড, আপনার ভাগ্য, এক প্ল্যাটফর্মে
                    </h1>
                    <p class="max-w-2xl text-lg leading-8 text-slate-300/90 font-light">
                        স্মার্ট নিবন্ধন থেকে তাৎক্ষণিক বিজয়ী শনাক্তকরণ পর্যন্ত। বাংলাদেশের নাগরিকদের জন্য ডিজাইন করা একটি সম্পূর্ণ, নিরাপদ এবং দ্রুত সমাধান।
                    </p>
                </div>

                <!-- CTA Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 pt-2">
                    <a href="{{ auth()->check() ? route('dashboard') : route('login') }}" class="group inline-flex items-center justify-center gap-2 rounded-lg bg-gradient-to-r from-emerald-500 to-emerald-600 px-8 py-3.5 font-semibold text-white shadow-lg shadow-emerald-600/40 transition-all duration-300 hover:shadow-emerald-600/60 hover:-translate-y-1 active:translate-y-0">
                        <svg class="w-5 h-5 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                        </svg>
                        সিটিজেন প্যানেল এক্সপ্লোর করুন
                    </a>
                    <a href="{{ auth()->check() ? route('dashboard') : route('register') }}" class="inline-flex items-center justify-center gap-2 rounded-lg border border-slate-400/30 bg-white/5 backdrop-blur-md px-8 py-3.5 font-semibold text-white transition-all duration-300 hover:bg-white/10 hover:border-slate-300/50 hover:-translate-y-1 active:translate-y-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path>
                        </svg>
                        {{ auth()->check() ? 'ড্যাশবোর্ড' : 'রেজিস্ট্রেশন' }}
                    </a>
                </div>

                <!-- Feature Pills -->
                <div class="grid gap-3 sm:grid-cols-3 pt-4">
                    <div class="group glass-card p-5 transition-all duration-300 hover:border-emerald-500/50 hover:shadow-lg hover:shadow-emerald-500/10">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-lg bg-emerald-500/20 flex items-center justify-center flex-shrink-0 group-hover:bg-emerald-500/30 transition-colors">
                                <svg class="w-6 h-6 text-emerald-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs font-medium text-slate-400 uppercase tracking-wider">নিবন্ধন</p>
                                <p class="text-sm font-bold text-white">সহজ একাউন্ট</p>
                            </div>
                        </div>
                    </div>
                    <div class="group glass-card p-5 transition-all duration-300 hover:border-blue-500/50 hover:shadow-lg hover:shadow-blue-500/10">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-lg bg-blue-500/20 flex items-center justify-center flex-shrink-0 group-hover:bg-blue-500/30 transition-colors">
                                <svg class="w-6 h-6 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs font-medium text-slate-400 uppercase tracking-wider">রিয়েল-টাইম</p>
                                <p class="text-sm font-bold text-white">দ্রুত ফলাফল</p>
                            </div>
                        </div>
                    </div>
                    <div class="group glass-card p-5 transition-all duration-300 hover:border-amber-500/50 hover:shadow-lg hover:shadow-amber-500/10">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-lg bg-amber-500/20 flex items-center justify-center flex-shrink-0 group-hover:bg-amber-500/30 transition-colors">
                                <svg class="w-6 h-6 text-amber-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs font-medium text-slate-400 uppercase tracking-wider">স্বয়ংক্রিয়</p>
                                <p class="text-sm font-bold text-white">বিজয়ী ম্যাচিং</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Live Preview Card -->
            <div class="glass-card overflow-hidden border-white/15 p-7 shadow-[0_40px_100px_rgba(0,0,0,0.4)] group hover:shadow-[0_40px_100px_rgba(16,185,129,0.15)] transition-shadow duration-500">
                <div class="rounded-2xl bg-gradient-to-br from-slate-950/60 to-slate-900/40 p-7 border border-white/5">
                    <!-- Live Badge -->
                    <div class="flex items-center justify-between mb-6">
                        <div>
                            <div class="flex items-center gap-2 mb-2">
                                <div class="w-2 h-2 rounded-full bg-red-500 animate-pulse shadow-lg shadow-red-500/50"></div>
                                <p class="text-xs font-semibold text-red-400 uppercase tracking-wider">LIVE</p>
                            </div>
                            <h2 class="text-2xl font-bold text-white">ড্র ড্যাশবোর্ড</h2>
                        </div>
                        <div class="text-right">
                            <p class="text-xs text-slate-400">সর্বশেষ আপডেট</p>
                            <p class="text-lg font-bold text-emerald-400">এখনই</p>
                        </div>
                    </div>

                    <!-- Draw Info Card -->
                    <div class="space-y-4">
                        <div class="rounded-xl bg-gradient-to-br from-white/10 to-white/5 border border-white/10 p-5 backdrop-blur-sm">
                            <p class="text-xs font-medium text-slate-400 uppercase tracking-wider">বর্তমান ড্র</p>
                            <p class="mt-3 text-3xl font-bold text-white">59তম আহরণ</p>
                            <p class="mt-2 text-sm text-slate-400">বছর: 2026</p>
                            <div class="mt-4 h-1 bg-gradient-to-r from-emerald-500 to-blue-500 rounded-full"></div>
                        </div>

                        <!-- Stats Grid -->
                        <div class="grid grid-cols-2 gap-3">
                            <div class="rounded-xl bg-gradient-to-br from-emerald-500/20 to-emerald-600/10 border border-emerald-500/30 p-4">
                                <p class="text-xs font-medium text-emerald-300 uppercase tracking-wider mb-2">নিবন্ধিত বন্ড</p>
                                <p class="text-2xl font-black text-white">12,480</p>
                                <p class="text-xs text-emerald-300/70 mt-1">↑ সক্রিয়</p>
                            </div>
                            <div class="rounded-xl bg-gradient-to-br from-amber-500/20 to-amber-600/10 border border-amber-500/30 p-4">
                                <p class="text-xs font-medium text-amber-300 uppercase tracking-wider mb-2">বিজয়ী ম্যাচ</p>
                                <p class="text-2xl font-black text-white">248</p>
                                <p class="text-xs text-amber-300/70 mt-1">✓ যাচাইকৃত</p>
                            </div>
                        </div>

                        <!-- Process Steps -->
                        <div class="rounded-xl border border-dashed border-white/20 bg-white/5 p-5 backdrop-blur-sm">
                            <p class="text-xs font-bold text-slate-300 uppercase tracking-wider mb-4">প্রক্রিয়া</p>
                            <div class="space-y-3">
                                <div class="flex items-start gap-3">
                                    <div class="flex-shrink-0 w-6 h-6 rounded-full bg-emerald-500/30 border border-emerald-500/50 flex items-center justify-center text-xs font-bold text-emerald-300">1</div>
                                    <p class="text-sm text-slate-300 pt-0.5">অ্যাকাউন্ট লগইন বা নতুন নিবন্ধন</p>
                                </div>
                                <div class="flex items-start gap-3">
                                    <div class="flex-shrink-0 w-6 h-6 rounded-full bg-blue-500/30 border border-blue-500/50 flex items-center justify-center text-xs font-bold text-blue-300">2</div>
                                    <p class="text-sm text-slate-300 pt-0.5">আপনার Price Bond নম্বর সংরক্ষণ করুন</p>
                                </div>
                                <div class="flex items-start gap-3">
                                    <div class="flex-shrink-0 w-6 h-6 rounded-full bg-amber-500/30 border border-amber-500/50 flex items-center justify-center text-xs font-bold text-amber-300">3</div>
                                    <p class="text-sm text-slate-300 pt-0.5">ড্র ফলাফল আপডেট হলে স্বয়ংক্রিয় নোটিফিকেশন</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="portal-shell py-8 sm:py-12">
        <div class="glass-card p-6">
            <div class="flex flex-wrap items-center justify-between gap-3">
                <div>
                    <h2 class="text-2xl font-bold text-white">Latest Results</h2>
                    <p class="mt-1 text-sm text-slate-300">Showing first 8 recent draw results.</p>
                </div>
                <a href="{{ auth()->check() ? route('dashboard.result-verify') : route('login') }}" class="rounded-xl border border-emerald-400/40 bg-emerald-500/10 px-4 py-2 text-sm font-semibold text-emerald-200 hover:bg-emerald-500/20">
                    View Result
                </a>
            </div>

            <div class="mt-4 overflow-x-auto">
                <table class="min-w-full text-left text-sm">
                    <thead class="text-slate-300">
                        <tr>
                            <th class="py-2 pr-4">Draw</th>
                            <th class="py-2 pr-4">Series</th>
                            <th class="py-2 pr-4">Date</th>
                            <th class="py-2 pr-4">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($latestResults as $draw)
                            <tr class="border-t border-white/10 text-slate-200">
                                <td class="py-2 pr-4">{{ $draw->draw_title }}</td>
                                <td class="py-2 pr-4">{{ $draw->series->name }}</td>
                                <td class="py-2 pr-4">{{ $draw->draw_date->format('d M Y') }}</td>
                                <td class="py-2 pr-4">
                                    <span class="text-xs {{ $draw->is_valid ? 'text-emerald-300' : 'text-slate-400' }}">{{ $draw->is_valid ? 'Valid' : 'Expired' }}</span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="py-3 text-slate-400">No results found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <!-- Why Choose Us Section -->
    <section class="relative portal-shell py-16 sm:py-24">
        <div class="mb-14">
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-blue-500/10 border border-blue-500/30 backdrop-blur-sm">
                <span class="text-sm font-medium text-blue-300">আমাদের শক্তি</span>
            </div>
            <h2 class="mt-4 text-3xl sm:text-4xl font-bold text-white max-w-2xl">
                বাংলাদেশের জন্য নির্মিত, নাগরিকদের দ্বারা বিশ্বস্ত
            </h2>
        </div>

        <div class="grid gap-6 lg:grid-cols-3">
            <!-- Card 1 -->
            <div class="group glass-card p-8 rounded-2xl hover:border-emerald-500/50 transition-all duration-300 hover:shadow-lg hover:shadow-emerald-500/10">
                <div class="inline-flex items-center justify-center w-14 h-14 rounded-lg bg-gradient-to-br from-emerald-500/30 to-emerald-600/20 group-hover:from-emerald-500/40 group-hover:to-emerald-600/30 transition-all">
                    <svg class="w-7 h-7 text-emerald-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                </div>
                <h3 class="mt-6 text-xl font-bold text-white">স্থানীয় অভিজ্ঞতা</h3>
                <p class="mt-3 text-slate-300 leading-relaxed">
                    বাংলা ভাষায় সম্পূর্ণ ইন্টারফেস এবং স্থানীয় সংস্কৃতি অনুযায়ী ডিজাইন করা। প্রতিটি ফিচার বাংলাদেশের ব্যবহারকারীদের চাহিদা মাথায় রেখে তৈরি।
                </p>
            </div>

            <!-- Card 2 -->
            <div class="group glass-card p-8 rounded-2xl hover:border-blue-500/50 transition-all duration-300 hover:shadow-lg hover:shadow-blue-500/10">
                <div class="inline-flex items-center justify-center w-14 h-14 rounded-lg bg-gradient-to-br from-blue-500/30 to-blue-600/20 group-hover:from-blue-500/40 group-hover:to-blue-600/30 transition-all">
                    <svg class="w-7 h-7 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                    </svg>
                </div>
                <h3 class="mt-6 text-xl font-bold text-white">এন্টারপ্রাইজ সিকিউরিটি</h3>
                <p class="mt-3 text-slate-300 leading-relaxed">
                    Role-based access নিয়ন্ত্রণ এবং ডেটা এনক্রিপশন সহ সর্বোচ্চ নিরাপত্তা মান। আপনার ব্যক্তিগত তথ্য সম্পূর্ণ সুরক্ষিত এবং গোপনীয়।
                </p>
            </div>

            <!-- Card 3 -->
            <div class="group glass-card p-8 rounded-2xl hover:border-amber-500/50 transition-all duration-300 hover:shadow-lg hover:shadow-amber-500/10">
                <div class="inline-flex items-center justify-center w-14 h-14 rounded-lg bg-gradient-to-br from-amber-500/30 to-amber-600/20 group-hover:from-amber-500/40 group-hover:to-amber-600/30 transition-all">
                    <svg class="w-7 h-7 text-amber-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                </div>
                <h3 class="mt-6 text-xl font-bold text-white">স্কেলেবল আর্কিটেকচার</h3>
                <p class="mt-3 text-slate-300 leading-relaxed">
                    সম্পূর্ণ ড্র হিস্টরি সংরক্ষণ এবং অনুসন্ধান সুবিধা। হাজার হাজার ব্যবহারকারী একযোগে ব্যবহার করতে পারে বিনা সমস্যায়।
                </p>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="relative portal-shell py-16 sm:py-20">
        <div class="glass-card p-12 rounded-2xl border-emerald-500/30 overflow-hidden">
            <div class="absolute inset-0 -z-10">
                <div class="absolute top-0 right-0 w-80 h-80 bg-emerald-500/10 rounded-full blur-3xl"></div>
            </div>
            <div class="max-w-2xl">
                <h2 class="text-3xl sm:text-4xl font-bold text-white mb-4">
                    আজই শুরু করুন আপনার যাত্রা
                </h2>
                <p class="text-lg text-slate-300 mb-8">
                    লক্ষ লক্ষ ব্যবহারকারী ইতিমধ্যে আমাদের প্ল্যাটফর্মে তাদের বন্ড সংরক্ষণ করছেন এবং তাৎক্ষণিক বিজয়ী শনাক্তকরণ পাচ্ছেন।
                </p>
                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="{{ auth()->check() ? route('dashboard') : route('register') }}" class="inline-flex items-center justify-center gap-2 rounded-lg bg-gradient-to-r from-emerald-500 to-emerald-600 px-8 py-3.5 font-semibold text-white shadow-lg shadow-emerald-600/40 hover:shadow-emerald-600/60 transition-all">
                        এখনই যোগদান করুন
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
