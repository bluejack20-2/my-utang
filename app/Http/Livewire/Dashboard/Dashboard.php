<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\Debt;
use Illuminate\Http\Request;
use Livewire\Component;
use Livewire\WithPagination;

class Dashboard extends Component
{
    public $showCreateDebtModal = false;

    protected $listeners = ['markAsPaid', 'deleteDebt', 'markAllAsPaid'];

    public function markAsPaid(Debt $debt)
    {
        $debt->update(['paid_at' => now()]);
        $this->emit('refresh');
    }

    public function deleteDebt(Debt $debt)
    {
        $debt->delete();
        $this->emit('refresh');
    }

    public function markAllAsPaid(Request $request)
    {
        Debt::whereDebtorId($request->user()->id)
            ->whereNull('paid_at')
            ->update(['paid_at' => now()]);
        $this->emit('refresh');
    }

    public function render()
    {
        return view('livewire.dashboard.dashboard');
    }
}
