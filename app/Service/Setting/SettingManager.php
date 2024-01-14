<?php

namespace App\Service\Setting;

use App\Enum\EnumSetting;
use App\Models\ModelSetting;
use App\Service\ServicePumpRecord;

class SettingManager
{
    public function __construct(protected ServicePumpRecord $servicePumpRecord)
    {
    }

    /** @return SettingObject[] */
    public function getAll(): array
    {

        return [
            new SettingObject(
                EnumSetting::TARIFF_DEFAULT,
                ModelSetting::find(EnumSetting::TARIFF_DEFAULT)?->value ?? env("TARIFF_DEFAULT_VALUE"),
                "Тариф по умолчанию",
            ),
            new SettingObject(
                \App\Enum\EnumSetting::PUMP_RECORD_ENABLED,
                !$this->servicePumpRecord->isSubmitPumpRecordPreviousMonth(),
                "Разрешено указывать показания счетчика"
            )
        ];
    }

    public function getValueByCode(string $code): mixed
    {
        foreach ($this->getAll() as $settingObject) {
            if($settingObject->getCode() === $code) {
                return $settingObject->getValue();
            }
        }

        return false;
    }
}
