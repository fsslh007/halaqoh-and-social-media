<x-jet-dialog-modal wire:model="isOpenCreateHalaqahModal">
    <x-slot name="title">
        {{ __('Create Halaqah') }}
    </x-slot>

    <x-slot name="content">
        <x-jet-validation-errors class="mb-4" />

        <form id="createHalaqahForm" wire:submit.prevent="createRoom" enctype="multipart/form-data">
            @csrf

            <div>
                <x-jet-label for="name" value="{{ __('Halaqah Name') }}" />
                <x-jet-input id="name" class="block mt-1 mb-2 w-full" type="text" wire:model.lazy="name" />
            </div>

            <div class="mt-4">
                <x-jet-label for="description" value="{{ __('Description') }}" />
                <textarea rows="5" class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow" wire:model.lazy="description"> </textarea>
            </div>

            <!-- Privacy Field -->
            <div class="mb-4">
                <x-jet-label for="privacy" value="{{ __('Privacy') }}" />
                <select id="privacy" wire:model.lazy="privacy" class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow">
                    <option value="public">Public</option>
                    <option value="private">Private</option>
                </select>
                @error('privacy') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>
        </form>
    </x-slot>

    <x-slot name="footer">
        <div class="flex items-center justify-end mt-4">
            <x-jet-secondary-button wire:click="$set('isOpenCreateHalaqahModal', false)">
                {{ __('Cancel') }}
            </x-jet-secondary-button>

            <x-jet-button type="createRoom" form="createHalaqahForm" class="ml-4">
                {{ __('Create Halaqah') }}
            </x-jet-button>
        </div>
    </x-slot>
</x-jet-dialog-modal>
