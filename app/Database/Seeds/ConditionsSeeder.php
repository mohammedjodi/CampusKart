<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ConditionsSeeder extends Seeder
{
    public function run()
    {
        //Products Condition 
        $conditions = [
            ['name' => 'New'],
            ['name' => 'Like New  '],
            ['name' => 'Used '],
            ['name' => 'Good'],
            ['name' => 'Fair'],
            ['name' => 'For parts '],
        ];

        $this->db->table('conditions')->insertBatch($conditions);
    }
}
