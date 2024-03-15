<?php

namespace App\Http\Controllers;

use App\Providers\PlacesServiceProvider;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;

class BarController extends PlaceController
{
    public const PLACE_TYPE_PARAM = 'bar';
    public const RENDER_VIEW = 'bars';

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

    public function searchBar(Request $request): void
    {
        parent::searchPlace($request, self::PLACE_TYPE_PARAM);

    }
}
