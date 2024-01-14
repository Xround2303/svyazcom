<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

/**
 * @extends Builder
 * @property int $resident_id
 * @property int $period_id
 * @property float $amount_rub
 * @property ModelPeriod $period
 * @property ModelResident $resident
 */
class ModelBill extends Model
{
    use HasFactory;

    protected $table = "bills";

    protected $guarded = [];

    public $timestamps = false;

    public function resident(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(ModelResident::class);
    }

    public function period(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(ModelPeriod::class);
    }
}
