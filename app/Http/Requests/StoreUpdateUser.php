<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateUser extends FormRequest
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
            "full_name" => "required|string",
            "username" => "required|string|unique:users,username,".$this->user.",id",
            "password" => "required_if:user,null|string|size:6",
            "co_password" => "required_if:user,null|string|same:password",
            "role"  => "required",
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'full_name.required' => 'Full name is required',
            'username.required' => 'Username is required',
            'password.required_if' => 'Password is required',
            'role.required' => 'User role is required',
            'co_password.required_if' => 'Re-Password is required',
            'co_password.same' => 'Password did not match',
        ];
    }
}
