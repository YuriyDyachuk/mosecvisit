<?php

declare(strict_types=1);

namespace App\Http\Requests\API\Auth;

use Illuminate\Foundation\Http\FormRequest;

class PhoneTwilioRequest extends FormRequest
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
     * @return array
     */
    public function rules(): array
    {
        return [
            'public_id' => ['required', 'string', 'exists:users,public_id'],
            'phone'     => ['required', 'string', 'exists:users,phone']
        ];
    }
}