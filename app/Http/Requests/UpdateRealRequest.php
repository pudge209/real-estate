<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRealRequest extends FormRequest
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
            'country' =>'required|string|max:75',
            'city' =>'required|string|max:75',
            'street' =>'required|string|max:75',
            'status' =>'required|string|max:75',
            'zip_code' =>'required|string|max:75',
            'price' => 'required|numeric|min:0|max:9999999999999.99',
            'real_type' => 'required|in:1,2,3',
            'size' => 'required|numeric|min:0|max:999999.99',
            'image' => 'image|max:5000',
            // 'rooms' => 'nullable|numeric|min:0|max:999999.99',
            // 'bedrooms' => 'nullable|numeric|min:0|max:999999.99',
            // 'bathrooms' => 'nullable|numeric|min:0|max:999999.99',
            // 'garage' => 'nullable|numeric|min:0|max:999999.99',
            'description' =>'required|string|max:75',
            // 'commercial_kind' =>'nullable|string|max:75',
            // 'parking_spot' =>'nullable|numeric|max:75',
            // 'type_of_use' =>'nullable|string|max:75',
        ];
    }
}
