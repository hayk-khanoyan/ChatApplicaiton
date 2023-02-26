<?php

namespace App\Http\Controllers;

use App\Http\Resources\SuccessResource;
use App\Models\Country;

class CountryController extends Controller
{
    public function __invoke(): SuccessResource
    {
        $countries = Country::all();

        return SuccessResource::make(['data' => $countries]);
    }
}
