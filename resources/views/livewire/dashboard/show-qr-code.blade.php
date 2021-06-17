<div>
    @if ($debt->creditor->payment_qr_code_path)
        <x-jet-secondary-button class="w-full justify-center" wire:click="$set('showModal', true)">
            qr code
        </x-jet-secondary-button>

        <x-jet-modal wire:model="showModal">
            <img
                src="{{ asset(Storage::url($debt->creditor->payment_qr_code_path)) }}"
                alt="payment qr code">
        </x-jet-modal>
    @endif
</div>
