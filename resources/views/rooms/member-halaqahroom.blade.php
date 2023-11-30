<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Member') }}
        </h2>
    </x-slot>

    <livewire:rooms.member-halaqahroom :roomId="$roomId" :classroomName="$classroomName" />

</x-app-layout>
