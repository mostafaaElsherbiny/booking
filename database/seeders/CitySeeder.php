<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $egyptCities = [
            'Cairo',
            'Alexandria',
            'Giza',
            'Shubra El-Kheima',
            'Port Said',
            'Suez',
            'Luxor',
            'al-Mansura',
            'El-Mahalla El-Kubra',
            'Tanta',
            'Asyut',
            'Ismailia',
            'Fayyum',
            'Zagazig',
            'Aswan',
            'Damietta',
            'Damanhur',
            'al-Minya',
            'Beni Suef',
            'Qena',
            'Sohag',
            'Hurghada',
            '6th of October City',
            'Shibin El Kom',
            'Banha',
            'Kafr el-Sheikh',
            'Arish',
            '10th of Ramadan City',
            'Bilbais',
            'Marsa Matruh',
            'Idfu',
            'Mit Ghamr',
            'Al-Hamidiyya',
            'Desouk',
            'Qalyub',
            'Abu Kabir',
            'Kafr el-Dawwar',
            'Girga',
            'Akhmim',
            'Matareya',
            'Qina',
            'Tala',
            'Al-Ghanam',
            'Al-Mahallah al-Kubra',
            'Al-Matariyyah',
            'Al-Minya',
            'Al-Qanatir al-Khayriyya',
            'Al-Saff',
            'Al-Salam',
            'Al-Sharqia',
            'Al-Shuhada',
            'Al-Waqf',
            'Arab El-Awamer',
            'Arab Qibli',
            'Armant',
            'Ashmoun',
            'Awsim',
            'Badr',
            'Badr',
            'Badr',
            'Badr',
        ];

        foreach ($egyptCities as $city) {
            City::create([
                'name' => $city,
            ]);
        }
    }
}
