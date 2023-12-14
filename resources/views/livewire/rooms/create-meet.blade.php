<div class="flex flex-col mx-2 my-5 md:mx-6 md:my-12 lg:my-12 lg:w-2/5 lg:mx-auto">
    <div class="bg-grey shadow-md rounded-3xl p-4">
        <h2 class="text-2xl font-semibold mb-4">Create Meet</h2>
        <!-- Check if any error -->
        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">Whoops! Something went wrong.</strong>
                <ul class="mt-3 list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form wire:submit.prevent="createMeet">
            <div class="flex flex-col mb-4">
                <!-- <label for="meetName" class="mb-2 text-lg font-semibold">Meet Name</label> -->
                <input type="text" id="meetName" wire:model="meetName" placeholder="Enter Meet Name" class="border rounded-md px-3 py-2">
            </div>

            <div class="flex flex-col mb-4">
                <!-- <label for="meetLocation" class="mb-2 text-lg font-semibold">Location or URL</label> -->
                <input type="text" id="meetLocation" wire:model="meetLocation" placeholder="Enter Meet Location or URL" class="border rounded-md px-3 py-2">
            </div>

            <div class="col-span-6 sm:col-span-4">
                <div class="flex items-center mt-2">
                    <label for="date" class="flex-1 mr-2">
                        <div class="border rounded-md p-2 flex items-center justify-between cursor-pointer border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">   
                            <input type="date" id="meetDate" wire:model="meetDate" class="border rounded-md px-3 py-2 w-full">
                        </div>
                    </label>
                    <label for="date" class="flex-1 mr-2">
                        <div class="border rounded-md p-2 flex items-center justify-between cursor-pointer border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">   
                            <input type="time" id="meetTime" wire:model="meetTime" class="border rounded-md px-3 py-2 w-full">
                        </div>
                    </label>
                </div>
            </div>
                
            <div class="flex items-center justify-end mt-4">
                <x-jet-secondary-button wire:click="cancel">
                    {{ __('Cancel') }}
                </x-jet-secondary-button>

                <x-jet-button type="submit" class="ml-4">
                    {{ __('Create Meet') }}
                </x-jet-button>
            </div>
        </form>
    </div>
</div>
