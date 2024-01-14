<?php

namespace App\Http\Requests;

use App\Rules\RuleSettingCode;
use Illuminate\Foundation\Http\FormRequest;

class RequestSettingUpdate extends RequestAbstract
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
            "value" => [
                "string",
                "required"
            ],
            "code" => [
                new RuleSettingCode(),
                "string",
                "required"
            ]
        ];
    }
}
