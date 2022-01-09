<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Hopital extends Model
{
    use HasFactory;
    use Sluggable;

    protected $table = 'hopital';
    protected $guarded = [];
    public $timestamps = false;

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'libelle'
            ]
        ];
    }
}
