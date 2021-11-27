<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Medecin extends Model
{
    use HasFactory;
    use Sluggable;

    protected $table = 'medecin';
    public $timestamps = false;

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => ['nom', 'prenom']
            ]
        ];
    }
}
