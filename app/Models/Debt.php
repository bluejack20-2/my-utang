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
 * @property int $id
 * @property int $creditor_id
 * @property int $debtor_id
 * @property string $description
 * @property int $price
 * @property int $is_paid
 * @property string|null $paid_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $creditor
 * @property-read \App\Models\User $debtor
 * @method static \Illuminate\Database\Eloquent\Builder|Debt whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Debt whereCreditorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Debt whereDebtorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Debt whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Debt whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Debt whereIsPaid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Debt wherePaidAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Debt wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Debt whereUpdatedAt($value)
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
