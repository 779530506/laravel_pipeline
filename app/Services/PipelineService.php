<?php

namespace App\Services;

use App\Models\Departement;
use App\Models\Hopital;
use Exception;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Crypt;

class PipelineService
{
    public static function createPipeline($hopital_id,$departement_id,$name_pipeline)
    {
        $departement =Departement::where('id',$departement_id)->pluck('name')->first();
        $hopital =Hopital::where('id',$hopital_id)->pluck('name')->first();
        $url = "/api/nifi/";
        try {
            $response = Http::withHeaders([
                "Accept" => "application/json",
                "Content-type" => "application/json"
            ])->post(config("app.FLASK_URL") . $url, [

                        "name_hospital"  =>  $hopital,
                        "name_dep"  =>  $departement,
                        "name_pipeline"  =>  $name_pipeline
            ]);


            return $response["response"];
        } catch (Exception $e) {
            $result['code'] = 500;
            $result['message'] = "Erreur de création d'un pipeline Serveur innaccessible";
            return $result;
        }
    }

    public static function deletePipeline()
    {
        // $hopital_id,$departement_id,$name_pipeline
        // $departement =Departement::where('id',$departement_id)->pluck('name')->first();
        // $hopital =Hopital::where('id',$hopital_id)->pluck('name')->first();
        $url = "/api/nifi/";
        try {
            $response = Http::withHeaders([
                "Accept" => "application/json",
                "Content-type" => "application/json"
            ])->delete(config("app.FLASK_URL") . $url, [

                        "name_hospital"  =>  'principal',
                        "name_dep"  =>  'cardio',
                        "name_pipeline"  =>  'fdfdfs'
                    ]);


            return $response["response"];
        } catch (Exception $e) {
            $result['code'] = 500;
            $result['message'] = "Erreur de création d'un pipeline Serveur innaccessible";
            return $result;
        }
    }


}
