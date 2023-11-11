<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Halaqah Room - ' . $classroomName) }}
        </h2>
    </x-slot>

    <livewire:rooms.halaqahroom :roomId="$id" :classroomName="$classroomName" />

</x-app-layout>
