<?php

namespace App\Providers;

use App\Providers\Interfaces\ApiInterface;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;

class GooglePlacesApiServiceProvider implements ApiInterface
{
    private const API_KEY_ENV_VAR_NAME = 'GOOGLE_KEY';

    private const BASE_URL = 'https://maps.googleapis.com/maps/api/';

    private const GEOCODE_URI = 'geocode/json';

    private const PLACE_NEARBY_SEARCH_URI = 'place/nearbysearch/json';

    private const TEXT_SEARCH_URL = 'place/textsearch/json';

    private const FIND_PLACE = 'place/findplacefromtext/json';

    private const DETAILS_SEARCH_URL = 'place/details/json';

    private const PLACE_AUTOCOMPLETE_URL = 'place/autocomplete/json';

    private const QUERY_AUTOCOMPLETE_URL = 'place/queryautocomplete/json';

    private const PLACE_ADD_URL = 'place/add/json';

    private const PLACE_DELETE_URL = 'place/delete/json';

    private const PLACE_PHOTO_URL = 'place/photo';

    //https://maps.googleapis.com/maps/api/geocode/json?address=Toledo&region=es&key=YOUR_API_KEY
    //https://maps.googleapis.com/maps/api/place/nearbysearch/json?location=-33.8670522%2C151.1957362&radius=1500&type=restaurant&key=YOUR_API_KEY

    public static function getBaseUrl(): string
    {
        return self::BASE_URL;
    }

    public static function getGeocodeUrl(): string
    {
        return self::BASE_URL . self::GEOCODE_URI;
    }
    public static function getPlaceNearbySearchUrl(): string
    {
        return self::BASE_URL . self::PLACE_NEARBY_SEARCH_URI;
    }

    /**
     * @throws GuzzleException
     */
    public static function makeGetRequest(Client $client, string $url, array $query): ResponseInterface
    {
        $query['key'] = self::getApiKey();

        return $client->request('GET', $url, [
            'query' => $query
        ]);
    }

    private static function getApiKey()
    {
        return env(self::API_KEY_ENV_VAR_NAME, null);
    }
}
