<?php

namespace App\Providers;

use App\DTOs\PlaceDTO;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\TransferStats;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Session;
use Psr\Http\Message\ResponseInterface;
use SKAgarwal\GoogleApi\Exceptions\GooglePlacesApiException;

class PlacesServiceProvider
{
    private Client $client;
    private bool $verifySSL;
    private array $headers = [];

    public function __construct(bool $verifySSL = false, array $headers = [])
    {
        $this->verifySSL = $verifySSL;

        $this->client = new Client([
            'base_uri' => GooglePlacesApiServiceProvider::getBaseUrl(),
            'headers' => $headers,
            'verify' => false,
        ]);
    }

    public function getCoordinatesByAddressAndRegion(string $address, string $region): string
    {
        $params = [
            'address' => $address,
            'region' => $region,
        ];

        $responseData = $this->makeGetRequest(GooglePlacesApiServiceProvider::getGeocodeUrl(), $params);
        return  $this->getLatitudeFromData($responseData) . ',' . $this->getLongitudeFromData($responseData);
    }

    private function makeGetRequest(string $url, array $params): array
    {
        return $this->getDataFromJsonResponse(GooglePlacesApiServiceProvider::makeGetRequest($this->client,
            $url,
            $params,
        ));
    }

    private function getDataFromJsonResponse(ResponseInterface $response): array
    {
        return json_decode($response->getBody()->getContents(), true);
    }

    private function getLatitudeFromData(array $data): float
    {
        return $data['results'][0]['geometry']['location']['lat'];
    }

    private function getLongitudeFromData(array $data): float
    {
        return $data['results'][0]['geometry']['location']['lng'];
    }

    public function getNearbyPlaces(string $location, string $radius, string $type): array
    {
        $params = [
            'location' => $location,
            'radius' => $radius,
            'type' => $type,
        ];

        $responseData = $this->makeGetRequest(GooglePlacesApiServiceProvider::getPlaceNearbySearchUrl(), $params);

        return PlaceDTO::createMultipleFromApiResponse($responseData);
    }

    public function textSearch(string $query, array $params = [])
    {
        $params['query'] = $query;
        //$response = $this->makeRequest(self::TEXT_SEARCH_URL, $params);

        //return $this->convertToCollection($response, 'results');
    }

    public function placeDetails(string $placeId, array $params = [])
    {
        $params['placeid'] = $placeId;

        //$response = $this->makeRequest(self::DETAILS_SEARCH_URL, $params);

        //return $this->convertToCollection($response);
    }

    public function photo(string $photoReference, array $params = []): string
    {
        $params['photoreference'] = $photoReference;

        if (!array_any_keys_exists(['maxwidth', 'maxheight'], $params)) {
            throw new GooglePlacesApiException('maxwidth or maxheight param is required');
        }

        $options['on_stats'] = function (TransferStats $stats) use (&$url) {
            $url = $stats->getEffectiveUri();
        };

        // $this->client->get(self::PLACE_PHOTO_URL, $options);

        return (string)$url;
    }

    private function prepareNearbySearchParams(string $location, string $radius, array $params): array
    {
        $params['location'] = $location;
        $params['radius'] = $radius;

        if (
            array_key_exists('rankby', $params)
            and $params['rankby'] === 'distance'
        ) {
            unset($params['radius']);

            if (!array_any_keys_exists(['keyword', 'name', 'type'], $params)) {
                throw new GooglePlacesApiException("Nearby Search require one"
                    . " or more of 'keyword', 'name', or 'type' params since 'rankby' = 'distance'.");
            }
        } elseif (!$radius) {
            throw new GooglePlacesApiException("'radius' param is not defined.");
        }

        return $params;
    }

    public function verifySSL(bool $verifySSL = true)
    {
        $this->verifySSL = $verifySSL;
    }

    private function getOptions(array $params, string $method = 'get'): array
    {
        //$options = [
        //    'query' => [
        //        'key' => $this->key,
        //    ],
        //];

        //if ($method == 'post') {
        //    $options = array_merge(['body' => json_encode($params)], $options);
        //} else {
        //    $options['query'] = array_merge($options['query'], $params);
        //}

        $options['http_errors'] = false;

        $options['verify'] = $this->verifySSL;

        if (!empty($this->headers)) {
            $options['headers'] = $this->headers;
        }

        return $options;
    }

    public function withHeaders(array $headers)
    {
        $this->headers = $headers;
    }
}
