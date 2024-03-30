<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateVehicle extends FormRequest
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
            "category" => "required|integer",
            "card" => "required|string",
            "vehicle_name" => "required|string",
            "reg_no" => "required|string",
            "owner_name" => "required|string",
            "owner_contact" => "required|string",
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
            'category.required' => 'Category is required',
            'card.required' => 'Card is required',
            'vehicle_name.required' => 'Vehicle name is required',
            'reg_no.required' => 'Reg/Plate number is required',
            'owner_name.required' => 'Owner name is required',
            'owner_contact.required' => 'Owner contact is required',
        ];
    }
}
