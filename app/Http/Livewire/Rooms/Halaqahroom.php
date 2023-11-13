<?php

namespace App\Http\Livewire\Rooms;

use Livewire\Component;
use App\Models\Room;
use Livewire\WithFileUploads;

class Halaqahroom extends Component
{
    use WithFileUploads;

    // Properties
    public $roomId;
    public $classroomName;
    public $room;
    public $editRoomId;
    public $isOpenDeleteRoomModal = false;
    public $isOpenEditRoomModal = false;
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
                'leaving_url' => '',
                'password' => '',
                // Additional properties as needed
            ],
        ];
    }

    // Validation rules
    protected $rules = [
        'room.name' => 'required',
        'room.meeting_time' => 'required',
        'room.description' => 'required',
        'room.leaving_url' => 'required',
        'room.password' => 'required',
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
    }

    // Render method to display the Livewire component
    public function render()
    {
        return view('livewire.rooms.halaqahroom');
    }

    // Show edit room modal
    public function showEditRoomModal($roomId)
    {
        $this->isOpenEditRoomModal = true;
    }

    // Update room information
    public function updateRoom()
    {
        // Validate the updated room fields
        $this->validate([
            'room.name' => 'required',
            'room.meeting_time' => 'required',
            'room.description' => 'required',
            'room.leaving_url' => 'required',
            'room.password' => 'required',
            // Additional validation rules as needed
        ]);

        // Update the room
        $this->room->save();

        // Handle file upload
        $this->uploadFile();

        // Flash a success message
        session()->flash('success', 'Classroom updated successfully');

        // Close the modal
        $this->isOpenEditRoomModal = false;

        // Refresh the Livewire component
        $this->emit('refreshLivewireComponent');
    }

    // Show delete room modal
    public function showDeleteRoomModal($roomId)
    {
        $this->isOpenDeleteRoomModal = true;
    }

    // Delete room
    public function deleteRoom()
    {
        // Find the room to delete
        $room = Room::findOrFail($this->roomId);

        // Your delete logic here...

        try {
            $room->delete();
            session()->flash('success', 'Classroom deleted successfully');
        } catch (Exception $e) {
            session()->flash('error', 'Cannot delete classroom');
        }

        // Redirect to the "/rooms" page using a named route
        return redirect()->route('rooms.index');
        $this->isOpenDeleteRoomModal = false;
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
        $this->uploadedFiles = $this->room->uploadFiles; // Fixed relationship name
    }
}
