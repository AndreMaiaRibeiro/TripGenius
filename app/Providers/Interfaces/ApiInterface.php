<?php

namespace App\Providers\Interfaces;

use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;

interface ApiInterface
{
    public static function getBaseUrl(): string;

    public static function makeGetRequest(Client $client, string $url, array $query): ResponseInterface;
}
