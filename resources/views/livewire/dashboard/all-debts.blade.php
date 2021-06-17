<div class="bg-white overflow-hidden shadow rounded-lg divide-y divide-gray-200">
    <div class="px-4 py-5 sm:px-6">
        <x-jet-button wire:click="$set('showCreateDebtModal', true)">
            create debt
        </x-jet-button>
    </div>

    <div class="px-4 py-5 sm:p-6 grid grid-cols-1 gap-8">
        <section>
            <h3 class="mb-4">Unpaid Debts</h3>
            <div class="flex flex-col" wire:loading.class="animate-pulse">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Creditor
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Description
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Price
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Created At
                                    </th>
                                    <th scope="col" class="relative px-6 py-3">
                                        <span class="sr-only">Edit</span>
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse ($unpaidDebts as $debt)
                                    <tr class="{{ $loop->odd ? 'bg-white' : 'bg-gray-50' }} hover:bg-gray-200">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 truncate">
                                            {{ $debt->creditor->name }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ Str::title($debt->description) }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            <b>Rp{{ number_format($debt->price, 2) }}</b>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $debt->created_at->toDayDateTimeString() }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium @if ($debt->creditor->payment_qr_code_path) grid grid-cols-1 xl:grid-cols-3 gap-2 @endif">
                                            <x-jet-button class="justify-center" wire:click="markAsPaid({{ $debt }})"
                                                          wire:loading.attr="disabled">
                                                <svg wire:loading class="animate-spin -ml-1 mr-3 h-5 w-5 text-white"
                                                     xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                    <circle class="opacity-25" cx="12" cy="12" r="10"
                                                            stroke="currentColor"
                                                            stroke-width="4"></circle>
                                                    <path class="opacity-75" fill="currentColor"
                                                          d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                                </svg>

                                                mark as paid
                                            </x-jet-button>

                                            <livewire:dashboard.show-qr-code :debt="$debt" :wire:key="$debt->id"/>

                                            <x-jet-danger-button class="justify-center"
                                                                 wire:click="deleteDebt({{ $debt }})"
                                                                 wire:loading.attr="disabled">
                                                <svg wire:loading class="animate-spin -ml-1 mr-3 h-5 w-5 text-white"
                                                     xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                    <circle class="opacity-25" cx="12" cy="12" r="10"
                                                            stroke="currentColor"
                                                            stroke-width="4"></circle>
                                                    <path class="opacity-75" fill="currentColor"
                                                          d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                                </svg>

                                                delete
                                            </x-jet-danger-button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr class="bg-white">
                                        <td colspan="5"
                                            class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 truncate text-center">
                                            You don't have any unpaid debts.
                                        </td>
                                    </tr>
                                @endforelse

                                @if ($totalPrice > 0)
                                    <tr class="bg-gray-100 border-t">
                                        <th colspan="2"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider text-right">
                                            Total Price
                                        </th>
                                        <td colspan="2"
                                            class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 truncate">
                                            <b>Rp.{{ number_format($totalPrice, 2) }}</b>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <x-jet-button wire:click="markAllAsPaid" wire:loading.attr="disabled">
                                                <svg wire:loading wire:target="markAllAsPaid"
                                                     class="animate-spin -ml-1 mr-3 h-5 w-5 text-white"
                                                     xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                    <circle class="opacity-25" cx="12" cy="12" r="10"
                                                            stroke="currentColor"
                                                            stroke-width="4"></circle>
                                                    <path class="opacity-75" fill="currentColor"
                                                          d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                                </svg>

                                                Mark all as paid
                                            </x-jet-button>
                                        </td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>

                            <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
                                {{ $unpaidDebts->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section>
            <h3 class="mb-4">My Debts</h3>
            <div class="flex flex-col" wire:loading.class="animate-pulse">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Debtor
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Description
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Price
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Created At
                                    </th>
                                    <th scope="col" class="relative px-6 py-3">
                                        <span class="sr-only">Edit</span>
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse ($myDebts as $debt)
                                    <tr class="{{ $loop->odd ? 'bg-white' : 'bg-gray-50' }} hover:bg-gray-200">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 truncate">
                                            {{ $debt->debtor->name }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ Str::title($debt->description) }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            <b>Rp{{ number_format($debt->price, 2) }}</b>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $debt->created_at->toDayDateTimeString() }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <x-jet-button class="justify-center" wire:click="markAsPaid({{ $debt }})"
                                                          wire:loading.attr="disabled">
                                                <svg wire:loading class="animate-spin -ml-1 mr-3 h-5 w-5 text-white"
                                                     xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                    <circle class="opacity-25" cx="12" cy="12" r="10"
                                                            stroke="currentColor"
                                                            stroke-width="4"></circle>
                                                    <path class="opacity-75" fill="currentColor"
                                                          d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                                </svg>

                                                mark as paid
                                            </x-jet-button>

                                            <x-jet-danger-button class="justify-center"
                                                                 wire:click="deleteDebt({{ $debt }})"
                                                                 wire:loading.attr="disabled">
                                                <svg wire:loading class="animate-spin -ml-1 mr-3 h-5 w-5 text-white"
                                                     xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                    <circle class="opacity-25" cx="12" cy="12" r="10"
                                                            stroke="currentColor"
                                                            stroke-width="4"></circle>
                                                    <path class="opacity-75" fill="currentColor"
                                                          d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                                </svg>

                                                delete
                                            </x-jet-danger-button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr class="bg-white">
                                        <td colspan="5"
                                            class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 truncate text-center">
                                            You don't have any debtor.
                                        </td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>

                            <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
                                {{ $myDebts->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <x-jet-modal wire:model="showCreateDebtModal">
            <livewire:debt.create-debt/>
        </x-jet-modal>
    </div>
</div>
