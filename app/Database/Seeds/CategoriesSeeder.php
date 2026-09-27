<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CategoriesSeeder extends Seeder
{
   public function run()
    {

        //Products Categories 
        $Categories = [
            ['name' => 'Phones & Tablets'],
            ['name' => 'Computers & Laptops '],
            ['name' => 'Electronics'],
            ['name' => 'Fashion'],
            
            ['name' => 'Shoes'],
            ['name' => 'Books & Study Materials '],
            ['name' => 'Furniture'],
            ['name' => 'Home and Kitchen '],
            ['name' => 'Sports & Fitness'],
            ['name' => 'Beauty & Personal Care'],
            ['name' => 'Services'],
            ['name' => 'Other']
        ];

        $this->db->table('categories')->insertBatch($Categories);
    }
}
