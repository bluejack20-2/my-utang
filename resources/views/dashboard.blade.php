<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <main class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="bg-white overflow-hidden shadow rounded-lg divide-y divide-gray-200">
                    <div class="px-4 py-5 sm:px-6">
                        <a href="{{ route('debt.create-form') }}">
                            <x-jet-button>
                                create debt
                            </x-jet-button>
                        </a>
                    </div>

                    <div class="px-4 py-5 sm:p-6 grid grid-cols-1 gap-8">
                        <section>
                            <h3 class="mb-4">Unpaid Debts</h3>

                            <div class="flex flex-col">
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
                                                @foreach ($unpaidDebts as $debt)
                                                    <tr class="{{ $loop->odd ? 'bg-white' : 'bg-gray-50' }} hover:bg-gray-200">
                                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 truncate">
                                                            {{ $debt->creditor->name }}
                                                        </td>
                                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                            {{ $debt->description }}
                                                        </td>
                                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                            Rp.{{ number_format($debt->price, 2) }}
                                                        </td>
                                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                            {{ $debt->created_at->toDayDateTimeString() }}
                                                        </td>
                                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium @if ($debt->creditor->payment_qr_code_path) grid grid-cols-2 gap-2 @endif"
                                                            x-data="{ open: false }">
                                                            @if ($debt->is_paid)
                                                                <form method="post"
                                                                      action="{{ route('debt.mark-unpaid', $debt) }}">
                                                                    @csrf
                                                                    <x-jet-secondary-button type="submit">
                                                                        mark as unpaid
                                                                    </x-jet-secondary-button>
                                                                </form>
                                                            @else
                                                                <form method="post"
                                                                      action="{{ route('debt.mark-paid', $debt) }}">
                                                                    @csrf
                                                                    <x-jet-button type="submit">
                                                                        mark as paid
                                                                    </x-jet-button>
                                                                </form>
                                                            @endif

                                                            @if ($debt->creditor->payment_qr_code_path)
                                                                <x-jet-secondary-button class="justify-center"
                                                                                        @click="open = true">
                                                                    qr code
                                                                </x-jet-secondary-button>

                                                                <aside x-show="open"
                                                                       class="fixed inset-0 w-screen h-screen flex justify-center">
                                                                    <div
                                                                        @click="open = false"
                                                                        style="z-index: -1;"
                                                                        class="absolute w-screen h-screen bg-black opacity-50"></div>

                                                                    <div class="mx-auto py-8">
                                                                        <img
                                                                            src="{{ asset(Storage::url($debt->creditor->payment_qr_code_path)) }}"
                                                                            alt="payment qr code"
                                                                            class="h-full rounded">
                                                                    </div>
                                                                </aside>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
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

                            <div class="flex flex-col">
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
                                                @foreach ($myDebts as $debt)
                                                    <tr class="{{ $loop->odd ? 'bg-white' : 'bg-gray-50' }} hover:bg-gray-200">
                                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 truncate">
                                                            {{ $debt->debtor->name }}
                                                        </td>
                                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                            {{ $debt->description }}
                                                        </td>
                                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                            Rp.{{ number_format($debt->price, 2) }}
                                                        </td>
                                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                            {{ $debt->created_at->toDayDateTimeString() }}
                                                        </td>
                                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                            @if ($debt->is_paid)
                                                                <form method="post"
                                                                      action="{{ route('debt.mark-unpaid', $debt) }}">
                                                                    @csrf
                                                                    <x-jet-secondary-button type="submit">
                                                                        mark as unpaid
                                                                    </x-jet-secondary-button>
                                                                </form>
                                                            @else
                                                                <form method="post"
                                                                      action="{{ route('debt.mark-paid', $debt) }}">
                                                                    @csrf
                                                                    <x-jet-button type="submit">
                                                                        mark as paid
                                                                    </x-jet-button>
                                                                </form>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
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
                    </div>
                </div>
            </div>
        </div>
    </main>
</x-app-layout>
