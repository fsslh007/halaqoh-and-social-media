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
        // Store acceptance in the members table
        Member::create([
            'user_id' => auth()->id(), // Assuming authenticated user ID
            'room_id' => $this->roomId,
            'username' => auth()->user()->username, // Assuming the username is in the users table
        ]);
    
        session()->flash('message', 'You have accepted the invitation.');
    
        // Refresh the component to display the message
        $this->emitSelf('invitationAccepted');
    }
       

    public function render()
    {
        return view('livewire.rooms.join-halaqahroom');
    }
}


