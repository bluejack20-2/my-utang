<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * App\Models\Debt
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $users
 * @property-read int|null $users_count
 * @method static \Database\Factories\DebtFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Debt newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Debt newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Debt query()
 * @mixin \Eloquent
 */
class Debt extends Model
{
    use HasFactory;

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class)->withPivot('is_active');
    }
}
