<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpecialiteHopital extends Model
{
    use HasFactory;

    protected $table = 'specialite_hopital';
    public $timestamps = false;
}