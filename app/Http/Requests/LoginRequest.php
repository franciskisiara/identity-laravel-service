<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'email' => [
                'required', 
                'email',
                Rule::exists('users', 'email'),
            ],

            'password' => [
                'required',
                function ($attribute, $value, $fail) {
                    $user = User::where('email', $this->email)->first();

                    if (! $user || ! Hash::check($value, $user->password)) {
                        $fail('The provided credentials are incorrect.');
                    }
                }
            ],

            'device_name' => [
                'required',
            ],
        ];
    }
}
