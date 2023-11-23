<?php

// App\Http\Livewire\Rooms\Create.php

namespace App\Http\Livewire\Rooms;

use Livewire\Component;
use App\Models\Room;
use Auth;

class Create extends Component
{

    public $name;
    public $description;
    public $privacy; // Add this property to capture the privacy choice
    public $isOpenCreateHalaqahModal = false;

    // Define the validation rules directly within the component
    protected $rules = [
        'name' => 'required|max:255',
        'description' => 'required|max:1000',
        'privacy' => 'required|in:public,private', // Validation rule for privacy
    ];

    public function render()
    {
        return view('livewire.rooms.create');
    }

    public function showCreateHalaqahModal()
    {
        $this->isOpenCreateHalaqahModal = true;
        //dd('Modal opened'); // Add this for debug
    }

    public function createRoom()
    {
        $this->validate();

    // Save the room to the database
    Room::create([
        'name' => $this->name,
        'user_id' => Auth::id(),
        'description' => $this->description,
        'privacy' => $this->privacy, // Save privacy choice
        // Add other fields as needed
    ]);

        session()->flash('success', 'Room created successfully');

        // Store the submitted data in the session
        session(['submittedData' => [
            'name' => $this->name,
            'description' => $this->description,
            'privacy' => $this->privacy, // Store privacy in session data
            // Add other fields as needed
        ]]);

        return redirect('/rooms'); // Change 'your_redirect_route' to the actual route
    }
}
