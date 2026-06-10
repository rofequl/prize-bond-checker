<section class="portal-shell py-10 sm:py-14">
    <div class="grid gap-6 lg:grid-cols-[1fr_1.35fr]">
        <div class="glass-card p-6">
            <div class="flex items-center justify-between gap-3">
                <h1 class="text-2xl font-bold text-white">Result Verify</h1>
                <a href="{{ route('dashboard') }}" class="rounded-xl border border-white/20 px-3 py-2 text-sm text-slate-200 hover:bg-white/10">Back</a>
            </div>

            <p class="mt-2 text-sm text-slate-300">Check matching results from the latest valid draws. Blocks are processed one by one.</p>

            @error('verification')
                <p class="mt-4 rounded-lg border border-red-400/30 bg-red-500/10 px-3 py-2 text-sm text-red-200">{{ $message }}</p>
            @enderror

            @if($runMessage)
                <p class="mt-4 rounded-lg border border-emerald-400/30 bg-emerald-500/10 px-3 py-2 text-sm text-emerald-200">{{ $runMessage }}</p>
            @endif

            <button
                type="button"
                wire:click="startVerification"
                wire:loading.attr="disabled"
                class="mt-5 inline-flex items-center gap-2 rounded-xl bg-emerald-400 px-4 py-2.5 font-semibold text-slate-950 disabled:cursor-not-allowed disabled:opacity-60"
            >
                @if($isProcessing)
                    <span class="h-4 w-4 animate-spin rounded-full border-2 border-slate-900 border-t-transparent"></span>
                    Processing...
                @else
                    Check Result
                @endif
            </button>

            @if($isProcessing)
                <div wire:poll.900ms="processNextBlock"></div>
            @endif

            <div class="mt-6 space-y-2">
                @forelse($blockProgress as $item)
                    @php
                        $isCurrent = $currentBlockId === (int) $item['id'];
                        $statusText = $item['status'] === 'completed'
                            ? 'Completed'
                            : ($isCurrent ? 'Processing...' : 'Pending');
                    @endphp
                    <div class="rounded-lg border border-white/10 bg-white/5 px-3 py-2 text-sm">
                        <div class="flex items-center justify-between gap-3">
                            <p class="text-slate-200">{{ $item['name'] }}</p>
                            <p class="text-xs {{ $item['status'] === 'completed' ? 'text-emerald-300' : ($isCurrent ? 'text-amber-300' : 'text-slate-400') }}">{{ $statusText }}</p>
                        </div>
                        @if($item['status'] === 'completed')
                            <p class="mt-1 text-xs text-slate-300">Matched: {{ $item['matched'] }}</p>
                        @endif
                    </div>
                @empty
                    <p class="text-sm text-slate-400">No process started yet.</p>
                @endforelse
            </div>
        </div>

        <div class="glass-card p-6">
            <h2 class="text-xl font-bold text-white">Saved Matched Results</h2>
            <p class="mt-1 text-sm text-slate-300">Saved in database. You can delete any row.</p>

            <div class="mt-4 overflow-x-auto">
                <table class="min-w-full text-left text-sm">
                    <thead class="text-slate-300">
                        <tr>
                            <th class="py-2 pr-4">Block</th>
                            <th class="py-2 pr-4">Bond Number</th>
                            <th class="py-2 pr-4">Result</th>
                            <th class="py-2 pr-4">Prize Info</th>
                            <th class="py-2 pr-0 text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($savedResults as $result)
                            <tr class="border-t border-white/10 text-slate-200">
                                <td class="py-2 pr-4">{{ $result->block?->name ?? '-' }}</td>
                                <td class="py-2 pr-4">{{ $result->bond_number }}</td>
                                <td class="py-2 pr-4">{{ ucfirst($result->prize_type) }} Prize</td>
                                <td class="py-2 pr-4">
                                    <div>{{ $result->draw_title }} ({{ $result->draw_date->format('d M Y') }})</div>
                                    <div class="text-xs text-emerald-300">{{ number_format((float) $result->prize_amount, 2) }}</div>
                                </td>
                                <td class="py-2 pr-0 text-right">
                                    <button
                                        type="button"
                                        wire:click="deleteSavedResult({{ $result->id }})"
                                        class="rounded-lg border border-red-400/30 px-2.5 py-1.5 text-xs text-red-200 hover:bg-red-500/10"
                                    >
                                        Delete
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-3 text-slate-400">No matched results saved yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
