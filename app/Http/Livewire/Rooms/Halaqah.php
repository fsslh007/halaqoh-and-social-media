<?php

namespace App\Http\Livewire\Rooms;

use Livewire\Component;
use App\Models\Room;

class Halaqah extends Component
{
    public $rooms;

    public function mount()
    {
        $this->rooms = Room::all();
        $this->submittedData = session('submittedData', []);
    }

    public function render()
    {
        return view('livewire.rooms.halaqah');
    }

    public function joinHalaqah($roomId, $classroomName)
    {
        // Implement any logic or validations needed
    
        // Redirect to the specified URL
        return redirect("/rooms/$roomId/$classroomName");
    }
}
