<?php

namespace App\Livewire\Citizen;

use App\Models\PrizeBond;
use App\Models\PrizeBondBlock;
use App\Models\PrizeBondSeries;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class Dashboard extends Component
{
    use WithPagination;

    public string $profileName = '';
    public string $profileEmail = '';
    public ?string $profilePhone = null;

    public string $blockName = '';
    public ?string $selectedBlockId = null;
    public ?string $selectedSeriesId = null;
    public string $bondNumber = '';
    public string $searchBondNumber = '';
    public string $filterBlockId = '';

    public function mount(): void
    {
        $user = Auth::user();

        $this->profileName = $user->name;
        $this->profileEmail = $user->email;
        $this->profilePhone = $user->phone;
    }

    public function updateProfile(): void
    {
        $user = Auth::user();

        $validated = $this->validate([
            'profileName' => ['required', 'string', 'max:255'],
            'profileEmail' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user->id)],
            'profilePhone' => ['nullable', 'string', 'max:20', Rule::unique('users', 'phone')->ignore($user->id)],
        ]);

        $user->update([
            'name' => $validated['profileName'],
            'email' => $validated['profileEmail'],
            'phone' => $validated['profilePhone'] ?: null,
        ]);

        session()->flash('profile_message', 'Profile updated.');
    }

    public function createBlock(): void
    {
        $validated = $this->validate([
            'blockName' => ['required', 'string', 'max:255'],
        ]);

        $block = Auth::user()->prizeBondBlocks()->create([
            'name' => $validated['blockName'],
        ]);

        $this->blockName = '';
        $this->selectedBlockId = $block->id;
        $this->resetPage('bondsPage');

        session()->flash('block_message', 'Block created.');
    }

    public function addPrizeBond(): void
    {
        $user = Auth::user();

        $validated = $this->validate([
            'selectedBlockId' => ['required', Rule::exists('prize_bond_blocks', 'id')->where('user_id', $user->id)],
            'selectedSeriesId' => ['required', Rule::exists('prize_bond_series', 'id')],
            'bondNumber' => ['required', 'string', 'max:50'],
        ]);

        $block = PrizeBondBlock::query()
            ->where('id', $validated['selectedBlockId'])
            ->where('user_id', $user->id)
            ->withCount('prizeBonds')
            ->firstOrFail();

        if ($block->prize_bonds_count >= 100) {
            $this->addError('selectedBlockId', 'This block already has 100 bonds.');

            return;
        }

        $alreadyExists = PrizeBond::query()
            ->where('prize_bond_block_id', $block->id)
            ->where('prize_bond_series_id', $validated['selectedSeriesId'])
            ->where('bond_number', $validated['bondNumber'])
            ->exists();

        if ($alreadyExists) {
            $this->addError('bondNumber', 'This bond already exists in the selected block.');

            return;
        }

        PrizeBond::create([
            'user_id' => $user->id,
            'prize_bond_block_id' => $block->id,
            'prize_bond_series_id' => $validated['selectedSeriesId'],
            'bond_number' => $validated['bondNumber'],
        ]);

        $this->bondNumber = '';
        $this->resetPage('bondsPage');
        session()->flash('bond_message', 'Prize bond added.');
    }

    public function updatingSearchBondNumber(): void
    {
        $this->resetPage('bondsPage');
    }

    public function updatingFilterBlockId(): void
    {
        $this->resetPage('bondsPage');
    }

    public function render()
    {
        $user = Auth::user();

        $stats = [
            'total_blocks' => $user->prizeBondBlocks()->count(),
            'total_bonds' => $user->prizeBonds()->count(),
        ];

        $blocks = $user->prizeBondBlocks()
            ->withCount('prizeBonds')
            ->latest()
            ->get();

        $bonds = $user->prizeBonds()
            ->with(['series', 'block'])
            ->when($this->searchBondNumber !== '', function ($query) {
                $query->where('bond_number', 'like', '%'.trim($this->searchBondNumber).'%');
            })
            ->when($this->filterBlockId !== '', function ($query) {
                $query->where('prize_bond_block_id', $this->filterBlockId);
            })
            ->latest()
            ->paginate(25, ['*'], 'bondsPage');

        $series = PrizeBondSeries::query()
            ->where('is_active', true)
            ->orderBy('name')
            ->get();

        return view('livewire.citizen.dashboard', [
            'user' => $user,
            'stats' => $stats,
            'blocks' => $blocks,
            'bonds' => $bonds,
            'series' => $series,
        ]);
    }
}
