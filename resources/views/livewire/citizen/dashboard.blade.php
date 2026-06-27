<section class="portal-shell py-10 sm:py-12">
    {{-- Header --}}
    <div class="flex flex-wrap items-end justify-between gap-4 mb-8">
        <div>
            <span class="section-label">সিটিজেন ড্যাশবোর্ড</span>
            <h1 class="mt-2 text-3xl sm:text-4xl font-black tracking-tight text-slate-900">
                স্বাগতম, <span class="text-indigo-600">{{ $user->name }}</span>
            </h1>
            <p class="mt-1 text-sm text-slate-500">আপনার বন্ড ম্যানেজ করুন এবং ফলাফল যাচাই করুন।</p>
        </div>
        <a href="{{ route('dashboard.result-verify') }}" class="btn-primary">
            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            ফলাফল যাচাই করুন
        </a>
    </div>

    {{-- Stats --}}
    <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
        <div class="stat-card">
            <div class="icon-badge-indigo">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
            </div>
            <div>
                <p class="text-xs font-medium text-slate-500">প্রোফাইল নাম</p>
                <p class="mt-0.5 text-base font-bold text-slate-900 truncate">{{ $user->name }}</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="icon-badge-emerald">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
            </div>
            <div>
                <p class="text-xs font-medium text-slate-500">যোগদানের তারিখ</p>
                <p class="mt-0.5 text-base font-bold text-slate-900">{{ $user->created_at->format('d M Y') }}</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="icon-badge-amber">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                </svg>
            </div>
            <div>
                <p class="text-xs font-medium text-slate-500">মোট ব্লক</p>
                <p class="mt-0.5 text-2xl font-black text-slate-900">{{ $stats['total_blocks'] }}</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="icon-badge-rose">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
            </div>
            <div>
                <p class="text-xs font-medium text-slate-500">মোট প্রাইজ বন্ড</p>
                <p class="mt-0.5 text-2xl font-black text-slate-900">{{ $stats['total_bonds'] }}</p>
            </div>
        </div>
    </div>

    {{-- Profile + Blocks --}}
    <div class="mt-6 grid gap-6 lg:grid-cols-3">
        {{-- Profile --}}
        <div class="card p-6 lg:col-span-1">
            <div class="flex items-center gap-3 mb-4">
                <div class="icon-badge-indigo h-10 w-10">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                </div>
                <div>
                    <h2 class="text-lg font-bold text-slate-900">প্রোফাইল হালনাগাদ</h2>
                    <p class="text-xs text-slate-500">আপনার তথ্য আপডেট করুন</p>
                </div>
            </div>

            @if (session('profile_message'))
                <div class="alert-success mb-4">{{ session('profile_message') }}</div>
            @endif

            <form wire:submit="updateProfile" class="space-y-3">
                <div>
                    <label class="mb-1.5 block text-sm font-medium text-slate-700">নাম</label>
                    <input type="text" wire:model="profileName" class="input-field">
                    @error('profileName') <p class="mt-1 text-sm text-rose-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="mb-1.5 block text-sm font-medium text-slate-700">ইমেইল</label>
                    <input type="email" wire:model="profileEmail" class="input-field">
                    @error('profileEmail') <p class="mt-1 text-sm text-rose-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="mb-1.5 block text-sm font-medium text-slate-700">মোবাইল <span class="text-slate-400 font-normal">(ঐচ্ছিক)</span></label>
                    <input type="text" wire:model="profilePhone" class="input-field">
                    @error('profilePhone') <p class="mt-1 text-sm text-rose-600">{{ $message }}</p> @enderror
                </div>
                <button type="submit" class="btn-primary w-full">সংরক্ষণ করুন</button>
            </form>
        </div>

        {{-- Blocks --}}
        <div class="card p-6 lg:col-span-2">
            <div class="flex items-center justify-between gap-3 mb-4">
                <div class="flex items-center gap-3">
                    <div class="icon-badge-emerald h-10 w-10">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-lg font-bold text-slate-900">প্রাইজ বন্ড ব্লক</h2>
                        <p class="text-xs text-slate-500">প্রথমে ব্লক তৈরি করুন, তারপর বন্ড যুক্ত করুন</p>
                    </div>
                </div>
            </div>

            <div class="help-callout">
                <span class="font-semibold text-indigo-700">ব্লক কী?</span>
                ব্লক হলো আপনার প্রাইজ বন্ড নম্বরগুলো রাখার একটি দল। একটি ব্লকে সর্বোচ্চ ১০০টি বন্ড নম্বর রাখা যায়।
            </div>

            @if($blocks->isNotEmpty())
                <div class="mt-4 grid gap-3 sm:grid-cols-2">
                    @foreach($blocks as $block)
                        <div class="rounded-xl border border-slate-200 bg-gradient-to-br from-slate-50 to-white p-4">
                            <div class="flex items-center justify-between gap-2 mb-2">
                                <p class="truncate font-semibold text-slate-900">{{ $block->name }}</p>
                                <p class="shrink-0 text-xs font-semibold text-slate-500">{{ $block->prize_bonds_count }}/100</p>
                            </div>
                            <div class="h-1.5 w-full overflow-hidden rounded-full bg-slate-100">
                                <div class="h-full rounded-full bg-gradient-to-r from-indigo-500 to-violet-500 transition-all" style="width: {{ $block->prize_bonds_count }}%"></div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

            @if (session('block_message'))
                <div class="alert-success mt-4">{{ session('block_message') }}</div>
            @endif

            <form wire:submit="createBlock" class="mt-4 flex flex-col gap-2 sm:flex-row">
                <input type="text" wire:model="blockName" placeholder="ব্লকের নাম (যেমন: আমার প্রথম ব্লক)" class="input-field">
                <button type="submit" class="btn-primary shrink-0">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    নতুন ব্লক
                </button>
            </form>
            @error('blockName') <p class="mt-1 text-sm text-rose-600">{{ $message }}</p> @enderror

            <div class="mt-6 pt-6 border-t border-slate-200">
                <h3 class="text-base font-bold text-slate-900 mb-1">প্রাইজ বন্ড যুক্ত করুন</h3>
                <p class="text-xs text-slate-500 mb-3">একটি ব্লক ও সিরিজ নির্বাচন করে বন্ড নম্বর যুক্ত করুন</p>

                @if (session('bond_message'))
                    <div class="alert-success mb-3">{{ session('bond_message') }}</div>
                @endif

                @if($blocks->isEmpty())
                    <div class="empty-state">এখনো কোনো ব্লক নেই। বন্ড যুক্ত করার আগে উপরে একটি ব্লক তৈরি করুন।</div>
                @else
                    <form wire:submit="addPrizeBond" class="grid gap-3 sm:grid-cols-3">
                        <div>
                            <label class="mb-1.5 block text-xs font-medium text-slate-700">ব্লক</label>
                            <select wire:model="selectedBlockId" class="input-field">
                                <option value="">ব্লক নির্বাচন</option>
                                @foreach($blocks as $block)
                                    <option value="{{ $block->id }}">{{ $block->name }} ({{ $block->prize_bonds_count }}/100)</option>
                                @endforeach
                            </select>
                            @error('selectedBlockId') <p class="mt-1 text-sm text-rose-600">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="mb-1.5 block text-xs font-medium text-slate-700">সিরিজ</label>
                            <select wire:model="selectedSeriesId" class="input-field">
                                <option value="">সিরিজ নির্বাচন</option>
                                @foreach($series as $seriesItem)
                                    <option value="{{ $seriesItem->id }}">{{ $seriesItem->name }}</option>
                                @endforeach
                            </select>
                            @error('selectedSeriesId') <p class="mt-1 text-sm text-rose-600">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="mb-1.5 block text-xs font-medium text-slate-700">বন্ড নম্বর</label>
                            <input type="text" wire:model="bondNumber" placeholder="0000000" class="input-field">
                            @error('bondNumber') <p class="mt-1 text-sm text-rose-600">{{ $message }}</p> @enderror
                        </div>
                        <div class="sm:col-span-3">
                            <button type="submit" class="btn-primary">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                                প্রাইজ বন্ড যুক্ত করুন
                            </button>
                        </div>
                    </form>
                @endif
            </div>
        </div>
    </div>

    {{-- Bond List --}}
    <div class="mt-6 card p-6">
        <div class="flex items-center gap-3 mb-4">
            <div class="icon-badge-indigo h-10 w-10">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
            </div>
            <div>
                <h2 class="text-lg font-bold text-slate-900">বন্ড তালিকা</h2>
                <p class="text-xs text-slate-500">আপনার সংরক্ষিত বন্ড নম্বরগুলোর তালিকা</p>
            </div>
        </div>

        <div class="grid gap-3 sm:grid-cols-2">
            <div>
                <label class="mb-1.5 block text-xs font-medium text-slate-700">বন্ড নম্বর খুঁজুন</label>
                <div class="relative">
                    <svg class="absolute left-3 top-1/2 -translate-y-1/2 h-4 w-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    <input
                        type="text"
                        wire:model.live.debounce.400ms="searchBondNumber"
                        placeholder="বন্ড নম্বর লিখুন"
                        class="input-field pl-9"
                    >
                </div>
            </div>
            <div>
                <label class="mb-1.5 block text-xs font-medium text-slate-700">ব্লক অনুযায়ী ফিল্টার</label>
                <select wire:model.live="filterBlockId" class="input-field">
                    <option value="">সব ব্লক</option>
                    @foreach($blocks as $block)
                        <option value="{{ $block->id }}">{{ $block->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="mt-5 space-y-3">
            @forelse($visibleBlocks as $block)
                @php $pager = $blockBondPages[$block->id]; @endphp
                <div wire:key="block-{{ $block->id }}" x-data="{ open: false }" class="rounded-xl border border-slate-200 bg-white overflow-hidden">
                    <button type="button" @click="open = !open" class="flex w-full flex-wrap items-center justify-between gap-2 px-4 py-3 text-left hover:bg-slate-50 transition">
                        <div class="flex items-center gap-3">
                            <div class="icon-badge-indigo h-9 w-9">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="font-semibold text-slate-900">{{ $block->name }}</p>
                                <p class="text-xs text-slate-500">{{ $block->prize_bonds_count }}/100 বন্ড সংরক্ষিত</p>
                            </div>
                        </div>
                        <svg class="h-4 w-4 text-slate-400 transition-transform duration-200" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>

                    <div x-show="open" x-transition class="border-t border-slate-100">
                    @if($pager->isEmpty())
                        <div class="p-5">
                            <div class="empty-state">
                                {{ $searchBondNumber !== '' ? 'এই ব্লকে অনুসন্ধানের সাথে মিলে এমন কোনো বন্ড নেই।' : 'এই ব্লকে এখনো কোনো বন্ড যুক্ত করা হয়নি।' }}
                            </div>
                        </div>
                    @else
                        <div class="overflow-x-auto">
                            <table class="table-modern">
                                <thead>
                                    <tr>
                                        <th class="pl-4">সিরিজ</th>
                                        <th>বন্ড নম্বর</th>
                                        <th>যুক্ত হয়েছে</th>
                                        <th class="text-right pr-4">অ্যাকশন</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($pager as $bond)
                                        @if($editingPrizeBondId === $bond->id)
                                            <tr wire:key="bond-{{ $bond->id }}" class="bg-indigo-50/40">
                                                <td colspan="4" class="py-3 px-4">
                                                    <div class="grid gap-2 sm:grid-cols-4">
                                                        <div>
                                                            <select wire:model="editingBlockId" class="input-field-sm">
                                                                @foreach($blocks as $blockOption)
                                                                    <option value="{{ $blockOption->id }}">{{ $blockOption->name }} ({{ $blockOption->prize_bonds_count }}/100)</option>
                                                                @endforeach
                                                            </select>
                                                            @error('editingBlockId') <p class="mt-1 text-xs text-rose-600">{{ $message }}</p> @enderror
                                                        </div>
                                                        <div>
                                                            <select wire:model="editingSeriesId" class="input-field-sm">
                                                                @foreach($series as $seriesItem)
                                                                    <option value="{{ $seriesItem->id }}">{{ $seriesItem->name }}</option>
                                                                @endforeach
                                                            </select>
                                                            @error('editingSeriesId') <p class="mt-1 text-xs text-rose-600">{{ $message }}</p> @enderror
                                                        </div>
                                                        <div>
                                                            <input type="text" wire:model="editingBondNumber" class="input-field-sm">
                                                            @error('editingBondNumber') <p class="mt-1 text-xs text-rose-600">{{ $message }}</p> @enderror
                                                        </div>
                                                        <div class="flex gap-2">
                                                            <button type="button" wire:click="updatePrizeBond" class="flex-1 rounded-lg bg-indigo-600 px-3 py-2 text-xs font-semibold text-white hover:bg-indigo-700">
                                                                সংরক্ষণ
                                                            </button>
                                                            <button type="button" wire:click="cancelEditPrizeBond" class="flex-1 rounded-lg border border-slate-200 px-3 py-2 text-xs font-semibold text-slate-700 hover:bg-slate-50">
                                                                বাতিল
                                                            </button>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @else
                                            <tr wire:key="bond-{{ $bond->id }}">
                                                <td class="pl-4">
                                                    <span class="badge-indigo">{{ $bond->series->name }}</span>
                                                </td>
                                                <td class="font-semibold text-slate-900">{{ $bond->bond_number }}</td>
                                                <td class="text-slate-500">{{ $bond->created_at->format('d M Y') }}</td>
                                                <td class="text-right pr-4">
                                                    <button type="button" wire:click="editPrizeBond({{ $bond->id }})" class="inline-flex items-center gap-1 rounded-lg border border-indigo-200 bg-indigo-50 px-2.5 py-1 text-xs font-semibold text-indigo-700 hover:bg-indigo-100">
                                                        <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                                        এডিট
                                                    </button>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        @if($pager->hasPages())
                            <div class="px-4 py-3 border-t border-slate-100">
                                {{ $pager->onEachSide(1)->links() }}
                            </div>
                        @endif
                    @endif
                    </div>
                </div>
            @empty
                <div class="empty-state">
                    <svg class="mx-auto h-16 w-16 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                    </svg>
                    <p class="mt-3 font-medium text-slate-600">এখনো কোনো ব্লক তৈরি করা হয়নি।</p>
                    <p class="mt-1 text-xs">উপরে ব্লক তৈরি করে বন্ড যুক্ত করুন।</p>
                </div>
            @endforelse
        </div>
    </div>
</section>
