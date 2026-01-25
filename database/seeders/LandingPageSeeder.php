<?php

namespace Database\Seeders;

use App\Models\LandingPageSection;
use Illuminate\Database\Seeder;

class LandingPageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Hero Section
        LandingPageSection::updateOrCreate(
            ['section_type' => LandingPageSection::TYPE_HERO],
            [
                'title' => 'Destinasi Terpadu untuk',
                'description' => 'Nikmati pengalaman tak terlupakan bersama keluarga di pusat kenyamanan dan kehangatan kota Ponorogo.',
                'extra_data' => [
                    'highlight_text' => 'Kuliner, Tradisi & Rekreasi',
                ],
                'sort_order' => 1,
                'is_active' => true,
            ]
        );

        // About Section
        LandingPageSection::updateOrCreate(
            ['section_type' => LandingPageSection::TYPE_ABOUT],
            [
                'title' => 'Mewujudkan "Dreamland" di Tanah Ponorogo',
                'description' => 'lahir dari sebuah mimpi sederhana: menyediakan satu tempat di mana tradisi lokal dapat berpadu harmonis dengan kenyamanan modern.',
                'extra_data' => [
                    'extra_description' => 'Kami percaya bahwa momen terbaik diciptakan melalui makanan yang lezat, suasana yang hangat, dan tempat yang nyaman. Baik Anda ingin menikmati hidangan di Dam Cokro atau merayakan cinta di Pendopo, kami hadir untuk melayani.',
                ],
                'sort_order' => 2,
                'is_active' => true,
            ]
        );

        // Why Choose Us Section
        LandingPageSection::updateOrCreate(
            ['section_type' => LandingPageSection::TYPE_WHY_CHOOSE_US],
            [
                'title' => 'Mengapa Memilih Kami',
                'extra_data' => [
                    'features' => [
                        [
                            'icon' => '📍',
                            'title' => 'Lokasi Strategis',
                            'description' => 'Mudah dijangkau, tepat di jantung aktivitas dan kenyamanan.',
                        ],
                        [
                            'icon' => '✨',
                            'title' => 'Fasilitas Lengkap',
                            'description' => 'One-stop destination: Makan, Acara, dan Hiburan keluarga.',
                        ],
                        [
                            'icon' => '🤝',
                            'title' => 'Pelayanan Ramah',
                            'description' => 'Keramahan khas Ponorogo dengan standar layanan profesional.',
                        ],
                        [
                            'icon' => '🏛️',
                            'title' => 'Suasana Otentik',
                            'description' => 'Perpaduan desain modern dan sentuhan tradisional Jawa.',
                        ],
                    ],
                ],
                'sort_order' => 3,
                'is_active' => true,
            ]
        );

        // Moment Section
        LandingPageSection::updateOrCreate(
            ['section_type' => LandingPageSection::TYPE_MOMENT],
            [
                'title' => 'Momen di Dreamland',
                'subtitle' => 'Lihat bagaimana pengunjung kami menikmati waktunya.',
                'sort_order' => 4,
                'is_active' => true,
            ]
        );

        $this->command->info('Landing page sections seeded successfully!');
    }
}
