<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CountryController extends Controller
{
    public function showEuropeanCountries()
    {
        $folderPath = 'countries/Europe';
        $files = File::files(public_path($folderPath));
        $countryNamesFromImages = [];

        foreach ($files as $file) {
            $fileName = pathinfo($file, PATHINFO_FILENAME);
            $webPath = asset($folderPath . '/' . $fileName . '.' . pathinfo($file, PATHINFO_EXTENSION));
            $countryNamesFromImages[$fileName] = $webPath;
        }

        return view('europeanCountries', ['countryNamesFromImages' => $countryNamesFromImages]);
    }

    public function selectCountry(Request $request)
    {
        $id = $request->query('id');
        $formattedCountryName = str_replace('-flag', '', $id);

        Session::put('sessionCountry', self::countryCode($formattedCountryName));

        return redirect()->route('restaurants.index');
    }
    public static function countryCode($countryName): string
    {
        $countryCodes = [
            'albania' => 'al',
            'andorra' => 'ad',
            'austria' => 'at',
            'belarus' => 'by',
            'belgium' => 'be',
            'bosnia-and-herzegovina' => 'ba',
            'bulgaria' => 'bg',
            'croatia' => 'hr',
            'czech-republic' => 'cz',
            'denmark' => 'dk',
            'england' => 'gb', // Changed to UK's code
            'estonia' => 'ee',
            'finland' => 'fi',
            'france' => 'fr',
            'georgia' => 'ge',
            'germany' => 'de',
            'greece' => 'gr',
            'greenland' => 'gl', // Note: Greenland is an autonomous territory of Denmark
            'hungary' => 'hu',
            'iceland' => 'is',
            'ireland' => 'ie',
            'italy' => 'it',
            'kosovo' => 'xk', // Note: 'xk' is a user-assigned code for Kosovo, not officially ISO assigned
            'latvia' => 'lv',
            'liechtenstein' => 'li',
            'lithuania' => 'lt',
            'luxembourg' => 'lu',
            'malta' => 'mt',
            'moldova' => 'md',
            'monaco' => 'mc',
            'montenegro' => 'me',
            'netherlands' => 'nl',
            'north-macedonia' => 'mk',
            'norway' => 'no',
            'poland' => 'pl',
            'portugal' => 'pt',
            'romania' => 'ro',
            'russia' => 'ru',
            'san-marino' => 'sm',
            'scotland' => 'gb', // Changed to UK's code
            'serbia' => 'rs',
            'slovakia' => 'sk',
            'slovenia' => 'si',
            'spain' => 'es',
            'sweden' => 'se',
            'switzerland' => 'ch',
            'ukraine' => 'ua',
            'united-kingdom' => 'gb',
            'vatican-city' => 'va',
            'wales' => 'gb', // Changed to UK's code
        ];

        return $countryCodes[$countryName];
    }
}

