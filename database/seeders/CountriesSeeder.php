<?php

namespace Database\Seeders;

use App\Models\Countries;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CountriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $countries = [
            "US" => "United States",
            "CA" => "Canada",
            "AT" => "Austria",
            "BE" => "Belgium",
            "BG" => "Bulgaria",
            "HR" => "Croatia",
            "CY" => "Cyprus",
            "CZ" => "Czech Republic",
            "DK" => "Denmark",
            "EE" => "Estonia",
            "FI" => "Finland",
            "FR" => "France",
            "DE" => "Germany",
            "GR" => "Greece",
            "HU" => "Hungary",
            "IE" => "Ireland",
            "IT" => "Italy",
            "LV" => "Latvia",
            "LT" => "Lithuania",
            "LU" => "Luxembourg",
            "MT" => "Malta",
            "NL" => "Netherlands",
            "PL" => "Poland",
            "PT" => "Portugal",
            "RO" => "Romania",
            "SK" => "Slovakia",
            "SI" => "Slovenia",
            "ES" => "Spain",
            "SE" => "Sweden",
            "AL" => "Albania",
            "BY" => "Belarus",
            "BA" => "Bosnia and Herzegovina",
            "XK" => "Kosovo",
            "MK" => "Macedonia (North Macedonia)",
            "MD" => "Moldova",
            "ME" => "Montenegro",
            "RU" => "Russia",
            "RS" => "Serbia",
            "UA" => "Ukraine",
            "BH" => "Bahrain",
            "EG" => "Egypt",
            "IR" => "Iran",
            "IQ" => "Iraq",
            "IL" => "Israel",
            "JO" => "Jordan",
            "KW" => "Kuwait",
            "LB" => "Lebanon",
            "OM" => "Oman",
            "PS" => "Palestine",
            "QA" => "Qatar",
            "SA" => "Saudi Arabia",
            "SY" => "Syria",
            "TR" => "Turkey",
            "AE" => "United Arab Emirates",
            "YE" => "Yemen"
        ];

        foreach ($countries as $code => $name) {
            Countries::create([
                'code' => $code,
                'name' => $name,
            ]);
        }

    }
}
