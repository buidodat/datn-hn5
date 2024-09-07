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
            'img_thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ];
    }
    public function messages(): array
    {
        return [
            'img_thumbnail.required' => 'Bạn chưa thêm ảnh.',
            'img_thumbnail.image' => 'File phải là một hình ảnh.',
            'img_thumbnail.mimes' => 'Hình ảnh phải có định dạng: jpeg, png, jpg, gif, svg.',
        ];
    }
}
