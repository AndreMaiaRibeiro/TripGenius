<?php

namespace App\DTOs;

class PlaceDTO
{
    private string $placeId;
    private string $name;
    private array $types;
    private string $businessStatus;
    private float $latitude;
    private float $longitude;
    private float|int $rating;
    private float|int $userRatingTotal;

    private function __construct(string $placeId, string $name, array $type, string $businessStatus, float $latitude, float $longitude, float $rating, int $userRatingTotal) {
        $this->placeId = $placeId;
        $this->name = $name;
        $this->types = $type;
        $this->businessStatus = $businessStatus;
        $this->latitude = $latitude;
        $this->longitude = $longitude;
        $this->rating = $rating;
        $this->userRatingTotal = $userRatingTotal;
    }

    public static function create(array $data): ?self
    {
        if (!isset($data['rating'])) {
        return null;
    }
        return new self(
            $data['place_id'],
            $data['name'],
            $data['types'],
            $data['business_status'],
            $data['geometry']['location']['lat'],
            $data['geometry']['location']['lng'],
            $data['rating'],
            $data['user_ratings_total'],
        );
    }

    public static function createMultipleFromApiResponse(array $response): array
    {
        $placeDTOList = [];
        foreach ($response['results'] as $place) {
            $placeDTO = PlaceDTO::create($place);
            if ($placeDTO !== null) {
                $placeDTOList[] = $placeDTO;
            }
        }

        return $placeDTOList;
    }
}
