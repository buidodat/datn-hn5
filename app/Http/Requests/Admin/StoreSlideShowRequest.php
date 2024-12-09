<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreSlideShowRequest extends FormRequest
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
            'img_thumbnail' => 'required|array|min:3',
            'img_thumbnail.*' => 'image|max:2048',
            'description' => 'nullable|string|max:1000',
        ];
    }
    public function messages(): array
    {
        return [
            'img_thumbnail.required' => 'Vui lòng chọn ít nhất 3 ảnh.',
            'img_thumbnail.array' => 'Ảnh phải là một mảng.',
            'img_thumbnail.min' => 'Vui lòng chọn ít nhất 3 ảnh.',
            'img_thumbnail.*.image' => 'Mỗi ảnh phải có định dạng hợp lệ (jpeg, png, jpg, gif, svg).',
            'img_thumbnail.*.max' => 'Kích thước mỗi ảnh không được vượt quá 2MB.',
            'description.string' => 'Mô tả phải là một chuỗi văn bản.',
            'description.max' => 'Mô tả không được vượt quá 1000 ký tự.',
        ];
    }
}
