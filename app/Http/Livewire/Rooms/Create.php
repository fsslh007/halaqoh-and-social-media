<?php

// App\Http\Livewire\Rooms\Create.php

namespace App\Http\Livewire\Rooms;

use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    public $name;
    public $meetingTime;
    public $password;
    public $description;
    public $leavingUrl; // New field for the leaving URL
    public $file;

    // Define the $imageFormats property
    public $imageFormats = ['jpg', 'png', 'gif', 'jpeg'];

    // Define the $videoFormats property if it's not already defined
    public $videoFormats = ['mp4', '3gp'];

    // Define the validation rules directly within the component
    protected $rules = [
        'name' => 'required|max:255',
        'meetingTime' => 'required|date',
        'password' => 'required|min:6',
        'description' => 'required|max:1000',
        'leavingUrl' => 'nullable|url', // Validation rule for leaving URL
        'file' => 'nullable|mimes:jpg,png,gif,jpeg,mp4,3gp|max:2048',
    ];

    public function render()
    {
        return view('livewire.rooms.create');
    }

    public function createRoom()
    {
        $this->validate();

        // Add your logic for creating the room here

        session()->flash('success', 'Room created successfully');

        return redirect('your_redirect_route'); // Change 'your_redirect_route' to the actual route
    }
}
