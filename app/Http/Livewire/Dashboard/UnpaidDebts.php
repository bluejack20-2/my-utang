<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\Debt;
use Illuminate\Http\Request;
use Livewire\Component;
use Livewire\WithPagination;

class UnpaidDebts extends Component
{
    use WithPagination;

    public function markAsPaid(Debt $debt)
    {
        $debt->update([
            'is_paid' => true,
            'paid_at' => now()
        ]);
    }

    public function render(Request $request)
    {
        return view('livewire.dashboard.unpaid-debts', [
            'unpaidDebts' => Debt::where('is_paid', '=', false)
                ->where('debtor_id', '=', $request->user()->id)
                ->orderBy('created_at')
                ->paginate(5)
        ]);
    }
}
