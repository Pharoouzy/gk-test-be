<?php

namespace App\Helpers;

use GuzzleHttp;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ConnectException;

/**
 * Trait LocationHelper
 * @package App\Helpers
 */
trait LocationHelper {

    /**
     * @param $keywords
     * @param float $lng
     * @param float $lat
     * @return mixed
     * @throws GuzzleHttp\Exception\GuzzleException
     */
    private function autocomplete($keywords, $lng = 6.4937861, $lat = 3.5840516) {
        try {
            $client = new Client();
            $radius = 50000; // in meter (50000M is equivalent to 50KM)
            $url = 'https://maps.googleapis.com/maps/api/place/autocomplete/json?input='.$keywords.'&location='.$lat.','.$lng.'&radius='.$radius.'&strictbounds&fields=formatted_address,name,geometry&key='.config('app.google_map_api_key');
            $response = json_decode((string)$client->post($url)->getBody());
            if($response->status == 'OK'){
                return $response;
            }
            else{
                abort(503, 'Connection error.');
            }

        } catch (ConnectException $e){
            abort(503, 'Connection error.');
        }
    }

    /**
     * @param $address
     * @return array
     * @throws GuzzleHttp\Exception\GuzzleException
     */
    public function getGeometry($address){
        try {
            $client = new Client();
            $url = 'https://maps.googleapis.com/maps/api/geocode/json?address=' . urlencode($address) . '&key=' . config('app.google_map_api_key');
            $response = json_decode((string)$client->post($url)->getBody());
            if($response->status == 'OK'){
                $geometry = (object)[
                    'address' => $response->results[0]->formatted_address,
                    'place_id' => $response->results[0]->place_id,
                    'lng' => $response->results[0]->geometry->location->lng,
                    'lat' => $response->results[0]->geometry->location->lat
                ];
            }
            else{
                abort(503, 'Connection error.');
            }

        } catch (ConnectException $e){
            abort(503, 'Connection error.');
        }

        return $geometry;
    }
}
