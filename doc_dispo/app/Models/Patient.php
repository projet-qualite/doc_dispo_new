<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;
    use Sluggable;

    protected $table = 'patient';
    protected $guarded = [];
    public $timestamps = false;
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'email'
            ]
        ];
    }
}
