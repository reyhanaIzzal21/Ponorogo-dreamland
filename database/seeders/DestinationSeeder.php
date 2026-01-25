<?php

namespace Database\Seeders;

use App\Models\Destination;
use Illuminate\Database\Seeder;

class DestinationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $destinations = [
            [
                'name' => 'Dam Cokro Resto',
                'slug' => 'dam-cokro-resto',
                'description' => 'Restoran keluarga dengan cita rasa nusantara dan suasana alam yang asri. Cocok untuk makan siang keluarga atau dinner romantis.',
                'type' => Destination::TYPE_RESTAURANT,
                'status' => Destination::STATUS_OPEN,
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'Pendopo Ageng',
                'slug' => 'pendopo-ageng',
                'description' => 'Ruang serbaguna elegan untuk pernikahan, meeting, dan gathering skala besar dengan arsitektur Jawa klasik.',
                'type' => Destination::TYPE_VENUE,
                'status' => Destination::STATUS_OPEN,
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'name' => 'Kolam Renang',
                'slug' => 'kolam-renang',
                'description' => 'Wahana rekreasi air modern untuk keluarga. Area bermain air yang menyenangkan untuk semua umur.',
                'type' => Destination::TYPE_RECREATION,
                'status' => Destination::STATUS_SOON,
                'sort_order' => 3,
                'is_active' => true,
            ],
        ];

        foreach ($destinations as $destination) {
            Destination::updateOrCreate(
                ['slug' => $destination['slug']],
                $destination
            );
        }
    }
}
