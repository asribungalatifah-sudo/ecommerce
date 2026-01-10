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
                'name' => 'Sparepart Mobil',
                'slug' => 'sparepart-mobil',
                'description' => 'Suku cadang mobil seperti mesin, rem, filter, dan komponen pendukung lainnya',
                'is_active' => true,
            ],
            [
                'name' => 'Sparepart Motor',
                'slug' => 'sparepart-motor',
                'description' => 'Suku cadang motor seperti rantai, kampas rem, oli, dan komponen motor lainnya',
                'is_active' => true,
            ],
            [
                'name' => 'Aksesoris Kendaraan',
                'slug' => 'aksesoris-kendaraan',
                'description' => 'Aksesoris kendaraan seperti cover jok, spion, lampu variasi, dan aksesoris interior',
                'is_active' => true,
            ],
            [
                'name' => 'Perawatan Kendaraan',
                'slug' => 'perawatan-kendaraan',
                'description' => 'Produk perawatan kendaraan seperti oli, cairan pembersih, wax, dan perawatan mesin',
                'is_active' => true,
            ],
            [
                'name' => 'Ban & Velg',
                'slug' => 'ban-velg',
                'description' => 'Ban dan velg untuk mobil dan motor berbagai ukuran dan tipe',
                'is_active' => true,
            ],
            [
                'name' => 'Helm & Safety',
                'slug' => 'helm-safety',
                'description' => 'Helm dan perlengkapan keselamatan berkendara seperti sarung tangan dan pelindung',
                'is_active' => true,
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }

        $this->command->info('✅ Kategori otomotif berhasil di-seed!');
    }
}
