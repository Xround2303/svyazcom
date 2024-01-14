<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class RequestAbstract extends FormRequest
{
    protected function failedValidation(Validator $validator) {
        throw new HttpResponseException(\App\Http\Response::json($validator->errors()->first(), 422));
    }

    protected function failedAuthorization(){
        throw new HttpResponseException(\App\Http\Response::json("User not authorization", 403));
    }

}
