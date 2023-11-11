<div>
    {{-- Display Classroom Information --}}
    <h1 class="text-2xl font-semibold mb-4">{{ $classroomName }}</h1>

    <div>
        <p><strong>Meeting Time:</strong> {{ $room->meeting_time }}</p>
    </div>

    <div>
        <p><strong>Description:</strong> {{ $room->description }}</p>
    </div>

    <div>
        <p><strong>Leaving URL:</strong> {{ $room->leaving_url }}</p>
    </div>

    {{-- Add other fields as needed --}}
</div>
