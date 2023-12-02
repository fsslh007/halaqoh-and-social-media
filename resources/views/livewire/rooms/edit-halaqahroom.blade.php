<div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
    <!-- Livewire form section -->
    <x-jet-form-section submit="updateHalaqahInformation">
        <!-- Title and description -->
        <x-slot name="title">
            {{ __('Halaqah Information') }}
        </x-slot>
        <x-slot name="description">
            {{ __('Update your halaqah\'s profile information.') }}
        </x-slot>

        <!-- Form fields -->
        <x-slot name="form">
            <!-- Name -->
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="name" value="{{ __('Name') }}" />
                <x-jet-input id="name" type="text" class="mt-1 block w-full" wire:model.defer="state.name" autocomplete="name" />
                <x-jet-input-error for="name" class="mt-2" />
            </div>

            <!-- Description -->
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="description" value="{{ __('Description') }}" />
                <x-jet-input id="description" type="text" class="mt-1 block w-full" wire:model.defer="state.description" />
                <x-jet-input-error for="description" class="mt-2" />
            </div>

            <!-- Actions -->
            <x-slot name="actions">
                <x-jet-action-message class="mr-3" on="saved">
                    {{ __('Saved.') }}
                </x-jet-action-message>

                <x-jet-button wire:loading.attr="disabled">
                    {{ __('Save') }}
                </x-jet-button>
            </x-slot>
        </x-slot>
    </x-jet-form-section>

    <!-- Additional content -->
    <x-jet-section-border />

    
    <!-- Delete Halaqah section -->
    <x-jet-action-section>
        <x-slot name="title">
            {{ __('Delete Halaqah') }}
        </x-slot>

        <x-slot name="description">
            {{ __('Permanently delete your Halaqah.') }}
        </x-slot>

        <x-slot name="content">
            <div class="max-w-xl text-sm text-gray-600">
                {{ __('Once your Halaqah is deleted, all of its resources and data will be permanently deleted. Before deleting your Halaqah, please download any data or information that you wish to retain.') }}
            </div>

            <div class="mt-5">
                <x-jet-danger-button wire:click="confirmDelete({{ $roomId }})" wire:loading.attr="disabled">
                    {{ __('Delete Halaqah') }}
                </x-jet-danger-button>
            </div>

            <!-- Include your delete room modal -->
            @include('elements.delete-room-modal')
        </x-slot>
    </x-jet-action-section>

        <!-- Additional content -->
        <x-jet-section-border />
        
</div>