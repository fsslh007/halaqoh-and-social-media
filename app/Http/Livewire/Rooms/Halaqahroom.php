<?php

namespace App\Http\Livewire\Rooms;

use Livewire\Component;
use App\Models\Room;

class Halaqahroom extends Component
{
    public $roomId;
    public $classroomName;
    public $room;

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
}
