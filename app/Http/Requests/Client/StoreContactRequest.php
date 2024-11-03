<?php

namespace App\Http\Requests\Client;

use Illuminate\Foundation\Http\FormRequest;

class StoreContactRequest extends FormRequest
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
            'user_contact' => 'required|string|min:3|max:50', // Bắt buộc, là chuỗi, tối thiểu 3 và tối đa 255 ký tự
            'email' => 'required|email', // Bắt buộc và phải là định dạng email
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:15', // Bắt buộc, phải là số điện thoại hợp lệ và có độ dài từ 10-15 ký tự
            'title' => 'required|string|max:255', // Bắt buộc, là chuỗi và tối đa 255 ký tự
            'content' => 'required|string|max:2000', // Bắt buộc, là chuỗi và tối đa 2000 ký tự
        ];
    }

    public function messages()
    {
        return [
            'user_contact.required' => 'Họ và tên là bắt buộc.',
            'user_contact.string' => 'Họ và tên phải là một chuỗi.',
            'user_contact.min' => 'Họ và tên phải có ít nhất 3 ký tự.',
            'user_contact.max' => 'Họ và tên không được vượt quá 50 ký tự.',
            'email.required' => 'Email là bắt buộc.',
            'email.email' => 'Địa chỉ email không hợp lệ.',
            'phone.required' => 'Số điện thoại là bắt buộc.',
            'phone.regex' => 'Số điện thoại không hợp lệ.',
            'phone.min' => 'Số điện thoại phải có ít nhất 10 ký tự.',
            'phone.max' => 'Số điện thoại không được vượt quá 15 ký tự.',
            'title.required' => 'Tiêu đề là bắt buộc.',
            'title.string' => 'Tiêu đề phải là một chuỗi.',
            'title.max' => 'Tiêu đề không được vượt quá 255 ký tự.',
            'content.required' => 'Nội dung là bắt buộc.',
            'content.string' => 'Nội dung phải là một chuỗi.',
            'content.max' => 'Nội dung không được vượt quá 2000 ký tự.',
        ];
    }
}
