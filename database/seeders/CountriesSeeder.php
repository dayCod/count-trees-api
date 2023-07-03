<?php

namespace Database\Seeders;

use App\Models\Countries;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CountriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
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

        foreach($array as $index => $value) {
            Countries::insert([
                'country_code' => $value['country_code'],
                'country_name' => $value['country_name'],
                'country_phone_code' => $value['country_phone_code'],
                'country_icon_link' => $value['country_icon_link'],
                'created_at' => now()->timestamp,
                'updated_at' => now()->timestamp,
            ]);
        }
    }
}
