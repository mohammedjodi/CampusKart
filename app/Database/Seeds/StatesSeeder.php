<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class StatesSeeder extends Seeder
{
    public function run()
    {

        //list of all states in Nigeria for campuskart users to select from when registering and used for filtering university by state
        $states = [
            ['name' => 'Abia'],
            ['name' => 'Adamawa'],
            ['name' => 'Akwa Ibom'],
            ['name' => 'Anambra'],
            ['name' => 'Bauchi'],
            ['name' => 'Bayelsa'],
            ['name' => 'Benue'],
            ['name' => 'Borno'],
            ['name' => 'Cross River'],
            ['name' => 'Delta'],
            ['name' => 'Ebonyi'],
            ['name' => 'Edo'],
            ['name' => 'Ekiti'],
            ['name' => 'Enugu'],
            ['name' => 'Gombe'],
            ['name' => 'Imo'],
            ['name' => 'Jigawa'],
            ['name' => 'Kaduna'],
            ['name' => 'Kano'],
            ['name' => 'Katsina'],
            ['name' => 'Kebbi'],
            ['name' => 'Kogi'],
            ['name' => 'Kwara'],
            ['name' => 'Lagos'],
            ['name' => 'Nasarawa'],
            ['name' => 'Niger'],
            ['name' => 'Ogun'],
            ['name' => 'Ondo'],
            ['name' => 'Osun'],
            ['name' => 'Oyo'],
            ['name' => 'Plateau'],
            ['name' => 'Rivers'],
            ['name' => 'Sokoto'],
            ['name' => 'Taraba'],
            ['name' => 'Yobe'],
            ['name' => 'Zamfara'],
            ['name' => 'FCT'],
        ];

        $this->db->table('states')->insertBatch($states);
}
}
