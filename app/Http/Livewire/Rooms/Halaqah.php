<?php

namespace App\Http\Livewire\Rooms;

use Livewire\Component;
use App\Models\Room;
use Auth;
use App\Models\Member; // Import the Member model

class Halaqah extends Component
{
    public $rooms;
    public $name;
    public $description;
    public $privacy = ''; // Initialize privacy as an empty string
    public $currentUserId; // Define a property to hold the user's ID
    public $isOpenCreateHalaqahModal = false;
    

    public function mount()
    {
        $this->rooms = Room::all();
        $this->submittedData = session('submittedData', []);
        $this->currentUserId = Auth::id(); // Get the authenticated user's ID
    }

    public function render()
    {
        return view('livewire.rooms.halaqah');
    }

    public function showCreateHalaqahModal()
    {
        $this->isOpenCreateHalaqahModal = true;
        //dd('Modal opened'); // Add this for debug
    }

    // Define the validation rules directly within the component
    protected $rules = [
        'name' => 'required|max:255',
        'description' => 'required|max:1000',
        'privacy' => 'required|in:public,private', // Validation rule for privacy
    ];

    public function createRoom()
    {
        $this->validate([
            'name' => 'required|max:255',
            'description' => 'required|max:1000',
            'privacy' => 'required|in:public,private',
        ]);

        // Create the room and store the owner as a member
        $newRoom = Room::create([
            'name' => $this->name,
            'user_id' => Auth::id(),
            'description' => $this->description,
            'privacy' => $this->privacy,
            // Add other fields as needed
        ]);

        // Store the owner as a member of the room
        Member::create([
            'user_id' => Auth::id(),
            'room_id' => $newRoom->id,
            'username' => Auth::user()->username,
            // Add other member-related fields if required
        ]);

        session()->flash('success', 'Room created successfully');

        return redirect('/rooms'); // Change 'your_redirect_route' to the actual route
    }

    public function joinHalaqah($roomId, $classroomName)
    {
        // Implement any logic or validations needed
    
        // Redirect to the specified URL
        return redirect("/rooms/$roomId/$classroomName");
    }
}
