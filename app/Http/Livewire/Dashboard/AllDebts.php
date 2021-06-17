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
        $debt->update([
            'is_paid' => true,
            'paid_at' => now()
        ]);
    }

    public function deleteDebt(Debt $debt)
    {
        $debt->delete();
    }

    public function markAllAsPaid(Request $request)
    {
        Debt::where('is_paid', '=', false)
            ->where('debtor_id', '=', $request->user()->id)
            ->update([
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

        $myDebts = Debt::where('is_paid', '=', false)
            ->where('creditor_id', '=', $request->user()->id)
            ->orderByDesc('created_at')
            ->paginate(5);

        return view('livewire.dashboard.all-debts', compact('totalPrice', 'unpaidDebts', 'myDebts'));
    }
}
