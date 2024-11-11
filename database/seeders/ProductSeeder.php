<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductGroup;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $smokedGroup = ProductGroup::where('name', 'Копченая колбаса')->first();
        $boiledGroup = ProductGroup::where('name', 'Вареная колбаса')->first();

        $smokedProducts = [
            ['name' => 'Сервелат', 'type' => 'Копченая', 'weight' => '500g', 'group_id' => $smokedGroup->id],
            ['name' => 'Московская', 'type' => 'Копченая', 'weight' => '450g', 'group_id' => $smokedGroup->id],
            ['name' => 'Краковская', 'type' => 'Копченая', 'weight' => '400g', 'group_id' => $smokedGroup->id],
        ];

        $boiledProducts = [
            ['name' => 'Докторская', 'type' => 'Вареная', 'weight' => '500g', 'group_id' => $boiledGroup->id],
            ['name' => 'Любительская', 'type' => 'Вареная', 'weight' => '450g', 'group_id' => $boiledGroup->id],
            ['name' => 'Молочная', 'type' => 'Вареная', 'weight' => '400g', 'group_id' => $boiledGroup->id],
        ];

        foreach (array_merge($smokedProducts, $boiledProducts) as $product) {
            Product::create($product);
        }
    }
}
