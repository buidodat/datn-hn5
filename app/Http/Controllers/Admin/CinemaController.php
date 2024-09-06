<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCinemaRequest;
use App\Http\Requests\Admin\UpdateCinemaRequest;
use App\Models\Branch;
use App\Models\Cinema;
use App\Models\Food;
use Illuminate\Http\Request;

class CinemaController extends Controller
{
    const PATH_VIEW = 'admin.cinemas.';
    const PATH_UPLOAD = 'cinemas';
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Cinema::query()->with('branch')->latest('id')->get();
        return view(self::PATH_VIEW . __FUNCTION__, compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $branches = Branch::where('is_active', 1)->pluck('name', 'id')->all();
        return view(self::PATH_VIEW . __FUNCTION__, compact('branches'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCinemaRequest $request)
    {
        try {
            $data = $request->all();
            $data['is_active'] ??= 0;

            Cinema::query()->create($data);

            return redirect()
                ->route('admin.cinemas.index')
                ->with('success', 'Thêm thành công!');
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
    public function edit(Cinema $cinema)
    {
        $branches = Branch::where('is_active', 1)->pluck('name', 'id')->all();
        return view(self::PATH_VIEW . __FUNCTION__, compact('branches', 'cinema'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCinemaRequest $request, Cinema $cinema)
    {
        try {
            $data = $request->all();
            $data['is_active'] ??= 0;

            $cinema->update($data);

            return redirect()
                ->back()
                ->with('success', 'Cập nhật thành công!');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
