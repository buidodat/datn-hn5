<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMovieRequest extends FormRequest
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
        $id = $this->route('movie')->id;
        return [
            'name' =>'required|unique:movies,name, ' .$id,
            'category'=>'required',
            'img_thumbnail'=>'nullable|image|max:2048',
            'description'=>'nullable',
            'director'=>'required',
            'cast'=>'nullable',
            'duration'=>'required|integer|min:50',
            'release_date'=>'required|date',
            'end_date'=>'required|date',
            'trailer_url'=>'nullable',
            'languages'=>'required|array',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Vui lòng nhập tên phim.',
            'name.unique' =>'Phim đã tồn tại trong hệ thống.',
            'category.required' => 'Vui lòng nhập danh mục.',
            'img_thumbnail.image' => 'File phải là một hình ảnh.',
            'director.required'=> 'Vui lòng nhập dạo diễn.',
            'duration.required'=> 'Vui lòng nhập thời lượng.',
            'duration.integer'=> 'Thời lượng phải là số.',
            'duration.min'=> 'Thời lượng tối thiểu phải lớn hơn 50 phút.',
            'release_date.required'=> 'Vui lòng nhập ngày khởi chiếu.',
            'end_date.required'=> 'Vui lòng nhập ngày kết thúc.',
            'languages.required' =>'Vui lòng chọn ít nhất một ngôn ngữ.',
            'languages.array' =>'Ngôn ngữ phải là một mảng.',
        ];
    }
}
