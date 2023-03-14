<?php

namespace App\Models;

use App\Services\PredictionService;
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

    public function aftersave()
    {
        // Perform some actions after the model has been saved
        $data = [
            "name"=> $this->name,
            "prenom"=> auth()->user()->name,
            "ville"=> "Dakar",
            "thickness"=> $this->thickness,
            "size"=> $this->size,
            "shape"=> $this->shape,
            "madh"=> $this->madh,
            "epsize"=> $this->epsize,
            "bnuc"=> $this->bnuc,
            "bchrom"=> $this->bchrom,
            "nNuc"=> $this->nNuc,
            "mit"=> $this->mit

        ];
        PredictionService::createPrediction($data);
    }

    public function save(array $options = [])
    {
        $saved = parent::save($options);
        //dd($this->name);

        if ($saved) {
             $this->aftersave();
        }

        return $saved;
    }
}
