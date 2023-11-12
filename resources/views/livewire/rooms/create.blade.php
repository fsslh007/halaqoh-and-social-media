<div class="flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
    <div class="w-11/12 lg:w-full md:w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden rounded-lg mb-12">
        <x-jet-validation-errors class="mb-4" />

        <form wire:submit.prevent="createRoom">
            @csrf

            <!-- Classroom Name -->
            <div class="mb-4">
                <x-jet-label for="name" value="{{ __('Classroom Name') }}" />
                <x-jet-input id="name" class="block mt-1 mb-2 w-full" type="text" wire:model.lazy="name" />
                @error('name') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>

            <!-- Other Form Fields (Meeting Time, Meeting Date, etc.) -->

            <!-- Description Field -->
            <div class="mt-4">
                <x-jet-label for="description" value="{{ __('Description') }}" />
                <textarea rows="5" id="description" class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow" wire:model.lazy="description"></textarea>
                @error('description') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>

            <!-- Meeting Time -->
            <div class="mb-4">
                <x-jet-label for="meetingTime" value="{{ __('Meeting Time') }}" />
                <input
                    id="meetingTime"
                    type="text"
                    wire:model.lazy="meetingTime"
                    class="mt-1 p-2 border rounded-md w-full"
                    x-data
                    x-init="flatpickr($refs.input, { enableTime: true, dateFormat: 'Y-m-d H:i', minDate: 'today' })"
                    x-ref="input"
                />
                @error('meetingTime') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>

            <!-- url Field -->
            <div class="mb-4">
                <label for="leavingUrl" class="block text-sm font-medium text-gray-700">Leaving URL:</label>
                <input type="text" id="leavingUrl" name="leavingUrl" wire:model="leavingUrl" class="mt-1 p-2 border rounded-md w-full">
                @error('leavingUrl') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>

            <!-- Password Field -->
            <div class="mb-4">
                <x-jet-label for="password" value="{{ __('Password') }}" />
                <x-jet-input id="password" class="block mt-1 mb-2 w-full" type="password" wire:model.lazy="password" />
                @error('password') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>


            <!-- Add more form fields as needed -->

            <!-- Submit Button -->
            <div class="flex items-center justify-end mt-4">
                <x-jet-button class="ml-4">
                    {{ __('Create Classroom') }}
                </x-jet-button>
            </div>
        </form>
    </div>
</div>
