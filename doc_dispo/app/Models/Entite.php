<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entite extends Model
{
    use HasFactory;
    protected $table = 'entite';
    public $timestamps = false;
    protected $fillable = ['slug','lien', 'img', 'titre', 'texte'];


}
