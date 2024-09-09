<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreBranchRequest extends FormRequest
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
        $branchesId = $this->route('branches') ? $this->route('branches')->id : null;
        return [
            'name' => 'required|unique:branches,name' . $branchesId,
        ];
    }

    public function messages(): array{
        return [
            'name.required' => 'Tên chi nhánh bạn chưa nhập.',
            'name.unique' => 'Tên chi nhánh này đã tồn tại, vui lòng chọn tên khác.',
        ];
    }
}
