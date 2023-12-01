<?php

namespace App\Http\Livewire\Rooms;

use Livewire\Component;
use App\Models\Room;
use App\Models\Member;

class MemberHalaqahroom extends Component
{
    public $roomId;
    public $inviteLink;
    public $classroomName;
    public $members;

    public function mount($roomId, $classroomName)
    {
        $this->roomId = $roomId;
        $this->classroomName = $classroomName;
        $this->generateInviteLink();
        $this->loadMembers();
    }

    public function render()
    {
        return view('livewire.rooms.member-halaqahroom');
    }

    public function generateInviteLink()
    {
        $this->inviteLink = route('rooms.join', [
            'room' => $this->roomId,
            'classroomName' => $this->classroomName,
        ]);
    }

    public function loadMembers()
    {
        // Retrieve the room details
        $room = Room::findOrFail($this->roomId);

        // Retrieve members of the room
        $this->members = $room->members()->with('user')->get()->map(function ($member) use ($room) {
            $member->isOwner = ($member->user_id === $room->user_id);
            $member->role = $member->isOwner ? 'Owner' : 'Member';
            return $member;
        });
    }
}
