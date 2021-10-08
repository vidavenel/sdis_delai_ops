<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Collection;

/**
 * @property-read int $id
 * @property string $no_parc
 * @property Centre $centre
 * @property Collection<Mission> $missions
 */
class Engin extends Model
{
    use HasFactory;

    /** @var string[]  */
    protected $fillable = ['no_parc'];

    public function centre(): BelongsTo
    {
        return $this->belongsTo(Centre::class);
    }

    public function missions(): BelongsToMany
    {
        return $this->belongsToMany(Mission::class);
    }
}
