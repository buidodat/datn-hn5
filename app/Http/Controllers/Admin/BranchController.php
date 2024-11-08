<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreBranchRequest;
use App\Http\Requests\Admin\UpdateBranchRequest;
use App\Models\Branch;
use Illuminate\Support\Str;
// use GuzzleHttp\Client; // Call api


class BranchController extends Controller
{
    const PATH_VIEW = 'admin.branches.'; // Sử dụng snake_case cho tên thư mục.

    public function __construct()
    {
        $this->middleware('can:Danh sách chi nhánh')->only('index');
        $this->middleware('can:Thêm chi nhánh')->only(['create', 'store']);
        $this->middleware('can:Sửa chi nhánh')->only(['edit', 'update']);
        $this->middleware('can:Xóa chi nhánh')->only('destroy');
    }

    public function index()
    {
        $branches = Branch::query()->latest('id')->get(); // Đổi tên biến cho dễ hiểu.
        return view(self::PATH_VIEW . __FUNCTION__, compact('branches')); // Sử dụng tên biến mới.
    }


    public function create()
    {
        return view(self::PATH_VIEW . __FUNCTION__);
    }

    public function store(StoreBranchRequest $request)
    {
        try {
            $data = $request->all();
            $data['slug'] = Str::slug($data['name']);
            $data['is_active'] ??= 0;

            Branch::query()->create($data);

            return redirect()
                ->route('admin.branches.index')
                ->with('success', 'Thêm thành công');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }


    public function edit(Branch $branch)
    {
        
        return view(self::PATH_VIEW . __FUNCTION__, compact('branch'));
    }

    public function update(UpdateBranchRequest $request, Branch $branch)
    {

        try {
            $data = $request->all();
            $data['slug'] = Str::slug($data['name']);
            $data['is_active'] ??= 0;

            $branch->update($data);

            return redirect()
                ->back()
                ->with('success', 'Cập nhật thành công!');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }

    }

    public function destroy(Branch $branch)
    {
        try {
            if ($branch->cinemas()->count() > 0) {
                return back()->with('error', 'Không thể xóa chi nhánh vì có rạp đang sử dụng chi nhánh này');
            }

            $branch->delete();

            return back()->with('success', 'Xóa chi nhánh thành công');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }
}
