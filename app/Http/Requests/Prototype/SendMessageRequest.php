<?php

namespace App\Http\Requests\Prototype;

use Illuminate\Foundation\Http\FormRequest;

class SendMessageRequest extends FormRequest
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

            'body' => 'required|string',
            'user_id' => 'required|integer',
            'chat_room_id' => 'required|integer',
            'second_user_id' => 'required|integer',
        ];
    }
}
