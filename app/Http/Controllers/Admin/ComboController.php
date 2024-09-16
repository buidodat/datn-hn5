<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreComboRequest;
use App\Http\Requests\Admin\UpdateComboRequest;
use App\Models\Combo;
use App\Models\ComboFood;
use App\Models\Food;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        $data = Combo::query()->with('comboFood')->latest('id')->get();
        $foods = Food::query()->select('id', 'name', 'type')->get();

        // dd($food->toArray());

        return view(self::PATH_VIEW . __FUNCTION__, compact('data', 'foods'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $food = Food::where('is_active', '1')->get(['id', 'name', 'price', 'type']);

        return view(self::PATH_VIEW . __FUNCTION__, compact('food'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreComboRequest $request)
    {
        try {

            DB::transaction(function () use ($request) {

                // Lấy dữ liệu từ request
                $data = $request->all();
                $data['is_active'] ??= 0;

                // Xử lý upload hình ảnh nếu có
                if ($data['img_thumbnail']) {
                    $data['img_thumbnail'] = Storage::put(self::PATH_UPLOAD, $data['img_thumbnail']);
                }

                // Tính tổng giá của combo dựa trên giá của món ăn và số lượng
                $foodIds = $request->input('combo_food');
                $quantities = $request->input('combo_quantity');
                $totalPrice = 0;

                foreach ($foodIds as $key => $foodId) {
                    // Lấy thông tin món ăn từ bảng food
                    $food = Food::findOrFail($foodId); // lấy món ăn
                    $quantity = $quantities[$key];     // lấy số lượng của món ăn tương ứng

                    // Tính giá: giá món ăn * số lượng
                    $totalPrice += $food->price * $quantity;
                }

                // Tạo combo mới và lưu tổng giá vào trường price
                $combo = Combo::create([
                    'name' => $data['name'],
                    'price_sale' => $data['price_sale'],
                    'price' => $totalPrice,  // Lưu tổng giá của combo
                    'description' => $data['description'],
                    'img_thumbnail' => $data['img_thumbnail'] ?? null,
                    'is_active' => $data['is_active'],
                ]);

                // Lưu các món ăn vào combo
                foreach ($foodIds as $key => $foodId) {
                    ComboFood::create([
                        'combo_id' => $combo->id,
                        'food_id' => $foodId,
                        'quantity' => $quantities[$key],
                    ]);
                }
            });

            return redirect()
                ->route('admin.combos.index')
                ->with('success', 'Thêm mới thành công!');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Combo $combo)
    {
        return view(self::PATH_VIEW . __FUNCTION__, compact('combo'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Combo $combo)
    {
        $food = Food::where('is_active', '1')->get(['id', 'name', 'price', 'type']);
        $comboFood = $combo->comboFood()->pluck('quantity', 'food_id')->all();

        return view(self::PATH_VIEW . __FUNCTION__, compact('combo', 'food', 'comboFood'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateComboRequest $request, Combo $combo)
    {
        try {
            DB::transaction(function () use ($request, $combo) {
                // Lấy dữ liệu từ request
                $data = $request->all();
                $data['is_active'] ??= 0;

                // Xử lý upload hình ảnh nếu có
                if ($request->hasFile('img_thumbnail')) {
                    // Xóa ảnh cũ nếu có
                    if ($combo->img_thumbnail && Storage::exists($combo->img_thumbnail)) {
                        Storage::delete($combo->img_thumbnail);
                    }
                    $data['img_thumbnail'] = Storage::put(self::PATH_UPLOAD, $request->file('img_thumbnail'));
                } else {
                    // Nếu không upload ảnh mới, giữ nguyên ảnh cũ
                    $data['img_thumbnail'] = $combo->img_thumbnail;
                }

                // Tính tổng giá của combo dựa trên giá của món ăn và số lượng
                $foodIds = $request->input('combo_food');
                $quantities = $request->input('combo_quantity');
                $totalPrice = 0;

                foreach ($foodIds as $key => $foodId) {
                    $food = Food::findOrFail($foodId); // Lấy món ăn
                    $quantity = $quantities[$key];     // Lấy số lượng của món ăn tương ứng

                    $totalPrice += $food->price * $quantity;
                }

                // Cập nhật thông tin combo
                $combo->update([
                    'name' => $data['name'],
                    'price_sale' => $data['price_sale'],
                    'price' => $totalPrice,  // Lưu tổng giá của combo
                    'description' => $data['description'],
                    'img_thumbnail' => $data['img_thumbnail'],
                    'is_active' => $data['is_active'],
                ]);

                // Xóa các món ăn hiện tại trong combo
                ComboFood::where('combo_id', $combo->id)->delete();

                // Lưu các món ăn vào combo
                foreach ($foodIds as $key => $foodId) {
                    ComboFood::create([
                        'combo_id' => $combo->id,
                        'food_id' => $foodId,
                        'quantity' => $quantities[$key],
                    ]);
                }
            });

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

    public function destroy(Combo $combo)
    {
        // try {

        //     $combo->delete();

        //     if ($combo->img_thumbnail && Storage::exists($combo->img_thumbnail)) {
        //         Storage::delete($combo->img_thumbnail);
        //     }

        //     return back()
        //         ->with('success', 'Xóa thành công');
        // } catch (\Throwable $th) {
        //     return back()->with('error', $th->getMessage());
        // }
    }
}
