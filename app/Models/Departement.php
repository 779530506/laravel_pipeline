<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departement extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'hopital_id'
    ];

    public function hopital()
    {
        return $this->belongsTo(Hopital::class);
    }

    public function pipelines()
    {
        return $this->hasMany(Pipeline::class);
    }
}
