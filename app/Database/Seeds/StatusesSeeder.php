<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class StatusesSeeder extends Seeder
{
    public function run()
    {
           //Products Status 
        $statuses = [
            ['name' => 'Active'],
            ['name' => 'Sold '],
            ['name' => 'Hidden '],
            ['name' => 'Pending'],
        ];

        $this->db->table('statuses')->insertBatch($statuses);
    }
    
}
