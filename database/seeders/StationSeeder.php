<?php

namespace Database\Seeders;

use App\Models\Station;
use Illuminate\Database\Seeder;

class StationSeeder extends Seeder
{
    public function run(): void
    {
        Station::insert([
            [
                'name' => 'АЗС Хуҷанд 1',
                'address' => 'мкр. 20, рядом с базаром "Панҷшанбе", Хуҷанд',
                'latitude' => 40.29436,
                'longitude' => 69.6177,
                'company_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'АЗС Хуҷанд 2',
                'address' => 'просп. Исмоили Сомони, напротив ТЦ "Садбарг", Хуҷанд',
                'latitude' => 40.30118,
                'longitude' => 69.63568,
                'company_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'АЗС Хуҷанд 3',
                'address' => 'ул. Гагарина, возле Университета, Хуҷанд',
                'latitude' => 40.2899,
                'longitude' => 69.6135,
                'company_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
