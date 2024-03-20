<?php

namespace App\Http\Controllers;

use App\DTOs\PlaceDTO;
use App\Providers\PlacesServiceProvider;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class RestaurantController extends PlaceController
{
    public const PLACE_TYPE_PARAM = 'restaurant';
    public const RENDER_VIEW = 'restaurants';

    public function __construct(PlacesServiceProvider $placesApiService)
    {
        parent::__construct($placesApiService);
    }

    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index(): Renderable
    {
        $countries = [
            'FR' => 'France',
            'DE' => 'Germany',
            'IT' => 'Italy',
            'ES' => 'Spain',
            'PT' => 'Portugal',
            'PL' => 'Poland',
            'GR' => 'Greece',
            'HU' => 'Hungary',
            'SE' => 'Sweden',
            'FI' => 'Finland',
            // missing the rest of the countries(for now Europe only)
        ];
        return view(self::RENDER_VIEW, ['countries' => $countries]);
    }

    public function searchRestaurant(Request $request): View
    {
        /** @var PlaceDTO[] $placesDTOList */
        $placesDTOList = parent::searchPlace($request, self::PLACE_TYPE_PARAM);

        return view('displays.restaurantDisplay')->with('placesDTOList', $placesDTOList);
    }
}
