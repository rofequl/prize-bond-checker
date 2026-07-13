@extends('layouts.portal')

@section('title', 'সর্বশেষ ড্র ফলাফল — Price Bond Bangladesh')
@section('meta_description', 'বাংলাদেশ ব্যাংক কর্তৃক ঘোষিত সাম্প্রতিক প্রাইজ বন্ড ড্র ফলাফল দেখুন। ১ম থেকে ৫ম পুরস্কার পর্যন্ত সব বিজয়ী নম্বর, প্রতিটি ড্র-এর তারিখ ও সরকারি PDF ডাউনলোড।')
@section('canonical', route('results.public'))
@section('og_type', 'article')

@push('json_ld')
    <script type="application/ld+json">
        @php
            $itemList = [
                '@context' => 'https://schema.org',
                '@type' => 'ItemList',
                'name' => 'সাম্প্রতিক প্রাইজ বন্ড ড্র ফলাফল',
                'itemListOrder' => 'https://schema.org/ItemListOrderDescending',
                'numberOfItems' => $draws->count(),
                'itemListElement' => $draws->getCollection()->values()->map(fn ($draw, $i) => [
                    '@type' => 'ListItem',
                    'position' => $i + 1,
                    'name' => $draw->draw_title,
                    'url' => route('results.public').'#draw-'.$draw->id,
                    'datePublished' => $draw->draw_date->toDateString(),
                ])->all(),
            ];
        @endphp
        {!! json_encode($itemList, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
    </script>
    <script type="application/ld+json">
        @php
            $crumbs = [
                '@context' => 'https://schema.org',
                '@type' => 'BreadcrumbList',
                'itemListElement' => [
                    ['@type' => 'ListItem', 'position' => 1, 'name' => 'হোম', 'item' => url('/')],
                    ['@type' => 'ListItem', 'position' => 2, 'name' => 'ড্র ফলাফল', 'item' => route('results.public')],
                ],
            ];
        @endphp
        {!! json_encode($crumbs, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
    </script>
@endpush

@php
    $prizeLabels = ['first' => '১ম পুরস্কার', 'second' => '২য় পুরস্কার', 'third' => '৩য় পুরস্কার', 'fourth' => '৪র্থ পুরস্কার', 'fifth' => '৫ম পুরস্কার'];
    $prizeColors = [
        'first' => 'from-amber-50 to-amber-100/40 border-amber-200 text-amber-800',
        'second' => 'from-indigo-50 to-indigo-100/40 border-indigo-200 text-indigo-800',
        'third' => 'from-emerald-50 to-emerald-100/40 border-emerald-200 text-emerald-800',
        'fourth' => 'from-violet-50 to-violet-100/40 border-violet-200 text-violet-800',
        'fifth' => 'from-slate-50 to-slate-100/40 border-slate-200 text-slate-800',
    ];
@endphp

@section('content')
    <section class="portal-shell py-12 sm:py-16">
        <div class="max-w-3xl mb-10">
            <span class="section-label">পাবলিক ফলাফল</span>
            <h1 class="mt-3 text-3xl sm:text-4xl font-black tracking-tight text-slate-900">
                সর্বশেষ <span class="text-indigo-600">ড্র ফলাফল</span>
            </h1>
            <p class="mt-3 text-base text-slate-600">
                বাংলাদেশ সরকার কর্তৃক ঘোষিত সাম্প্রতিক প্রাইজ বন্ড ড্র ফলাফল। প্রতিটি ড্র এর সাথে সরকারি PDF ডাউনলোড করতে পারবেন।
            </p>
        </div>

        @if($draws->isEmpty())
            <div class="empty-state">
                <svg class="mx-auto h-16 w-16 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                </svg>
                <p class="mt-3 font-medium text-slate-600">এখনো কোনো ড্র ফলাফল পাওয়া যায়নি।</p>
            </div>
        @else
            <div class="space-y-6">
                @foreach($draws as $draw)
                    @php $grouped = $draw->winners->groupBy('prize_type'); @endphp
                    <div id="draw-{{ $draw->id }}" class="card-elevated overflow-hidden">
                        {{-- Draw header --}}
                        <div class="border-b border-slate-200 bg-gradient-to-r from-slate-50 to-white px-6 py-5">
                            <div class="flex flex-wrap items-start justify-between gap-3">
                                <div>
                                    <div class="flex items-center gap-2 mb-1">
                                        @if($draw->is_valid)
                                            <span class="badge-success">
                                                <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                                                বৈধ
                                            </span>
                                        @else
                                            <span class="badge-muted">পুরাতন</span>
                                        @endif
                                        <span class="text-xs text-slate-500">{{ $draw->draw_date->format('d M Y') }}</span>
                                    </div>
                                    <h2 class="text-2xl font-black text-slate-900">{{ $draw->draw_title }}</h2>
                                </div>

                                @if($draw->result_pdf_path)
                                    <a href="{{ asset('storage/'.$draw->result_pdf_path) }}" target="_blank" rel="noopener" class="inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-rose-500 to-rose-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm shadow-rose-500/30 transition hover:shadow-md hover:shadow-rose-500/40">
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0l-4 4m4-4v12"/>
                                        </svg>
                                        সরকারি PDF ডাউনলোড
                                    </a>
                                @else
                                    <span class="inline-flex items-center gap-1.5 rounded-lg border border-slate-200 bg-slate-50 px-3 py-1.5 text-xs font-medium text-slate-500">
                                        <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                                        PDF যুক্ত নেই
                                    </span>
                                @endif
                            </div>
                        </div>

                        {{-- Prize sections --}}
                        <div class="divide-y divide-slate-100">
                            @foreach(['first', 'second', 'third', 'fourth'] as $level)
                                @php
                                    $numbers = $grouped->get($level, collect());
                                    $amount = $draw->{$level.'_prize_amount'};
                                @endphp
                                @if($numbers->isNotEmpty())
                                    <div class="px-6 py-4">
                                        <div class="flex flex-wrap items-center justify-between gap-3 mb-3">
                                            <div class="flex items-center gap-2">
                                                <span class="inline-flex items-center justify-center h-8 w-8 rounded-lg bg-gradient-to-br {{ $prizeColors[$level] }} border text-xs font-bold">
                                                    {{ ['first' => '১', 'second' => '২', 'third' => '৩', 'fourth' => '৪'][$level] }}
                                                </span>
                                                <h3 class="text-base font-bold text-slate-900">{{ $prizeLabels[$level] }}</h3>
                                            </div>
                                            <span class="text-sm font-bold text-emerald-700">৳ {{ number_format((float) $amount, 0) }}</span>
                                        </div>
                                        <div class="flex flex-wrap gap-2">
                                            @foreach($numbers as $winner)
                                                <span class="inline-flex items-center font-mono font-bold text-base bg-gradient-to-br {{ $prizeColors[$level] }} border rounded-lg px-3 py-1.5">
                                                    {{ $winner->bond_number }}
                                                </span>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            @endforeach

                            @php $fifth = $grouped->get('fifth', collect()); @endphp
                            @if($fifth->isNotEmpty())
                                <div class="px-6 py-4">
                                    <div class="flex flex-wrap items-center justify-between gap-3 mb-3">
                                        <div class="flex items-center gap-2">
                                            <span class="inline-flex items-center justify-center h-8 w-8 rounded-lg bg-gradient-to-br {{ $prizeColors['fifth'] }} border text-xs font-bold">৫</span>
                                            <h3 class="text-base font-bold text-slate-900">{{ $prizeLabels['fifth'] }}</h3>
                                            <span class="badge-muted">{{ $fifth->count() }} নম্বর</span>
                                        </div>
                                        <span class="text-sm font-bold text-emerald-700">৳ {{ number_format((float) $draw->fifth_prize_amount, 0) }}</span>
                                    </div>
                                    <div class="grid grid-cols-2 sm:grid-cols-4 md:grid-cols-5 lg:grid-cols-8 gap-1.5">
                                        @foreach($fifth as $winner)
                                            <span class="text-center font-mono font-semibold text-sm bg-slate-50 border border-slate-200 rounded-md py-1.5 text-slate-800">
                                                {{ $winner->bond_number }}
                                            </span>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-8">
                {{ $draws->links() }}
            </div>
        @endif

        {{-- Footer CTA --}}
        <div class="mt-12 rounded-2xl bg-gradient-to-br from-indigo-600 to-violet-600 p-8 text-white">
            <div class="flex flex-wrap items-center justify-between gap-4">
                <div>
                    <h3 class="text-xl font-bold">আপনার বন্ড নম্বর স্বয়ংক্রিয়ভাবে যাচাই করুন</h3>
                    <p class="mt-1 text-indigo-100">অ্যাকাউন্ট তৈরি করে আপনার সব বন্ড সংরক্ষণ করুন এবং প্রতিটি ড্র এর সাথে এক ক্লিকে মিলিয়ে দেখুন।</p>
                </div>
                <a href="{{ auth()->check() ? route('dashboard') : route('register') }}" class="inline-flex items-center gap-2 rounded-xl bg-white px-5 py-2.5 font-semibold text-indigo-700 hover:bg-indigo-50 transition">
                    {{ auth()->check() ? 'ড্যাশবোর্ড' : 'এখনই শুরু করুন' }}
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                </a>
            </div>
        </div>
    </section>
@endsection
