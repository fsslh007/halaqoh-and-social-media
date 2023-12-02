<?php

namespace App\Http\Livewire\Rooms;

use Livewire\Component;
use App\Models\Room;

class EditHalaqahroom extends Component
{
    public $state;
    public $roomId;
    public $isOpenDeleteRoomModal = false;

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

    // Show delete room modal
    public function confirmDelete($roomId)
    {
        $this->roomId = $roomId;
        $this->isOpenDeleteRoomModal = true;
    }

    public function deleteRoom()
    {
        $room = Room::findOrFail($this->roomId);

        try {
            $room->delete();
            session()->flash('success', 'Halaqah deleted successfully');
            $this->isOpenDeleteRoomModal = false;
            $this->emit('notifyDeleted');
        } catch (\Exception $e) {
            session()->flash('error', 'Cannot delete Halaqah');
        }

        // Redirect to the "/rooms" page using a named route
        return redirect()->route('rooms.index');
        $this->isOpenDeleteRoomModal = false;
    }

    public function render()
    {
        return view('livewire.rooms.edit-halaqahroom');
    }
}
