<?php

namespace App\Services;

use Exception;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Crypt;

class PipelineService
{
    public static function createPipeline()
    {
        $url = "/api/nifi/";
        try {
            $response = Http::withHeaders([
                "Accept" => "application/json",
                "Content-type" => "application/json"
            ])->post(config("app.FLASK_URL") . $url, [

                        "name_hospital"  =>  "principal",
                        "name_dep"  =>  "cardio",
                        "name_pipeline"  =>  "pipe1"
            ]);


            return $response["response"];
        } catch (Exception $e) {
            $result['code'] = 500;
            $result['message'] = "Erreur de création d'un pipeline Serveur innaccessible";
            return $result;
        }
    }


}
