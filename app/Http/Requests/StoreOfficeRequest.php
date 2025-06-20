<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOfficeRequest extends FormRequest
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
            'office_name' =>'required|string|max:75',
            'image' => 'image|max:5000',


        ];
    }
}
