<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreuserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    // form validator
    public function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        throw new \Illuminate\Http\Exceptions\HttpResponseException(
            response()->json([
                'message' => 'Validation Failed',
                'errors' => $validator->errors()
            ], 422)
        );
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'full_name' => ['required', 'string', 'max:100'],
            'mobile' => ['required', 'string', 'size:11', 'regex:/^09\d{9}$/'],
            'address' => ['required', 'string', 'max:255'],
            'zip_code' => ['required', 'string', 'max:10', 'unique:users,zip_code'],
        ];
    }

    /**
     * Custom error messages.
     */
    public function messages(): array
    {
        return [
            'full_name.required' => 'Please enter the receiver\'s name.',
            'full_name.string' => 'The receiver\'s name must be a string.',
            'full_name.max' => 'The receiver\'s name cannot exceed 100 characters.',

            'phone.string' => 'The phone number must be a string.',
            'phone.size' => 'The mobile number must be exactly 11 digits.',
            'mobile.regex' => 'The mobile number format is invalid. It should start with 09 followed by 9 digits.',

            'address.required' => 'Please enter the receiver\'s address.',
            'address.string' => 'The address must be a string.',
            'address.max' => 'The address cannot exceed 255 characters.',

            'zip_code.required' => 'Please enter the receiver\'s postal code.',
            'zip_code.string' => 'The postal code must be a string.',
            'zip_code.max' => 'The postal code cannot exceed 10 characters.',
            'zip_code.unique' => 'This postal code is already used by another user.'
        ];
    }

}
