<?php

namespace App\Http\Livewire\Profile;

use Illuminate\Http\Request;
use Livewire\Component;
use Livewire\WithFileUploads;
use Storage;

class UpdateQrCodeForm extends Component
{
    use WithFileUploads;

    public $user;
    public $photo;

    public function mount(Request $request)
    {
        $this->user = $request->user();
    }

    public function updatedPhoto()
    {
        $this->validate(['photo' => 'required|image']);

        if ($this->user->payment_qr_code_path) {
            Storage::disk('public')->delete($this->user->payment_qr_code_path);
        }

        $this->user->update([
            'payment_qr_code_path' => $this->photo->storePublicly('payment-qr-codes', 'public')
        ]);
    }

    public function render()
    {
        return view('livewire.profile.update-qr-code-form');
    }
}
