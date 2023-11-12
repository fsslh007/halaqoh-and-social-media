<!-- resources/views/elements/delete-room-modal.blade.php -->

<div>
    <x-jet-dialog-modal wire:model="isOpenDeleteRoomModal">
        <x-slot name="title">
            {{ __('Delete Classroom') }}
        </x-slot>

        <x-slot name="content">
            {{ __('Are you sure you want to delete this classroom?') }}
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('isOpenDeleteRoomModal')" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-jet-secondary-button>

            <x-jet-danger-button wire:click="deleteRoom" wire:loading.attr="disabled">
                {{ __('Delete') }}
            </x-jet-danger-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>
