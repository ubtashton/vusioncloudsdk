<?php

//initially a single file - to be split out later on

namespace ubtashton\vusioncloudsdk;

require_once 'vendor/autoload.php';

use GuzzleHttp\Client;

class Vusion
{
    public $apikey;
    public $region;
    public $baseurl = '';

    public function __construct($apikey, $region= 'eu'){
        $this->apikey = $apikey;
        $this->region = $region;
        $this->baseurl = 'https://api-'.$this->region.'.vusion.io/vusion-cloud/v1/';
    }


    public function sendPost($url, $data){
        $client = new Client();
        $response = $client->request('POST', $this->baseurl.$url, [
            'headers' => [
                'Ocp-Apim-Subscription-Key' => $this->apikey,
            ],'body' => json_encode($data)
        ]);
        return json_decode($response->getBody());
    }


    public function storeSearch($search){
        $send=new \stdClass();
        $send->search=($search!=null?$search:'');
        $send->page=1;
        $send->pageSize=500;
        return $this->sendPost('stores/search', $send);
    }





    
}