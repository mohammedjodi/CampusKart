<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddProfileFieldsToUsers extends Migration
{
    public function up()
    {
        $fields = [
            'first_name' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false,
                'after' => 'username'
            ],
            'last_name' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false,
                'after' => 'first_name'
            ],
            'university'  => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => false,
                'after' => 'last_name'
            ],
            'avatar' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => false,
                'after' => 'university'
            ],

        ];

        //adding this fields to the current users table that is provided by Shield to allow users to enter our own custom information 
            $this->forge->addColumn('users' , $fields);

    }

    public function down()
    {
        $this->forge->dropColumn('users' , [
            'first_name',
            'last_name',
            'university',
            'avatar',
        ]);
    }
}
