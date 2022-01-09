<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Rdv extends Model
{
    use HasFactory;
    use Sluggable;

    protected $table = 'rdv';
    public $timestamps = false;
    protected $guarded = [];
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => ['id_creneau', 'id_proche']
            ]
        ];
    }
}
