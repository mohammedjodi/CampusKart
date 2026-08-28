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
            'university_id'  => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => false,
                'after' => 'last_name'
            ],
            'avatar' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
                'after' => 'university_id'
            ],

        ];

        //adding this fields to the current users table that is provided by Shield to allow users to enter our own custom information 
            $this->forge->addColumn('users' , $fields);
        
        //Foreign Keys for Users Table 
        //users.university_id -> University.id 
        $this->forge->addForeignKey(
            'university_id',
            'university',
            'id',
            'CASCADE',
            'RESTRICT'
        );

    }

    public function down()
    {
        $this->forge->dropForeignKey('users' , 'university_id');
        $this->forge->dropColumn('users' , [
            'first_name',
            'last_name',
            'university_id',
            'avatar',
        ]);
    }
}
