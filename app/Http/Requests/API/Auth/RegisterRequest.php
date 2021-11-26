<?php

declare(strict_types=1);

namespace App\Http\Requests\API\Auth;

use App\Enums\Role\InternalRoleEnum;
use App\Enums\Role\RoleEnum;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'pin'           => ['required','numeric','min:6','max:6'],
            'role'          => ['required','numeric','in:' . RoleEnum::implodeData()],
            'name'          => ['required', 'string'],
            'email'         => ['required','email','string'],
            'phone'         => ['required','string'],
        ];
    }
}
