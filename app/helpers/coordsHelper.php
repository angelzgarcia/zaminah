<?php

    use Illuminate\Support\Facades\Http;

    if (!function_exists('getCoordinates')) {
        function getCoordinates($address) {
            $apiKey = 'AIzaSyCIpIISAV4iA4HQYpwSDnBpgVe2iQFKYig';
            $url = "https://maps.googleapis.com/maps/api/geocode/json?address=".urlencode($address)."&key={$apiKey}";

            $response = Http::get($url)->json();

            if (isset($response['status']) && $response['status'] == 'OK') {
                return [
                    'lat' => $response['results'][0]['geometry']['location']['lat'],
                    'lng' => $response['results'][0]['geometry']['location']['lng'],
                ];
            }

            return null;
        }
    }

    if (!function_exists('getAddress')) {
        function getAddress($lat, $lng) {
            $apiKey = 'AIzaSyCIpIISAV4iA4HQYpwSDnBpgVe2iQFKYig';
            $url = "https://maps.googleapis.com/maps/api/geocode/json?latlng={$lat},{$lng}&key={$apiKey}";

            $response = Http::get($url)->json();

            if ($response['status'] == 'OK') {
                return $response['results'][0]['formatted_address'];
            }

            return null;
        }
    }
