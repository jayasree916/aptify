<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateBlocksTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'          => ['type' => 'INT', 'constraint' => 11, 'auto_increment' => true],
            'name'        => ['type' => 'VARCHAR', 'constraint' => 255],
            'description' => ['type' => 'TEXT', 'null' => true],
            'created_at'  => ['type' => 'DATETIME', 'null' => true],
            'created_by'  => ['type' => 'INT', 'constraint' => 11, 'null' => false],
            'updated_at'  => ['type' => 'DATETIME', 'null' => true],
            'updated_by' => ['type'  => 'INT', 'constraint' => 11, 'null' => true]
        ]);

        $this->forge->addKey('id', true);
        // Add foreign keys
        // $this->forge->addForeignKey('created_by', 'users','id', 'SET NULL', 'CASCADE');
        // $this->forge->addForeignKey('updated_by', 'users','id', 'SET NULL', 'CASCADE');

    
        $this->forge->createTable('blocks');
    }

    public function down()
    {
        //
    }
}
