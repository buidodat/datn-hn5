<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreRoomRequest;
use App\Models\Branch;
use App\Models\Cinema;
use App\Models\Room;
use App\Models\TypeRoom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        $capacities = Room::CAPACITIESS;
        $branches = Branch::where('is_active',1)->pluck('name','id')->all();
        $cinemas = Cinema::pluck('name','id')->all();
        $typeRooms = TypeRoom::pluck('name','id')->all();
        return view(self::PATH_VIEW . __FUNCTION__,compact(['typeRooms','capacities','branches','cinemas']) );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRoomRequest $request)
    {
        try {
            $dataRoom = [
                'cinema_id' => $request->cinema_id,
                'type_room_id'=> $request->type_room_id,
                'name' => $request->name,
                'capacity' => $request->capacity,
                'is_active' => isset($request->is_active) ? 1 : 0,
            ];

            Room::create($dataRoom);

            return redirect()
                ->route('admin.rooms.index')
                ->with('success', 'Thêm mới thành công!');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
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
