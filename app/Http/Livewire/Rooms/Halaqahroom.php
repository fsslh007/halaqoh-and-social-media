<?php

namespace App\Http\Livewire\Rooms;

use Livewire\Component;
use App\Models\Room;
use App\Models\Meet; // Add the Meet model
use Livewire\WithFileUploads;

class Halaqahroom extends Component
{
    use WithFileUploads;

    // Properties
    public $roomId;
    public $classroomName;
    public $room;
    public $file;
    public $uploadedFiles; // Variable name corrected

    // Initialize the $room property with empty values
    public function data()
    {
        return [
            'room' => [
                'name' => '',
                'meeting_time' => '',
                'description' => '',
                'meeting_url' => '',
                // Additional properties as needed
            ],
        ];
    }

    // Validation rules
    protected $rules = [
        'file' => 'nullable|file|max:10240',
        // Additional validation rules as needed
    ];

    // Mount method to initialize component
    public function mount($roomId, $classroomName)
    {
        $this->roomId = $roomId;
        $this->classroomName = $classroomName;
        $this->room = Room::findOrFail($roomId);
        $this->getUploadedFiles(); // Initialize the uploadedFiles variable
        $meets = $this->getMeets();
    }

    // Render method to display the Livewire component
    public function render()
    {
        $meets = $this->getMeets(); // Fetch meets associated with the room
        return view('livewire.rooms.halaqahroom', ['meets' => $meets]);
    }

    // Upload file
    public function uploadFile()
    {
        // Validate the file upload
        $this->validate([
            'file' => 'nullable|file|max:10240', // Adjust the max file size as needed
        ]);

        // Check if a file is provided
        if ($this->file) {
            // Store the uploaded file
            $file = $this->file->store('upload-files', 'public');

            // Create a new UploadFile record
            $this->room->uploadFiles()->create([ // Fixed method name
                'user_id' => auth()->id(),
                'file_name' => $this->file->getClientOriginalName(),
                'path' => $file,
            ]);

            // Clear the file input
            $this->file = null;

            // Refresh the Livewire component
            $this->emit('refreshLivewireComponent');

            // Fetch and update the uploaded files
            $this->getUploadedFiles();
        }
    }

    // New method to fetch uploaded files
    public function getUploadedFiles()
    {
        $this->uploadedFiles = $this->room->uploadFiles()->with('user')->get();    
    }

    public function getMeets()
    {
        // Fetch meets related to the current room and order them by date in descending order (newest to oldest)
        return Meet::where('room_id', $this->roomId)
            ->orderBy('created_at', 'desc')
            ->get();
    }
    
}
