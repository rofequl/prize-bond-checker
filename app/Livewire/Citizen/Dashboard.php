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
    public ?int $editingPrizeBondId = null;
    public ?string $editingBlockId = null;
    public ?string $editingSeriesId = null;
    public string $editingBondNumber = '';

    public function paginationView(): string
    {
        return 'livewire.pagination';
    }

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
        $this->resetPage('block'.$block->id.'Page');
        session()->flash('bond_message', 'Prize bond added.');
    }

    public function editPrizeBond(int $prizeBondId): void
    {
        $bond = Auth::user()->prizeBonds()
            ->where('id', $prizeBondId)
            ->firstOrFail();

        $this->resetErrorBag();
        $this->editingPrizeBondId = $bond->id;
        $this->editingBlockId = (string) $bond->prize_bond_block_id;
        $this->editingSeriesId = (string) $bond->prize_bond_series_id;
        $this->editingBondNumber = $bond->bond_number;
    }

    public function cancelEditPrizeBond(): void
    {
        $this->resetEditPrizeBondForm();
    }

    public function updatePrizeBond(): void
    {
        $user = Auth::user();

        if ($this->editingPrizeBondId === null) {
            return;
        }

        $bond = $user->prizeBonds()
            ->where('id', $this->editingPrizeBondId)
            ->firstOrFail();

        $validated = $this->validate([
            'editingBlockId' => ['required', Rule::exists('prize_bond_blocks', 'id')->where('user_id', $user->id)],
            'editingSeriesId' => ['required', Rule::exists('prize_bond_series', 'id')],
            'editingBondNumber' => ['required', 'string', 'max:50'],
        ]);

        $block = PrizeBondBlock::query()
            ->where('id', $validated['editingBlockId'])
            ->where('user_id', $user->id)
            ->withCount('prizeBonds')
            ->firstOrFail();

        if ((int) $bond->prize_bond_block_id !== (int) $block->id && $block->prize_bonds_count >= 100) {
            $this->addError('editingBlockId', 'This block already has 100 bonds.');

            return;
        }

        $alreadyExists = PrizeBond::query()
            ->where('prize_bond_block_id', $block->id)
            ->where('prize_bond_series_id', $validated['editingSeriesId'])
            ->where('bond_number', $validated['editingBondNumber'])
            ->whereKeyNot($bond->id)
            ->exists();

        if ($alreadyExists) {
            $this->addError('editingBondNumber', 'This bond already exists in the selected block.');

            return;
        }

        $bond->update([
            'prize_bond_block_id' => $block->id,
            'prize_bond_series_id' => $validated['editingSeriesId'],
            'bond_number' => $validated['editingBondNumber'],
        ]);

        $this->resetEditPrizeBondForm();
        session()->flash('bond_message', 'Prize bond updated.');
    }

    private function resetEditPrizeBondForm(): void
    {
        $this->resetErrorBag();

        $this->editingPrizeBondId = null;
        $this->editingBlockId = null;
        $this->editingSeriesId = null;
        $this->editingBondNumber = '';
    }

    public function updatingSearchBondNumber(): void
    {
        $this->resetAllBlockPages();
    }

    public function updatingFilterBlockId(): void
    {
        $this->resetAllBlockPages();
    }

    private function resetAllBlockPages(): void
    {
        foreach (Auth::user()->prizeBondBlocks()->pluck('id') as $blockId) {
            $this->resetPage('block'.$blockId.'Page');
        }
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

        $visibleBlocks = $this->filterBlockId === ''
            ? $blocks
            : $blocks->where('id', (int) $this->filterBlockId)->values();

        $blockBondPages = [];
        foreach ($visibleBlocks as $block) {
            $blockBondPages[$block->id] = $block->prizeBonds()
                ->with('series')
                ->when($this->searchBondNumber !== '', function ($query) {
                    $query->where('bond_number', 'like', '%'.trim($this->searchBondNumber).'%');
                })
                ->latest()
                ->paginate(10, ['*'], 'block'.$block->id.'Page');
        }

        $series = PrizeBondSeries::query()
            ->where('is_active', true)
            ->orderBy('name')
            ->get();

        return view('livewire.citizen.dashboard', [
            'user' => $user,
            'stats' => $stats,
            'blocks' => $blocks,
            'visibleBlocks' => $visibleBlocks,
            'blockBondPages' => $blockBondPages,
            'series' => $series,
        ]);
    }
}
