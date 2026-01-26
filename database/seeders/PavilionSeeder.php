<?php

namespace Database\Seeders;

use App\Models\PavilionSection;
use App\Models\PavilionFacility;
use App\Models\PavilionLayout;
use Illuminate\Database\Seeder;

class PavilionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Seed Hero Section
        PavilionSection::create([
            'section_type' => PavilionSection::TYPE_HERO,
            'title' => 'Ruang Elegan untuk',
            'description' => 'Pendopo Ponorogo Dreamland menghadirkan perpaduan arsitektur tradisional Jawa yang agung dengan fasilitas modern untuk berbagai kebutuhan acara.',
            'extra_data' => [
                'highlighted_title' => 'Momen Istimewa Anda',
                'cta_text' => 'Cek Ketersediaan & Paket',
                'cta_url' => '#inquiry',
                'badge_text' => 'Venue & Events',
                'background_image' => 'https://images.unsplash.com/photo-1511578314322-379afb476865?q=80&w=2070&auto=format&fit=crop',
            ],
            'sort_order' => 1,
            'is_active' => true,
        ]);

        // Seed Specs Section
        PavilionSection::create([
            'section_type' => PavilionSection::TYPE_SPECS,
            'title' => 'Spesifikasi Venue',
            'subtitle' => 'Detail teknis untuk kebutuhan Anda',
            'extra_data' => [
                'specs_items' => [
                    ['title' => 'Kapasitas Tamu', 'desc' => '500 - 800', 'subtitle' => 'Seated / Standing'],
                    ['title' => 'Dimensi Ruang', 'desc' => '20 x 30 m', 'subtitle' => 'Tanpa Pilar Tengah'],
                    ['title' => 'Material Lantai', 'desc' => 'Granit HQ', 'subtitle' => 'Aksen Kayu Jati'],
                    ['title' => 'Kenyamanan', 'desc' => 'Semi-Outdoor', 'subtitle' => 'Mist Fan / AC Option'],
                ],
            ],
            'sort_order' => 2,
            'is_active' => true,
        ]);

        // Seed Facilities Section
        PavilionSection::create([
            'section_type' => PavilionSection::TYPE_FACILITIES,
            'title' => 'Segala yang Anda Butuhkan',
            'description' => 'Kami memahami bahwa kelancaran acara bergantung pada fasilitas pendukung. Paket sewa Pendopo sudah termasuk:',
            'image_path' => 'https://images.unsplash.com/photo-1505236858219-8359eb29e329?q=80&w=900&auto=format&fit=crop',
            'sort_order' => 3,
            'is_active' => true,
        ]);

        // Seed Facilities
        $facilities = [
            [
                'icon' => '🔊',
                'title' => 'Sound System Standard',
                'description' => '4 Speaker Aktif, Mixer, 2 Wireless Mic.',
                'icon_bg_color' => 'bg-green-50',
                'icon_color' => 'text-primary',
            ],
            [
                'icon' => '💡',
                'title' => 'Lighting Estetik',
                'description' => 'Lampu gantung Jawa & sorot area.',
                'icon_bg_color' => 'bg-yellow-50',
                'icon_color' => 'text-earth',
            ],
            [
                'icon' => '🚪',
                'title' => 'Ruang Transit',
                'description' => 'Privat room untuk VIP/Pengantin.',
                'icon_bg_color' => 'bg-blue-50',
                'icon_color' => 'text-accent',
            ],
            [
                'icon' => '🅿️',
                'title' => 'Area Parkir Luas',
                'description' => 'Kapasitas hingga 50 mobil & 100 motor.',
                'icon_bg_color' => 'bg-zinc-100',
                'icon_color' => 'text-zinc-600',
            ],
        ];

        foreach ($facilities as $index => $facility) {
            PavilionFacility::create(array_merge($facility, ['sort_order' => $index]));
        }

        // Seed Layouts
        $layouts = [
            [
                'title' => 'Wedding Setup',
                'image_path' => 'https://images.unsplash.com/photo-1511795409834-ef04bbd61622?q=80&w=1000&auto=format&fit=crop',
            ],
            [
                'title' => 'Seminar / Workshop',
                'image_path' => 'https://images.unsplash.com/photo-1511578314322-379afb476865?q=80&w=1000&auto=format&fit=crop',
            ],
            [
                'title' => 'Social Gathering',
                'image_path' => 'https://images.unsplash.com/photo-1529156069898-49953e39b3ac?q=80&w=1000&auto=format&fit=crop',
            ],
        ];

        foreach ($layouts as $index => $layout) {
            PavilionLayout::create(array_merge($layout, ['sort_order' => $index]));
        }
    }
}
