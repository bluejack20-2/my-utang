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
                                <x-jet-button wire:click="markAsPaid({{ $debt }})">
                                    mark as paid
                                </x-jet-button>
                            </td>
                        </tr>
                        @empty
                            <tr class="bg-white">
                                <td colspan="5" class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 truncate text-center">
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
