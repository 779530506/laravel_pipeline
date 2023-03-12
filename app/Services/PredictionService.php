<?php

namespace App\Services;

use App\Models\Departement;
use App\Models\Hopital;
use App\Models\Prediction;
use Exception;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Crypt;

class PredictionService
{
    public static function createPrediction()
    {

        $url = "/api/kafka/";
        $username = str_replace(' ', '', auth()->user()->name);
        try {
            $response = Http::withHeaders([
                "Accept" => "application/json",
                "Content-type" => "application/json"
            ])->post(config("app.FLASK_URL") . $url, [

                    "lat"=> 0,
                    "lon"=> 0,
                    "nom"=> "string",
                    "prenom"=> "string",
                    "dateNaiss"=> "string",
                    "ville"=> "string",
                    "thickness"=> 0,
                    "size"=> 0,
                    "shape"=> 0,
                    "madh"=> 0,
                    "epsize"=> 0,
                    "bnuc"=> 0,
                    "bchrom"=> 0,
                    "nNuc"=> 0,
                    "mit"=> 0

            ]);


            return $response["response"];
        } catch (Exception $e) {
            $result['code'] = 500;
            $result['message'] = "Erreur de création d'un prediction Serveur innaccessible";
            $result['error'] =$e;
            return $result;
        }
    }




}
