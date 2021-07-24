<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class ApiRequest extends FormRequest
{
    public function expectsJson()
    {
        return true;
    }

    public function wantsJson()
    {
        return true;
    }

    public function failedValidation(Validator $validator)
    {
        throw new \Exception($validator->errors()->getMessages(), 400);
    }
}
