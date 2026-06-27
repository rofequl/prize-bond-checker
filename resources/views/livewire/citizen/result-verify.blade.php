@php
    $prizeLabels = ['first' => '১ম', 'second' => '২য়', 'third' => '৩য়', 'fourth' => '৪র্থ', 'fifth' => '৫ম'];
@endphp

<section class="portal-shell py-10 sm:py-12">
    <div class="flex flex-wrap items-end justify-between gap-4 mb-8">
        <div>
            <span class="section-label">ফলাফল যাচাই</span>
            <h1 class="mt-2 text-3xl sm:text-4xl font-black tracking-tight text-slate-900">
                আপনার বন্ড ফলাফল <span class="text-indigo-600">যাচাই করুন</span>
            </h1>
            <p class="mt-1 text-sm text-slate-500">সাম্প্রতিক ৮টি বৈধ ড্র এর সাথে আপনার বন্ড স্বয়ংক্রিয়ভাবে মিলিয়ে দেখুন</p>
        </div>
        <a href="{{ route('dashboard') }}" class="btn-secondary">
            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            ড্যাশবোর্ডে ফিরুন
        </a>
    </div>

    <div class="grid gap-6 lg:grid-cols-[1fr_1.35fr]">
        {{-- Verification panel --}}
        <div class="card p-6">
            <div class="flex items-center gap-3 mb-4">
                <div class="icon-badge-brand">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div>
                    <h2 class="text-lg font-bold text-slate-900">ভেরিফিকেশন চালান</h2>
                    <p class="text-xs text-slate-500">সংরক্ষিত বন্ড নম্বর মিলিয়ে দেখুন</p>
                </div>
            </div>

            <p class="text-sm leading-7 text-slate-600">
                এই প্রক্রিয়া আপনার সংরক্ষিত সব বন্ড নম্বরকে সাম্প্রতিক বৈধ ৮টি ড্র-এর বিজয়ী তালিকার সাথে মিলিয়ে দেখে, ব্লক ধরে ধরে একটির পর একটি। মিল পেলে তা স্বয়ংক্রিয়ভাবে পাশের তালিকায় সংরক্ষণ হয়ে যাবে।
            </p>

            @error('verification')
                <div class="alert-error mt-4">{{ $message }}</div>
            @enderror

            @if($runMessage)
                <div class="alert-success mt-4">{{ $runMessage }}</div>
            @endif

            @if(! $hasBlocks)
                <div class="empty-state mt-5">
                    এখনো কোনো ব্লক বা বন্ড সংরক্ষণ করা হয়নি। যাচাই শুরু করার আগে
                    <a href="{{ route('dashboard') }}" class="font-semibold text-indigo-600 hover:text-indigo-700">ড্যাশবোর্ড থেকে একটি ব্লক তৈরি করে বন্ড যুক্ত করুন</a>।
                </div>
            @else
                <button
                    type="button"
                    wire:click="startVerification"
                    wire:loading.attr="disabled"
                    class="btn-primary mt-5 w-full"
                >
                    @if($isProcessing)
                        <span class="h-4 w-4 animate-spin rounded-full border-2 border-white border-t-transparent"></span>
                        প্রসেস হচ্ছে...
                    @else
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                        ফলাফল চেক করুন
                    @endif
                </button>
            @endif

            @if($isProcessing)
                <div wire:poll.900ms="processNextBlock"></div>
            @endif

            <div class="mt-6 space-y-2">
                @forelse($blockProgress as $item)
                    @php
                        $isCurrent = $currentBlockId === (int) $item['id'];
                        $isDone = $item['status'] === 'completed';
                    @endphp
                    <div class="flex items-center gap-3 rounded-xl border {{ $isDone ? 'border-emerald-200 bg-emerald-50/50' : ($isCurrent ? 'border-indigo-200 bg-indigo-50/50' : 'border-slate-200 bg-slate-50/50') }} px-3 py-2.5 text-sm">
                        <span class="flex h-7 w-7 shrink-0 items-center justify-center rounded-full {{ $isDone ? 'bg-emerald-500 text-white' : ($isCurrent ? 'bg-indigo-500 text-white' : 'bg-slate-200 text-slate-500') }}">
                            @if($isDone)
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                                </svg>
                            @elseif($isCurrent)
                                <span class="h-3 w-3 animate-spin rounded-full border-2 border-white border-t-transparent"></span>
                            @else
                                <span class="h-1.5 w-1.5 rounded-full bg-slate-400"></span>
                            @endif
                        </span>
                        <div class="flex-1 min-w-0">
                            <p class="font-medium text-slate-900 truncate">{{ $item['name'] }}</p>
                            @if($isDone)
                                <p class="text-xs text-emerald-700">মিলেছে: {{ $item['matched'] }}টি</p>
                            @endif
                        </div>
                        <p class="text-xs font-medium {{ $isDone ? 'text-emerald-600' : ($isCurrent ? 'text-indigo-600' : 'text-slate-400') }}">
                            {{ $isDone ? 'সম্পন্ন' : ($isCurrent ? 'প্রসেসিং...' : 'অপেক্ষমান') }}
                        </p>
                    </div>
                @empty
                    <p class="text-sm text-slate-400 text-center py-3">এখনো কোনো প্রসেস শুরু হয়নি।</p>
                @endforelse
            </div>
        </div>

        {{-- Saved results --}}
        <div class="card p-6">
            <div class="flex items-center gap-3 mb-4">
                <div class="icon-badge-amber">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                    </svg>
                </div>
                <div>
                    <h2 class="text-lg font-bold text-slate-900">সংরক্ষিত মিলকৃত ফলাফল</h2>
                    <p class="text-xs text-slate-500">ডাটাবেসে সংরক্ষিত আপনার বিজয়ী বন্ড</p>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="table-modern">
                    <thead>
                        <tr>
                            <th>ব্লক</th>
                            <th>বন্ড নম্বর</th>
                            <th>পুরস্কার</th>
                            <th>ড্র তথ্য</th>
                            <th class="text-right">অ্যাকশন</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($savedResults as $result)
                            <tr>
                                <td>{{ $result->block?->name ?? '-' }}</td>
                                <td class="font-semibold text-slate-900">{{ $result->bond_number }}</td>
                                <td>
                                    <span class="badge-warning">
                                        <svg class="h-3 w-3" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                        {{ $prizeLabels[$result->prize_type] ?? ucfirst($result->prize_type) }} পুরস্কার
                                    </span>
                                </td>
                                <td>
                                    <div class="text-slate-900 font-medium">{{ $result->draw_title }}</div>
                                    <div class="text-xs text-slate-500">{{ $result->draw_date->format('d M Y') }}</div>
                                    <div class="text-xs font-bold text-indigo-600 mt-0.5">৳ {{ number_format((float) $result->prize_amount, 2) }}</div>
                                </td>
                                <td class="text-right">
                                    <button
                                        type="button"
                                        wire:click="deleteSavedResult({{ $result->id }})"
                                        class="btn-danger"
                                    >
                                        <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        মুছুন
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-10">
                                    <div class="empty-state">
                                        <svg class="mx-auto h-16 w-16 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                        </svg>
                                        <p class="mt-3 font-medium text-slate-600">এখনো কোনো মিলকৃত ফলাফল সংরক্ষিত নেই।</p>
                                        <p class="mt-1 text-xs">বাম পাশ থেকে যাচাই শুরু করুন।</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
