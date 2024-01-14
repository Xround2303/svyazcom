<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestResidentStore;
use App\Http\Requests\RequestResidentUpdate;
use App\Http\Response;
use App\Models\ModelResident;
use Carbon\Carbon;

class ControllerResident extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Response::json(ModelResident::query()->orderBy("id", "DESC")->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RequestResidentStore $request)
    {
        $model = ModelResident::create([
            ...$request->all(),
            "start_date" => Carbon::now()
        ]);

        return Response::json(!!$model);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RequestResidentUpdate $request, string $id)
    {
        if(!$model = ModelResident::query()->where("id", $id)->first()) {
            return Response::json("Residents not found", 404);
        }

        return Response::json($model->fill($request->all())->save());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): \Illuminate\Http\JsonResponse
    {
        if(!$model = ModelResident::query()->where("id", $id)->first()) {
            return Response::json("Residents not found", 404);
        }

        $model->deleteAllRelatedBills();

        return Response::json($model->delete());
    }
}
