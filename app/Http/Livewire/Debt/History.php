<?php

namespace App\Http\Livewire\Debt;

use App\Models\Debt;
use Illuminate\Http\Request;
use Livewire\Component;
use Livewire\WithPagination;

class History extends Component
{
    use WithPagination;

    public function markAsUnpaid(Debt $debt)
    {
        $debt->update(['paid_at' => null]);
    }

    public function deleteDebt(Debt $debt)
    {
        $debt->delete();
    }

    public function render(Request $request)
    {
        $debts = Debt::whereCreditorId($request->user()->id)
            ->whereNotNull('paid_at')
            ->orderByDesc('paid_at')
            ->paginate();

        return view('livewire.debt.history', compact('debts'));
    }
}
