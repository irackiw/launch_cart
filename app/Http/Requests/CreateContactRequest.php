<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateContactRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'first_name' => 'required|max:35',
            'email' => 'required|email|max:255',
            'phone' => 'max:15',
        ];
    }
}
