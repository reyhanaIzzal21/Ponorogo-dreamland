<?php

namespace Database\Seeders;

use App\Models\RestaurantSection;
use App\Models\RestaurantGalleryImage;
use Illuminate\Database\Seeder;

class RestaurantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Hero Section
        RestaurantSection::updateOrCreate(
            ['section_type' => RestaurantSection::TYPE_HERO],
            [
                'title' => 'Cita Rasa Tradisional',
                'subtitle' => 'di Jantung Ponorogo',
                'description' => 'Nikmati hidangan warisan leluhur dengan sentuhan modern, disajikan dalam kehangatan suasana kekeluargaan.',
                'extra_data' => [
                    'background_image' => 'https://images.unsplash.com/photo-1514362545857-3bc16c4c7d1b?q=80&w=2070&auto=format&fit=crop',
                    'instagram_username' => 'ponorogo.dreamland',
                    'instagram_url' => 'https://instagram.com/ponorogo.dreamland',
                ],
                'sort_order' => 1,
                'is_active' => true,
            ]
        );

        // Filosofi Section
        RestaurantSection::updateOrCreate(
            ['section_type' => RestaurantSection::TYPE_FILOSOFI],
            [
                'title' => 'Lebih dari Sekadar Tempat Makan',
                'description' => '"Dam Cokro" bukan hanya nama, tapi sebuah janji. Diambil dari semangat menjaga aliran tradisi agar tetap jernih dan menghidupi.

Kami bekerja sama langsung dengan petani lokal Ponorogo untuk mendapatkan rempah terbaik. Proses memasak kami masih mempertahankan teknik \'slow cooking\' menggunakan tungku kayu untuk menu-menu tertentu, demi menjaga aroma asap yang khas.',
                'sort_order' => 2,
                'is_active' => true,
            ]
        );

        // Gallery Images (using external URLs for demo)
        $galleryImages = [
            [
                'image_path' => 'https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?q=80&w=1000&auto=format&fit=crop',
                'alt_text' => 'Suasana Interior Dam Cokro',
                'sort_order' => 1,
            ],
            [
                'image_path' => 'https://images.unsplash.com/photo-1550966871-3ed3c6227685?q=80&w=300',
                'alt_text' => 'Area Makan Outdoor',
                'sort_order' => 2,
            ],
            [
                'image_path' => 'https://images.unsplash.com/photo-1559339352-11d035aa65de?q=80&w=500&auto=format&fit=crop',
                'alt_text' => 'Hidangan Khas Ponorogo',
                'sort_order' => 3,
            ],
            [
                'image_path' => 'https://images.unsplash.com/photo-1592861956120-e524fc739696?q=80&w=500&auto=format&fit=crop',
                'alt_text' => 'Spot Foto Estetik',
                'sort_order' => 4,
            ],
        ];

        foreach ($galleryImages as $image) {
            RestaurantGalleryImage::updateOrCreate(
                ['image_path' => $image['image_path']],
                $image
            );
        }
    }
}
