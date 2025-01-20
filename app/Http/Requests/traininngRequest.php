<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class traininngRequest extends FormRequest
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
        $validate = [];
        $validate += [
            'email' => [
                "required",
                "unique:users,email",
                "email",
                "max:255"
            ]
        ];
        $validate += [
            'name' => [
                "required",
                "string",
                "max:255"
            ]
        ];

        $validate += [
            "password" => [
                "required",
                "min:8",
                "max:255",
            ]
        ];
        $validate += [
            "password2" => [
                "required",
                "same:password",
            ]
        ];
        return $validate;
}
}