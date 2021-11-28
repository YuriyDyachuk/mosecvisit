<?php

declare(strict_types=1);

namespace App\Http\Requests\API\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
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
            'secret_qrcode'    => ['required', 'string', 'exists:users,login'],
            'captcha'   => ['required', function($attr, $val, $fail){
                if ($val !== env('CAPTCHA')){
                    throw ValidationException::withMessages(['captcha' => 'invalid.captcha']);
                }
            }]
        ];
    }
}