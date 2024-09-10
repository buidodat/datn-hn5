<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreFoodRequest extends FormRequest
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
        return [
            'name'          => 'required|unique:food,name', 
            'img_thumbnail' => 'required|image|max:2048', 
            'price'         => 'required|numeric|min:1', 
            'type'         => 'nullable', 
            'is_active'     => 'nullable|boolean', 
            'description'   => 'required|string|max:1000',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Bạn chưa nhập tên.',
            'name.unique' => 'Tên đã tồn tại.',
            'img_thumbnail.required' => 'Bạn chưa thêm ảnh.',
            'img_thumbnail.image' => 'File phải là một hình ảnh.',
            'price.required' => 'Bạn chưa nhập giá.',
            'price.numeric' => 'Giá phải là số.',
            'price.min' => 'Giá phải là số lớn hơn 0.',
            'description.required' => 'Bạn chưa nhập mô tả.',
            'description.max' => 'Trường mô tả không được lớn hơn 1000 ký tự.',
        ];
    }
}