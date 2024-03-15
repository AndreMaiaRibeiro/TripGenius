<?php

namespace App\Http\Controllers;

use App\Providers\PlacesServiceProvider;
use Illuminate\Contracts\Support\Renderable;
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
        return view(self::RENDER_VIEW);
    }

    public function searchRestaurant(Request $request): void
    {
        parent::searchPlace($request, self::PLACE_TYPE_PARAM);

        echo 'funcionou caralho';
    }
}
