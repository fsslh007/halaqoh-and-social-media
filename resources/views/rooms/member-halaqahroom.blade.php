<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Member') }}
        </h2>
    </x-slot>

    @if(isset($roomId) && isset($classroomName))
        <livewire:rooms.member-halaqahroom :roomId="$roomId" :classroomName="$classroomName" />
    @else
        <p>Missing required data to render the component.</p>
    @endif

</x-app-layout>
