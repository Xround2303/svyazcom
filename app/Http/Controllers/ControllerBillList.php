<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestBillFilter;
use App\Http\Resources\ResourceBill;
use App\Http\Response;
use App\Models\ModelBill;
use App\Models\ModelPeriod;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
class ControllerBillList extends Controller
{
    public function __invoke(RequestBillFilter $request): JsonResponse
    {
        if(!empty($request->validated("date"))) {
            if(!$this->getModelPeriodByDate($request->validated("date"))) {
                return Response::json([]);
            }
        }

        return Response::json(
            ResourceBill::collection(
                ModelBill::query()
                    ->where($this->buildFilter($request))
                    ->get()
            )
        );
    }

    protected function getModelPeriodByDate(string $date): ?ModelPeriod
    {
        $start = Carbon::parse($date)->startOfMonth();
        $end = Carbon::parse($date)->endOfMonth();

        $filter = [
            "begin_date" => $start,
            "end_date" => $end,
        ];

        return ModelPeriod::query()->where($filter)->first();
    }

    protected function buildFilter(RequestBillFilter $request): array
    {
        if($date = $request->validated("date")) {

            if(!$modelPeriod = $this->getModelPeriodByDate($date)) {
                return [];
            }

            return [
                "period_id" => $modelPeriod->id,
            ];
        }

        return [];
    }
}
