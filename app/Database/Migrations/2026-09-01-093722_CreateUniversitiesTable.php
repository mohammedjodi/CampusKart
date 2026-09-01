<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUniversitiesTable extends Migration
{
     public function up() {

        /*

            Due to Codigniter migrations issues i deleted the Universities Migration column and the table.. 
            And i then created another table "Campuses" to replace that table that was deleted and gave it an id column with phpmyadmin 
            NOTE:
                to self i didnt create the Campuses table with migrations i did it manually and then added the remaining columns using migrations 
    
        */
        $this->forge->addColumn( 'Campuses' , [
            'name' => [
                'type' => 'VARCHAR',
                 'constraint' => 150
            ],
            'state_id' =>[
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
                
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true
            ],
            'updated_at'  => [
                'type' => 'DATETIME',
                'null' => true
            ],
        ]);
        // $this->forge->addKey('id', true);

        //universities.state_id -> states.id
        $this->db->query(
            'ALTER TABLE  Campuses
            ADD CONSTRAINT fk_universities_states
            FOREIGN KEY (state_id)
            REFERENCES states(id)
            ON DELETE SET NULL 
            ON UPDATE CASCADE'
        );
        // $this->forge->createTable('universities');
    }
    public function down() { 

        $this->db->query(
            ' ALTER TABLE Campuses     
            DROP FOREIGN KEY fk_universities_states
        ');

        $this->forge->dropTable('Campuses'); 
    }
}
