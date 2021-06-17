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
                        <a href="{{ route('debt.create') }}">
                            <x-jet-button>
                                create debt
                            </x-jet-button>
                        </a>
                    </div>

                    <div class="px-4 py-5 sm:p-6 grid grid-cols-1 gap-8">
                        <section>
                            <h3 class="mb-4">Unpaid Debts</h3>
                            <livewire:dashboard.unpaid-debts/>
                        </section>

                        <section>
                            <h3 class="mb-4">My Debts</h3>
                            <livewire:dashboard.my-debts/>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </main>
</x-app-layout>
