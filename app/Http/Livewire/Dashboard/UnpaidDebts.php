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
        $builder = Debt::where('is_paid', '=', false)
            ->where('debtor_id', '=', $request->user()->id);

        $totalPrice = $builder->sum('price');
        $unpaidDebts = $builder
            ->orderBy('created_at')
            ->paginate(5);

        return view('livewire.dashboard.unpaid-debts', compact('totalPrice', 'unpaidDebts'));
    }
}
