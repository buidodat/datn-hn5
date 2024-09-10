<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
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
            //
            'title' => 'required|unique:posts,title',
            'img_post' => 'nullable|image|max:2048',
            // 'slug' => 'required|unique:posts,slug',
            'description' => 'required',
            'content' => 'required',
            // 'is_active'     => 'required|boolean',
        ];
    }
    public function messages()
    {
        return [
            'title.required' => 'Tiêu đề không được để trống.',
            'title.unique' => "Tiêu đề bài viết này đã tồn tại.",
            'img_post.image' => 'File phải là một hình ảnh.',
            // 'slug.required' => "Đường link slug không được để trống.",
            'description.required' => "Mô tả ngắn không được để trống.",
            'content.required' => "Nội dung không được để trống.",

        ];
    }
}
