<div>
    <div class="flex flex-col mx-2 my-5 md:mx-6 md:my-12 lg:my-8 lg:w-2/5 lg:mx-auto">
        <div class="bg-white shadow-md rounded-3xl p-4 justify-center">
            <div class="flex-none">
                <div class="flex items-center justify-between">
                    <!-- search bar -->
                    <div class="flex-grow ml-4 w-4/5 justify-center sm:ml-auto mr-5">
                        <form class="hidden sm:block"> <!-- Hide on screens less than 640px, show otherwise -->
                            <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-2 start-0 flex items-center ps-3 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                    </svg>
                                </div>
                                <input type="search" id="default-search" class="items-center block w-full p-1 ps-8 px-12 text-md text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search Halaqah..." required>
                                <button 
                                    type="submit" 
                                    class="absolute right-0 end-3 bottom-1 pr-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-7 h-7 bg-white-700">
                                            <path d="M6.5 9a2.5 2.5 0 115 0 2.5 2.5 0 01-5 0z" />
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9 5a4 4 0 102.248 7.309l1.472 1.471a.75.75 0 101.06-1.06l-1.471-1.472A4 4 0 009 5z" clip-rule="evenodd" />
                                        </svg>
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Create button -->
                    <div class="flex items-center">
                        <div class="flex-grow ml-4 w-1/5 justify-center sm:ml-auto">
                            <button id="create_halaqah" wire:click="showCreateHalaqahModal" class="flex items-center w-full h-10 bg-green-300 rounded-md text-xs mr-2">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 mx-2"> <!-- Added margin to separate SVG from text -->
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm.75-11.25a.75.75 0 00-1.5 0v2.5h-2.5a.75.75 0 000 1.5h2.5v2.5a.75.75 0 001.5 0v-2.5h2.5a.75.75 0 000-1.5h-2.5v-2.5z" clip-rule="evenodd" />
                                </svg>
                                {{ __('Halaqah') }}
                            </button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Create Halaqah Button -->
    <!-- <div class="flex flex-col mx-2 my-5 md:mx-6 md:my-12 lg:my-8 lg:w-2/5 lg:mx-auto">
        <div class="flex items-center justify-center">
                <button id="create_halaqah" wire:click="showCreateHalaqahModal" class="w-full bg-green-400 font-bold py-2 px-4 rounded-full">
                    <span class="relative z-10">{{ __('+ Create Halaqah') }}</span>
                </button>
        </div>    
    </div>     -->
    @include('rooms.create-halaqah-modal')

    <!-- Section for displaying the user's created Halaqah -->
    <div class="flex flex-col mx-2 my-5 md:mx-6 md:my-12 lg:my-8 lg:w-2/5 lg:mx-auto">
        <div class="bg-white shadow-md p-4 justify-center">
            <div class="flex justify-center">
                <h1 class="bg-gray-200 shadow-lg mx-3 w-full px-1 py-1 rounded-lg text-center font-bold text-xl">
                    MY HALAQAH
                </h1>
            </div>
            <div class="flex justify-center">
                <h1 class="w-full px-1 py-1  rounded-lg text-center">
                    @foreach ($createdRooms as $room)
                        <hr>
                        <div class="w-full mb-4 mt-4">
                            <div class="h-flex bg-gray-100 shadow-lg  rounded-md  overflow-hidden justify-center align-middle mx-2">
                                <div class="mt-2 mx-6">
                                    <h2 class="text-center text-xl font-bold">{{ wordwrap($room->name, 45, "\n", true) }}</h2>
                                </div>
                                <div class="my-2 mx-4">
                                    <p class="text-left text-sm"><strong>Description:</strong> {{ wordwrap($room->description, 45, "\n", true) }}</p>
                                </div>

                                <hr>

                                <div class="my-2 mx-2">
                                    <p class="text-center text-sm"><strong>Privacy:</strong> {{ wordwrap($room->privacy, 45, "\n", true) }}</p>
                                </div>

                                <hr class="mb-3">

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

                                <hr>

                                <!-- Add other fields as needed -->

                                <!-- Join Halaqah Button -->
                                <div class="mt-4">
                                    <x-jet-button wire:click="seeHalaqah('{{ $room->id }}', '{{ $room->name }}')" class="bg-orange-400">
                                        {{ __('See Halaqah') }}
                                    </x-jet-button>
                                </div>

                                <!-- Add free space at the bottom -->
                                <div class="mb-2"></div>
                            </div>
                        </div>
                    @endforeach
                </h1>
            </div>
        </div>
    </div>
    
    <hr>

    <!-- Section for displaying the user's joined Halaqah -->
    <div class="flex flex-col mx-2 my-5 md:mx-6 md:my-12 lg:my-8 lg:w-2/5 lg:mx-auto">
        <div class="bg-gray-100 shadow-xl shadow-grey-500/50 rounded-md p-4 justify-center">
            <div class="flex justify-center">
                <h1 class="bg-gray-200 shadow-md  mx-3 w-full px-1 py-1 rounded-lg text-center font-bold text-xl">
                    JOINED HALAQAH
                </h1>
            </div>
            <div class="flex justify-center">
                <h1 class="w-full px-1 py-1  rounded-lg text-center">
                    @foreach ($joinedRooms as $room)
                        <hr>
                        <div class="w-full mb-4 mt-4">
                            <div class="h-flex bg-white shadow-md overflow-hidden rounded-lg justify-center align-middle mx-2">
                                <div class="mt-2 mx-6">
                                    <h2 class="text-center text-xl font-bold">{{ wordwrap($room->name, 45, "\n", true) }}</h2>
                                </div>
                                <div class="my-2 mx-4">
                                    <p class="text-left text-sm"><strong>Description:</strong> {{ wordwrap($room->description, 45, "\n", true) }}</p>
                                </div>

                                <hr>

                                <div class="my-2 mx-2">
                                    <p class="text-center text-sm"><strong>Privacy:</strong> {{ wordwrap($room->privacy, 45, "\n", true) }}</p>
                                </div>

                                <hr class="mb-3">

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

                                <hr>

                                <!-- Add other fields as needed -->

                                <!-- Join Halaqah Button -->
                                <div class="mt-4">
                                    <x-jet-button wire:click="seeHalaqah('{{ $room->id }}', '{{ $room->name }}')" class="bg-orange-400">
                                        {{ __('See Halaqah') }}
                                    </x-jet-button>
                                </div>


                                <!-- Add free space at the bottom -->
                                <div class="mb-2"></div>
                            </div>
                        </div>
                    @endforeach
                </h1>
            </div>
        </div>
    </div>

</div>