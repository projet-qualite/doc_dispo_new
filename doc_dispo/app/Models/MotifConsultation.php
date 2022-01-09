<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MotifConsultation extends Model
{
    use HasFactory;
    protected $table = 'motif_consultation';
    protected $guarded = [];
    public $timestamps = false;
}
