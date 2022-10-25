<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pipeline extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_hospital',
        'name_dep',
        'name_pipeline',
        'is_running',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
