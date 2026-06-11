<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\Shipment;
use App\Models\User;

class StoreshipmentRequest extends FormRequest
{
    /**
     * Always authorize request
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
     * Validation rules
     */
    public function rules(): array
    {
        return [
            'sender_id' => ['required', 'string', Rule::exists(User::class, 'id')],
            'receiver_id' => ['required', 'string', Rule::exists(User::class, 'id')],

            // packages must be an array of objects with numeric fields
            'packages' => ['required', 'array', 'min:1'],
            'packages.*.weight' => ['required', 'numeric', 'min:0.1'],
            'packages.*.length' => ['required', 'numeric', 'min:0.1'],
            'packages.*.width' => ['required', 'numeric', 'min:0.1'],
            'packages.*.height' => ['required', 'numeric', 'min:0.1'],
            'packages.*.package_type' => ['required', 'string', Rule::in(Shipment::PACKAGE_TYPES)],

            'service_type' => ['required', 'string', Rule::in(Shipment::SERVICE_TYPES)],
            'status' => ['required', 'string', Rule::in(Shipment::STATUSES)],
            
            'description' => ['required', 'string']
        ];
    }

    /**
     * Validation messages
     */
    public function messages(): array
    {
        return [
            'sender_id.required' => 'Please provide sender information.',
            'sender_id.exists' => 'The selected sender does not exist.',

            'receiver_id.required' => 'Please provide receiver information.',
            'receiver_id.exists' => 'The selected receiver does not exist.',

            'packages.required' => 'Please provide at least one package.',
            'packages.array' => 'Packages must be an array.',
            'packages.*.weight.required' => 'Each package must have a weight.',
            'packages.*.weight.numeric' => 'Package weight must be numeric.',
            'packages.*.length.required' => 'Each package must have a length.',
            'packages.*.length.numeric' => 'Package length must be numeric.',
            'packages.*.width.required' => 'Each package must have a width.',
            'packages.*.width.numeric' => 'Package width must be numeric.',
            'packages.*.height.required' => 'Each package must have a height.',
            'packages.*.height.numeric' => 'Package height must be numeric.',
            'packages.*.package_type.required' => 'Each package must have a type.',
            'packages.*.package_type.in' => 'Invalid package type selected.',

            'service_type.required' => 'Please select the service type.',
            'service_type.in' => 'Invalid service type selected.',

            'status.required' => 'Please select the shipment status.',
            'status.in' => 'Invalid status selected.',
        ];
    }

}
