@extends('layouts.admin')

@section('title', 'Admin Results | Price Bond Bangladesh')

@section('content')
    <section class="portal-shell py-10 sm:py-14">
        <div class="grid gap-6 xl:grid-cols-[1fr_1.25fr]">
            <div class="glass-card p-6">
                <h1 class="text-2xl font-bold text-white">Result Entry</h1>
                <p class="mt-2 text-sm text-slate-300">Draw: every 3 months. System keeps latest 8 draws as valid.</p>

                @if(session('result_message'))
                    <p class="mt-4 rounded-lg border border-emerald-400/30 bg-emerald-500/10 px-3 py-2 text-sm text-emerald-200">{{ session('result_message') }}</p>
                @endif

                <form method="POST" action="{{ route('admin.results.store') }}" class="mt-5 space-y-4">
                    @csrf

                    <div class="grid gap-3 sm:grid-cols-2">
                        <div>
                            <label class="mb-1 block text-sm text-slate-300">Draw Date</label>
                            <input type="date" name="draw_date" value="{{ old('draw_date') }}" class="w-full rounded-xl border border-white/20 bg-slate-950/50 px-4 py-2.5 text-white">
                            @error('draw_date') <p class="mt-1 text-sm text-red-300">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div>
                        <label class="mb-1 block text-sm text-slate-300">Draw Title</label>
                        <input type="text" name="draw_title" value="{{ old('draw_title') }}" placeholder="Example: 60th Draw"
                               class="w-full rounded-xl border border-white/20 bg-slate-950/50 px-4 py-2.5 text-white">
                        @error('draw_title') <p class="mt-1 text-sm text-red-300">{{ $message }}</p> @enderror
                    </div>

                    <div class="grid gap-3 sm:grid-cols-2">
                        <div><label class="mb-1 block text-sm text-slate-300">1st Prize Amount</label><input type="number" step="0.01" name="first_prize_amount" value="{{ old('first_prize_amount') }}" class="w-full rounded-xl border border-white/20 bg-slate-950/50 px-4 py-2.5 text-white">@error('first_prize_amount') <p class="mt-1 text-sm text-red-300">{{ $message }}</p> @enderror</div>
                        <div><label class="mb-1 block text-sm text-slate-300">2nd Prize Amount</label><input type="number" step="0.01" name="second_prize_amount" value="{{ old('second_prize_amount') }}" class="w-full rounded-xl border border-white/20 bg-slate-950/50 px-4 py-2.5 text-white">@error('second_prize_amount') <p class="mt-1 text-sm text-red-300">{{ $message }}</p> @enderror</div>
                        <div><label class="mb-1 block text-sm text-slate-300">3rd Prize Amount</label><input type="number" step="0.01" name="third_prize_amount" value="{{ old('third_prize_amount') }}" class="w-full rounded-xl border border-white/20 bg-slate-950/50 px-4 py-2.5 text-white">@error('third_prize_amount') <p class="mt-1 text-sm text-red-300">{{ $message }}</p> @enderror</div>
                        <div><label class="mb-1 block text-sm text-slate-300">4th Prize Amount</label><input type="number" step="0.01" name="fourth_prize_amount" value="{{ old('fourth_prize_amount') }}" class="w-full rounded-xl border border-white/20 bg-slate-950/50 px-4 py-2.5 text-white">@error('fourth_prize_amount') <p class="mt-1 text-sm text-red-300">{{ $message }}</p> @enderror</div>
                        <div class="sm:col-span-2"><label class="mb-1 block text-sm text-slate-300">5th Prize Amount</label><input type="number" step="0.01" name="fifth_prize_amount" value="{{ old('fifth_prize_amount') }}" class="w-full rounded-xl border border-white/20 bg-slate-950/50 px-4 py-2.5 text-white">@error('fifth_prize_amount') <p class="mt-1 text-sm text-red-300">{{ $message }}</p> @enderror</div>
                    </div>

                    <div class="grid gap-3">
                        <div><label class="mb-1 block text-sm text-slate-300">1st Prize Number (exactly 1)</label><textarea name="first_numbers" rows="2" class="w-full rounded-xl border border-white/20 bg-slate-950/50 px-4 py-2.5 text-white">{{ old('first_numbers') }}</textarea>@error('first_numbers') <p class="mt-1 text-sm text-red-300">{{ $message }}</p> @enderror</div>
                        <div><label class="mb-1 block text-sm text-slate-300">2nd Prize Number (exactly 1)</label><textarea name="second_numbers" rows="2" class="w-full rounded-xl border border-white/20 bg-slate-950/50 px-4 py-2.5 text-white">{{ old('second_numbers') }}</textarea>@error('second_numbers') <p class="mt-1 text-sm text-red-300">{{ $message }}</p> @enderror</div>
                        <div><label class="mb-1 block text-sm text-slate-300">3rd Prize Numbers (exactly 2, comma/space separated)</label><textarea name="third_numbers" rows="2" class="w-full rounded-xl border border-white/20 bg-slate-950/50 px-4 py-2.5 text-white">{{ old('third_numbers') }}</textarea>@error('third_numbers') <p class="mt-1 text-sm text-red-300">{{ $message }}</p> @enderror</div>
                        <div><label class="mb-1 block text-sm text-slate-300">4th Prize Numbers (exactly 2, comma/space separated)</label><textarea name="fourth_numbers" rows="2" class="w-full rounded-xl border border-white/20 bg-slate-950/50 px-4 py-2.5 text-white">{{ old('fourth_numbers') }}</textarea>@error('fourth_numbers') <p class="mt-1 text-sm text-red-300">{{ $message }}</p> @enderror</div>
                        <div><label class="mb-1 block text-sm text-slate-300">5th Prize Numbers (exactly 40, comma/space separated)</label><textarea name="fifth_numbers" rows="5" class="w-full rounded-xl border border-white/20 bg-slate-950/50 px-4 py-2.5 text-white">{{ old('fifth_numbers') }}</textarea>@error('fifth_numbers') <p class="mt-1 text-sm text-red-300">{{ $message }}</p> @enderror</div>
                    </div>

                    <button type="submit" class="rounded-xl bg-emerald-400 px-5 py-2.5 font-semibold text-slate-950">Save Result</button>
                </form>
            </div>

            <div class="glass-card p-6">
                <h2 class="text-xl font-bold text-white">Draw Results</h2>
                <p class="mt-1 text-sm text-slate-300">Valid window: latest 8 draws.</p>

                <div class="mt-4 space-y-4">
                    @forelse($draws as $draw)
                        <div class="rounded-xl border border-white/10 bg-white/5 p-4">
                            <div class="flex flex-wrap items-center justify-between gap-2">
                                <p class="font-semibold text-white">{{ $draw->draw_title }} ({{ $draw->series->name }})</p>
                                <span class="text-xs {{ $draw->is_valid ? 'text-emerald-300' : 'text-slate-400' }}">{{ $draw->is_valid ? 'Valid' : 'Expired' }}</span>
                            </div>
                            <p class="mt-1 text-sm text-slate-300">{{ $draw->draw_date->format('d M Y') }}</p>

                            <div class="mt-3 grid gap-2 text-sm text-slate-200 sm:grid-cols-2">
                                <p>1st: {{ number_format((float) $draw->first_prize_amount, 2) }}</p>
                                <p>2nd: {{ number_format((float) $draw->second_prize_amount, 2) }}</p>
                                <p>3rd: {{ number_format((float) $draw->third_prize_amount, 2) }}</p>
                                <p>4th: {{ number_format((float) $draw->fourth_prize_amount, 2) }}</p>
                                <p class="sm:col-span-2">5th: {{ number_format((float) $draw->fifth_prize_amount, 2) }}</p>
                            </div>

                            <div class="mt-3 text-xs text-slate-300">
                                @php
                                    $grouped = $draw->winners->groupBy('prize_type');
                                @endphp
                                <p>1st: {{ $grouped->get('first', collect())->pluck('bond_number')->join(', ') }}</p>
                                <p>2nd: {{ $grouped->get('second', collect())->pluck('bond_number')->join(', ') }}</p>
                                <p>3rd: {{ $grouped->get('third', collect())->pluck('bond_number')->join(', ') }}</p>
                                <p>4th: {{ $grouped->get('fourth', collect())->pluck('bond_number')->join(', ') }}</p>
                                <p>5th: {{ $grouped->get('fifth', collect())->count() }} numbers</p>
                            </div>
                        </div>
                    @empty
                        <p class="text-slate-400">No draw result found.</p>
                    @endforelse
                </div>

                <div class="mt-4">
                    {{ $draws->links() }}
                </div>
            </div>
        </div>
    </section>
@endsection
