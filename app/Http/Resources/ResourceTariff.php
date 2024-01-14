<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ResourceTariff extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "date_period_start" => Carbon::createFromTimeString($this->period->begin_date)->format("d.m.Y"),
            "date_period_end" => Carbon::createFromTimeString($this->period->end_date)->format("d.m.Y"),
            "amount" => $this->amount
        ];
    }
}
