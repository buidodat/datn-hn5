<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreTypeSeatRequest;
use App\Http\Requests\Admin\UpdateTypeSeatRequest;
use App\Models\TypeSeat;
use Illuminate\Http\Request;

class TypeSeatController extends Controller
{
    const PATH_VIEW = 'admin.typeseats.';

    public function index(){
        $data = TypeSeat::query()->latest('id')->get();
        return view(self::PATH_VIEW . __FUNCTION__, compact('data'));
    }
    public function create(){
        return view(self::PATH_VIEW . __FUNCTION__);
    }
    public function store(StoreTypeSeatRequest $request){
        try{
            $data = $request->all();

            TypeSeat::query()->create($data);

            return redirect()
                ->route('admin.typeseats.index')
                ->with('success', 'Thêm thành công!');
        } catch(\Throwable $th){
            return back()->with('error', $th->getMessage());
        }
    }
    public function show(string $id){

    }
    public function edit(TypeSeat $typeseat){
        return view(self::PATH_VIEW . __FUNCTION__, compact('typeseat'));
    }
    public function update(UpdateTypeSeatRequest $request, TypeSeat $typeseat){
        try {
            $data = $request->all();

            $typeseat->update($data);

            return redirect()
                ->route('admin.typeseats.index')
                ->with('success', 'Cập nhật thành công!');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }
    public function destroy(TypeSeat $typeseat)
    {
        try {
            $typeseat->delete();
            
            return back()
                ->with('success', 'Xóa thành công');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }
}
