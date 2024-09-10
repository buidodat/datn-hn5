<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    const PATH_VIEW = 'admin.users.';
    const PATH_UPLOAD = 'users';
    public function index()
    {
        $users = User::query()->latest('id')->get();
        return view(self::PATH_VIEW . __FUNCTION__ ,compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $typeAdmin = User::TYPE_ADMIN;
        $typeMember = User::TYPE_MEMBER;
        $genders = User::GENDERS;
        return view(self::PATH_VIEW . __FUNCTION__,compact(['typeAdmin','typeMember','genders']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        try {
            $user = $request->all();

            if ($request->img_thumbnail) {
                $user['img_thumbnail'] = Storage::put(self::PATH_UPLOAD, $request->img_thumbnail);
            }

            User::create($user);

            return redirect()
                ->route('admin.users.index')
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
