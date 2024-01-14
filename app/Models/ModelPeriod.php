<?php

namespace App\Models;

use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

/**
 * @extends Builder
 * @property int $id
 * @property string $begin_date
 * @property string $end_date
 */
class ModelPeriod extends Model
{
    use HasFactory;

    protected $table = "periods";

    protected $guarded = [];

    public $timestamps = false;

    public function pumpRecord(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(ModelPumpRecord::class, "period_id", "id");
    }

    protected function serializeDate(DateTimeInterface $date): string
    {
        return $date->format('d.m.Y H:i:s');
    }
}
