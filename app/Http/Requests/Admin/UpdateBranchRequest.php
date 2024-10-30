<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBranchRequest extends FormRequest
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
        $id = $this->route('branch')->id;
        return [
            'name' => 'required|unique:branches,name,' . $id . '|min:3|max:50',
        ];
    }
    
    public function messages(): array{
        return [
            'name.required' => 'Tên chi nhánh bạn chưa nhập.',
            'name.unique' => 'Tên chi nhánh này đã tồn tại, vui lòng chọn tên khác.',
            'name.min' => 'Tên chi nhánh phải có ít nhất 3 ký tự.',
            'name.max' => 'Tên chi nhánh không được dài quá 50 ký tự.',
        ];
    }
}
