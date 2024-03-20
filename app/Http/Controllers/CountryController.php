<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CountryController extends Controller
{
    public function showEuropeanCountries()
    {
        $folderPath = public_path('countries/Europe');
        $files = File::files($folderPath);
        $imagePaths = [];

        foreach ($files as $file) {
            $imagePaths[] = 'countries/Europe/' . $file->getFilename();
        }
        return view('europeanCountries', ['imagePaths' => $imagePaths]);
    }

    public function selectCountry(Request $request)
    {
        $countryName = $request->input('country_name');
        session()->flash('selected_country', $countryName);

        return redirect()->route('restaurants.index', ['country' => $countryName]);
    }
}
