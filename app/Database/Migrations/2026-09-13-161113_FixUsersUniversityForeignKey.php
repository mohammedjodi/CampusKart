<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class FixUsersUniversityForeignKey extends Migration
{
    public function up()
    {
        //Remove old fk 
        $this->forge->dropForeignKey('users' , 'fk_users_university');

        //Adding the correct Key 
        $this->forge->addForeignKey(
            'university_id',
            'Campuses',
            'id',
            'SET NULL',
            'CASCADE',
            'fk_users_university'
        );
    }

    public function down()
    {
        $this->forge->dropForeignKey('users' , 'fk_users_university');

        //Restore the old fk

        
    }
}
