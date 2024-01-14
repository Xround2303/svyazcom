<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

/**
 * @extends Builder
 * @property int $id
 * @property string $fio
 * @property float $area
 */
class ModelResident extends Model
{
    use HasFactory;

    protected $table = "residents";

    protected $guarded = [];

    public $timestamps = false;

    public function bills(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(ModelBill::class, "resident_id", "id");
    }

    public function deleteAllRelatedBills(): void
    {
        foreach ($this->bills as $bill) {
            $bill->delete();
        }
    }
}
