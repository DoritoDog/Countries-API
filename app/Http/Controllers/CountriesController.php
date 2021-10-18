<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;

class CountriesController extends Controller
{
    public function index(Request $request)
    {
        $countries = Country::getByFilters($request->name);

        return \json_encode($countries);
    }
}
