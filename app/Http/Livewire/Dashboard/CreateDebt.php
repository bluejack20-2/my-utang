<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\Debt;
use App\Models\User;
use Illuminate\Http\Request;
use Livewire\Component;

class CreateDebt extends Component
{
    public $debtors = [];
    public $description = '';
    public $price = 0;

    protected $rules = [
        'debtors' => 'required|array',
        'description' => 'required|string',
        'price' => 'required|integer|min:1',
    ];

    public function save(Request $request)
    {
        $data = $this->validate();

        $data = collect($data['debtors'])
            ->filter(function ($isSelected) {
                return $isSelected;
            })
            ->map(function ($isSelected, $userId) use ($data, $request) {
                return [
                    'creditor_id' => $request->user()->id,
                    'debtor_id' => $userId,
                    'description' => $data['description'],
                    'price' => $data['price'],
                    'created_at' => now()
                ];
            })
            ->all();

        Debt::insert($data);
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
