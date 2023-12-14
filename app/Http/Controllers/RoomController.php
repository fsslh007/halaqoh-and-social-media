<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Http\Requests\StoreRoomRequest;
use App\Http\Requests\UpdateRoomRequest;
use Illuminate\View\View;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('rooms.halaqah');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('rooms.create');
    }

    /**
     * Show the form for showing a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Show the specified Halaqah room.
     *
     * @param  string  $username
     * @return \Illuminate\Http\Response
     */
    public function rooms($id, $name): View
    {
        // Fetch the room by ID (assuming 'Room' model exists)
        $room = Room::findOrFail($id);
    
        // Check if the user can view the room using the RoomPolicy
        $this->authorize('view', $room);
        
        // Proceed only if authorization passes
        $classroomName = $room->name;
    
        return view('rooms.halaqahroom', [
            'id' => $id,
            'classroomName' => $classroomName,
            'room' => $room,
        ]);
    }
    
    


    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreRoomRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRoomRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function show(Room $room)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function edit(Room $room)
    {
        // Check if the user can view the room using the RoomPolicy
        $this->authorize('Ownerview', $room);

        return view('rooms.edit-halaqahroom', [
            'roomId' => $room->id, // Pass the $roomId variable to the view
            'room' => $room, // Pass the $room variable as needed
        ]);
    }

    /**
     * Show the form for inviting the specified resource.
     *
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function member(Room $room)
    {
        // Check if the user can view the room using the RoomPolicy
        $this->authorize('Ownerview', $room);

        return view('rooms.member-halaqahroom', [
            'roomId' => $room->id,
            'classroomName' => $room->name, // Replace 'classroomName' with the actual property name from your Room model
        ]);
    }

    /**
     * Show the form for create meet the specified resource.
     *
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function createMeet(Room $room)
    {
        // Fetch the room by ID
        $rooms = Room::findOrFail($room->id);
    
        // Check if the user can view the room using the RoomPolicy
        $this->authorize('Ownerview', $room);

        return view('rooms.create-meet', [
            'roomId' => $room->id,
            'classroomName' => $room->name, // Replace 'classroomName' with the actual property name from your Room model
        ]);
    }
    

    /**
     * Show the form for inviting the specified resource.
     *
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function join(Room $room)
    {
        $classroomName = $room->name; // Get the classroom name
        
        return view('rooms.join-halaqahroom', [
            'roomId' => $room->id,
            'classroomName' => $room->name, // Replace 'classroomName' with the actual property name from your Room model
        ]);
    }
    

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRoomRequest  $request
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRoomRequest $request, Room $room)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function destroy(Room $room)
    {
        //
    }
}
