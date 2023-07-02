<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class testcontroller extends Controller
{
    public function enviarmensaje(){

        try {
            $url='https://graph.facebook.com/';
            $id='100523783044572';
            $ver='v15.0';
            $token='EABim2siW0Y4BAOHT3j1bmozQIJKoaTYfXr9mmCKw3jZAHTKj5olSd5LCKzAvKJgGqhNHFIzSIORUkTdFnTvW8BiD6ex7ZAb0FRlxMRmUDr93ayZBx7ZCgEqOHNRtigNRRr2HG6jLQCNnZCAzkN52RG7tU5RYZA3433rA7vrhak509LdKTciMUi3gypJR7Mb6B688Eh3NNYugZDZD';
            $payload=[
                "messaging_product"=> "whatsapp",
                "recipient_type"=> "individual",
                "to"=> "573007945983",
                "type"=> "text",
                "text"=> [
                    "preview_url"=> false,
                    "body"=> "MESSAGE_CONTENT"
                ]
            ];

            $response = Http::withToken($token)->post($url.$ver.'/'.$id.'/'.'messages'.'/', $payload)->throw();
            $mansaje = $response->json();

            return response()->json([
                'succes'=>true,
                'data'=> $mansaje,
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'succes'=>false,
                'error'=> $e->getMessage(),
            ], 500);
        }
    }

    public function verificar(Request $request){
        try {
            $tokenVerify='S3rv1MensajesWHATSAPP';
            $query=$request->query();

            $mode=$query['hub_mode'];
            $token=$query['hub_verify_token'];
            $challenge=$query['hub_challenge'];


            if($mode && $token){
                if($mode==='subscribe' && $token==$tokenVerify){
                    /*return response()->json([
                        'succes'=>true,
                        //'data'=> $query,
                    ], 200);*/
                    return response($challenge, 200)->header('Content-Type', 'text/plain');
                }
            }
            throw new Exception('Invalid request');

            

        } catch (Exception $e) {
            return response()->json([
                'succes'=>false,
                'error'=> $e->getMessage(),
            ], 500);
        }
    }

    public function procesar (Request $request){
        try {
            $bodycontnet=json_decode($request->getContent(),true);
            $value=$bodycontnet['entry'][0]['changes'][0]['value'];

            //texto
            if(!empty($value['messages'])){
                if($value['messages'][0]['type']=='text'){
                    $body=$value['messages'][0]['text']['body'];
                }
            }

            //imagenes
            if(!empty($value['messages'])){
                if($value['messages'][0]['type']=='image'){
                    $body=$value['messages'][0]['image']['sha256'];// guardar mas informacion de la imagen
                }   
            }

            //audios
            if(!empty($value['messages'])){
                if($value['messages'][0]['type']=='audio'){
                    $body=$value['messages'][0]['audio'];
                }   
            }

            //audios
            if(!empty($value['messages'])){
                if($value['messages'][0]['type']=='document'){
                    $body=$value['messages'][0]['document'];
                }
            }

            return response()->json([
                        'succes'=>true,
                        'data'=> $body,
                    ], 200);

        } catch (Exception $e) {
            return response()->json([
                'succes'=>false,
                'error'=> $e->getMessage(),
            ], 500);
        }
    }
}