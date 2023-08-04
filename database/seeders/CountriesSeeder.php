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
        $countries = (array)json_decode(http_request("https://raw.githubusercontent.com/dayCod/count-trees/content/src/Content/countries_json.json"));

        foreach($countries as $index => $value) {
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
