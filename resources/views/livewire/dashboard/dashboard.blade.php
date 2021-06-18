<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Dashboard') }}
    </h2>
</x-slot>

<main class="py-12">
    <div class="max-w-screen-2xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="bg-white overflow-hidden shadow rounded-lg divide-y divide-gray-200">
                <div class="px-4 py-5 sm:px-6">
                    <x-jet-button wire:click="$set('showCreateDebtModal', true)" wire:loading.attr="disabled" wire:target="$set">
                        <svg wire:loading wire:target="$set"
                             class="animate-spin -ml-1 mr-3 h-5 w-5 text-white"
                             xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10"
                                    stroke="currentColor"
                                    stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor"
                                  d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>

                        create debt
                    </x-jet-button>

                    <x-jet-modal wire:model="showCreateDebtModal">
                        <livewire:dashboard.create-debt/>
                    </x-jet-modal>
                </div>

                <div class="px-4 py-5 sm:p-6 grid grid-cols-1 gap-8">
                    <livewire:dashboard.unpaid-debts/>
                    <livewire:dashboard.my-debts/>
                </div>
            </div>
        </div>
    </div>
</main>
