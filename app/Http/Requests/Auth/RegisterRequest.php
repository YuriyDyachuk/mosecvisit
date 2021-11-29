<?php

declare(strict_types=1);

namespace App\Http\Requests\Auth;

use App\Enums\RoleEnum;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'full_name' => ['required','max:50'],
            'email' => ['required','email','unique:users'],
            'phone' => ['required'],
            'role_id' => ['required','numeric','in:'.RoleEnum::getRoles()],
            'company_name' => ['required', 'max:100']
        ];
    }
}
