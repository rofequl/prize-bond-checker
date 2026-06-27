@extends('layouts.portal')

@section('title', 'কীভাবে ব্যবহার করবেন | Price Bond Bangladesh')

@section('content')
    {{-- Hero --}}
    <section class="portal-shell py-14 sm:py-20">
        <div class="max-w-3xl">
            <span class="section-label">সহায়িকা</span>
            <h1 class="mt-3 text-3xl sm:text-5xl font-black tracking-tight text-slate-900 leading-tight">
                কীভাবে <span class="text-indigo-600">Price Bond</span> ব্যবহার করবেন?
            </h1>
            <p class="mt-4 text-base sm:text-lg leading-8 text-slate-600">
                সম্পূর্ণ প্রক্রিয়াটি ৪টি সহজ ধাপে বিভক্ত। নতুন ব্যবহারকারীরা মাত্র কয়েক মিনিটেই শুরু করতে পারবেন।
            </p>
        </div>
    </section>

    {{-- Steps --}}
    <section class="portal-shell pb-16">
        <div class="grid gap-6 sm:grid-cols-2">
            {{-- Step 1 --}}
            <div class="card-elevated p-6 relative overflow-hidden">
                <div class="absolute top-4 right-4 text-7xl font-black text-indigo-100 leading-none">01</div>
                <div class="icon-badge-brand relative">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                    </svg>
                </div>
                <h2 class="mt-5 text-2xl font-bold text-slate-900 relative">অ্যাকাউন্ট তৈরি করুন</h2>
                <p class="mt-2 text-slate-600 leading-relaxed relative">
                    আপনার নাম, ইমেইল এবং পাসওয়ার্ড দিয়ে কয়েক সেকেন্ডে একটি ফ্রি অ্যাকাউন্ট তৈরি করুন। চাইলে মোবাইল নম্বর দিয়েও পরে লগইন করতে পারবেন।
                </p>
                <ul class="mt-4 space-y-2 text-sm text-slate-600 relative">
                    <li class="flex items-start gap-2">
                        <svg class="h-5 w-5 text-emerald-500 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                        সম্পূর্ণ বিনামূল্যে
                    </li>
                    <li class="flex items-start gap-2">
                        <svg class="h-5 w-5 text-emerald-500 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                        কোনো ক্রেডিট কার্ড লাগে না
                    </li>
                </ul>
                @guest
                    <a href="{{ route('register') }}" class="mt-6 btn-primary relative">রেজিস্ট্রেশন করুন</a>
                @endguest
            </div>

            {{-- Step 2 --}}
            <div class="card-elevated p-6 relative overflow-hidden">
                <div class="absolute top-4 right-4 text-7xl font-black text-violet-100 leading-none">02</div>
                <div class="icon-badge-brand relative">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                    </svg>
                </div>
                <h2 class="mt-5 text-2xl font-bold text-slate-900 relative">ব্লক তৈরি করুন</h2>
                <p class="mt-2 text-slate-600 leading-relaxed relative">
                    "ব্লক" হলো আপনার প্রাইজ বন্ড নম্বর গুলো গুছিয়ে রাখার একটি দল। যেমন: "আমার নিজের বন্ড", "বাবার বন্ড", ইত্যাদি। প্রতি ব্লকে সর্বোচ্চ ১০০টি বন্ড রাখা যায়।
                </p>
                <div class="mt-4 rounded-xl bg-indigo-50/60 border border-indigo-100 p-3 relative">
                    <p class="text-xs font-bold text-indigo-700 uppercase tracking-wider mb-1">কেন ব্লক?</p>
                    <p class="text-sm text-slate-700">একাধিক ব্লক ব্যবহার করে পরিবারের সদস্যদের বন্ড আলাদা ভাবে সংরক্ষণ ও যাচাই করতে পারবেন।</p>
                </div>
            </div>

            {{-- Step 3 --}}
            <div class="card-elevated p-6 relative overflow-hidden">
                <div class="absolute top-4 right-4 text-7xl font-black text-emerald-100 leading-none">03</div>
                <div class="icon-badge-brand relative">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
                <h2 class="mt-5 text-2xl font-bold text-slate-900 relative">বন্ড নম্বর যুক্ত করুন</h2>
                <p class="mt-2 text-slate-600 leading-relaxed relative">
                    প্রতিটি ব্লকে আপনার Price Bond এর সিরিজ ও নম্বর যুক্ত করুন। ভুল হলে যেকোনো সময় এডিট করতে পারবেন।
                </p>
                <ul class="mt-4 space-y-2 text-sm text-slate-600 relative">
                    <li class="flex items-start gap-2">
                        <svg class="h-5 w-5 text-emerald-500 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                        সিরিজ + ৭ ডিজিট নম্বর
                    </li>
                    <li class="flex items-start gap-2">
                        <svg class="h-5 w-5 text-emerald-500 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                        খোঁজা ও ফিল্টার সুবিধা
                    </li>
                </ul>
            </div>

            {{-- Step 4 --}}
            <div class="card-elevated p-6 relative overflow-hidden">
                <div class="absolute top-4 right-4 text-7xl font-black text-fuchsia-100 leading-none">04</div>
                <div class="icon-badge-brand relative">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <h2 class="mt-5 text-2xl font-bold text-slate-900 relative">ফলাফল যাচাই করুন</h2>
                <p class="mt-2 text-slate-600 leading-relaxed relative">
                    "ফলাফল চেক করুন" বাটনে ক্লিক করুন — সিস্টেম স্বয়ংক্রিয়ভাবে আপনার সব বন্ডকে সাম্প্রতিক ৮টি বৈধ ড্র এর বিজয়ী তালিকার সাথে মিলিয়ে দেখাবে।
                </p>
                <div class="mt-4 rounded-xl bg-emerald-50/60 border border-emerald-100 p-3 relative">
                    <p class="text-xs font-bold text-emerald-700 uppercase tracking-wider mb-1">বিজয়ী হলে?</p>
                    <p class="text-sm text-slate-700">মিলে গেলে স্বয়ংক্রিয়ভাবে সংরক্ষিত হবে — পুরস্কারের পরিমাণ, ড্র তারিখ ও ক্যাটাগরি সহ।</p>
                </div>
            </div>
        </div>
    </section>

    {{-- FAQ --}}
    <section class="portal-shell py-12">
        <div class="card p-8 sm:p-10">
            <div class="mb-8">
                <span class="section-label">FAQ</span>
                <h2 class="mt-2 text-3xl font-black tracking-tight text-slate-900">সাধারণ প্রশ্নাবলী</h2>
            </div>

            <div class="space-y-3" x-data="{ open: 0 }">
                @php
                    $faqs = [
                        [
                            'q' => 'এই সাইট কি সরকারি?',
                            'a' => 'না, এটি একটি বেসরকারি নাগরিক সহায়ক টুল। আমরা বাংলাদেশ ব্যাংকের প্রকাশিত অফিসিয়াল ড্র ফলাফল ব্যবহার করি। চূড়ান্ত নিশ্চিতকরণের জন্য সর্বদা সরকারি PDF যাচাই করুন।',
                        ],
                        [
                            'q' => 'আমার তথ্য কি নিরাপদ?',
                            'a' => 'হ্যাঁ। আপনার পাসওয়ার্ড এনক্রিপ্ট করে সংরক্ষণ করা হয় এবং আপনার বন্ড নম্বর শুধুমাত্র আপনিই দেখতে পারবেন। আমরা কখনো তৃতীয় পক্ষের সাথে তথ্য শেয়ার করি না।',
                        ],
                        [
                            'q' => 'কতগুলো বন্ড সংরক্ষণ করতে পারব?',
                            'a' => 'প্রতিটি ব্লকে সর্বোচ্চ ১০০টি বন্ড। আপনি যত খুশি ব্লক তৈরি করতে পারবেন — কোনো সীমাবদ্ধতা নেই।',
                        ],
                        [
                            'q' => 'কোন ড্র গুলোর সাথে মিলানো হয়?',
                            'a' => 'বাংলাদেশ ব্যাংক প্রতি ৩ মাসে একটি করে ড্র অনুষ্ঠিত করে। আমাদের সিস্টেম সর্বশেষ ৮টি বৈধ ড্র (গত ২ বছর) এর সাথে মিলিয়ে দেখায়, যা সরকারি নিয়ম অনুসারে দাবি করার সময়সীমার মধ্যে পড়ে।',
                        ],
                        [
                            'q' => 'বিজয়ী হলে কীভাবে পুরস্কার নেব?',
                            'a' => 'আমরা শুধু মিলিয়ে দেখার সুবিধা দিই — পুরস্কার সংগ্রহ করতে হবে বাংলাদেশ ব্যাংকের নির্দেশিকা অনুসারে। মূল bond এবং পরিচয়পত্র নিয়ে নির্ধারিত শাখায় যোগাযোগ করুন।',
                        ],
                        [
                            'q' => 'খরচ কত?',
                            'a' => 'সম্পূর্ণ বিনামূল্যে। কোনো subscription, কোনো premium feature, কোনো hidden charge নেই।',
                        ],
                    ];
                @endphp

                @foreach($faqs as $i => $faq)
                    <div class="rounded-xl border border-slate-200 bg-white overflow-hidden">
                        <button type="button" @click="open = open === {{ $i }} ? null : {{ $i }}" class="w-full flex items-center justify-between gap-3 px-5 py-4 text-left hover:bg-slate-50/60 transition">
                            <span class="font-semibold text-slate-900">{{ $faq['q'] }}</span>
                            <svg class="h-5 w-5 text-slate-400 transition-transform" :class="open === {{ $i }} ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </button>
                        <div x-show="open === {{ $i }}" x-transition class="px-5 pb-4 text-slate-600 leading-relaxed" style="display:none">
                            {{ $faq['a'] }}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- CTA --}}
    <section class="portal-shell pb-20">
        <div class="rounded-2xl bg-gradient-to-br from-indigo-600 to-violet-600 p-8 sm:p-10 text-white">
            <div class="grid gap-6 lg:grid-cols-[1.5fr_1fr] lg:items-center">
                <div>
                    <h3 class="text-2xl sm:text-3xl font-black">এখনো প্রশ্ন আছে?</h3>
                    <p class="mt-2 text-indigo-100">সবচেয়ে ভালো উপায় হলো নিজে চেষ্টা করে দেখা। কয়েক সেকেন্ডে অ্যাকাউন্ট তৈরি করুন এবং একটি ডামি বন্ড যুক্ত করে দেখুন।</p>
                </div>
                <div class="flex flex-col sm:flex-row gap-3 lg:justify-end">
                    @guest
                        <a href="{{ route('register') }}" class="inline-flex items-center justify-center gap-2 rounded-xl bg-white px-5 py-3 font-semibold text-indigo-700 hover:bg-indigo-50 transition">
                            শুরু করুন
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                        </a>
                    @endguest
                    <a href="{{ route('results.public') }}" class="inline-flex items-center justify-center gap-2 rounded-xl border border-white/30 bg-white/10 px-5 py-3 font-semibold text-white backdrop-blur hover:bg-white/20 transition">
                        ফলাফল দেখুন
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
