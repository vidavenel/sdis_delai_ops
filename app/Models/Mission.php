<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property-read int $id
 * @property string $libelle
 * @property string $description
 */
class Mission extends Model
{
    use HasFactory;

    protected $fillable = ['libelle', 'description'];
}
