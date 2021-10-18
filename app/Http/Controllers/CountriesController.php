<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;

class CountriesController extends Controller
{
    public function index(Request $request, string $countryName)
    {
        $countries = Country::where('code', 'ARB')
               ->orderBy('name')
               ->take(10)
               ->get();

        dd($countries);
    }
}
