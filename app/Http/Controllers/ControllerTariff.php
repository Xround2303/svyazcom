<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestPeriodTariffStore;
use App\Http\Resources\ResourceTariff;
use App\Http\Response;
use App\Models\ModelPeriod;
use App\Models\ModelTariff;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ControllerTariff extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Response::json(
            ResourceTariff::collection(
                ModelTariff::query()
                    ->select("period_tariffs.*", "periods.begin_date", "periods.end_date")
                    ->leftJoin('periods', 'period_tariffs.period_id', '=', 'periods.id')
                    ->where("begin_date", ">=", Carbon::parse("first day of last month")->startOfMonth())
                    ->orderBy("periods.begin_date", "asc")
                    ->get()

            )
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RequestPeriodTariffStore $request)
    {
        $start = Carbon::parse($request->validated("date"))->startOfMonth();
        $end = Carbon::parse($request->validated("date"))->endOfMonth();

        $modelPeriod = \App\Models\ModelPeriod::firstOrCreate([
            "begin_date" => $start,
            "end_date" => $end
        ],[
            "begin_date" => $start,
            "end_date" => $end
        ]);

        if(ModelTariff::query()->where("period_id", $modelPeriod->id)->first()) {
           return Response::json("За этот период тариф указан", 422);
        }

        return Response::json(
            !!ModelTariff::create([
                "period_id" => $modelPeriod->id,
                "amount" => $request->validated("price")
            ])
        );
    }

    public function destroy(int $id)
    {
        if(!$model = ModelTariff::query()->where("id", $id)) {
            Response::json("Tariff not found", 404);
        }

        return Response::json(!!$model->delete());
    }
}
