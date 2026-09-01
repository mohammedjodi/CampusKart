<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateCutomFeilds extends Migration
{
      public function up()
     {

    
        $this->forge->addColumn('users' , 
        [
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
                'unsigned' => true,
                'null' => true,
                'after' => 'last_name'
            ],
            'phone' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
                'null' => true ,
                'after' => 'university_id'
            ],

            'bio' => [
                'type' => 'TEXT',
                'null' => true ,
                'after' => 'phone'
            ],
            'state_id' =>[
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
                'after' => 'bio'
            ],

            'avatar' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
                'after' => 'state_id'
            ],

        ]);

        //Foreign Keys for Users Table 

       // users.university_id -> Campuses.id 
        $this->db->query(
            'ALTER TABLE users 
            ADD CONSTRAINT fk_users_university
            FOREIGN KEY (university_id)
            REFERENCES Campuses(id)
            ON DELETE SET NULL 
            ON UPDATE CASCADE'
        );

        //users.state_id -> states.id
        $this->db->query(
            'ALTER TABLE users 
            ADD CONSTRAINT fk_users_states
            FOREIGN KEY (state_id)
            REFERENCES states(id)
            ON DELETE SET NULL 
            ON UPDATE CASCADE'
        );



     }

     public function down()
     {
        //Remove FOREIGN Keys
        $this->db->query(
            ' ALTER TABLE users 
            DROP FOREIGN KEY fk_users_university
                    ');

        $this->db->query(
            ' ALTER TABLE users     
            DROP FOREIGN KEY fk_users_states
        ');

        $this->forge->dropColumn('users' , [
            'first_name',
            'last_name',
            'university_id',
            'phone',
            'bio',
            'state_id',
            'avatar',
        ]);
     }
}
