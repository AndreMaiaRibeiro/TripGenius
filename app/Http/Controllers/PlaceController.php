<?php

namespace App\Http\Controllers;

use App\DTOs\PlaceDTO;
use App\Http\Controllers\Controller;
use App\Providers\PlacesServiceProvider;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;

class PlaceController extends Controller
{
    public const ADDRESS_PARAM = 'address';
    public const REGION_PARAM = 'region';
    public const RADIUS_PARAM = 'radius';

    private PlacesServiceProvider $placesApiService;

    public function __construct(PlacesServiceProvider $placesApiService)
    {
        $this->middleware('auth');
        $this->placesApiService = $placesApiService;
    }

    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index(): Renderable
    {
        return view('cafes');
    }

    public function searchPlace(Request $request, string $placeType): void
    {
        $locationResponse = $this->placesApiService->getCoordinatesByAddressAndRegion(
            $request->input(self::ADDRESS_PARAM),
            $request->input(self::REGION_PARAM)
        );

        /** @var PlaceDTO[] $nearbyPlacesData */
        $nearbyPlacesData = $this->placesApiService->getNearbyPlaces(
            $locationResponse,
            $request->input(self::RADIUS_PARAM),
            $placeType,
        );

    }
}
