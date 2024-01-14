<?php

namespace App\Service;


use App\Enum\EnumSetting;
use App\Http\Response;
use App\Models\ModelBill;
use App\Models\ModelPeriod;
use App\Models\ModelResident;
use App\Models\ModelTariff;
use App\Service\Setting\SettingManager;

class ServiceGenerateBIll
{
    public function __construct(protected SettingManager $settingManager)
    {
    }


    public function execute(ModelPeriod $modelPeriod, int $pumpRecordValue): bool
    {
        if(empty($collectionResident = ModelResident::all())) {
            return false;
        }

        if(empty($totalArea = $collectionResident->pluck("area")->sum())) {
            return false;
        }

        foreach ($collectionResident as $modelResident) {
            $this->createBill($modelResident, $modelPeriod, $pumpRecordValue, $totalArea);
        }

        return true;
    }

    protected function getTariffAmount(int $periodId)
    {
        if($modelTariff = ModelTariff::query()->where("period_id", $periodId)->first()) {
            if(!empty($modelTariff->amount)) {
                return $modelTariff->amount;
            }
        }

        return $this->settingManager->getValueByCode(EnumSetting::TARIFF_DEFAULT);
    }

    public function createBill(ModelResident $modelResident, ModelPeriod $modelPeriod, int $pumpRecordValue, int $totalArea): bool
    {
        return !!ModelBill::updateOrcreate([
            "resident_id" => $modelResident->id,
            "period_id" => $modelPeriod->id,
        ],[
            "resident_id" => $modelResident->id,
            "period_id" => $modelPeriod->id,
            "amount_rub" => $this->calculateWaterCost(
                $pumpRecordValue,
                $this->getTariffAmount($modelPeriod->id),
                $totalArea,
                $modelResident
            ),
        ]);
    }

    protected function calculateWaterCost(int $totalCost, int $tariffCost, int $totalArea, ModelResident $modelResident): int
    {
        return ($modelResident->area / $totalArea) * $totalCost * $tariffCost;
    }
}
