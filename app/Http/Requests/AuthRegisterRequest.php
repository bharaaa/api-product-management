<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class AuthRegisterRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            "email" => ["required", "max:100", "email"],
            "password" => ["required", "max:100"],
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        return $this->errorResponse(
            "bad request",
            400,
            $validator->getMessageBag()
        );
    }
}
