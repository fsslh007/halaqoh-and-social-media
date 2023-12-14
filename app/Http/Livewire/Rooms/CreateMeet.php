<?php

namespace App\Http\Livewire\Rooms;

use Livewire\Component;
use App\Models\Meet;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class CreateMeet extends Component
{
    public $meetName;
    public $meetDate;
    public $meetTime;
    public $meetLocation;
    public $roomId; // Add a property to store room_id
    public $classroomName;

    public function mount($roomId, $classroomName)
    {
        $this->roomId = $roomId; // Set the provided room_id
        $this->classroomName = $classroomName;
    }

    public function createMeet()
    {
        // Validate the form data if needed
        $validatedData = $this->validate([
            'meetName' => 'required',
            'meetDate' => 'required|date',
            'meetTime' => 'required',
            'meetLocation' => 'required',
        ]);

        try {
            // Create a new Meet record with the provided user_id and room_id
            Meet::create([
                'user_id' => Auth::id(), // Get the authenticated user's ID
                'room_id' => $this->roomId, // Use the provided room_id
                'meet_name' => $this->meetName,
                'meet_date' => $this->meetDate,
                'meet_time' => $this->meetTime,
                'meet_location' => $this->meetLocation,
            ]);

            // Optionally, you can reset the form fields after submission
            $this->reset([
                'meetName',
                'meetDate',
                'meetTime',
                'meetLocation',
            ]);
        
                // Flash a success message
                Session::flash('success', 'Meet created successfully');

                // Redirect to the 'halaqahroom' page after creating the meet
                return redirect()->route('rooms.halaqahroom', [
                    'roomId' => $this->roomId,
                    'classroomName' => $this->classroomName,
                ])->with('success', 'Meet created successfully');
            } catch (\Exception $e) {
                // Flash an error message
                Session::flash('error', 'Failed to create meet. Please try again.');
    
                // Redirect back to the form if there's an error
                return back()->withInput()->withErrors(['error' => $e->getMessage()]);
            }

        // Optionally, emit an event or perform other actions after creating the meet

        // Redirect or perform any other necessary actions after successful meet creation
    }

    public function cancel()
    {
        // Redirect back to the 'halaqahroom' page without creating the meet
        return redirect()->route('rooms.halaqahroom', [
            'roomId' => $this->roomId,
            'classroomName' => $this->classroomName,
        ]);
    }

    public function render()
    {
        return view('livewire.rooms.create-meet');
    }
}
