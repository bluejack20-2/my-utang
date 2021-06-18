<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\Debt;
use App\Models\User;
use Illuminate\Http\Request;
use Livewire\Component;

class CreateDebt extends Component
{
    public $debtor_id = 0;
    public $description = '';
    public $price = 0;

    protected $rules = [
        'debtor_id' => 'required|exists:users,id',
        'description' => 'required|string',
        'price' => 'required|integer|min:1',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function save(Request $request)
    {
        $data = $this->validate();

        $data = collect($data)
            ->forget('_token')
            ->merge(['creditor_id' => $request->user()->id])
            ->all();

        Debt::create($data);
        $this->reset();

        $this->emit('refresh');
    }

    public function render()
    {
        return view('livewire.dashboard.create-debt', [
            'users' => User::orderBy('username')->get()
        ]);
    }
}
