<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateBillingTypesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 10,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'billing_type' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'default_charge' => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2',
                'null'       => false,
            ],
            'created_by' => [
                'type'    => 'INT',
                'unsigned'=> true,
                'null'    => true,
            ],
            'created_at' => [
                'type'    => 'DATETIME',
                'null'    => true,
            ],
            'updated_by' => [
                'type'    => 'INT',
                'unsigned' => true,
                'null'    => true,
            ],
            'updated_at' => [
                'type'    => 'DATETIME',
                'null'    => true,
            ],

             
        ]);
        $this->forge->addKey('id', true);

        // Add foreign keys
        $this->forge->addForeignKey('created_by', 'users','id', 'SET NULL', 'CASCADE');
        $this->forge->addForeignKey('updated_by', 'users','id', 'SET NULL', 'CASCADE');

        $this->forge->createTable('billing_types');
    }

    public function down()
    {
        $this->forge->dropTable('billing_types');
    }
}
