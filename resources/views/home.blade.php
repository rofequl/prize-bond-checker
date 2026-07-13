@extends('layouts.portal')

@section('title', 'Price Bond Bangladesh — নিজের বন্ড ট্র্যাক করুন, ড্র ফলাফল যাচাই করুন')
@section('meta_description', 'বাংলাদেশ ব্যাংকের প্রাইজ বন্ড ড্র ফলাফল স্বয়ংক্রিয়ভাবে মিলিয়ে দেখুন। বিনামূল্যে অ্যাকাউন্ট তৈরি করে আপনার সব বন্ড নম্বর সংরক্ষণ করুন এবং সাম্প্রতিক ৮টি বৈধ ড্র-এর সাথে এক ক্লিকে যাচাই করুন।')
@section('canonical', url('/'))

@push('json_ld')
    <script type="application/ld+json">
        @php
            $homeLd = [
                '@context' => 'https://schema.org',
                '@type' => 'WebPage',
                'name' => 'Price Bond Bangladesh',
                'url' => url('/'),
                'inLanguage' => 'bn-BD',
                'isPartOf' => ['@id' => url('/').'#website'],
                'about' => 'বাংলাদেশ ব্যাংকের প্রাইজ বন্ড ট্র্যাকিং ও ড্র ফলাফল যাচাই',
                'description' => 'নাগরিকদের জন্য একটি বিনামূল্যের প্ল্যাটফর্ম, যেখানে প্রাইজ বন্ড নম্বর সংরক্ষণ করে সরকারি ঘোষিত ড্র ফলাফলের সাথে স্বয়ংক্রিয়ভাবে মিলিয়ে দেখা যায়।',
            ];
        @endphp
        {!! json_encode($homeLd, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
    </script>
@endpush

@section('content')
    {{-- Hero --}}
    <section class="relative overflow-hidden">
        <div class="absolute inset-0 -z-10">
            <div class="absolute -top-20 left-1/4 h-72 w-72 rounded-full bg-indigo-200/40 blur-3xl"></div>
            <div class="absolute top-20 right-0 h-96 w-96 rounded-full bg-violet-200/30 blur-3xl"></div>
        </div>

        <div class="portal-shell pt-14 pb-20 sm:pt-20 sm:pb-28">
            <div class="grid gap-14 lg:grid-cols-[1.05fr_0.95fr] lg:items-center">
                {{-- Left --}}
                <div class="space-y-7">
                    <div class="inline-flex items-center gap-2 rounded-full border border-indigo-100 bg-white/90 backdrop-blur px-3.5 py-1.5 shadow-sm">
                        <span class="relative flex h-2 w-2">
                            <span class="absolute inline-flex h-full w-full animate-ping rounded-full bg-emerald-400 opacity-75"></span>
                            <span class="relative inline-flex h-2 w-2 rounded-full bg-emerald-500"></span>
                        </span>
                        <span class="text-xs font-semibold text-slate-700">বাংলাদেশি ডিজিটাল প্রাইজ বন্ড প্ল্যাটফর্ম</span>
                    </div>

                    <h1 class="text-4xl sm:text-5xl lg:text-6xl font-black leading-[1.05] tracking-tight text-slate-900">
                        আপনার বন্ড,
                        <span class="block bg-gradient-to-r from-indigo-600 via-violet-600 to-fuchsia-600 bg-clip-text text-transparent">আপনার ভাগ্য,</span>
                        এক প্ল্যাটফর্মে
                    </h1>

                    <p class="max-w-xl text-lg leading-8 text-slate-600">
                        স্মার্ট নিবন্ধন থেকে তাৎক্ষণিক বিজয়ী শনাক্তকরণ পর্যন্ত। বাংলাদেশের নাগরিকদের জন্য ডিজাইন করা একটি সম্পূর্ণ, নিরাপদ এবং দ্রুত সমাধান।
                    </p>

                    <div class="flex flex-col sm:flex-row gap-3 pt-2">
                        <a href="{{ auth()->check() ? route('dashboard') : route('register') }}" class="btn-primary group text-base px-6 py-3">
                            {{ auth()->check() ? 'ড্যাশবোর্ডে যান' : 'এখনই শুরু করুন' }}
                            <svg class="h-5 w-5 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                            </svg>
                        </a>
                        <a href="{{ route('results.public') }}" class="btn-secondary text-base px-6 py-3">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            ফলাফল দেখুন
                        </a>
                    </div>

                    {{-- Trust indicators --}}
                    <div class="grid grid-cols-3 gap-6 pt-8 border-t border-slate-200">
                        <div>
                            <p class="text-2xl sm:text-3xl font-black text-slate-900">{{ number_format($stats['total_bonds']) }}+</p>
                            <p class="mt-1 text-xs text-slate-500">নিবন্ধিত বন্ড</p>
                        </div>
                        <div>
                            <p class="text-2xl sm:text-3xl font-black text-slate-900">{{ number_format($stats['total_matches']) }}</p>
                            <p class="mt-1 text-xs text-slate-500">বিজয়ী ম্যাচ</p>
                        </div>
                        <div>
                            <p class="text-2xl sm:text-3xl font-black text-slate-900">৮</p>
                            <p class="mt-1 text-xs text-slate-500">বৈধ ড্র উইন্ডো</p>
                        </div>
                    </div>
                </div>

                {{-- Right: Live preview card --}}
                <div class="relative">
                    <div class="absolute -inset-4 -z-10 rounded-3xl bg-gradient-to-tr from-indigo-200 via-violet-200 to-fuchsia-200 opacity-50 blur-2xl"></div>

                    <div class="card-elevated overflow-hidden">
                        <div class="border-b border-slate-100 bg-slate-50/50 px-5 py-3 flex items-center justify-between">
                            <div class="flex items-center gap-1.5">
                                <span class="h-2.5 w-2.5 rounded-full bg-rose-400"></span>
                                <span class="h-2.5 w-2.5 rounded-full bg-amber-400"></span>
                                <span class="h-2.5 w-2.5 rounded-full bg-emerald-400"></span>
                            </div>
                            <span class="text-xs font-medium text-slate-500">ড্র ড্যাশবোর্ড প্রিভিউ</span>
                        </div>

                        <div class="p-6 space-y-5">
                            <div>
                                <div class="flex items-center justify-between mb-3">
                                    <span class="badge-success">
                                        <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                                        লাইভ
                                    </span>
                                    <span class="text-xs text-slate-500">সর্বশেষ আপডেট</span>
                                </div>
                                <p class="text-xs font-semibold uppercase tracking-wider text-slate-500">বর্তমান ড্র</p>
                                <p class="mt-1 text-2xl font-black text-slate-900">{{ $latestDraw?->draw_title ?? 'শীঘ্রই আসছে' }}</p>
                                <p class="text-sm text-slate-500">{{ $latestDraw ? 'বছর: '.$latestDraw->draw_date->format('Y') : 'প্রথম ড্র শীঘ্রই যুক্ত হবে' }}</p>
                                <div class="mt-3 h-1.5 w-full rounded-full bg-slate-100">
                                    <div class="h-full rounded-full bg-gradient-to-r from-indigo-500 to-violet-500" style="width: 78%"></div>
                                </div>
                            </div>

                            <div class="grid grid-cols-2 gap-3">
                                <div class="rounded-xl bg-gradient-to-br from-indigo-50 to-indigo-100/40 border border-indigo-100 p-4">
                                    <div class="flex items-center justify-between">
                                        <span class="text-[10px] font-bold uppercase tracking-wider text-indigo-600">নিবন্ধিত</span>
                                        <svg class="h-4 w-4 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5-5 5M6 12h12"/></svg>
                                    </div>
                                    <p class="mt-2 text-2xl font-black text-slate-900">{{ number_format($stats['total_bonds']) }}</p>
                                    <p class="text-xs text-slate-500">বন্ড সংরক্ষিত</p>
                                </div>
                                <div class="rounded-xl bg-gradient-to-br from-emerald-50 to-emerald-100/40 border border-emerald-100 p-4">
                                    <div class="flex items-center justify-between">
                                        <span class="text-[10px] font-bold uppercase tracking-wider text-emerald-600">বিজয়ী</span>
                                        <svg class="h-4 w-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                    </div>
                                    <p class="mt-2 text-2xl font-black text-slate-900">{{ number_format($stats['total_matches']) }}</p>
                                    <p class="text-xs text-slate-500">যাচাইকৃত ম্যাচ</p>
                                </div>
                            </div>

                            <div class="rounded-xl border border-slate-200 bg-slate-50/50 p-4">
                                <p class="text-[10px] font-bold uppercase tracking-wider text-slate-500 mb-3">কীভাবে কাজ করে</p>
                                <ol class="space-y-2.5">
                                    <li class="flex items-start gap-3">
                                        <span class="flex h-6 w-6 items-center justify-center rounded-full bg-indigo-600 text-[11px] font-bold text-white shrink-0">1</span>
                                        <span class="text-sm text-slate-700 pt-0.5">অ্যাকাউন্ট লগইন বা নতুন নিবন্ধন</span>
                                    </li>
                                    <li class="flex items-start gap-3">
                                        <span class="flex h-6 w-6 items-center justify-center rounded-full bg-violet-600 text-[11px] font-bold text-white shrink-0">2</span>
                                        <span class="text-sm text-slate-700 pt-0.5">প্রাইজ বন্ড নম্বর সংরক্ষণ</span>
                                    </li>
                                    <li class="flex items-start gap-3">
                                        <span class="flex h-6 w-6 items-center justify-center rounded-full bg-fuchsia-600 text-[11px] font-bold text-white shrink-0">3</span>
                                        <span class="text-sm text-slate-700 pt-0.5">স্বয়ংক্রিয় ফলাফল যাচাই</span>
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Latest results --}}
    <section class="portal-shell py-12">
        <div class="card p-6 sm:p-8">
            <div class="flex flex-wrap items-end justify-between gap-3 mb-6">
                <div>
                    <span class="section-label">Latest Results</span>
                    <h2 class="mt-2 text-2xl font-bold text-slate-900">সাম্প্রতিক ড্র ফলাফল</h2>
                    <p class="mt-1 text-sm text-slate-500">সর্বশেষ ৮টি ড্র এর ফলাফল দেখুন।</p>
                </div>
                <a href="{{ route('results.public') }}" class="btn-secondary text-sm">
                    সম্পূর্ণ দেখুন
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                </a>
            </div>

            <div class="overflow-x-auto">
                <table class="table-modern">
                    <thead>
                        <tr>
                            <th>Draw</th>
                            <th>Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($latestResults as $draw)
                            <tr>
                                <td class="font-semibold text-slate-900">{{ $draw->draw_title }}</td>
                                <td>{{ $draw->draw_date->format('d M Y') }}</td>
                                <td>
                                    @if($draw->is_valid)
                                        <span class="badge-success">
                                            <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                                            Valid
                                        </span>
                                    @else
                                        <span class="badge-muted">Expired</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="py-10 text-center text-slate-400">কোনো ফলাফল পাওয়া যায়নি।</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    {{-- Features --}}
    <section class="portal-shell py-16">
        <div class="max-w-2xl">
            <span class="section-label">আমাদের শক্তি</span>
            <h2 class="mt-3 text-3xl sm:text-4xl font-black tracking-tight text-slate-900">
                বাংলাদেশের জন্য নির্মিত, <span class="text-indigo-600">নাগরিকদের দ্বারা বিশ্বস্ত</span>
            </h2>
            <p class="mt-3 text-base text-slate-600">
                একটি আধুনিক ও নিরাপদ প্ল্যাটফর্ম যা আপনার প্রাইজ বন্ডকে ট্র্যাক করতে সাহায্য করে।
            </p>
        </div>

        <div class="mt-10 grid gap-5 lg:grid-cols-3">
            <div class="group card-elevated p-7">
                <div class="icon-badge-indigo">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                </div>
                <h3 class="mt-5 text-xl font-bold text-slate-900">স্থানীয় অভিজ্ঞতা</h3>
                <p class="mt-2 text-slate-600 leading-relaxed">
                    বাংলা ভাষায় সম্পূর্ণ ইন্টারফেস এবং স্থানীয় সংস্কৃতি অনুযায়ী ডিজাইন করা। প্রতিটি ফিচার বাংলাদেশের ব্যবহারকারীদের চাহিদা মাথায় রেখে তৈরি।
                </p>
            </div>

            <div class="group card-elevated p-7">
                <div class="icon-badge-emerald">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                    </svg>
                </div>
                <h3 class="mt-5 text-xl font-bold text-slate-900">এন্টারপ্রাইজ সিকিউরিটি</h3>
                <p class="mt-2 text-slate-600 leading-relaxed">
                    Role-based access নিয়ন্ত্রণ এবং ডেটা এনক্রিপশন সহ সর্বোচ্চ নিরাপত্তা মান। আপনার ব্যক্তিগত তথ্য সম্পূর্ণ সুরক্ষিত এবং গোপনীয়।
                </p>
            </div>

            <div class="group card-elevated p-7">
                <div class="icon-badge-amber">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                </div>
                <h3 class="mt-5 text-xl font-bold text-slate-900">স্কেলেবল আর্কিটেকচার</h3>
                <p class="mt-2 text-slate-600 leading-relaxed">
                    সম্পূর্ণ ড্র হিস্টরি সংরক্ষণ এবং অনুসন্ধান সুবিধা। হাজার হাজার ব্যবহারকারী একযোগে ব্যবহার করতে পারে বিনা সমস্যায়।
                </p>
            </div>
        </div>
    </section>

    {{-- CTA --}}
    <section class="portal-shell pb-20">
        <div class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-indigo-600 via-violet-600 to-fuchsia-600 p-10 sm:p-14">
            <div class="absolute inset-0 -z-10 opacity-30">
                <div class="absolute -top-20 -right-20 h-72 w-72 rounded-full bg-white blur-3xl"></div>
                <div class="absolute -bottom-20 -left-10 h-72 w-72 rounded-full bg-fuchsia-300 blur-3xl"></div>
            </div>

            <div class="grid gap-8 lg:grid-cols-[1.5fr_1fr] lg:items-center">
                <div class="text-white">
                    <h2 class="text-3xl sm:text-4xl font-black tracking-tight">
                        আজই শুরু করুন আপনার যাত্রা
                    </h2>
                    <p class="mt-3 max-w-xl text-base text-indigo-100">
                        লক্ষ লক্ষ ব্যবহারকারী ইতিমধ্যে আমাদের প্ল্যাটফর্মে তাদের বন্ড সংরক্ষণ করছেন এবং তাৎক্ষণিক বিজয়ী শনাক্তকরণ পাচ্ছেন।
                    </p>
                </div>
                <div class="flex flex-col sm:flex-row lg:flex-col gap-3 lg:items-end">
                    <a href="{{ auth()->check() ? route('dashboard') : route('register') }}" class="inline-flex items-center justify-center gap-2 rounded-xl bg-white px-6 py-3 font-semibold text-indigo-700 shadow-lg hover:bg-indigo-50 transition">
                        এখনই যোগদান করুন
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                    </a>
                    <a href="{{ auth()->check() ? route('dashboard.result-verify') : route('login') }}" class="inline-flex items-center justify-center gap-2 rounded-xl border border-white/30 bg-white/10 px-6 py-3 font-semibold text-white backdrop-blur hover:bg-white/20 transition">
                        {{ auth()->check() ? 'ফলাফল যাচাই' : 'লগইন করুন' }}
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
