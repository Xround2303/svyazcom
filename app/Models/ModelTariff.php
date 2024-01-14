<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

/**
 * @extends Builder
 * @property int $period_id
 * @property float $amount
 */
class ModelTariff extends Model
{
    use HasFactory;

    protected $table = "period_tariffs";

    protected $guarded = [];

    public $timestamps = false;

    public function period(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(ModelPeriod::class);
    }
}
