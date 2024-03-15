<?php

namespace App\Integration;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use GuzzleHttp\Client;

class AutocompleteHandler
{

    public const BASE_URL = "https://maps.googleapis.com/maps/api/place";

    public string $key;

    public function __construct()
    {
        $this->key = config('services.googlekey.key');
    }

    public function placeId(string $address): JsonResponse
    {
        $url = sprintf(
            '%s/autocomplete/json?%s',
            self::BASE_URL,
            http_build_query([
                'input' => $address,
                'types' => 'address',
                'key' => $this->key,
            ])
        );
        try {
            $client = new Client();
            $response = $client->request('get', $url);
            $responseJson = $response->getBody()->getContents();
            $responseArray = json_decode($responseJson, true);
            return response()->json(collect($responseArray['predictions'])->map(
                fn ($value) =>
                [
                    'id' => $value['place_id'],
                    'label' => $value['description'],
                ]
            ));
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}