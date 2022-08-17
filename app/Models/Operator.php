<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;

/**
 * @property int $id;
 * @property string $code;
 */
class Operator extends Model
{
    use HasFactory;

    protected $fillable = [
      'code'
    ];

    public function fares(): Collection|HasMany
    {
        return $this->hasMany(Fare::class);
    }
}
