<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\User;

/**
 * Registration request
 *
 * @property string $username
 * @property string $phone_number
 */
class RegistrationRequest extends FormRequest
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
        return [
            'username' => ['required', 'string', 'min:2'],
            'phone_number' => ['required', 'string', 'min:10', 'regex:/^\+\d{12}$/'],
        ];
    }

    /**
     * Configure the validator instance.
     */
    public function withValidator($validator): void
    {
        $validator->after(function ($validator) {
            $username = $this->username;
            $phone = $this->phone_number;

            if ($validator->errors()->isNotEmpty()) {
                return;
            }

            $user = User::where('username', $username)
                ->orWhere('phone_number', $phone)
                ->first();

            if ($user && ($user->username !== $username || $user->phone_number !== $phone)) {
                $message = 'Username and phone number must belong to the same user.';
                $validator->errors()->add('username', $message);
                return;
            }
        });
    }
}
