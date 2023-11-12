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

    public function editHalaqah($roomId)
    {
        // Your edit logic here...

        // Set the editRoomId variable
        $this->editRoomId = $roomId;

        // Redirect to the "/rooms" page using a named route
        return redirect()->route('rooms.index');
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
