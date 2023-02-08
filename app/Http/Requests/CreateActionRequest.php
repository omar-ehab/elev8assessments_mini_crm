<?php

namespace App\Http\Requests;

use App\Enums\ActionTypeEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class CreateActionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        if(auth()->user()->role == 'admin' || $this->customer->assigned_to == auth()->user()->id)
        {
            return true;
        }
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'action' => ['nullable', new Enum(ActionTypeEnum::class)],
            'note' => ['nullable', 'string', 'min:3', 'max:255'],
        ];
    }
}
