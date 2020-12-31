<?php

namespace Nathel;


class OsuApi
{
    const CLIENT_ID = 4227;
    const SECRET = 'kB9lkO0UUgvjdOmizgHUE5FJdM1d6JpTCJG0UFGr';
    const URI = 'http://localhost/Mappool-website-project/model/api/osu/OsuApi.php';


    public static function getToken(bool $queryType) // False for Authorization Grant and True for User Credentials
    {
        $curl = curl_init();

        $payload_temp1 = [
            "client_id"     => self::CLIENT_ID,
            "client_secret" => self::SECRET,
            "grant_type"    => "authorization_code",
            "redirect_uri"  => self::URI
        ];

        $code = array ( "code"  => $_GET['code']);

        $payload_temp2 = array_merge($payload_temp1, $code);

        $payload = $queryType ? json_encode($payload_temp1) : json_encode($payload_temp2);

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://osu.ppy.sh/oauth/token',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => 1,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_POSTFIELDS => $payload,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json', 'Accept: application/json',
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

    }
    public static function refreshToken($queryType)
    {
        //...

    }

    public static function apiQueryTemplatePOST($token, $url, $header, $body) // Probably won't need it though..
    {
        $curl = curl_init();
        $oauth = array(
            'Authorization: '.$token,
        );
        $payload = $body;

        $payload = json_encode($payload);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://osu.ppy.sh/api/'.$url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => 1,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_POSTFIELDS => $payload,
            CURLOPT_HTTPHEADER => array_merge($header, $oauth),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        return $response;

    }

    public static function apiQueryTemplateGET($token, $url, $params, $body, $header=null)
    {
        //... ce n'est qu'une question de flèm.... de temps
    }
}




