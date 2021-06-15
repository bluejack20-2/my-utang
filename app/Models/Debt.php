<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\Debt
 *
 * @method static \Database\Factories\DebtFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Debt newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Debt newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Debt query()
 * @mixin \Eloquent
 */
class Debt extends Model
{
    use HasFactory;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    public function debtor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'debtor_id');
    }

    public function creditor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'creditor_id');
    }
}
