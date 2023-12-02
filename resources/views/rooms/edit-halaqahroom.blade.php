<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Settings') }}
        </h2>
    </x-slot>

    <livewire:rooms.edit-halaqahroom :roomId="$roomId" />
    @livewireScripts
    <script>
        document.addEventListener('livewire:load', function () {
            Livewire.on('saved', () => {
                console.log('Saved event triggered'); // Check if this log appears in the console upon save
                Livewire.emit('notifySaved');
            });
        });
    </script>
</x-app-layout>
