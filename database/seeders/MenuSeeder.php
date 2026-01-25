<?php

namespace Database\Seeders;

use App\Models\MenuCategory;
use App\Models\MenuItem;
use App\Models\MenuPackageContent;
use App\Models\MenuPriceGroup;
use App\Models\MenuPriceGroupItem;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // ========================================
        // 1. PROMO - Grid Promo Layout
        // ========================================
        $promoCategory = MenuCategory::create([
            'slug' => 'promo',
            'name' => 'Combo Nikmat',
            'type' => MenuCategory::TYPE_GRID_PROMO,
            'sort_order' => 1,
            'is_active' => true,
        ]);

        $promoItems = [
            [
                'name' => 'Paket Combo 1',
                'description' => '1 Nasi Campur + 1 Ice Lemontea/Milo',
                'price' => 23000,
                'image_path' => 'https://images.unsplash.com/photo-1546069901-ba9599a7e63c',
                'is_promo' => true,
                'promo_badge' => 'BEST DEAL',
            ],
            [
                'name' => 'Paket Combo 2',
                'description' => '1 Chicken Steak Crispy + 1 Ice Lemontea/Milo',
                'price' => 23000,
                'image_path' => 'https://images.unsplash.com/photo-1604908176997-125f25cc6f3d',
                'is_promo' => true,
                'promo_badge' => 'BEST DEAL',
            ],
            [
                'name' => 'Paket Combo 3',
                'description' => '1 Spaghetti Ayam + 1 Ice Lemontea/Milo',
                'price' => 23000,
                'image_path' => 'https://images.unsplash.com/photo-1563379926898-05f4575a45d8',
                'is_promo' => true,
                'promo_badge' => 'BEST DEAL',
            ],
        ];

        foreach ($promoItems as $index => $item) {
            MenuItem::create([
                'menu_category_id' => $promoCategory->id,
                'name' => $item['name'],
                'slug' => 'paket-combo-' . ($index + 1),
                'description' => $item['description'],
                'price' => $item['price'],
                'image_path' => $item['image_path'],
                'is_promo' => $item['is_promo'],
                'promo_badge' => $item['promo_badge'],
                'sort_order' => $index + 1,
                'is_active' => true,
            ]);
        }

        // ========================================
        // 2. PRASMANAN - Package List Layout
        // ========================================
        $prasmananCategory = MenuCategory::create([
            'slug' => 'prasmanan',
            'name' => 'Paket Prasmanan',
            'type' => MenuCategory::TYPE_PACKAGE_LIST,
            'sort_order' => 2,
            'is_active' => true,
        ]);

        $prasmananPackages = [
            [
                'name' => 'Paket Yudistira',
                'price' => 52500,
                'price_suffix' => '/pax',
                'contents' => ['Nasi Putih', 'Sambal', 'Kerupuk', 'Buah Segar', 'Teh/Kopi', 'Es Campur', 'Brokoli Jamur', 'Sop Galantin', 'Ayam Bakar/Goreng', 'Ikan Saos Lada Hitam'],
            ],
            [
                'name' => 'Paket Bima',
                'price' => 47500,
                'price_suffix' => '/pax',
                'contents' => ['Nasi Putih', 'Sambal', 'Kerupuk', 'Buah Segar', 'Snack 2 Macam', 'Teh/Kopi', 'Es Campur', 'Angsio Tahu', 'Sop Telur Puyuh', 'Ayam Saos Mentega'],
            ],
            [
                'name' => 'Paket Arjuna',
                'price' => 42500,
                'price_suffix' => '/pax',
                'contents' => ['Nasi Putih', 'Sambal', 'Kerupuk', 'Buah Segar', 'Snack 1 Macam', 'Teh/Kopi', 'Sop Ayam Jamur', 'Ikan Asam Manis', 'Sapo Tahu'],
            ],
        ];

        foreach ($prasmananPackages as $index => $package) {
            $item = MenuItem::create([
                'menu_category_id' => $prasmananCategory->id,
                'name' => $package['name'],
                'slug' => strtolower(str_replace(' ', '-', $package['name'])),
                'price' => $package['price'],
                'price_suffix' => $package['price_suffix'],
                'sort_order' => $index + 1,
                'is_active' => true,
            ]);

            foreach ($package['contents'] as $contentIndex => $content) {
                MenuPackageContent::create([
                    'menu_item_id' => $item->id,
                    'content_name' => $content,
                    'sort_order' => $contentIndex + 1,
                ]);
            }
        }

        // ========================================
        // 3. NASI BOX - Package List Layout
        // ========================================
        $nasiBoxCategory = MenuCategory::create([
            'slug' => 'nasi-box',
            'name' => 'Paket Nasi Box',
            'type' => MenuCategory::TYPE_PACKAGE_LIST,
            'sort_order' => 3,
            'is_active' => true,
        ]);

        $nasiBoxPackages = [
            [
                'name' => 'Box Hemat',
                'price' => 25000,
                'contents' => ['Nasi Putih', 'Ayam Goreng/Bakar/Broiler', 'Mie Goreng', 'Kerupuk', 'Sambal'],
            ],
            [
                'name' => 'Box Premium',
                'price' => 30000,
                'contents' => ['Nasi Putih', 'Ayam Goreng Kampoeng', 'Mie Goreng', 'Sambel Goreng Kentang', 'Kerupuk', 'Sambal', 'Air Mineral'],
            ],
            [
                'name' => 'Box Sultan',
                'price' => 37500,
                'contents' => ['Nasi Putih', 'Daging Lapis', 'Sambel Goreng Kentang', 'Kerupuk', 'Sambal', 'Air Mineral'],
            ],
        ];

        foreach ($nasiBoxPackages as $index => $package) {
            $item = MenuItem::create([
                'menu_category_id' => $nasiBoxCategory->id,
                'name' => $package['name'],
                'slug' => strtolower(str_replace(' ', '-', $package['name'])),
                'price' => $package['price'],
                'sort_order' => $index + 1,
                'is_active' => true,
            ]);

            foreach ($package['contents'] as $contentIndex => $content) {
                MenuPackageContent::create([
                    'menu_item_id' => $item->id,
                    'content_name' => $content,
                    'sort_order' => $contentIndex + 1,
                ]);
            }
        }

        // ========================================
        // 4. NDAGING & SEAFOOD - Grid Photo Layout
        // ========================================
        $ndagingCategory = MenuCategory::create([
            'slug' => 'ndaging',
            'name' => 'Ndaging & Seafood',
            'type' => MenuCategory::TYPE_GRID_PHOTO,
            'sort_order' => 4,
            'is_active' => true,
        ]);

        $ndagingItems = [
            ['name' => 'Ayam Kampoeng Goreng Laos', 'price' => 27000, 'image' => 'https://images.unsplash.com/photo-1626082927389-6cd097cdc6ec'],
            ['name' => 'Bebek Bakar Kecap', 'price' => 30000, 'image' => 'https://images.unsplash.com/photo-1596450523098-9994c6575196'],
            ['name' => 'Cumi Crispy', 'price' => 30000, 'image' => 'https://images.unsplash.com/photo-1599488615731-7e5c2823528c'],
            ['name' => 'Udang Saus Padang', 'price' => 30000, 'image' => 'https://images.unsplash.com/photo-1565557623262-b51c2513a641'],
            ['name' => 'Beef Steak Original', 'price' => 45000, 'image' => 'https://images.unsplash.com/photo-1600891964092-4316c288032e'],
        ];

        foreach ($ndagingItems as $index => $item) {
            MenuItem::create([
                'menu_category_id' => $ndagingCategory->id,
                'name' => $item['name'],
                'slug' => strtolower(str_replace(' ', '-', $item['name'])),
                'price' => $item['price'],
                'image_path' => $item['image'],
                'sort_order' => $index + 1,
                'is_active' => true,
            ]);
        }

        // ========================================
        // 5. MINUMAN - Grid Photo Small Layout
        // ========================================
        $minumanCategory = MenuCategory::create([
            'slug' => 'minuman',
            'name' => 'Ngadem & Nganget',
            'type' => MenuCategory::TYPE_GRID_PHOTO_SMALL,
            'sort_order' => 5,
            'is_active' => true,
        ]);

        $minumanItems = [
            ['name' => 'Es Teh', 'price' => 6000, 'image' => 'https://images.unsplash.com/photo-1556679343-c7306c1976bc'],
            ['name' => 'Es Teler', 'price' => 17000, 'image' => 'https://images.unsplash.com/photo-1563583271-9c1044432c28'],
            ['name' => 'Jus Alpukat', 'price' => 15000, 'image' => 'https://images.unsplash.com/photo-1603569283847-aa295f0d016a'],
            ['name' => 'Wedang Uwuh', 'price' => 10000, 'image' => 'https://images.unsplash.com/photo-1599305445671-ac291c95aaa9'],
            ['name' => 'Kopi Tubruk', 'price' => 5000, 'image' => 'https://images.unsplash.com/photo-1497935586351-b67a49e012bf'],
        ];

        foreach ($minumanItems as $index => $item) {
            MenuItem::create([
                'menu_category_id' => $minumanCategory->id,
                'name' => $item['name'],
                'slug' => strtolower(str_replace(' ', '-', $item['name'])),
                'price' => $item['price'],
                'image_path' => $item['image'],
                'sort_order' => $index + 1,
                'is_active' => true,
            ]);
        }

        // ========================================
        // 6. SNACK - Price Group Layout
        // ========================================
        $snackCategory = MenuCategory::create([
            'slug' => 'snack',
            'name' => 'Menu Snack',
            'type' => MenuCategory::TYPE_PRICE_GROUP,
            'sort_order' => 6,
            'is_active' => true,
        ]);

        $priceGroups = [
            [
                'price' => 2000,
                'items' => ['Buah Jeruk', 'Buah Salak', 'Kacang Telur', 'Kacang Oven', 'Buah Pisang'],
            ],
            [
                'price' => 2500,
                'items' => ['Lumpia Sayur', 'Pukis', 'Dadar Gulung Polos', 'Bolu Lapis', 'Lumpia Rebung', 'Piscok', 'Martabak Mini', 'Pastel Sayur'],
            ],
            [
                'price' => 3000,
                'items' => ['Lumpia Ayam', 'Lumpia Telur', 'Bronis Mini', 'Lemper', 'Bikang', 'Bolu Gulung', 'Donat Bobolon'],
            ],
        ];

        foreach ($priceGroups as $index => $group) {
            $priceGroup = MenuPriceGroup::create([
                'menu_category_id' => $snackCategory->id,
                'price' => $group['price'],
                'sort_order' => $index + 1,
                'is_active' => true,
            ]);

            foreach ($group['items'] as $itemIndex => $itemName) {
                MenuPriceGroupItem::create([
                    'menu_price_group_id' => $priceGroup->id,
                    'item_name' => $itemName,
                    'sort_order' => $itemIndex + 1,
                ]);
            }
        }

        $this->command->info('Menu seeder completed successfully!');
        $this->command->info('Created:');
        $this->command->info('- ' . MenuCategory::count() . ' categories');
        $this->command->info('- ' . MenuItem::count() . ' menu items');
        $this->command->info('- ' . MenuPackageContent::count() . ' package contents');
        $this->command->info('- ' . MenuPriceGroup::count() . ' price groups');
        $this->command->info('- ' . MenuPriceGroupItem::count() . ' price group items');
    }
}
