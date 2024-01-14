<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

/**
 * @extends Builder
 * @property int $id
 * @property int $period_id
 * @property int $amount_volume
 */
class ModelPumpRecord extends Model
{
    use HasFactory;

    protected $table = "pump_meter_records";

    protected $guarded = [];

    public $timestamps = false;

    /*public function period()
    {
        $this->hasOne(ModelPeriod::class, "period_id", "id");
    }*/
}
