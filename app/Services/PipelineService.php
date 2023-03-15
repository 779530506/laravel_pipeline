<?php

namespace App\Services;

use App\Models\Departement;
use App\Models\Hopital;
use App\Models\Pipeline;
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
        $username = str_replace(' ', '', auth()->user()->name);
        try {
            $response = Http::withHeaders([
                "Accept" => "application/json",
                "Content-type" => "application/json"
            ])->post(config("app.FLASK_URL") . $url, [

                        "name_hospital"  =>  $hopital,
                        "name_dep"  =>  $departement,
                        "name_pipeline"  =>  $name_pipeline,
                        "username"  =>  $username
            ]);

            return $response["response"];
        } catch (Exception $e) {
            $result['code'] = 500;
            $result['message'] = "Erreur de création d'un pipeline Serveur innaccessible";
            $result['error'] =$e;
            return $result;
        }
    }

    public static function deletePipeline(Pipeline $pipeline)
    {
        //dd($pipeline->departement_id);
        //$hopital_id,$departement_id,$name_pipeline
        $departement =Departement::where('id',$pipeline->departement_id)->pluck('name')->first();
        $hopital =Hopital::where('id',$pipeline->hopital_id)->pluck('name')->first();
        //dd($departement,$hopital,$pipeline->name_pipeline);
        $url = "/api/nifi/";
        try {
            $response = Http::withHeaders([
                "Accept" => "application/json",
                "Content-type" => "application/json"
            ])->delete(config("app.FLASK_URL") . $url, [

                        "name_hospital"  =>  $hopital,
                        "name_dep"  =>  $departement,
                        "name_pipeline"  =>  $pipeline->name_pipeline
                    ]);

            return $response["response"];
        } catch (Exception $e) {
            $result['code'] = 500;
            $result['message'] = "Erreur de création d'un pipeline Serveur innaccessible";
            return $result;
        }
    }

    public static function runOrOffPipeline(Pipeline $pipeline,String $action)
    {
        //Pipeline::all();
        $departement =Departement::where('id',$pipeline->departement_id)->pluck('name')->first();
        $hopital =Hopital::where('id',$pipeline->hopital_id)->pluck('name')->first();
        //dd($departement,$hopital,$pipeline->name_pipeline);
        if($action=='run'){
            $url = "/api/nifi/pipeline_run";
        }else{
            $url = "/api/nifi/pipeline_stop";
        }

        try {
            $response = Http::withHeaders([
                "Accept" => "application/json",
                "Content-type" => "application/json"
            ])->post(config("app.FLASK_URL") . $url, [

                        "name_hospital"  =>  $hopital,
                        "name_dep"  =>  $departement,
                        "name_pipeline"  =>  $pipeline->name_pipeline
                    ]);

            return $response["response"];
        } catch (Exception $e) {
            $result['code'] = 500;
            $result['message'] = "Erreur de lancement d'un pipeline,s Serveur innaccessible";
            return $result;
        }
    }

    public static function createUser($username,$password,$email)
    {

        $url = "/api/users/";
        try {
            $response = Http::withHeaders([
                "Accept" => "application/json",
                "Content-type" => "application/json"
            ])->post(config("app.FLASK_URL") . $url, [

                        "username"  =>  $username,
                        "password"  =>  $password,
                        "email"  =>  $email,
            ]);


            return $response["response"];
        } catch (Exception $e) {
            $result['code'] = 500;
            $result['message'] = "Erreur de création d'un pipeline Serveur innaccessible";
            return $result;
        }
    }

    public static function deleteUser($username)
    {

        $url = "/api/users/";
        try {
            $response = Http::withHeaders([
                "Accept" => "application/json",
                "Content-type" => "application/json"
            ])->delete(config("app.FLASK_URL") . $url, [

                        "username"  =>  $username,

            ]);


            return $response;
        } catch (Exception $e) {
            $result['code'] = 500;
            $result['message'] = "Erreur de suppression d'un pipeline Serveur innaccessible";
            return $result;
        }
    }



}
