<?php
// database/seeders/CategorySeeder.php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Perangkat Komputer',
                'slug' => 'perangkat-komputer',
                'description' => 'Komponen dan perangkat komputer seperti CPU, motherboard, RAM, VGA, dan storage',
                'is_active' => true,
            ],
            [
                'name' => 'Laptop & Notebook',
                'slug' => 'laptop-notebook',
                'description' => 'Laptop dan notebook untuk kerja, sekolah, desain, dan gaming',
                'is_active' => true,
            ],
            [
                'name' => 'Smartphone & Tablet',
                'slug' => 'smartphone-tablet',
                'description' => 'Smartphone dan tablet dari berbagai merek dan spesifikasi',
                'is_active' => true,
            ],
            [
                'name' => 'Aksesoris Gadget',
                'slug' => 'aksesoris-gadget',
                'description' => 'Aksesoris gadget seperti charger, kabel data, casing, holder, dan power bank',
                'is_active' => true,
            ],
            [
                'name' => 'Perangkat Jaringan',
                'slug' => 'perangkat-jaringan',
                'description' => 'Perangkat jaringan seperti router, modem, switch, repeater, dan access point',
                'is_active' => true,
            ],

        ];

        foreach ($categories as $category) {
            Category::create($category);
        }

        $this->command->info('✅ Kategori perlengkapan teknologi berhasil di-seed!');
    }
}
