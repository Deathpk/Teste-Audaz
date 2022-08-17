<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * @property int $id;
 * @property int $operator_id;
 * @property int $status;
 * @property int $value;
 */
class Fare extends Model
{
    const UNACTIVE_FARE = 0;
    const ACTIVE_FARE = 1;

    use HasFactory;

    protected $fillable = [
        'operator_id',
        'status',
        'value'
    ];

    public static function getActiveFaresBetweenSixMonthsAgo(int $operatorId): ?Collection
    {
        return self::query()
            ->whereMonth('created_at', '<=', Carbon::now()->month)
            ->whereMonth('created_at', '>', Carbon::now()->subMonths(6)->month)
            ->where('status', self::ACTIVE_FARE)
            ->where('operator_id', $operatorId)
            ->get();
    }
}
