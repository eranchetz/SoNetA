<?php
class Facebook {
    function __construct($client_id, $client_secret) {
        $this->client_id = $client_id;
        $this->client_secret = $client_secret;
    }

    function call_api($path="/me",$method="get",$data=" ") {
        $url = "https://graph.facebook.com/{$path}";

        if(strtolower($method) == "post") {
            $data = "access_token=". $this->access_token."&".$data ;
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $result = curl_exec($ch);
            curl_close($ch);
            return json_decode($result,true);
        } else {
            $url = "https://graph.facebook.com/". $path ."?access_token=".$this->access_token."&".$data;
            $response = file_get_contents($url);
            return json_decode($response,true);

        }
    }

    function getAuthorizeUrl($callback_url = "", $perms = array()) {
        return "https://graph.facebook.com/oauth/authorize?client_id={$this->client_id}&redirect_uri={$callback_url}&scope=".implode(",",$perms);
    }

    function getAccessToken($callback_url = "" , $code="") {
        $url = "https://graph.facebook.com/oauth/access_token?client_id={$this->client_id}&redirect_uri={$callback_url}&client_secret={$this->client_secret}&code={$code}";
        parse_str(file_get_contents($url),$data);
        return $data;
    }

    function setAccessToken($access_token) {
        $this->access_token = $access_token;
    }


}
?>
