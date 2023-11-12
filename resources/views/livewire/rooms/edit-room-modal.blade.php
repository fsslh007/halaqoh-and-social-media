<div>
    <x-jet-dialog-modal wire:model="isOpenEditRoomModal">
        <x-slot name="title">
            {{ __('Delete Classroom') }}
        </x-slot>

        <x-slot name="content">
            {{ __('Are you sure you want to delete this classroom?') }}
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('isOpenEditRoomModal')" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-jet-secondary-button>

            <x-jet-danger-button wire:click="EditRoom" wire:loading.attr="disabled">
                {{ __('Delete') }}
            </x-jet-danger-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>
