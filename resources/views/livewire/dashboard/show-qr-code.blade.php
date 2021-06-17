<div>
    <x-jet-secondary-button @if ($debt->creditor->payment_qr_code_path) disabled @endif class="w-full justify-center"
                            wire:click="$set('showModal', true)">
        qr code
    </x-jet-secondary-button>

    <x-jet-modal wire:model="showModal">
        <img
            src="{{ asset(Storage::url($debt->creditor->payment_qr_code_path)) }}"
            alt="payment qr code">
    </x-jet-modal>
</div>
