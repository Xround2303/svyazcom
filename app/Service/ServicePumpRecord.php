<?php

namespace App\Service;

use App\Http\Response;
use App\Models\ModelPeriod;
use App\Models\ModelPumpRecord;
use Carbon\Carbon;

class ServicePumpRecord
{
    public function isSubmitPumpRecordMonth(ModelPeriod $modelPeriod): bool
    {
        if($modelPeriod->pumpRecord()->first()) {
            return true;
        }

        return false;
    }

    public function createPeriodPreviousMonth(): ModelPeriod
    {
        $start = (new Carbon('first day of last month'))->startOfMonth();
        $end = (new Carbon('last day of last month'))->endOfMonth();

        return \App\Models\ModelPeriod::firstOrCreate([
            "begin_date" => $start,
            "end_date" => $end
        ],[
            "begin_date" => $start,
            "end_date" => $end
        ]);
    }

    public function isSubmitPumpRecordPreviousMonth(): bool
    {
        $start = (new Carbon('first day of last month'))->startOfMonth();
        $end = (new Carbon('last day of last month'))->endOfMonth();

        $modelPeriod = \App\Models\ModelPeriod::query()
            ->where([
                "begin_date" => $start,
                "end_date" => $end,
            ])
            ->first();

        if(empty($modelPeriod)) {
            return false;
        }

        return $this->isSubmitPumpRecordMonth($modelPeriod);


    }

    public function submitPumpRecord(int $value, $modelPeriod): bool
    {
        return !!ModelPumpRecord::create([
            "period_id" => $modelPeriod->id,
            "amount_volume" => $value,
        ]);
    }
}
