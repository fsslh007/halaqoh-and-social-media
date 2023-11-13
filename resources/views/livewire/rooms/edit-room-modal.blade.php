<div>
    <x-jet-dialog-modal wire:model="isOpenEditRoomModal">
        <x-slot name="title">
            {{ __('Edit Classroom') }}
        </x-slot>

        <x-slot name="content">
            <!-- Form for updating room fields -->
            <form wire:submit.prevent="updateRoom">
                <div class="mb-4">
                    <x-jet-label for="name" value="{{ __('Classroom Name') }}" />
                    <x-jet-input id="name" type="text" class="mt-1 block w-full" wire:model.defer="room.name" />
                    <x-jet-input-error for="name" class="mt-2" />
                </div>


                <div class="mb-4">
                    <x-jet-label for="meeting_time" value="{{ __('Meeting Time') }}" />
                    <x-jet-input
                        id="meeting_time"
                        type="text"
                        class="mt-1 block w-full flatpickr"
                        wire:model.defer="room.meeting_time"
                        data-input
                    />
                    <x-jet-input-error for="meeting_time" class="mt-2" />
                </div>

                @section('scripts')
                    @parent
                    <script>
                        document.addEventListener('livewire:load', function () {
                            flatpickr('.flatpickr', {
                                enableTime: true,
                                dateFormat: 'Y-m-d H:i',
                                // Add other Flatpickr options as needed
                            });
                        });
                    </script>
                @endsection

                <div class="mb-4">
                    <x-jet-label for="description" value="{{ __('Description') }}" />
                    <textarea id="description" class="form-input rounded-md shadow-sm mt-1 block w-full" wire:model.defer="room.description"></textarea>
                    <x-jet-input-error for="description" class="mt-2" />
                </div>

                <div class="mb-4">
                    <x-jet-label for="leaving_url" value="{{ __('Leaving URL') }}" />
                    <x-jet-input id="leaving_url" type="text" class="mt-1 block w-full" wire:model.defer="room.leaving_url" />
                    <x-jet-input-error for="leaving_url" class="mt-2" />
                </div>

                <div class="mb-4">
                    <x-jet-label for="password" value="{{ __('Password') }}" />
                    <x-jet-input id="password" type="password" class="mt-1 block w-full" wire:model.defer="room.password" />
                    <x-jet-input-error for="password" class="mt-2" />
                </div>

                <!-- Additional fields as needed -->

                <div class="flex items-center justify-end mt-4">
                    <x-jet-secondary-button wire:click="$toggle('isOpenEditRoomModal')" wire:loading.attr="disabled">
                        {{ __('Cancel') }}
                    </x-jet-secondary-button>

                    <x-jet-button class="ml-2" type="submit" wire:loading.attr="disabled">
                        {{ __('Update') }}
                    </x-jet-button>
                </div>
            </form>
        </x-slot>

        <x-slot name="footer">
            <!-- No need for a footer in this case -->
        </x-slot>
    </x-jet-dialog-modal>
</div>
