<div class="inline">
    @if ($debt->creditor->payment_qr_code_path)
        <x-jet-secondary-button class="justify-center" wire:click="$set('showModal', true)">
            qr code
        </x-jet-secondary-button>

        <x-jet-modal wire:model="showModal">
            <img
                src="{{ asset(Storage::url($debt->creditor->payment_qr_code_path)) }}"
                alt="payment qr code"
                class="mx-auto">
        </x-jet-modal>
    @else
        <x-jet-secondary-button class="justify-center" disabled>
            qr code
        </x-jet-secondary-button>
    @endif
</div>
