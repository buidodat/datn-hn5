<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreComboRequest;
use App\Models\Combo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class ComboController extends Controller
{

    const PATH_VIEW = 'admin.combos.';
    const PATH_UPLOAD = 'combos';


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Combo::query()->get();

        dd($data->toArray());
        return view(self::PATH_VIEW . __FUNCTION__);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view(self::PATH_VIEW . __FUNCTION__);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreComboRequest $request)
    {
        try {
            $data = $request->all();
            $data['is_active'] ??= 0;

            if ($data['img_thumbnail']) {
                $data['img_thumbnail'] = Storage::put(self::PATH_UPLOAD, $data['img_thumbnail']);
            }

            Combo::query()->create($data);

            return redirect()
                ->route('admin.combos.create')
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
