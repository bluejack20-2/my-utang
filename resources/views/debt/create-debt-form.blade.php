<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <main class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                    <form method="post" action="{{ route('debt.create') }}">
                        @csrf

                        <ol>
                            @foreach ($users as $user)
                                <li class="my-4 flex items-center">
                                    <input type="radio" name="debtor_id" value="{{ $user->id }}" class="mr-2">
                                    <span>{{ $user->name }}</span>
                                </li>
                            @endforeach
                        </ol>

                        <div class="grid grid-cols-2 gap-4 my-4">
                            <x-jet-input type="text" name="description" placeholder="Description e.g. Lunch yesterday"
                                         required/>

                            <x-jet-input type="number" name="price" placeholder="Price" min="0" value="0" required/>
                        </div>

                        <x-jet-button type="submit">Submit</x-jet-button>
                    </form>
                </div>
            </div>
        </div>
    </main>
</x-app-layout>
