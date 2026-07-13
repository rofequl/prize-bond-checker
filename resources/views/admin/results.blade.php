@extends('layouts.admin')

@section('title', 'Admin Results | Prize Bond Bangladesh')
@section('page_title', 'Draw Results')

@section('content')
    <section class="px-4 sm:px-6 lg:px-8 py-8">
        <div class="mb-8">
            <span class="section-label">Result Entry</span>
            <h1 class="mt-2 text-3xl font-black tracking-tight text-slate-900">Manage draw results</h1>
            <p class="mt-1 text-sm text-slate-500">Add new quarterly draws and view recent history.</p>
        </div>

        <div class="grid gap-6 xl:grid-cols-[1fr_1.2fr]">
            {{-- Add new draw --}}
            <div class="card p-6">
                <div class="flex items-center gap-3 mb-4">
                    <div class="icon-badge-brand">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-lg font-bold text-slate-900">Add New Draw Result</h2>
                        <p class="text-xs text-slate-500">Enter winning numbers and prize amounts</p>
                    </div>
                </div>

                <div class="help-callout">
                    Draws happen every 3 months. The system automatically keeps the latest 8 draws as <span class="font-semibold text-emerald-700">valid</span> for citizen verification — older draws are kept for history but no longer matched.
                </div>

                @if(session('result_message'))
                    <div class="alert-success mt-4">{{ session('result_message') }}</div>
                @endif

                <form method="POST" action="{{ route('admin.results.store') }}" enctype="multipart/form-data" class="mt-5 space-y-6">
                    @csrf

                    <div>
                        <p class="mb-3 text-xs font-bold uppercase tracking-[0.18em] text-slate-500">Draw Info</p>
                        <div class="grid gap-3 sm:grid-cols-2">
                            <div>
                                <label class="mb-1.5 block text-sm font-medium text-slate-700">Draw Date</label>
                                <input type="date" name="draw_date" value="{{ old('draw_date') }}" class="input-field">
                                @error('draw_date') <p class="mt-1.5 text-sm text-rose-600">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label class="mb-1.5 block text-sm font-medium text-slate-700">Draw Title</label>
                                <input type="text" name="draw_title" value="{{ old('draw_title') }}" placeholder="Example: 60th Draw" class="input-field">
                                @error('draw_title') <p class="mt-1.5 text-sm text-rose-600">{{ $message }}</p> @enderror
                            </div>
                        </div>
                    </div>

                    <div>
                        <p class="mb-3 text-xs font-bold uppercase tracking-[0.18em] text-slate-500">Prize Amounts (BDT)</p>
                        <div class="grid gap-3 sm:grid-cols-2">
                            <div>
                                <label class="mb-1.5 block text-sm font-medium text-slate-700">1st Prize Amount</label>
                                <input type="number" step="0.01" name="first_prize_amount" value="{{ old('first_prize_amount') }}" class="input-field">
                                @error('first_prize_amount') <p class="mt-1.5 text-sm text-rose-600">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label class="mb-1.5 block text-sm font-medium text-slate-700">2nd Prize Amount</label>
                                <input type="number" step="0.01" name="second_prize_amount" value="{{ old('second_prize_amount') }}" class="input-field">
                                @error('second_prize_amount') <p class="mt-1.5 text-sm text-rose-600">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label class="mb-1.5 block text-sm font-medium text-slate-700">3rd Prize Amount</label>
                                <input type="number" step="0.01" name="third_prize_amount" value="{{ old('third_prize_amount') }}" class="input-field">
                                @error('third_prize_amount') <p class="mt-1.5 text-sm text-rose-600">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label class="mb-1.5 block text-sm font-medium text-slate-700">4th Prize Amount</label>
                                <input type="number" step="0.01" name="fourth_prize_amount" value="{{ old('fourth_prize_amount') }}" class="input-field">
                                @error('fourth_prize_amount') <p class="mt-1.5 text-sm text-rose-600">{{ $message }}</p> @enderror
                            </div>
                            <div class="sm:col-span-2">
                                <label class="mb-1.5 block text-sm font-medium text-slate-700">5th Prize Amount</label>
                                <input type="number" step="0.01" name="fifth_prize_amount" value="{{ old('fifth_prize_amount') }}" class="input-field">
                                @error('fifth_prize_amount') <p class="mt-1.5 text-sm text-rose-600">{{ $message }}</p> @enderror
                            </div>
                        </div>
                    </div>

                    <div>
                        <p class="mb-3 text-xs font-bold uppercase tracking-[0.18em] text-slate-500">Winning Numbers</p>
                        <div class="grid gap-4">
                            <div>
                                <div class="flex items-center justify-between mb-1.5">
                                    <label class="block text-sm font-medium text-slate-700">1st Prize Number</label>
                                    <span class="badge-muted">exactly 1</span>
                                </div>
                                <textarea name="first_numbers" rows="2" placeholder="0000000" class="input-field">{{ old('first_numbers') }}</textarea>
                                @error('first_numbers') <p class="mt-1.5 text-sm text-rose-600">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <div class="flex items-center justify-between mb-1.5">
                                    <label class="block text-sm font-medium text-slate-700">2nd Prize Number</label>
                                    <span class="badge-muted">exactly 1</span>
                                </div>
                                <textarea name="second_numbers" rows="2" placeholder="0000000" class="input-field">{{ old('second_numbers') }}</textarea>
                                @error('second_numbers') <p class="mt-1.5 text-sm text-rose-600">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <div class="flex items-center justify-between mb-1.5">
                                    <label class="block text-sm font-medium text-slate-700">3rd Prize Numbers</label>
                                    <span class="badge-muted">exactly 2, comma/space separated</span>
                                </div>
                                <textarea name="third_numbers" rows="2" placeholder="0000000, 0000000" class="input-field">{{ old('third_numbers') }}</textarea>
                                @error('third_numbers') <p class="mt-1.5 text-sm text-rose-600">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <div class="flex items-center justify-between mb-1.5">
                                    <label class="block text-sm font-medium text-slate-700">4th Prize Numbers</label>
                                    <span class="badge-muted">exactly 2, comma/space separated</span>
                                </div>
                                <textarea name="fourth_numbers" rows="2" placeholder="0000000, 0000000" class="input-field">{{ old('fourth_numbers') }}</textarea>
                                @error('fourth_numbers') <p class="mt-1.5 text-sm text-rose-600">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <div class="flex items-center justify-between mb-1.5">
                                    <label class="block text-sm font-medium text-slate-700">5th Prize Numbers</label>
                                    <span class="badge-muted">exactly 40, comma/space separated</span>
                                </div>
                                <textarea name="fifth_numbers" rows="5" placeholder="0000000, 0000000, ..." class="input-field">{{ old('fifth_numbers') }}</textarea>
                                @error('fifth_numbers') <p class="mt-1.5 text-sm text-rose-600">{{ $message }}</p> @enderror
                            </div>
                        </div>
                    </div>

                    <div>
                        <p class="mb-3 text-xs font-bold uppercase tracking-[0.18em] text-slate-500">Official Result PDF <span class="text-slate-400 font-normal normal-case">(optional)</span></p>
                        <label for="result_pdf" class="flex flex-col items-center justify-center gap-2 rounded-xl border-2 border-dashed border-slate-300 bg-slate-50/50 px-4 py-6 cursor-pointer hover:border-indigo-400 hover:bg-indigo-50/30 transition">
                            <svg class="h-8 w-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                            </svg>
                            <span class="text-sm font-medium text-slate-700">Click to upload PDF</span>
                            <span class="text-xs text-slate-500">PDF up to 10MB</span>
                            <input id="result_pdf" type="file" name="result_pdf" accept="application/pdf" class="sr-only" onchange="document.getElementById('pdf-filename').textContent = this.files[0]?.name || ''">
                        </label>
                        <p id="pdf-filename" class="mt-2 text-xs font-medium text-emerald-700"></p>
                        @error('result_pdf') <p class="mt-1.5 text-sm text-rose-600">{{ $message }}</p> @enderror
                    </div>

                    <button type="submit" class="btn-primary w-full">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        Save Result
                    </button>
                </form>
            </div>

            {{-- Past draws --}}
            <div class="card p-6">
                <div class="flex items-center gap-3 mb-4">
                    <div class="icon-badge-amber">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-lg font-bold text-slate-900">Draw Results</h2>
                        <p class="text-xs text-slate-500">Valid window: latest 8 draws</p>
                    </div>
                </div>

                <div class="space-y-4">
                    @forelse($draws as $draw)
                        <div class="rounded-2xl border border-slate-200 bg-white p-4 hover:shadow-md transition">
                            <div class="flex flex-wrap items-center justify-between gap-2">
                                <div>
                                    <p class="font-bold text-slate-900">{{ $draw->draw_title }}</p>
                                    <p class="text-xs text-slate-500">{{ $draw->draw_date->format('d M Y') }}</p>
                                </div>
                                @if($draw->is_valid)
                                    <span class="badge-success">
                                        <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                                        Valid
                                    </span>
                                @else
                                    <span class="badge-muted">Expired</span>
                                @endif
                            </div>

                            @php $grouped = $draw->winners->groupBy('prize_type'); @endphp
                            <div class="mt-3 grid gap-2 sm:grid-cols-2">
                                <div class="rounded-lg bg-gradient-to-br from-amber-50 to-amber-100/40 border border-amber-100 px-3 py-2">
                                    <p class="text-[10px] font-bold uppercase tracking-wider text-amber-700">1st · ৳{{ number_format((float) $draw->first_prize_amount, 2) }}</p>
                                    <p class="mt-0.5 text-sm font-bold text-slate-900">{{ $grouped->get('first', collect())->pluck('bond_number')->join(', ') }}</p>
                                </div>
                                <div class="rounded-lg bg-gradient-to-br from-indigo-50 to-indigo-100/40 border border-indigo-100 px-3 py-2">
                                    <p class="text-[10px] font-bold uppercase tracking-wider text-indigo-700">2nd · ৳{{ number_format((float) $draw->second_prize_amount, 2) }}</p>
                                    <p class="mt-0.5 text-sm font-bold text-slate-900">{{ $grouped->get('second', collect())->pluck('bond_number')->join(', ') }}</p>
                                </div>
                                <div class="rounded-lg bg-slate-50 border border-slate-200 px-3 py-2">
                                    <p class="text-[10px] font-bold uppercase tracking-wider text-slate-600">3rd · ৳{{ number_format((float) $draw->third_prize_amount, 2) }}</p>
                                    <p class="mt-0.5 text-sm text-slate-800">{{ $grouped->get('third', collect())->pluck('bond_number')->join(', ') }}</p>
                                </div>
                                <div class="rounded-lg bg-slate-50 border border-slate-200 px-3 py-2">
                                    <p class="text-[10px] font-bold uppercase tracking-wider text-slate-600">4th · ৳{{ number_format((float) $draw->fourth_prize_amount, 2) }}</p>
                                    <p class="mt-0.5 text-sm text-slate-800">{{ $grouped->get('fourth', collect())->pluck('bond_number')->join(', ') }}</p>
                                </div>
                                <div class="rounded-lg bg-slate-50 border border-slate-200 px-3 py-2 sm:col-span-2">
                                    <p class="text-[10px] font-bold uppercase tracking-wider text-slate-600">5th · ৳{{ number_format((float) $draw->fifth_prize_amount, 2) }}</p>
                                    <p class="mt-0.5 text-sm text-slate-800">{{ $grouped->get('fifth', collect())->count() }} numbers</p>
                                </div>
                            </div>

                            <div class="mt-3 flex flex-wrap items-center gap-2">
                                @if($draw->result_pdf_path)
                                    <a href="{{ asset('storage/'.$draw->result_pdf_path) }}" target="_blank" class="inline-flex items-center gap-1.5 rounded-lg border border-rose-200 bg-rose-50 px-3 py-1.5 text-xs font-semibold text-rose-700 hover:bg-rose-100">
                                        <svg class="h-3.5 w-3.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd"/></svg>
                                        View PDF
                                    </a>
                                @endif
                                <a href="{{ route('admin.results.edit', $draw) }}" class="inline-flex items-center gap-1.5 rounded-lg border border-indigo-200 bg-indigo-50 px-3 py-1.5 text-xs font-semibold text-indigo-700 hover:bg-indigo-100">
                                    <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    Edit
                                </a>
                                <form method="POST" action="{{ route('admin.results.destroy', $draw) }}" onsubmit="return confirm('Are you sure you want to delete this draw? This will remove all its winners.');" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-danger">
                                        <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <div class="empty-state">No draw result found yet.</div>
                    @endforelse
                </div>

                <div class="mt-4">
                    {{ $draws->links() }}
                </div>
            </div>
        </div>
    </section>
@endsection
