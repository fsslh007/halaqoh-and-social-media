<?php

// App\Http\Livewire\Rooms\Create.php

namespace App\Http\Livewire\Rooms;

use Livewire\Component;
use App\Models\Room;

class Create extends Component
{

    public $name;
    public $meetingTime;
    public $password;
    public $description;
    public $leavingUrl; // New field for the leaving URL

    // Define the validation rules directly within the component
    protected $rules = [
        'name' => 'required|max:255',
        'meetingTime' => 'required|date',
        'password' => 'required|min:6',
        'description' => 'required|max:1000',
        'leavingUrl' => 'nullable|url', // Validation rule for leaving URL
    ];

    public function render()
    {
        return view('livewire.rooms.create');
    }

    public function createRoom()
    {
        $this->validate();

    // Save the room to the database
    Room::create([
        'name' => $this->name,
        'meeting_time' => $this->meetingTime,
        'password' => bcrypt($this->password), // Make sure to hash passwords
        'description' => $this->description,
        'leaving_url' => $this->leavingUrl,
        // Add other fields as needed
    ]);

        session()->flash('success', 'Room created successfully');

        // Store the submitted data in the session
        session(['submittedData' => [
            'name' => $this->name,
            'meetingTime' => $this->meetingTime,
            'password' => $this->password,
            'description' => $this->description,
            'leavingUrl' => $this->leavingUrl,
            // Add other fields as needed
        ]]);

        return redirect('/rooms'); // Change 'your_redirect_route' to the actual route
    }
}
