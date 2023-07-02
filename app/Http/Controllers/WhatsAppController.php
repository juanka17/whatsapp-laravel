<?php

namespace App\Http\Controllers;

use Facebook\Facebook;
use Illuminate\Http\Request;

class WhatsAppController extends Controller{


    public function sendMessage(Request $request){
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://graph.facebook.com/v17.0/100523783044572/messages',
            CURLOPT_RETURNTRANSFER => true,
            
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>'{
                "messaging_product": "whatsapp",
                "to": "573007945983",
                "type": "template",
                "template": {
                    "name": "hello_world",
                    "language": {
                        "code": "en_US"
                    }
                }
            }',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Authorization: Bearer EABim2siW0Y4BADvS0kPWDFOM5poobomaPiSkAtZCztKdUu0WPc3mb6DB71lTYOHz9qs7ZCRXJdXbqr5Xmei1ka29R9rehZCYSj1IktofYPcYadEK8kEvoCKbzuXEMRZB8AhOoRTFtDNSBRGIdsFzZAEtml2gAw8BzNYyn0v98fDMT5mLFVAUDItwZBrLAUzKUMJzqkNjjaewZDZD'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;

    }
}
