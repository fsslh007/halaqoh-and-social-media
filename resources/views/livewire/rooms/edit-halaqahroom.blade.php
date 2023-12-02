<!DOCTYPE html>
<html>
<head>
    <!-- Other head elements -->

    @livewireStyles <!-- Include Livewire styles -->

    <!-- Other CSS -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>
<body>
    <div>
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

        </div>
    </div>

    <!-- Livewire scripts and other scripts -->
    @livewireScripts <!-- Include Livewire scripts -->

    <script>
        Livewire.on('notifySaved', () => {
            Livewire.emit('refreshComponent');
        });
    </script>

    <!-- Other scripts -->
</body>
</html>
