<?php

namespace App\Livewire\Citizen;

use App\Models\PrizeBondDraw;
use App\Models\UserResultVerification;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ResultVerify extends Component
{
    public bool $isProcessing = false;
    public array $blockProgress = [];
    public array $pendingBlockIds = [];
    public int $processingPointer = 0;
    public ?int $currentBlockId = null;
    public array $winnerMap = [];
    public int $totalMatchedInRun = 0;
    public ?string $runMessage = null;

    public function startVerification(): void
    {
        $blocks = Auth::user()
            ->prizeBondBlocks()
            ->orderBy('id')
            ->get(['id', 'name']);

        if ($blocks->isEmpty()) {
            $this->addError('verification', 'No block found. Please add a block first.');

            return;
        }

        $draws = PrizeBondDraw::query()
            ->where('is_valid', true)
            ->with('winners:id,prize_bond_draw_id,prize_type,bond_number')
            ->get();

        $winnerMap = [];
        foreach ($draws as $draw) {
            foreach ($draw->winners as $winner) {
                $key = strtoupper(trim($winner->bond_number));
                $winnerMap[$key][] = [
                    'draw_id' => $draw->id,
                    'prize_type' => $winner->prize_type,
                    'prize_amount' => $this->prizeAmountByType($draw, $winner->prize_type),
                    'draw_title' => $draw->draw_title,
                    'draw_date' => $draw->draw_date->toDateString(),
                ];
            }
        }

        $this->resetErrorBag('verification');
        $this->winnerMap = $winnerMap;
        $this->pendingBlockIds = $blocks->pluck('id')->map(fn ($id) => (int) $id)->values()->all();
        $this->blockProgress = $blocks->map(fn ($block) => [
            'id' => (int) $block->id,
            'name' => $block->name,
            'status' => 'pending',
            'matched' => 0,
        ])->values()->all();
        $this->processingPointer = 0;
        $this->currentBlockId = null;
        $this->totalMatchedInRun = 0;
        $this->runMessage = null;
        $this->isProcessing = true;
    }

    public function processNextBlock(): void
    {
        if (! $this->isProcessing) {
            return;
        }

        $blockId = $this->pendingBlockIds[$this->processingPointer] ?? null;
        if (! $blockId) {
            $this->finishProcessing();

            return;
        }

        $this->currentBlockId = $blockId;

        $block = Auth::user()
            ->prizeBondBlocks()
            ->with('prizeBonds:id,prize_bond_block_id,prize_bond_series_id,bond_number')
            ->find($blockId);

        $matchedInBlock = 0;

        if ($block) {
            foreach ($block->prizeBonds as $bond) {
                $key = strtoupper(trim($bond->bond_number));
                $entries = $this->winnerMap[$key] ?? [];

                foreach ($entries as $entry) {
                    UserResultVerification::query()->updateOrCreate(
                        [
                            'user_id' => Auth::id(),
                            'prize_bond_id' => $bond->id,
                            'prize_bond_block_id' => $block->id,
                            'prize_bond_draw_id' => $entry['draw_id'],
                            'bond_number' => strtoupper(trim($bond->bond_number)),
                            'prize_type' => $entry['prize_type'],
                        ],
                        [
                            'prize_amount' => $entry['prize_amount'],
                            'draw_title' => $entry['draw_title'],
                            'draw_date' => $entry['draw_date'],
                        ]
                    );

                    $matchedInBlock++;
                    $this->totalMatchedInRun++;
                }
            }
        }

        foreach ($this->blockProgress as $index => $item) {
            if ((int) $item['id'] === (int) $blockId) {
                $this->blockProgress[$index]['status'] = 'completed';
                $this->blockProgress[$index]['matched'] = $matchedInBlock;
                break;
            }
        }

        $this->processingPointer++;

        if ($this->processingPointer >= count($this->pendingBlockIds)) {
            $this->finishProcessing();
        }
    }

    public function deleteSavedResult(int $resultId): void
    {
        UserResultVerification::query()
            ->where('user_id', Auth::id())
            ->whereKey($resultId)
            ->delete();
    }

    public function render()
    {
        $savedResults = UserResultVerification::query()
            ->where('user_id', Auth::id())
            ->with(['block', 'draw.series'])
            ->latest('draw_date')
            ->latest('id')
            ->get();

        $hasBlocks = Auth::user()->prizeBondBlocks()->exists();

        return view('livewire.citizen.result-verify', [
            'savedResults' => $savedResults,
            'hasBlocks' => $hasBlocks,
        ]);
    }

    private function finishProcessing(): void
    {
        $this->isProcessing = false;
        $this->currentBlockId = null;
        $this->runMessage = 'Verification completed. Matched results: '.$this->totalMatchedInRun.'.';
    }

    private function prizeAmountByType(PrizeBondDraw $draw, string $prizeType): string
    {
        return match ($prizeType) {
            'first' => $draw->first_prize_amount,
            'second' => $draw->second_prize_amount,
            'third' => $draw->third_prize_amount,
            'fourth' => $draw->fourth_prize_amount,
            default => $draw->fifth_prize_amount,
        };
    }
}
