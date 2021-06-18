<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\Debt;
use Illuminate\Http\Request;
use Livewire\Component;
use Livewire\WithPagination;

class MyDebts extends Component
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

    public function render(Request $request)
    {
        $myDebts = Debt::whereCreditorId($request->user()->id)
            ->whereNull('paid_at')
            ->orderBy('created_at')
            ->paginate(5);

        return view('livewire.dashboard.my-debts', compact('myDebts'));
    }
}
