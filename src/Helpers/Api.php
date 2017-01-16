<?php

namespace PMTest\Helpers;



class Api
{
    const AUTHORIZATION = 'Bearer 080042cad6356ad5dc0a720c18b53b8e53d4c274';
    const API_URL = 'https://test33.plentymarkets-cloud01.com/rest/items?';


    public function getHttpPage($page, $itemsPerPage)
    {

        $url = self::API_URL . 'page=' . $page . '&itemsPerPage=' . $itemsPerPage;

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($curl, CURLINFO_HEADER_OUT, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json' , self::AUTHORIZATION ));

        $response = curl_exec($curl);
        $result = json_decode($response, true);
        curl_close($curl);

        return $result;
    }
}