<?php

namespace Database\Seeders;

use App\Models\ProductGroup;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $groups = [
            ['name' => 'Копченая колбаса', 'description' => 'Группа копченых колбас'],
            ['name' => 'Вареная колбаса', 'description' => 'Группа вареных колбас'],
        ];

        foreach ($groups as $group) {
            ProductGroup::create($group);
        }
    }
}
