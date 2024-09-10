<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCinemaRequest extends FormRequest
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
        $id = $this->route('cinema')->id;
        return [
            'name'          => 'required|unique:cinemas,name,' .$id, 
            'address'   => 'required|string|max:150',
            'is_active'     => 'nullable|boolean', 
            'description'   => 'required|string|max:1000',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Bạn chưa nhập tên.',
            'name.unique' => 'Tên đã tồn tại.',
            'address.required' => 'Bạn chưa nhập địa chỉ.',
            'address.max' => 'Trường địa chỉ không được lớn hơn 200 ký tự.',
            'description.required' => 'Bạn chưa nhập mô tả.',
            'description.max' => 'Trường mô tả không được lớn hơn 1000 ký tự.',

        ];
    }
}
