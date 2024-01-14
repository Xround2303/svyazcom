<?php

namespace App\Rules;

use App\Enum\EnumSetting;
use App\Models\ModelSetting;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Translation\PotentiallyTranslatedString;

class RuleSettingCode implements ValidationRule
{
    const SETTING_LIST_AVAILABLE = [
        \App\Enum\EnumSetting::TARIFF_DEFAULT
    ];

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if(!in_array($value, self::SETTING_LIST_AVAILABLE)) {
            $fail('Code not found');
        }
    }
}
