<?php

namespace App\Http\Livewire\Rooms;

use Livewire\Component;
use App\Models\Room;
use App\Models\Meet;

class Halaqahroom extends Component
{
    public $roomId;
    public $meets = [];
    public $showDetails = [];
    
    public function mount($roomId, $classroomName)
    {
        $this->roomId = $roomId;
        $this->meets = Meet::where('room_id', $this->roomId)
            ->orderBy('created_at', 'desc')
            ->get()
            ->toArray();
    
        // Initialize showDetails array with all keys set to true
        $this->showDetails = array_fill_keys(array_column($this->meets, 'id'), true);
    }
    
    
    public function fetchMeets()
    {
        $this->meets = Meet::where('room_id', $this->roomId)
            ->orderBy('created_at', 'desc')
            ->get()
            ->toArray();
    
        // Initialize showDetails array with all keys set to true
        $this->showDetails = array_fill_keys(array_column($this->meets, 'id'), true);
    }
    
    
    
    public function toggleDetails($meetId)
    {
        $this->showDetails[$meetId] = !$this->showDetails[$meetId];
    }
          
    
    public function render()
    {
        return view('livewire.rooms.halaqahroom');
    }
}
