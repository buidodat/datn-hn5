<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreBranchRequest;
use App\Http\Requests\Admin\UpdateBranchRequest;
use App\Models\Branch;
use Illuminate\Http\Request;
// use GuzzleHttp\Client; // Call api 


class BranchController extends Controller
{
    const PATH_VIEW = 'admin.branches.'; // Sử dụng snake_case cho tên thư mục.

    // public function fetchExternalBranches()
    // {
    //     $client = new Client();

    //     try {
    //         $response = $client->request('GET', 'https://api.example.com/branches');

    //         if ($response->getStatusCode() == 200) {
    //             $branches = json_decode($response->getBody(), true);
    //             return response()->json($branches);
    //         } else {
    //             return response()->json(['error' => 'Unable to fetch branches'], 500);
    //         }
    //     } catch (\Exception $e) {
    //         return response()->json(['error' => $e->getMessage()], 500);
    //     }
    // }

    public function index()
    {
        $branches = Branch::query()->latest('id')->get(); // Đổi tên biến cho dễ hiểu.
        return view(self::PATH_VIEW . __FUNCTION__, compact('branches')); // Sử dụng tên biến mới.
    }


    public function create()
    {
        return view(self::PATH_VIEW . __FUNCTION__);
    }

    public function store(StoreBranchRequest $request){
        try{
            $data = $request->all();
            $data['is_active'] ??= 0;

            Branch::query()->create($data);

            return redirect()
                ->route('admin.branches.index')
                ->with('success', 'Thêm thành công');
        }catch(\Throwable $th){
            return back()->with('error', $th->getMessage());
        }
    }

    public function show(string $id){

    }
    public function edit(Branch $branch){
        return view(self::PATH_VIEW . __FUNCTION__, compact('branch'));
    }

    public function update(UpdateBranchRequest $request, Branch $branch)
    {
        try {
            $data = $request->all();
            $data['is_active'] ??= 0;

            $branch->update($data);

            return redirect()
                ->back()
                ->with('success', 'Cập nhật thành công!');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    public function destroy(Branch $branch){
        try{
            $branch->delete();

            return back()
                ->with('success', 'Xóa thành công');
        }catch(\Throwable $th){
            return back()->with('error', $th->getMessage());
        }
    }
}