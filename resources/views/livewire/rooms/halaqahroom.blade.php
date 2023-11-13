<!-- resources/views/livewire/rooms/halaqahroom.blade.php -->

<div class="flex items-center justify-center h-screen mt-8 mx-4">
    <div class="p-8 rounded-lg w-full max-w-2xl">
        {{-- Big square covering all details --}}
        <div class="grid grid-cols-2 gap-4">
            {{-- Small square for Classroom Name --}}
            <div class="p-4 bg-white shadow-md rounded-lg col-span-2 mx-2 text-center">
                <h1 style="font-size: 1.5rem; font-weight: bold;" class="mb-2">Halaqah: {{ $classroomName }}</h1>
            </div>

            {{-- Small square for Meeting Time, Description, and Leaving URL --}}
            <div class="p-4 bg-white shadow-md rounded-lg mx-2">

                <!-- Show owner created Halaqah -->
                <div class="w-full flex-none mb-2 text-xs text-blue-700 font-medium" wire:offline.class.remove="text-blue-700" wire:offline.class="text-gray-400">
                    @if ($room->user)
                        <a href="{{ route('profile', ['username' => $room->user->username]) }}">
                            <img class="inline-block object-cover w-8 h-8 mr-1 text-white rounded-full shadow-sm cursor-pointer" wire:offline.class="filter grayscale" src="{{ $room->user->profile_photo_url }}" alt="{{ $room->user->name }}" />
                            Created by {{ '@' . $room->user->username }}
                        </a>
                    @else
                        <span class="text-gray-500">Creator information not available</span>
                    @endif
                </div>

                <p class="text-lg"><strong>Meeting Time:</strong> {{ $room->meeting_time }}</p>
                <p class="text-lg"><strong>Description:</strong> {{ $room->description }}</p>
                <p class="text-lg"><strong>Meeting URL:</strong> {{ $room->leaving_url }}</p>
                
                {{-- Add other fields as needed --}}
                
                <div class="mt-4 relative">

                <!-- Edit Halaqah Button -->
                @can('update', $room)
                <button
                    id="edit_room_{{ $room->id }}"
                    wire:click="showEditRoomModal({{ $room->id }})"
                    class="bg-black text-white px-4 py-2 rounded-md focus:outline-none relative z-10"
                    style="position: relative; z-index: 10; background-color: black;"
                >
                    {{ __('Edit Halaqah') }}
                    <div class="absolute top-0 left-0 h-full w-full bg-black opacity-75 z-0"></div>
                </button>
                @endcan

                    <!-- Delete Post Button -->
                    @can('delete', $room)
                    <button
                        id="delete_room_{{ $room->id }}"
                        wire:click="showDeleteRoomModal({{ $room->id }})"
                        class="bg-red-600 text-white px-4 py-2 rounded-md focus:outline-none"
                    >
                        {{ __('Delete Halaqah') }}
                    </button>
                    @endcan

                <!-- Include the Edit Room Modal -->
                @include('livewire.rooms.edit-room-modal')

                <!-- Include the Delete Room Modal -->
                @include('elements.delete-room-modal')

                <!-- Script refresh page after Edit Halaqah -->
                <script>
                    document.addEventListener('livewire:load', function () {
                        Livewire.on('refreshLivewireComponent', function () {
                            window.location.reload();
                        });
                    });
                </script>

                </div>
            </div>
        </div>
    </div>
</div>
