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
    public static function createPrediction($data)
    {

        $url = "/api/kafka/";
        $username = str_replace(' ', '', auth()->user()->name);

        try {
            $response = Http::withHeaders([
                "Accept" => "application/json",
                "Content-type" => "application/json"
            ])->post(config("app.FLASK_URL") . $url,
            [
                "lat"=> 0,
                "lon"=> 0,
                "dateNaiss"=> "string",
                "nom"=> $data['name'],
                "prenom"=> auth()->user()->name,
                "ville"=> "Dakar",
                "thickness"=>  (float)$data['thickness'],
                "size"=>  (float)$data['size'],
                "shape"=>  (float)$data['shape'],
                "madh"=>  (float)$data['madh'],
                "epsize"=>  (float)$data['epsize'],
                "bnuc"=>  (float)$data['bnuc'],
                "bchrom"=>  (float)$data['bchrom'],
                "nNuc"=>  (float) $data['nNuc'],
                "mit"=>  (float)$data['mit']

            ]
            );

            // dd($response);
            return $response["response"];
        } catch (Exception $e) {
            $result['code'] = 500;
            $result['message'] = "Erreur de création d'un prediction Serveur innaccessible";
            $result['error'] =$e;
            return $result;
        }
    }




}
