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

    public function mount($roomId, $classroomName)
    {
        $this->roomId = $roomId;
        $this->classroomName = $classroomName;
        $this->room = Room::findOrFail($roomId);
    }

    public function editHalaqah($roomId)
    {
        // Your edit logic here...
    
        // Set the editRoomId variable
        $this->editRoomId = $roomId;
    
        // Redirect to the "/rooms" page using a named route
        return redirect()->route('rooms.index');
    }

    public function render()
    {
        return view('livewire.rooms.halaqahroom');
    }
}
