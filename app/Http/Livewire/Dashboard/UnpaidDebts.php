<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\Debt;
use Illuminate\Http\Request;
use Livewire\Component;
use Livewire\WithPagination;

class UnpaidDebts extends Component
{
    use WithPagination;

    protected $listeners = ['refresh' => '$refresh'];

    public function markAsPaid(Debt $debt)
    {
        $this->emit('markAsPaid', $debt);
    }

    public function deleteDebt(Debt $debt)
    {
        $this->emit('deleteDebt', $debt);
    }

    public function markAllAsPaid()
    {
        $this->emit('markAllAsPaid');
    }

    public function render(Request $request)
    {
        $builder = Debt::whereDebtorId($request->user()->id)
            ->whereNull('paid_at');

        $totalPrice = $builder->sum('price');

        $unpaidDebts = $builder
            ->orderByDesc('created_at')
            ->paginate(5);

        return view('livewire.dashboard.unpaid-debts', compact('totalPrice', 'unpaidDebts'));
    }
}
