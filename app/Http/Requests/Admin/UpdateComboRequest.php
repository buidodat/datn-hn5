<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateComboRequest extends FormRequest
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
    public function rules(): array
    {
        $id = $this->route('combo')->id;
        return [
            'name'          => 'required|unique:combos,name,'. $id, 
            'img_thumbnail' => 'nullable|image|max:2048', 
            'price'         => 'required|numeric|min:0', 
            'is_active'     => 'nullable|boolean', 
            'description'   => 'required|string|max:1000',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Bạn chưa nhập tên.',
            'name.unique' => 'Tên đã tồn tại.',
            // 'img_thumbnail.required' => 'Bạn chưa thêm ảnh.',
            'img_thumbnail.image' => 'File phải là một hình ảnh.',
            'price.required' => 'Bạn chưa nhập giá.',
            'price.numeric' => 'Giá phải là số.',
            'price.min' => 'Giá phải là số lớn hơn 0.',
            'description.required' => 'Bạn chưa nhập mô tả.',
        ];
    }
}
