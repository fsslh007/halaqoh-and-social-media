@if(session()->has('success'))
    <div class="bg-green-100 border my-3 border-green-400 text-green-700 dark:bg-green-700 dark:border-green-600 dark:text-green-100 px-4 py-3 rounded relative" role="alert">
        <span class="block sm:inline text-center">{{ session()->get('success') }}</span>
    </div>
@endif

@if(session()->has('error'))
    <div class="bg-red-100 border my-3 border-red-400 text-red-700 dark:bg-red-700 dark:border-red-600 dark:text-red-100 px-4 py-3 rounded relative" role="alert">
        <span class="block sm:inline text-center">{{ session()->get('error') }}</span>
    </div>
@endif

<div class="flex flex-col mx-2 my-5 md:mx-6 md:my-12 lg:my-12 lg:w-2/5 lg:mx-auto">
    @if (!empty($meets))
        @foreach ($meets as $meet)    
            <div class="bg-white shadow-md" style="margin-bottom: 30px;">
                <button wire:click="toggleDetails({{ $meet['id'] }})" class="py-1"style="background-color: orange; display: flex; justify-content: left; align-items: center;  width: 100%;">
                    <div class="" style="font-weight: bold; display: inline-block; padding: 5px 10px; text-align: center;">
                        {{ $meet['meet_name'] }} || {{ $meet['meet_date'] }}
                    </div>
                </button>
                @if (isset($showDetails[$meet['id']]) && $showDetails[$meet['id']])
                    <div wire:key="details-{{ $meet['id'] }}" class="details-container">
                        @if (isset($meet['meet_date']))
                            <div class="flex mb-4"  style="margin-top: 10px;">
                                <div class="flex-1 bg-green-100 p-4 bg-white shadow-md rounded-lg mt-1 mx-2 text-center">
                                    <h3 style="font-weight: bold;">Date</h3>
                                    <div>{{ $meet['meet_date'] }}</div>
                                </div>
                                @if (isset($meet['meet_time']))
                                    <div class="flex-1 bg-green-100 p-4 bg-white shadow-md rounded-lg mt-1 mx-2 text-center">
                                        <h3 style="font-weight: bold;">Time</h3>
                                        <div>{{ $meet['meet_time'] }}</div>
                                    </div>
                                @endif
                                @if (isset($meet['meet_location']))
                                    <div class="flex-1 bg-green-100 p-4 bg-white shadow-md rounded-lg mt-1 mx-2 text-center">
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
        <div class="bg-red-100 border my-3 border-red-400 text-red-700 dark:bg-red-700 dark:border-red-600 dark:text-red-100 px-4 py-3 rounded relative" role="alert">
            <span class="block sm:inline text-center">{{ 'No meets found.' }}</span>
        </div>
    @endif
</div>
