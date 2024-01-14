<?php

namespace App\Http\Controllers;

use App\Enum\EnumSetting;
use App\Http\Requests\RequestSettingUpdate;
use App\Http\Response;
use App\Models\ModelSetting;
use App\Service\Setting\SettingManager;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;


class ControllerSetting extends Controller
{
    public function __construct(protected SettingManager $settingManager)
    {
    }

    public function list(Request $request): JsonResponse
    {
        return Response::json([
            EnumSetting::TARIFF_DEFAULT => $this->settingManager->getValueByCode(EnumSetting::TARIFF_DEFAULT),
            EnumSetting::PUMP_RECORD_ENABLED => $this->settingManager->getValueByCode(EnumSetting::PUMP_RECORD_ENABLED),
        ]);
    }

    public function update(RequestSettingUpdate $request): JsonResponse
    {
        if(!$model = ModelSetting::query()->where("code", $request->validated("code"))->first()) {
            Response::json(
                !!ModelSetting::create([
                    "code" => $request->validated("code"),
                    "value" => $request->validated("value")
                ])
            );
        }

        return Response::json(
            !!$model->update([
                "value" => $request->validated("value")
            ])
        );
    }
}
