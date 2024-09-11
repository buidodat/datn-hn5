<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreComboRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    // public function rules(): array
    // {
    //     return [
    //         'name'          => 'required|unique:combos,name',
    //         'img_thumbnail' => 'required|image|max:2048',
    //         'price_sale'    => 'required|numeric|min:0',
    //         'is_active'     => 'nullable|boolean',
    //         'description'   => 'required|string|max:1000',
    //         'combo_food'    => 'array', // Đảm bảo combo_food không rỗng và là mảng
    //         'combo_food.*'  => 'required|integer|exists:food,id', // Kiểm tra từng phần tử trong combo_food phải là integer và tồn tại trong bảng foods
    //         'combo_quantity.*' => 'required|integer|min:1', // Kiểm tra từng phần tử trong combo_quantity phải là integer và tối thiểu là 1
    //     ];
    // }

    // public function messages()
    // {
    //     return [
    //         'name.required' => 'Bạn chưa nhập tên.',
    //         'name.unique' => 'Tên đã tồn tại.',
    //         'img_thumbnail.required' => 'Bạn chưa thêm ảnh.',
    //         'img_thumbnail.image' => 'File phải là một hình ảnh.',
    //         'price_sale.required' => 'Bạn chưa nhập giá.',
    //         'price_sale.numeric' => 'Giá phải là số.',
    //         'price_sale.min' => 'Giá phải là số lớn hơn 0.',
    //         'description.required' => 'Bạn chưa nhập mô tả.',
    //         'combo_food.required' => 'Bạn chưa chọn món ăn cho combo.',
    //         'combo_food.*.exists' => 'Món ăn bạn chọn không tồn tại.',
    //         'combo_quantity.*.min' => 'Số lượng món ăn phải lớn hơn 0.',

    //     ];
    // }

    public function rules(): array
{
    return [
        'name'          => 'required|unique:combos,name',
        'img_thumbnail' => 'required|image|max:2048',
        'price_sale'    => 'required|numeric|min:0',
        'is_active'     => 'nullable|boolean',
        'description'   => 'required|string|max:1000',
        // 'combo_food'    => 'required|array|min:2', // Đảm bảo combo_food không rỗng và có ít nhất 2 món ăn
        // 'combo_food.*'  => 'required|integer|exists:food,id', // Kiểm tra từng phần tử trong combo_food phải là integer và tồn tại trong bảng foods
        // 'combo_quantity' => 'required|array|min:2', // Đảm bảo combo_quantity không rỗng và có ít nhất 2 số lượng
        // 'combo_quantity.*' => 'required|integer|min:1', // Kiểm tra từng phần tử trong combo_quantity phải là integer và tối thiểu là 1
        'combo_food.*' => 'required|exists:food,id',  // Đảm bảo đồ ăn được chọn có tồn tại trong DB
        'combo_quantity.*' => 'required|integer|min:1'
    ];
}

public function messages()
{
    return [
        'name.required' => 'Bạn chưa nhập tên.',
        'name.unique' => 'Tên đã tồn tại.',
        'img_thumbnail.required' => 'Bạn chưa thêm ảnh.',
        'img_thumbnail.image' => 'File phải là một hình ảnh.',
        'price_sale.required' => 'Bạn chưa nhập giá.',
        'price_sale.numeric' => 'Giá phải là số.',
        'price_sale.min' => 'Giá phải là số lớn hơn 0.',
        'description.required' => 'Bạn chưa nhập mô tả.',
        // 'combo_food.required' => 'Bạn chưa chọn món ăn cho combo.',
        // 'combo_food.array' => 'Món ăn phải là một mảng.',
        // 'combo_food.min' => 'Phải chọn ít nhất 2 món ăn.',
        // 'combo_food.*.exists' => 'Món ăn bạn chọn không tồn tại.',
        // 'combo_quantity.required' => 'Bạn chưa nhập số lượng cho mỗi món ăn.',
        // 'combo_quantity.array' => 'Số lượng phải là một mảng.',
        // 'combo_quantity.min' => 'Phải nhập số lượng cho ít nhất 2 món ăn.',
        // 'combo_quantity.*.integer' => 'Số lượng phải là số nguyên.',
        // 'combo_quantity.*.min' => 'Số lượng món ăn phải lớn hơn 0.',
    ];
}

}
