<?php

namespace App\Http\Requests\Work;

use Illuminate\Foundation\Http\FormRequest;

class DeleteNotifyRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'me_id' => 'required|integer',
            'second_user_id' => 'required|integer'
        ];
    }
}
