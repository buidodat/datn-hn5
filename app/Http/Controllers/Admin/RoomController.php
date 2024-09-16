<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Cinema;
use App\Models\Room;
use App\Models\TypeRoom;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    const PATH_VIEW = 'admin.rooms.';
    const PATH_UPLOAD = 'rooms';
    // public function getCinemasByBranch(Request $request)
    // {
    //     $branch_id = $request->branch_id;
    //     $cinemas = Cinema::where('branch_id', $branch_id)->get();

    //     return response()->json($cinemas);
    // }
    public function index()
    {
        $rooms = Room::query()->with(['typeRoom','cinema'])->latest('id')->get();
        return view(self::PATH_VIEW . __FUNCTION__ ,compact('rooms'));
    }

    /**x
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $totalSeats = Room::TOTAL_SEATS;
        $branches = Branch::where('is_active',1)->pluck('name','id')->all();
        $typeRooms = TypeRoom::pluck('name')->all();
        return view(self::PATH_VIEW . __FUNCTION__,compact(['typeRooms','totalSeats','branches']) );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
