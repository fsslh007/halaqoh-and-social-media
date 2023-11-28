<div class="flex items-center justify-center h-screen flex-col">

    <!-- Some Free Space from Top -->
    <div class="mt-4"></div>

    <div class="flex items-center justify-center h-screen bg-green-200">
        <!-- Create Halaqah Button -->
        <div class="flex-grow ml-4 w-60 mb-8">
            <button id="create_halaqah" wire:click="showCreateHalaqahModal" class="w-full text-white px-4 py-2 rounded-full focus:outline-none relative z-10" style="background-color: #4CAF50;">
                <span class="absolute top-0 left-0 h-full w-full bg-green-500 opacity-0 z-0 rounded-full"></span>
                <span class="relative z-10">{{ __('+ Create Halaqah') }}</span>
            </button>
        </div>
    </div>

    @include('rooms.create-halaqah-modal')

    <!-- Section for displaying the user's created Halaqah -->
    <div>
        <div class="mt-8 flex justify-center">
            <h1 class="w-96 py-4 bg-white shadow-md rounded-lg text-center font-bold" style="padding-left: 150px; padding-right: 150px; font-size: 1.5rem;">MY HALAQAH</h1>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 w-full">
            @foreach ($rooms as $room)
                @if ($room->user_id === $currentUserId)
                    <div class="p-4 flex-shrink-0">
                        <div class="bg-white shadow-md overflow-hidden rounded-lg h-full flex flex-col items-center justify-center">
                            <div class="text-center mb-4 whitespace-pre-line">
                                <h2 class="text-lg font-semibold">Halaqah: {{ wordwrap($room->name, 45, "\n", true) }}</h2>
                            </div>
                            <div class="text-center mb-4 whitespace-pre-line">
                                <p><strong>Description:</strong> {{ wordwrap($room->description, 45, "\n", true) }}</p>
                            </div>
                            <div class="text-center mb-4 whitespace-pre-line">
                                <p><strong>Meeting Time:</strong> {{ wordwrap($room->meeting_time, 45, "\n", true) }}</p>
                            </div>

                            <!-- Show owner created Halaqah -->
                            <div class="w-full flex-none mb-2 text-center text-xs text-blue-700 font-medium" wire:offline.class.remove="text-blue-700" wire:offline.class="text-gray-400">
                                @if ($room->user)
                                    <a href="{{ route('profile', ['username' => $room->user->username]) }}">
                                        <img class="inline-block object-cover w-8 h-8 mr-1 text-white rounded-full shadow-sm cursor-pointer" wire:offline.class="filter grayscale" src="{{ $room->user->profile_photo_url }}" alt="{{ $room->user->name }}" />
                                        Created by {{ '@' . $room->user->username }}
                                    </a>
                                @else
                                    <span class="text-gray-500">Creator information not available</span>
                                @endif
                            </div>

                            <!-- Add other fields as needed -->

                            <!-- Join Halaqah Button -->
                            <div class="mt-4">
                                <x-jet-button wire:click="joinHalaqah('{{ $room->id }}', '{{ $room->name }}')">
                                    {{ __('Join Halaqah') }}
                                </x-jet-button>
                            </div>

                            <!-- Add free space at the bottom -->
                            <div class="mb-2"></div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>

    <!-- show all created Halaqah -->
    <div>
        <div class="mt-8 flex justify-center">
            <h1 class="w-96 py-4 bg-white shadow-md rounded-lg text-center font-bold" style="padding-left: 150px; padding-right: 150px; font-size: 1.5rem;">ALL HALAQAH</h1>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 w-full">
            @foreach ($rooms as $room)
                <div class="p-4 flex-shrink-0">
                    <div class="bg-white shadow-md overflow-hidden rounded-lg h-full flex flex-col items-center justify-center">
                        <div class="text-center mb-4 whitespace-pre-line">
                            <h2 class="text-lg font-semibold">Halaqah: {{ wordwrap($room->name, 45, "\n", true) }}</h2>
                        </div>
                        <div class="text-center mb-4 whitespace-pre-line">
                            <p><strong>Description:</strong> {{ wordwrap($room->description, 45, "\n", true) }}</p>
                        </div>
                        <div class="text-center mb-4 whitespace-pre-line">
                            <p><strong>Meeting Time:</strong> {{ wordwrap($room->meeting_time, 45, "\n", true) }}</p>
                        </div>

                        <!-- Show owner created Halaqah -->
                        <div class="w-full flex-none mb-2 text-center text-xs text-blue-700 font-medium" wire:offline.class.remove="text-blue-700" wire:offline.class="text-gray-400">
                            @if ($room->user)
                                <a href="{{ route('profile', ['username' => $room->user->username]) }}">
                                    <img class="inline-block object-cover w-8 h-8 mr-1 text-white rounded-full shadow-sm cursor-pointer" wire:offline.class="filter grayscale" src="{{ $room->user->profile_photo_url }}" alt="{{ $room->user->name }}" />
                                    Created by {{ '@' . $room->user->username }}
                                </a>
                            @else
                                <span class="text-gray-500">Creator information not available</span>
                            @endif
                        </div>

                        <!-- Add other fields as needed -->

                        <!-- Join Halaqah Button -->
                        <div class="mt-4">
                            <x-jet-button wire:click="joinHalaqah('{{ $room->id }}', '{{ $room->name }}')">
                                {{ __('Join Halaqah') }}
                            </x-jet-button>
                        </div>

                        <!-- Add free space at the bottom -->
                        <div class="mb-2"></div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>