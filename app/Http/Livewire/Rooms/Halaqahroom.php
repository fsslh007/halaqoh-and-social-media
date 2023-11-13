<?php

namespace App\Http\Livewire\Rooms;

use Livewire\Component;
use App\Models\Room;

class Halaqahroom extends Component
{
    public $roomId;
    public $classroomName;
    public $room;
    public $editRoomId;
    public $isOpenDeleteRoomModal = false;
    public $isOpenEditRoomModal = false;

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
        'room.password' => 'required', // Add validation rule for the password field
        // Additional validation rules as needed
    ];

    public function mount($roomId, $classroomName)
    {
        $this->roomId = $roomId;
        $this->classroomName = $classroomName;
        $this->room = Room::findOrFail($roomId);
    }

    public function render()
    {
        return view('livewire.rooms.halaqahroom');
    }

    public function showEditRoomModal($roomId)
    {
        // Your edit logic here...
        $this->isOpenEditRoomModal = true;
    }

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
    
        // Flash a success message
        session()->flash('success', 'Classroom updated successfully');
    
        // Close the modal
        $this->isOpenEditRoomModal = false;
    
        // Refresh the Livewire component
        $this->emit('refreshLivewireComponent');
    }
    

    public function showDeleteRoomModal($roomId)
    {
        $this->isOpenDeleteRoomModal = true;
    }

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
}
