<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateCard extends FormRequest
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
            'device' => 'required|integer',
            'card_no' => 'required',
            'card_fee' => 'required',
            'card_name' => 'required',
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
            'device.required' => 'Device is required',
            'card_no.required' => 'Card no is required',
            'card_fee.required' => 'Card amount is required',
            'card_name.required' => 'Card name is required',
        ];
    }
}
