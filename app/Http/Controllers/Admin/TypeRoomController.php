<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreTypeRoomRequest;
use App\Http\Requests\Admin\UpdateTypeRoomRequest;
use App\Models\TypeRoom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class TypeRoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    const PATH_VIEW = 'admin.typeRooms.';
    const PATH_UPLOAD = 'typeRooms';

    public function index()
    {
        //
        $typeRooms = TypeRoom::query()->latest('id')->get();
        return view(self::PATH_VIEW . __FUNCTION__, compact('typeRooms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view(self::PATH_VIEW . __FUNCTION__);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTypeRoomRequest $request)
    {
        //
        try {
            $data = $request->all();
            TypeRoom::create($data);

            return redirect()
                ->route('admin.typeRooms.index')
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
    public function edit(TypeRoom $typeRoom)
    {

        return view(self::PATH_VIEW . __FUNCTION__, compact('typeRoom'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTypeRoomRequest $request, TypeRoom $typeRoom)
    {
        //
        try {
            $data = $request->all();
            $typeRoom->update($data);

            return redirect()
                ->route('admin.typeRooms.index')
                ->with('success', 'Cập nhật thành công!');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TypeRoom $typeRoom)
    {
        try {
            $typeRoom->delete(); 

            return back()
                ->with('success', 'Xóa thành công !');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }
}
