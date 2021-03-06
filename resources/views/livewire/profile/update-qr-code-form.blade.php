<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('QR Code') }}
    </h2>
</x-slot>

<main class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="px-4 py-5 sm:p-6"
                 x-data="{ isUploading: false, progress: 0 }"
                 x-on:livewire-upload-start="isUploading = true"
                 x-on:livewire-upload-finish="isUploading = false"
                 x-on:livewire-upload-error="isUploading = false"
                 x-on:livewire-upload-progress="progress = $event.detail.progress">
                @if ($user->payment_qr_code_path != null)
                    <img src="{{ asset(Storage::url($user->payment_qr_code_path)) }}" alt="QR Code"
                         class="mx-auto w-96 rounded mb-8">
                @endif

                <div x-show="isUploading">
                    <p class="text-center">Uploading <span x-text="progress"></span>%...</p>
                </div>
                <div x-show="!isUploading">
                    <x-jet-input type="file" wire:model="photo" class="mx-auto block border p-4 rounded"/>
                    @error('photo') <p class="mt-2 text-sm text-red-600 text-center">{{ $message }}</p> @enderror
                </div>
            </div>
        </div>
    </div>
</main>
