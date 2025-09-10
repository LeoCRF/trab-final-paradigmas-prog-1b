<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCompanyRequest extends FormRequest
{
    
    public function authorize(): bool
    {
        return false;
    }

    
    public function rules(): array
    {
        return [
            'name' => 'sometimes||string|max:255',
            'responsible_id' => 'sometimes|exists:users,id',
            'licensed' => 'sometimes|boolean',
        ];
    }
}
