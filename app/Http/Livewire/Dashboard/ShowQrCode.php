<?php

namespace App\Http\Livewire\Dashboard;

use Livewire\Component;

class ShowQrCode extends Component
{
    public $debt;
    public $showModal = false;

    public function render()
    {
        return view('livewire.dashboard.show-qr-code');
    }
}
