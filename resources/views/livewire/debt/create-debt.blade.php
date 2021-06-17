<form wire:submit.prevent="save">
    <ol class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-4">
        @foreach ($users as $user)
            <li>
                <label class="flex">
                    <x-jet-input type="radio" wire:model="debtor_id" value="{{ $user->id }}" class="mr-2 m-1"/>
                    <span>{{ $user->name }}</span>
                </label>
            </li>
        @endforeach
    </ol>

    <x-jet-input-error for="debtor_id"/>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 my-4">
        <div>
            <x-jet-input type="text" wire:model="description" placeholder="Description e.g. Lunch" class="w-full"/>
            <x-jet-input-error for="description"/>
        </div>

        <div>
            <x-jet-input type="number" wire:model="price" placeholder="Price" class="w-full"/>
            <x-jet-input-error for="price"/>
        </div>
    </div>

    <x-jet-button type="submit">
        Submit
    </x-jet-button>
</form>
