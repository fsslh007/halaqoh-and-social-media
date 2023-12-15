<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Halaqah Room - ' . $classroomName) }}
            </h2>
            <div class="flex items-center space-x-4">
                @can('update', $room)
                <span>
                    <a href="{{ route('rooms.createMeet', ['room' => $id, 'classroomName' => $classroomName]) }}" 
                        :active="request()->routeIs('rooms.createMeet', ['room' => $id, 'classroomName' => $classroomName])'"
                        class="text-sm text-gray-600 hover:text-gray-900 focus:outline-none ml-4">
                            + Create Meet
                    </a>
                    <a href="{{ route('rooms.member', ['room' => $id, 'classroomName' => $classroomName]) }}" 
                        :active="request()->routeIs('rooms.member', ['room' => $id, 'classroomName' => $classroomName])'"
                        class="text-sm text-gray-600 hover:text-gray-900 focus:outline-none ml-4">
                            Member
                    </a>
                    <a href="{{ route('rooms.edit', ['room' => $id]) }}" 
                        :active="request()->routeIs('rooms.edit', ['room' => $id])')" 
                        class="text-sm text-gray-600 hover:text-gray-900 focus:outline-none ml-4">
                            Settings
                    </a>
                </span>
                @endcan
            </div>
        </div>
    </x-slot>

    <div class="bg-gray-100">
        <style>
            /* Move these styles to your CSS file for better organization */
            input, textarea, button, select, a { -webkit-tap-highlight-color: rgba(0,0,0,0); }
            button:focus{ outline:0 !important; } 
        </style>

        <livewire:rooms.halaqahroom :roomId="$id" :classroomName="$classroomName" />
    </div>
</x-app-layout>
