<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Halaqah Room - ' . $classroomName) }}
        </h2>
    </x-slot>

    <div class="container px-3 mx-auto grid bg-gray-100">
        <style>
            input, textarea, button, select, a { -webkit-tap-highlight-color: rgba(0,0,0,0); }
            button:focus{ outline:0 !important; } 
            
        </style>

        <livewire:rooms.halaqahroom :roomId="$id" :classroomName="$classroomName" />

        
    </div>
</x-app-layout>
