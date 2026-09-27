<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class BrandsSeeder extends Seeder
{
    public function run()
    {
       //Some Popular Products  Brands 
        $brands = [
            //Phone
            ['name' => 'Apple'],
            ['name' => 'Samsung '],
            ['name' => 'Tecno'],
            ['name' => 'Infinix'],
            ['name' => 'Xiaomi'],
            ['name' => 'Oppo'],
            ['name' => 'Vivo'],
            ['name' => 'Huawie '],
            ['name' => 'Nokia'],
            ['name' => 'Google'],
            ['name' => 'OnePlus'],

            //Latops
            ['name' => 'Hp'],
            ['name' => 'Dell'],
            ['name' => 'Lenovo'],
            ['name' => 'ASUS '],
            ['name' => 'Acer'],
            ['name' => 'Microsoft'],
            
            //Fashion
            ['name' => 'Nike'],
            ['name' => 'Adidas'],
            ['name' => 'Puma'],
            ['name' => 'Reebok '],

            //Electronics
            ['name' => 'Sony'],
            ['name' => 'LG'],
            ['name' => 'JBL'],
            ['name' => 'Hisense'],
            ['name' => 'Panasonic'],

            ['name' => 'Others']

        ];

        $this->db->table('brands')->insertBatch($brands);
    }
}
