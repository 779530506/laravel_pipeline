<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prediction extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'thickness','size','shape','madh','epsize','bnuc','bchrom','nNuc','mit','pipeline_id'
    ];

    public function pipeline()
    {
        return $this->belongsTo(Pipeline::class);
    }
}
