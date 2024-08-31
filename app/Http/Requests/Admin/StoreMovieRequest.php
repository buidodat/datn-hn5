<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreMovieRequest extends FormRequest
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
            'name' =>'required|unique:movies',
            'slug' =>'required|unique:movies' ,
            'category'=>'required',
            'img_thumbnail'=>'nullable|image|max:2048',
            'description'=>'nullable',
            'director'=>'required',
            'cast'=>'nullable',
            'duration'=>'required|integer|',
            'release_date'=>'required|date',
            'end_date'=>'required|date',
            'trailer_url'=>'nullable',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Vui lòng nhập tên phim.',
            'name.unique' =>'Phim đã tồn tại trong hệ thống.',
            'slug.required' => 'Vui lòng nhập slug.',
            'slug.unique' =>'Slug đã tồn tại trong hệ thống.',
            'category.required' => 'Vui lòng nhập danh mục.',
            'img_thumbnail.image' => 'File phải là một hình ảnh.',
            'director.required'=> 'Vui lòng nhập dạo diễn.',
            'release_date.required'=> 'Vui lòng nhập ngày khởi chiếu.',
            'end_date.required'=> 'Vui lòng nhập ngày kết thúc.',
        ];
    }
}
