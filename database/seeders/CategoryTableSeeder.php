<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categoryRecords = [
            ['id'=>1, 'parent_id'=>0, 'category_name'=>'Motorcycles', 'category_discount'=>0, 'category_description'=>'', 'url'=>'motorcycles', 'status'=>1],
            ['id'=>2, 'parent_id'=>0, 'category_name'=>'Accessories', 'category_discount'=>0, 'category_description'=>'', 'url'=>'accessories', 'status'=>1],
            ['id'=>3, 'parent_id'=>2, 'category_name'=>'Helmets', 'category_discount'=>0, 'category_description'=>'', 'url'=>'helmets', 'status'=>1],
            ['id'=>4, 'parent_id'=>2, 'category_name'=>'Jackets', 'category_discount'=>0, 'category_description'=>'', 'url'=>'jackets', 'status'=>1],
            ['id'=>5, 'parent_id'=>2, 'category_name'=>'Pants', 'category_discount'=>0, 'category_description'=>'', 'url'=>'pants', 'status'=>1],
            ['id'=>6, 'parent_id'=>2, 'category_name'=>'Gloves', 'category_discount'=>0, 'category_description'=>'', 'url'=>'gloves', 'status'=>1],
            ['id'=>7, 'parent_id'=>2, 'category_name'=>'Boots', 'category_discount'=>0, 'category_description'=>'', 'url'=>'boots', 'status'=>1],
        ];

        Category::insert($categoryRecords);
    }
}
