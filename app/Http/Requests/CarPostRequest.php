<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class CarPostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'plat_number' => ['required', 'string', 'max:20'],

            'identification_number' => [
                'required',
                'string',
                'min:8',
                'max:17',
                'unique:car_posts,identification_number',
            ],

            'color' => ['required', 'string', 'max:50'],
            'model' => ['required', 'string', 'max:50'],

            'loss' => ['nullable', 'integer', 'min:0'],
            'profit' => ['nullable', 'integer', 'min:0'],

            'seller' => ['required', 'string', 'max:100'],
            'mobile_seller' => ['required', 'regex:/^09[0-9]{9}$/'],

            'buyer' => ['required', 'string', 'max:100'],
            'mobile_buyer' => ['required', 'regex:/^09[0-9]{9}$/'],

            'car_name' => ['required', 'string', 'max:100'],
            'car_fuel_type' => ['required', 'in:bensin,gas,dual,diesel,hybrid,electric'],

            'description' => ['nullable', 'string', 'max:9999'],
            'cylinder_type' => ['required', 'in:4,6,8'],

            'price_car' => ['required', 'integer', 'min:0'],
            'gear_type' => ['required', 'in:manual,automatic'],
            'gearbox_type' => ['required', 'string', 'max:50'],
        ];
    }
}
