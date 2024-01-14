<?php

namespace App\Http\Controllers;

use App\Enum\EnumSetting;
use App\Http\Requests\RequestStorePumpRecordVolume;
use App\Http\Response;
use App\Service\ServiceGenerateBIll;
use App\Service\ServicePumpRecord;

class ControllerPumpRecord extends Controller
{
    public function __construct(
        protected ServicePumpRecord $servicePumpRecord,
        protected ServiceGenerateBIll $serviceGenerateBIll
    ) {
    }

    public function __invoke(RequestStorePumpRecordVolume $request)
    {
        if($this->servicePumpRecord->isSubmitPumpRecordPreviousMonth()) {
            return Response::json("Показания уже были указаны за предыдущий месяц", 422);
        }

        // Создать период предыдущего месяца
        $modelPeriodPreviousMonth = $this->servicePumpRecord->createPeriodPreviousMonth();

        // Сделать запись за предыдущий месяц
        $this->servicePumpRecord->submitPumpRecord($request->validated("volume"), $modelPeriodPreviousMonth);

        // Сгенерировать счет для клиентов
        $this->serviceGenerateBIll->execute($modelPeriodPreviousMonth, $request->validated("volume"));

        return Response::json(true);
    }


}
