<?php

namespace Nathel;


class OsuApi
{
    const CLIENT_ID = 4227;
    const SECRET = 'kB9lkO0UUgvjdOmizgHUE5FJdM1d6JpTCJG0UFGr';
    const URI = 'https://533b3f89b216.ngrok.io/connexion';

    protected $current_credentials_token;
    protected $user_token;


    public function getToken($code=null)
    {
        // Method that get a token code
        $curl = curl_init();
        if ($code == null):
            $payload = [
                "client_id"     => self::CLIENT_ID,
                "client_secret" => self::SECRET,
                "grant_type"    => "client_credentials",
                "scope" => "public",
            ];
        else:
            $payload = [
                "client_id"     => self::CLIENT_ID,
                "client_secret" => self::SECRET,
                "grant_type"    => "authorization_code",
                "redirect_uri" => self::URI,
                "code" => $code
            ];
            endif;


        $payload = json_encode($payload);

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://osu.ppy.sh/oauth/token',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => 1,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_POSTFIELDS => $payload,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        $response = json_decode($response, true);


        if ($code==null): // Public Token
            $this->current_credentials_token = $response;
        else: // User authentification token
            return $response['access_token'];
        endif;

    }
    public static function refreshToken($queryType)
    {
        //Method that refresh a token code when it expired

    }

    public function apiQueryGET(bool $token, string $endpoint, array $params=null, array $body=null, array $header=null)
    {
        // GET template for queries in the api
        $curl = curl_init();
        $url = $endpoint;
        if ($params !== null){
            $url.= '?' . http_build_query($params);
        }

        $tokenused = $token == 1 ? $this->user_token : $this->current_credentials_token;

        $header_tmp = array(
            'Authorization: Bearer '.$tokenused,
            'Accept: application/json',
            'Content-Type: application/json',);
        if ($header !== null):
            $header_tmp = array_merge($header_tmp, $header);
        endif;

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => $header_tmp,
            CURLOPT_POSTFIELDS => $body,
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return json_decode($response, true);

    }



    // -------- QUERIES -----------------


    public function GetUserInfo(int $user_id)
    {
        $endpoint = "https://osu.ppy.sh/api/v2/users/".$user_id;
        return self::apiQueryGET($token=0, $endpoint);
    }

    public function getOwnUserInfo($token_user) //Only used for Oauth user_id verification
    {
        $this->user_token = $token_user;

        $endpoint = 'https://osu.ppy.sh/api/v2/me/osu';
        return self::apiQueryGET($token=1, $endpoint);
    }

    public function getUserRecentActivity($user_id, $limit=12, $offset=1)
    {
        //Limit : Maximum number of results
        //Offset : Result offset for pagination
        $endpoint = "https://osu.ppy.sh/api/v2/users/" . $user_id . "1/recent_activity";
        $params = array(
            'limit' => 12,
            'offset' => 1,
        );
        return self::apiQueryGET($token=0,$endpoint, $params);
    }

    public function getUserScores($user_id, $score_type, $include_fails=0, $mode=osu, $limit=12, $offset=1)
    {
        // score_type : Must be one of these: best, firsts, recent.
        // include_fails : Only for recent scores, include scores of failed plays. Set to 1 to include them. Defaults to 0.
        // mode : GameMode of the scores to be returned. Defaults to the specified user's mode.
        $endpoint = "https://osu.ppy.sh/api/v2/users/" . $user_id ."/scores/" . $score_type;
        $params = array(
            'include_fails' => $include_fails,
            'mode' => $mode,
            'limit' => $limit,
            'offset' => $offset
        );

        return self::apiQueryGET($token=0, $endpoint, $params);

    }

    public function getUserScores_Map(){
        // api v2 not yet merged, need to connect with api v1, WIP
    }




}


