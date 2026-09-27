<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateProductsTable extends Migration
{
  public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],

            'user_id' => [
                'type'     => 'INT',
                'unsigned' => true,
            ],

            'category_id' => [
                'type'     => 'INT',
                'unsigned' => true,
            ],

            'brand_id' => [
                'type'     => 'INT',
                'unsigned' => true,
                'null'     => true,
            ],

            'condition_id' => [
                'type'     => 'INT',
                'unsigned' => true,
            ],

            'status_id' => [
                'type'     => 'INT',
                'unsigned' => true,
            ],

            'title' => [
                'type'       => 'VARCHAR',
                'constraint' => 150,
            ],

            'description' => [
                'type' => 'TEXT',
            ],

            'price' => [
                'type'       => 'DECIMAL',
                'constraint' => '12,2',
            ],

            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],

            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);

        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('category_id', 'categories', 'id', 'RESTRICT', 'CASCADE');
        $this->forge->addForeignKey('brand_id', 'brands', 'id', 'SET NULL', 'CASCADE');
        $this->forge->addForeignKey('condition_id', 'conditions', 'id', 'RESTRICT', 'CASCADE');
        $this->forge->addForeignKey('status_id', 'statuses', 'id', 'RESTRICT', 'CASCADE');

        $this->forge->createTable('products');
    }

    public function down()
    {
        $this->forge->dropTable('products');
    }
}

