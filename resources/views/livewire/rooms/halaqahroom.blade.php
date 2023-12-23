@if(session()->has('success'))
    <div class="relative px-4 py-3 my-3 text-green-700 bg-green-100 border border-green-400 rounded dark:bg-green-700 dark:border-green-600 dark:text-green-100" role="alert">
        <span class="block text-center sm:inline">{{ session()->get('success') }}</span>
    </div>
@endif

@if(session()->has('error'))
    <div class="relative px-4 py-3 my-3 text-red-700 bg-red-100 border border-red-400 rounded dark:bg-red-700 dark:border-red-600 dark:text-red-100" role="alert">
        <span class="block text-center sm:inline">{{ session()->get('error') }}</span>
    </div>
@endif

<div class="flex flex-col mx-2 my-5 md:mx-6 md:my-12 lg:my-12 lg:w-2/5 lg:mx-auto">
    @if (!empty($meets))
        @foreach ($meets as $meet)    
            <div class="bg-white shadow-md mb-7">
                <button wire:click="toggleDetails({{ $meet['id'] }})" class="flex items-center w-full py-1 bg-orange-300">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" 
                        class="w-5 h-5">
                        <path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z" clip-rule="evenodd" />
                    </svg>
                    <div style="font-weight: bold; display: inline-block; padding: 5px 10px; text-align: center;">
                        {{ $meet['meet_name'] }} || {{ $meet['meet_date'] }}
                    </div>
                </button>
                @if (isset($showDetails[$meet['id']]) && $showDetails[$meet['id']])
                    <div wire:key="details-{{ $meet['id'] }}" class="details-container">
                        @if (isset($meet['meet_date']))
                            <div class="flex mb-4"  style="margin-top: 10px;">
                                <div class="flex-1 p-4 mx-2 mt-1 text-center bg-white rounded-lg shadow-md">
                                    <h3 style="font-weight: bold;">Date</h3>
                                    <div>{{ $meet['meet_date'] }}</div>
                                </div>
                                @if (isset($meet['meet_time']))
                                    <div class="flex-1 p-4 mx-2 mt-1 text-center bg-white rounded-lg shadow-md">
                                        <h3 style="font-weight: bold;">Time</h3>
                                        <div>{{ $meet['meet_time'] }}</div>
                                    </div>
                                @endif
                                @if (isset($meet['meet_location']))
                                    <div class="flex-1 p-4 mx-2 mt-1 text-center bg-white rounded-lg shadow-md">
                                        <h3 style="font-weight: bold;">Place or URL</h3>
                                        <div>{{ $meet['meet_location'] }}</div>
                                    </div>
                                @endif
                            </div>
                        @else
                            <p>No details available for this meet.</p>
                        @endif
                    </div>
                @endif
            </div>
        @endforeach
    @else
        <div class="relative px-4 py-3 my-3 text-red-700 bg-red-100 border border-red-400 rounded dark:bg-red-700 dark:border-red-600 dark:text-red-100" role="alert">
            <span class="block text-center sm:inline">{{ 'No meets found.' }}</span>
        </div>
    @endif
</div>
