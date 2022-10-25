<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hopital extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function departements()
    {
        return $this->hasMany(Departement::class);
    }
    public function pipelines()
    {
        return $this->hasMany(Pipeline::class);
    }
}
