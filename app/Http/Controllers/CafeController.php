<?php

namespace App\Http\Controllers;

use App\Providers\PlacesServiceProvider;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;

class CafeController extends PlaceController
{
    public const PLACE_TYPE_PARAM = 'cafe';
    public const RENDER_VIEW = 'cafes';

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

    public function searchCafe(Request $request): void
    {
        parent::searchPlace($request, self::PLACE_TYPE_PARAM);

    }
}
