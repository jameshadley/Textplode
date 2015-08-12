<?php

class Textplode
{
    private $version;
    private $base_url;
    private $api_key;

    public function __construct($api_key)
    {
        $this->api_key  = $api_key;
        $this->version  = 'v3';
        $this->base_url = 'http://api.textplode.com/' . $this->version . '/';
    }
    public function send(array $recipients, $message, $from_name){
        $data = [
            'recipients' => json_encode($recipients),
            'message'    => $message,
            'from'       => $from_name,
            'api_key'    => $this->api_key
        ];

        $curl = curl_init(sprintf('%s/messages/send', $this->base_url));
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_TIMEOUT, 30);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_exec($curl);
    }
}
