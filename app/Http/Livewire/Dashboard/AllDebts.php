<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\Debt;
use Illuminate\Http\Request;
use Livewire\Component;

class AllDebts extends Component
{
    public $showCreateDebtModal = false;

    protected $listeners = ['createDebt'];

    public function createDebt($data)
    {
        Debt::create($data);
    }

    public function markAsPaid(Debt $debt)
    {
        $debt->update(['paid_at' => now()]);
    }

    public function deleteDebt(Debt $debt)
    {
        $debt->delete();
    }

    public function markAllAsPaid(Request $request)
    {
        Debt::whereDebtorId($request->user()->id)
            ->whereNull('paid_at')
            ->update(['paid_at' => now()]);
    }

    public function render(Request $request)
    {
        $builder = Debt::whereDebtorId($request->user()->id)
            ->whereNull('paid_at');

        $totalPrice = $builder->sum('price');

        $unpaidDebts = $builder
            ->orderBy('created_at')
            ->paginate(5);

        $myDebts = $builder
            ->orderByDesc('created_at')
            ->paginate(5);

        return view('livewire.dashboard.all-debts', compact('totalPrice', 'unpaidDebts', 'myDebts'));
    }
}
