<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

/**
 * @extends Builder
 * @property string $code
 * @property string $value
 */
class ModelSetting extends Model
{
    use HasFactory;
    protected $primaryKey = "code";
    protected $table = "settings";

    protected $guarded = [];

    public $timestamps = false;
}
