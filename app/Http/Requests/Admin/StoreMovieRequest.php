<?php

namespace App\Http\Requests\Admin;

use App\Models\Movie;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'category'=>'required',
            'img_thumbnail'=>'nullable|image|max:2048',
            'description'=>'nullable',
            'director'=>'required',
            'cast'=>'nullable',
            'duration'=>'required|integer|min:30|max:180',
            'release_date'=>'required|date|after_or_equal:today',
            'end_date'=>'required|after:release_date',
            'trailer_url'=>'nullable',
            'versions'=>'required|array',
            'versions.*' => [
                'nullable',
                Rule::in(array_column(Movie::VERSIONS, 'name')),
            ],
            'surcharge'=>'nullable|integer|min:0'
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
            'duration.min'=> 'Thời lượng tối thiểu phải là 30 phút.',
            'duration.max'=> 'Thời lượng tối đa không quá 180 phút.',
            'release_date.required'=> 'Vui lòng nhập ngày khởi chiếu.',
            'release_date.after_or_equal' => 'Ngày khởi chiếu phải là hôm nay hoặc trong tương lai.',
            'end_date.required'=> 'Vui lòng nhập ngày kết thúc.',
            'end_date.after' => 'Ngày kết thúc phải sau ngày khởi chiếu.',
            'versions.required' =>'Vui lòng chọn ít nhất một phiên bản.',
            'versions.*.in' => 'Giá trị không hợp lệ trong phiên bản',
            'versions.array' =>'Phiên bản phải là một mảng.',
            'surcharge.integer'=>'Giá thu thêm phải là số',
            'surcharge.min'=>'Giá thu thêm phải là số nguyên dương',

        ];
    }
}
