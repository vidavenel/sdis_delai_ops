<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Collection;

/**
 * @property-read int $id
 * @property string $nom
 * @property Collection $centres
 */
class Commune extends Model
{
    use HasFactory;

    protected $fillable = ['nom'];

    /**
     * Liste des centres dans l'ordre de delai croissant
     * @return BelongsToMany
     */
    public function centres(): BelongsToMany
    {
        return $this->belongsToMany(Centre::class)
            ->withPivot('delai')
            ->orderByPivot('delai');
    }

    public function getEnginsByMission()
    {
        $_missions = Mission::all();
        $_centres = $this->centres;
        $res = [];

        foreach ($_missions as $_mission) {
            $res[$_mission->libelle] = [];
            /** @var Centre $centre */
            foreach ($_centres as $centre) {
                $res[$_mission->libelle][] = $centre->getEnginsHasMission($_mission)->first();
            }
        }
        return $res;
    }
}
