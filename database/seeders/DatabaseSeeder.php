<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
         \App\Models\Category::factory(5)->create();
         \App\Models\MetalType::factory()->createMany([
            ['name'=>'Gold','purity'=>'18k','color'=>'gold'],
            ['name'=>'Silver','purity'=>null,'color'=>'silver'],
           ['name'=>'Rose Gold','purity'=>'18k','color'=>'rose-gold'],
    ]);

    // create jewellery items using existing categories & metal types
    \App\Models\JewelleryItem::factory(20)->create();
    }

}
