<section class="portal-shell py-10 sm:py-14">
    <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
        <div class="glass-card p-5">
            <p class="text-sm text-slate-300">Profile Name</p>
            <p class="mt-2 text-xl font-bold text-white">{{ $user->name }}</p>
        </div>
        <div class="glass-card p-5">
            <p class="text-sm text-slate-300">Joined</p>
            <p class="mt-2 text-xl font-bold text-white">{{ $user->created_at->format('d M Y') }}</p>
        </div>
        <div class="glass-card p-5">
            <p class="text-sm text-slate-300">Total Block</p>
            <p class="mt-2 text-xl font-bold text-white">{{ $stats['total_blocks'] }}</p>
        </div>
        <div class="glass-card p-5">
            <p class="text-sm text-slate-300">Total Prize Bond</p>
            <p class="mt-2 text-xl font-bold text-white">{{ $stats['total_bonds'] }}</p>
        </div>
    </div>

    <div class="mt-6 grid gap-6 lg:grid-cols-3">
        <div class="glass-card p-6 lg:col-span-1">
            <h2 class="text-xl font-bold text-white">Update Profile</h2>

            @if (session('profile_message'))
                <p class="mt-3 rounded-lg border border-emerald-400/30 bg-emerald-500/10 px-3 py-2 text-sm text-emerald-200">{{ session('profile_message') }}</p>
            @endif

            <form wire:submit="updateProfile" class="mt-4 space-y-3">
                <div>
                    <label class="mb-1 block text-sm text-slate-300">Name</label>
                    <input type="text" wire:model="profileName" class="w-full rounded-xl border border-white/20 bg-slate-950/50 px-4 py-2.5 text-white">
                    @error('profileName') <p class="mt-1 text-sm text-red-300">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="mb-1 block text-sm text-slate-300">Email</label>
                    <input type="email" wire:model="profileEmail" class="w-full rounded-xl border border-white/20 bg-slate-950/50 px-4 py-2.5 text-white">
                    @error('profileEmail') <p class="mt-1 text-sm text-red-300">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="mb-1 block text-sm text-slate-300">Phone (optional)</label>
                    <input type="text" wire:model="profilePhone" class="w-full rounded-xl border border-white/20 bg-slate-950/50 px-4 py-2.5 text-white">
                    @error('profilePhone') <p class="mt-1 text-sm text-red-300">{{ $message }}</p> @enderror
                </div>
                <button type="submit" class="w-full rounded-xl bg-emerald-400 px-4 py-2.5 font-semibold text-slate-950">Save Profile</button>
            </form>
        </div>

        <div class="glass-card p-6 lg:col-span-2">
            <div class="flex flex-wrap items-center justify-between gap-3">
                <div>
                    <h2 class="text-xl font-bold text-white">Prize Bond Blocks</h2>
                    <p class="mt-1 text-sm text-slate-300">Create block first. One block can store maximum 100 prize bonds.</p>
                </div>
                <a href="{{ route('dashboard.result-verify') }}" class="rounded-xl border border-emerald-400/40 bg-emerald-500/10 px-4 py-2 text-sm font-semibold text-emerald-200 hover:bg-emerald-500/20">
                    Result Verify
                </a>
            </div>

            @if (session('block_message'))
                <p class="mt-3 rounded-lg border border-emerald-400/30 bg-emerald-500/10 px-3 py-2 text-sm text-emerald-200">{{ session('block_message') }}</p>
            @endif

            <form wire:submit="createBlock" class="mt-4 flex flex-col gap-3 sm:flex-row">
                <input type="text" wire:model="blockName" placeholder="Block name (e.g. My First Block)" class="w-full rounded-xl border border-white/20 bg-slate-950/50 px-4 py-2.5 text-white">
                <button type="submit" class="rounded-xl bg-emerald-400 px-4 py-2.5 font-semibold text-slate-950">Create Block</button>
            </form>
            @error('blockName') <p class="mt-1 text-sm text-red-300">{{ $message }}</p> @enderror

            <div class="mt-7">
                <h3 class="text-lg font-semibold text-white">Add Prize Bond</h3>
                @if (session('bond_message'))
                    <p class="mt-3 rounded-lg border border-emerald-400/30 bg-emerald-500/10 px-3 py-2 text-sm text-emerald-200">{{ session('bond_message') }}</p>
                @endif

                <form wire:submit="addPrizeBond" class="mt-4 grid gap-3 sm:grid-cols-3">
                    <div>
                        <label class="mb-1 block text-sm text-slate-300">Block</label>
                        <select wire:model="selectedBlockId" class="w-full rounded-xl border border-white/20 bg-slate-950/50 px-4 py-2.5 text-white">
                            <option value="">Select Block</option>
                            @foreach($blocks as $block)
                                <option value="{{ $block->id }}">{{ $block->name }} ({{ $block->prize_bonds_count }}/100)</option>
                            @endforeach
                        </select>
                        @error('selectedBlockId') <p class="mt-1 text-sm text-red-300">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="mb-1 block text-sm text-slate-300">Series</label>
                        <select wire:model="selectedSeriesId" class="w-full rounded-xl border border-white/20 bg-slate-950/50 px-4 py-2.5 text-white">
                            <option value="">Select Series</option>
                            @foreach($series as $seriesItem)
                                <option value="{{ $seriesItem->id }}">{{ $seriesItem->name }}</option>
                            @endforeach
                        </select>
                        @error('selectedSeriesId') <p class="mt-1 text-sm text-red-300">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="mb-1 block text-sm text-slate-300">Bond Number</label>
                        <input type="text" wire:model="bondNumber" class="w-full rounded-xl border border-white/20 bg-slate-950/50 px-4 py-2.5 text-white">
                        @error('bondNumber') <p class="mt-1 text-sm text-red-300">{{ $message }}</p> @enderror
                    </div>
                    <div class="sm:col-span-3">
                        <button type="submit" class="rounded-xl bg-emerald-400 px-4 py-2.5 font-semibold text-slate-950">Add Prize Bond</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="mt-6 glass-card p-6">
        <h2 class="text-xl font-bold text-white">Bond List</h2>
        <p class="mt-1 text-sm text-slate-300">Paginated list of your saved bond numbers.</p>

        <div class="mt-4 grid gap-3 sm:grid-cols-2">
            <div>
                <label class="mb-1 block text-sm text-slate-300">Search Bond Number</label>
                <input
                    type="text"
                    wire:model.live.debounce.400ms="searchBondNumber"
                    placeholder="Type bond number"
                    class="w-full rounded-xl border border-white/20 bg-slate-950/50 px-4 py-2.5 text-white"
                >
            </div>
            <div>
                <label class="mb-1 block text-sm text-slate-300">Filter By Block</label>
                <select wire:model.live="filterBlockId" class="w-full rounded-xl border border-white/20 bg-slate-950/50 px-4 py-2.5 text-white">
                    <option value="">All Blocks</option>
                    @foreach($blocks as $block)
                        <option value="{{ $block->id }}">{{ $block->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="mt-4 overflow-x-auto">
            <table class="min-w-full text-left text-sm">
                <thead class="text-slate-300">
                    <tr>
                        <th class="py-2 pr-4">Block</th>
                        <th class="py-2 pr-4">Series</th>
                        <th class="py-2 pr-4">Bond Number</th>
                        <th class="py-2 pr-4">Added</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($bonds as $bond)
                        <tr class="border-t border-white/10 text-slate-200">
                            <td class="py-2 pr-4">{{ $bond->block->name }}</td>
                            <td class="py-2 pr-4">{{ $bond->series->name }}</td>
                            <td class="py-2 pr-4">{{ $bond->bond_number }}</td>
                            <td class="py-2 pr-4">{{ $bond->created_at->format('d M Y') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="py-3 text-slate-400">No prize bond saved yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($bonds->hasPages())
            <div class="mt-4 flex flex-wrap items-center gap-2">
                <button
                    type="button"
                    wire:click="previousPage('bondsPage')"
                    @disabled(! $bonds->onFirstPage())
                    class="rounded-lg border border-white/20 px-3 py-1.5 text-sm text-slate-200 disabled:cursor-not-allowed disabled:opacity-50"
                >
                    Previous
                </button>

                @for($page = 1; $page <= $bonds->lastPage(); $page++)
                    <button
                        type="button"
                        wire:click="gotoPage({{ $page }}, 'bondsPage')"
                        class="rounded-lg border px-3 py-1.5 text-sm {{ $bonds->currentPage() === $page ? 'border-emerald-400/60 bg-emerald-500/20 text-emerald-200' : 'border-white/20 text-slate-200' }}"
                    >
                        {{ $page }}
                    </button>
                @endfor

                <button
                    type="button"
                    wire:click="nextPage('bondsPage')"
                    @disabled(! $bonds->hasMorePages())
                    class="rounded-lg border border-white/20 px-3 py-1.5 text-sm text-slate-200 disabled:cursor-not-allowed disabled:opacity-50"
                >
                    Next
                </button>
            </div>
        @endif
    </div>
</section>
