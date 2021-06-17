<form wire:submit.prevent="save" class="sm:p-6 lg:p-8">
    <ol class="grid grid-cols-1 lg:grid-cols-2 gap-4">
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

    <x-jet-button type="submit" class="w-full" wire:loading.attr="disabled" wire:target="save">
        <svg wire:loading wire:target="save" class="animate-spin -ml-1 mr-3 h-5 w-5 text-white"
             xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor"
                  d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
        </svg>


        Submit
    </x-jet-button>
</form>
