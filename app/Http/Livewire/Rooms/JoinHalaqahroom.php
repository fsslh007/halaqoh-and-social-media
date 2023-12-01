<?php

namespace App\Http\Livewire\Rooms;

use App\Models\Member;
use Livewire\Component;

class JoinHalaqahroom extends Component
{
    public $roomId;
    public $classroomName;

    public function mount($roomId, $classroomName)
    {
        $this->roomId = $roomId;
        $this->classroomName = $classroomName;
    }

    public function acceptInvitation()
    {
        // Check if the user is already a member of this room
        $existingMembership = Member::where('user_id', auth()->id())
                                    ->where('room_id', $this->roomId)
                                    ->first();
    
        if ($existingMembership) {
            session()->flash('message', "You have already joined this Halaqah: {$this->classroomName}");
        } else {
            // Store acceptance in the members table
            Member::create([
                'user_id' => auth()->id(),
                'room_id' => $this->roomId,
                'username' => auth()->user()->username,
            ]);
    
            session()->flash('message', 'You have accepted the invitation.');
    
            // Refresh the component to display the message
            $this->emitSelf('invitationAccepted');
        }
    }
    
       

    public function render()
    {
        return view('livewire.rooms.join-halaqahroom');
    }
}


