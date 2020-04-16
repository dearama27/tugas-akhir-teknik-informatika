<?php

namespace App\Validators;

use GuzzleHttp\Client;

class ReCaptcha
{
    public function validate($attribute, $value, $parameters, $validator)
    {
        $client = new Client([
            'base_uri' => 'https://www.google.com',
            'verify' => base_path('cacert.pem'),
        ]);

        $response = $client->post('/recaptcha/api/siteverify',
            [
                'form_params' =>
                    [
                        'secret' => config('recaptcha.secret_key'),
                        'response' => $value
                    ]
            ]
        );

        $body       = json_decode((string)$response->getBody());
        return $body->success;
    }
}