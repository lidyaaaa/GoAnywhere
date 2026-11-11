<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($this->user()->id),
            ],
            // Nomor WA wajib untuk penyewa agar manager bisa menghubungi via WhatsApp.
            'phone' => [
                $this->user()->role === 'user' ? 'required' : 'nullable',
                'string',
                User::PHONE_REGEX,
            ],
        ];
    }

    public function messages(): array
    {
        return User::PHONE_MESSAGES;
    }
}
