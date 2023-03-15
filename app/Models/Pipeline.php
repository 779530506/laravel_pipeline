<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pipeline extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_pipeline',
        'is_running',
        'departement_id',
        'hopital_id',
        'user_id'
    ];

    public function predictions()
    {
        return $this->hasMany(Prediction::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function departement()
    {
        return $this->belongsTo(Departement::class);
    }

    public function hopital()
    {
        return $this->belongsTo(Hopital::class);
    }
}
