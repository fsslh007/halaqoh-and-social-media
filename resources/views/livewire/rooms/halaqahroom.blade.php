<div class="flex items-center justify-center h-screen mt-8 mx-4">
    <div class="bg-gray-200 p-8 rounded-lg w-full max-w-2xl">
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
            </div>

            {{-- Add other fields as needed --}}
        </div>
    </div>
</div>
