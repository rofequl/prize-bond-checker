@extends('layouts.admin')

@section('title', 'Edit Draw Result | Prize Bond Bangladesh')
@section('page_title', 'Edit Draw Result')

@section('content')
    <section class="px-4 sm:px-6 lg:px-8 py-8">
        <div class="mb-8 flex flex-wrap items-end justify-between gap-3">
            <div>
                <span class="section-label">Edit Draw</span>
                <h1 class="mt-2 text-3xl font-black tracking-tight text-slate-900">{{ $draw->draw_title }}</h1>
                <p class="mt-1 text-sm text-slate-500">Modify any field including PDF, prize amounts, and winning numbers.</p>
            </div>
            <a href="{{ route('admin.results') }}" class="btn-secondary">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                Back to Results
            </a>
        </div>

        <div class="card p-6 max-w-3xl">
            @if(session('result_message'))
                <div class="alert-success mb-4">{{ session('result_message') }}</div>
            @endif

            <form method="POST" action="{{ route('admin.results.update', $draw) }}" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

                <div>
                    <p class="mb-3 text-xs font-bold uppercase tracking-[0.18em] text-slate-500">Draw Info</p>
                    <div class="grid gap-3 sm:grid-cols-2">
                        <div>
                            <label class="mb-1.5 block text-sm font-medium text-slate-700">Draw Date</label>
                            <input type="date" name="draw_date" value="{{ old('draw_date', $draw->draw_date->toDateString()) }}" class="input-field">
                            @error('draw_date') <p class="mt-1.5 text-sm text-rose-600">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="mb-1.5 block text-sm font-medium text-slate-700">Draw Title</label>
                            <input type="text" name="draw_title" value="{{ old('draw_title', $draw->draw_title) }}" placeholder="Example: 60th Draw" class="input-field">
                            @error('draw_title') <p class="mt-1.5 text-sm text-rose-600">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>

                <div>
                    <p class="mb-3 text-xs font-bold uppercase tracking-[0.18em] text-slate-500">Prize Amounts (BDT)</p>
                    <div class="grid gap-3 sm:grid-cols-2">
                        <div>
                            <label class="mb-1.5 block text-sm font-medium text-slate-700">1st Prize Amount</label>
                            <input type="number" step="0.01" name="first_prize_amount" value="{{ old('first_prize_amount', $draw->first_prize_amount) }}" class="input-field">
                            @error('first_prize_amount') <p class="mt-1.5 text-sm text-rose-600">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="mb-1.5 block text-sm font-medium text-slate-700">2nd Prize Amount</label>
                            <input type="number" step="0.01" name="second_prize_amount" value="{{ old('second_prize_amount', $draw->second_prize_amount) }}" class="input-field">
                            @error('second_prize_amount') <p class="mt-1.5 text-sm text-rose-600">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="mb-1.5 block text-sm font-medium text-slate-700">3rd Prize Amount</label>
                            <input type="number" step="0.01" name="third_prize_amount" value="{{ old('third_prize_amount', $draw->third_prize_amount) }}" class="input-field">
                            @error('third_prize_amount') <p class="mt-1.5 text-sm text-rose-600">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="mb-1.5 block text-sm font-medium text-slate-700">4th Prize Amount</label>
                            <input type="number" step="0.01" name="fourth_prize_amount" value="{{ old('fourth_prize_amount', $draw->fourth_prize_amount) }}" class="input-field">
                            @error('fourth_prize_amount') <p class="mt-1.5 text-sm text-rose-600">{{ $message }}</p> @enderror
                        </div>
                        <div class="sm:col-span-2">
                            <label class="mb-1.5 block text-sm font-medium text-slate-700">5th Prize Amount</label>
                            <input type="number" step="0.01" name="fifth_prize_amount" value="{{ old('fifth_prize_amount', $draw->fifth_prize_amount) }}" class="input-field">
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
                            <textarea name="first_numbers" rows="2" class="input-field">{{ old('first_numbers', $existing['first_numbers']) }}</textarea>
                            @error('first_numbers') <p class="mt-1.5 text-sm text-rose-600">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <div class="flex items-center justify-between mb-1.5">
                                <label class="block text-sm font-medium text-slate-700">2nd Prize Number</label>
                                <span class="badge-muted">exactly 1</span>
                            </div>
                            <textarea name="second_numbers" rows="2" class="input-field">{{ old('second_numbers', $existing['second_numbers']) }}</textarea>
                            @error('second_numbers') <p class="mt-1.5 text-sm text-rose-600">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <div class="flex items-center justify-between mb-1.5">
                                <label class="block text-sm font-medium text-slate-700">3rd Prize Numbers</label>
                                <span class="badge-muted">exactly 2</span>
                            </div>
                            <textarea name="third_numbers" rows="2" class="input-field">{{ old('third_numbers', $existing['third_numbers']) }}</textarea>
                            @error('third_numbers') <p class="mt-1.5 text-sm text-rose-600">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <div class="flex items-center justify-between mb-1.5">
                                <label class="block text-sm font-medium text-slate-700">4th Prize Numbers</label>
                                <span class="badge-muted">exactly 2</span>
                            </div>
                            <textarea name="fourth_numbers" rows="2" class="input-field">{{ old('fourth_numbers', $existing['fourth_numbers']) }}</textarea>
                            @error('fourth_numbers') <p class="mt-1.5 text-sm text-rose-600">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <div class="flex items-center justify-between mb-1.5">
                                <label class="block text-sm font-medium text-slate-700">5th Prize Numbers</label>
                                <span class="badge-muted">exactly 40</span>
                            </div>
                            <textarea name="fifth_numbers" rows="6" class="input-field">{{ old('fifth_numbers', $existing['fifth_numbers']) }}</textarea>
                            @error('fifth_numbers') <p class="mt-1.5 text-sm text-rose-600">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>

                <div>
                    <p class="mb-3 text-xs font-bold uppercase tracking-[0.18em] text-slate-500">Official Result PDF</p>

                    @if($draw->result_pdf_path)
                        <div class="mb-3 flex flex-wrap items-center gap-3 rounded-xl border border-emerald-200 bg-emerald-50/60 p-3">
                            <svg class="h-6 w-6 text-emerald-600 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" clip-rule="evenodd"/></svg>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-semibold text-slate-900 truncate">Current PDF attached</p>
                                <a href="{{ asset('storage/'.$draw->result_pdf_path) }}" target="_blank" class="text-xs font-medium text-indigo-600 hover:underline truncate">View existing file</a>
                            </div>
                            <label class="flex items-center gap-2 text-sm text-rose-700">
                                <input type="checkbox" name="remove_pdf" value="1" class="h-4 w-4 rounded border-slate-300 text-rose-600 focus:ring-rose-500">
                                Remove
                            </label>
                        </div>
                    @endif

                    <label for="result_pdf" class="flex flex-col items-center justify-center gap-2 rounded-xl border-2 border-dashed border-slate-300 bg-slate-50/50 px-4 py-6 cursor-pointer hover:border-indigo-400 hover:bg-indigo-50/30 transition">
                        <svg class="h-8 w-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                        </svg>
                        <span class="text-sm font-medium text-slate-700">{{ $draw->result_pdf_path ? 'Replace PDF (optional)' : 'Click to upload PDF' }}</span>
                        <span class="text-xs text-slate-500">PDF up to 10MB</span>
                        <input id="result_pdf" type="file" name="result_pdf" accept="application/pdf" class="sr-only" onchange="document.getElementById('pdf-filename').textContent = this.files[0]?.name || ''">
                    </label>
                    <p id="pdf-filename" class="mt-2 text-xs font-medium text-emerald-700"></p>
                    @error('result_pdf') <p class="mt-1.5 text-sm text-rose-600">{{ $message }}</p> @enderror
                </div>

                <div class="flex flex-wrap gap-3 pt-2">
                    <button type="submit" class="btn-primary">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        Update Result
                    </button>
                    <a href="{{ route('admin.results') }}" class="btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </section>
@endsection
