<?php

namespace App\Http\Livewire\Rooms;

use Livewire\Component;

class MemberHalaqahroom extends Component
{
    public $roomId;
    public $inviteLink;
    public $classroomName;

    public function mount($roomId, $classroomName)
    {
        $this->roomId = $roomId;
        $this->classroomName = $classroomName;
        $this->generateInviteLink();
    }

    public function render()
    {
        return view('livewire.rooms.member-halaqahroom');
    }

    public function generateInviteLink()
    {
        // Ensure both $roomId and $classroomName are present when generating the link
        $this->inviteLink = route('rooms.join', [
            'room' => $this->roomId,
            'classroomName' => $this->classroomName,
        ]);
    }
}
