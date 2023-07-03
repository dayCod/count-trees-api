<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {

    $array = [];

    $countries = (array)json_decode(http_request(config('country-api.country-name')));
    $country_phone_code = (array)json_decode(http_request(config('country-api.country-phone-code')));

    foreach($countries as $index => $country) {
        $array["$country"] = [
            'country_code' => $index,
            'country_name' => $country,
            'country_phone_code' => array_filter($country_phone_code, function ($value, $key) use ( $index ) {
                return $key == $index;
            }, ARRAY_FILTER_USE_BOTH)[$index],
            'country_icon_link' => "https://flagsapi.com/$index/flat/64.png",
        ];
    }

    dd($array);

    return view('welcome');
});
