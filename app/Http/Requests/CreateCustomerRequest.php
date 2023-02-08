<?php

namespace App\Http\Requests;

use App\Enums\ActionTypeEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class CreateCustomerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:3', 'max:255'],
            'mobile' => ['required', 'numeric', 'unique:customers,mobile'],
            'email' => ['nullable', 'string', 'max:255', 'unique:customers,email'],
            'address' => ['nullable', 'string', 'max:255'],
            'landline' => ['nullable', 'numeric'],
            'assigned_to' => ['nullable', 'integer']
        ];
    }
}
