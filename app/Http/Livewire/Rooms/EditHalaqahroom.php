<?php

namespace App\Http\Livewire\Rooms;

use Livewire\Component;
use App\Models\Room;

class EditHalaqahroom extends Component
{
    public $state;
    public $roomId;

    protected $rules = [
        'state.name' => 'required|string|max:255',
        'state.description' => 'required|string|max:255',
    ];

    public function mount($roomId)
    {
        $this->roomId = $roomId;
        $room = Room::findOrFail($roomId);
        $this->state = [
            'name' => $room->name,
            'description' => $room->description,
        ];
    }

    public function updateHalaqahInformation()
    {
        $this->validate();

        $room = Room::findOrFail($this->roomId);
        $room->update([
            'name' => $this->state['name'],
            'description' => $this->state['description'],
            // Add other fields to update as needed
        ]);

        $this->emit('saved');
    }

    public function updated()
    {
    $this->emit('notifySaved');
    }

    public function render()
    {
        return view('livewire.rooms.edit-halaqahroom');
    }
}
