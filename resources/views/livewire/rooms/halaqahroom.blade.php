<!-- resources/views/livewire/rooms/halaqahroom.blade.php -->

<div class="flex items-center justify-center h-screen mt-8 mx-4">
    <div class="p-8 rounded-lg w-full max-w-2xl">
        {{-- Big square covering all details --}}
        <div class="grid grid-cols-2 gap-4">
            {{-- Small square for Classroom Name --}}
            <div class="p-4 bg-white shadow-md rounded-lg col-span-2 mx-2 text-center">
                <h1 style="font-size: 1.5rem; font-weight: bold;" class="mb-2">Classroom: {{ $classroomName }}</h1>
            </div>
            
            {{-- Small square for Meeting Time, Description, and Leaving URL --}}
            <div class="p-4 bg-white shadow-md rounded-lg mx-2">
                <p class="text-lg"><strong>Meeting Time:</strong> {{ $room->meeting_time }}</p>
                <p class="text-lg"><strong>Description:</strong> {{ $room->description }}</p>
                <p class="text-lg"><strong>Leaving URL:</strong> {{ $room->leaving_url }}</p>
                {{-- Add other fields as needed --}}

                <!-- Edit Halaqah Button -->
                <div class="mt-4 text-center relative">
                    <button 
                        wire:click="editHalaqah('{{ $editRoomId }}')"
                        class="bg-black text-white px-4 py-2 rounded-md focus:outline-none relative z-10"
                        style="position: relative; z-index: 10; background-color: black;"
                    >
                        {{ __('Edit Halaqah') }}
                        <div class="absolute top-0 left-0 h-full w-full bg-black opacity-75 z-0"></div>
                    </button>
                </div>

            </div>
        </div>
    </div>
</div>
