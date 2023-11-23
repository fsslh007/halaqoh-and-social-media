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

            <!-- Privacy Field -->
            <div class="mb-4">
                <x-jet-label for="privacy" value="{{ __('Privacy') }}" />
                <select id="privacy" wire:model.lazy="privacy" class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow">
                    <option value="public">Public</option>
                    <option value="private">Private</option>
                </select>
                @error('privacy') <span class="text-red-500">{{ $message }}</span> @enderror
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
