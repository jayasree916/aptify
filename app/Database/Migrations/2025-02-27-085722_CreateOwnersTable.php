<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateOwnersTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'   => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true
            ],
            'block_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => false
            ],
            'apartment_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => false
            ],
            'owner_name' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => false
            ],
            'address' => [
                'type'       => 'TEXT',
                'null'       => true
            ],
            'mobile_no' => [
                'type'       => 'VARCHAR',
                'constraint' => 15,
                'null'       => false
            ],
            'email' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => true
            ],
            'from_date' => [
                'type'       => 'DATE',
                'null'       => false
            ],
            'to_date' => [
                'type'       => 'DATE',
                'null'       => true
            ],
            'is_active' => [
                'type'       => 'TINYINT',
                'constraint' => 1,
                'default'    => 1,
                'null'       => false
            ],
            'created_by' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => false
            ],
            'updated_by' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true
            ],
            'created_at' => [
                'type'    => 'DATETIME',
                'null'    => true
            ],
            'updated_at' => [
                'type'    => 'DATETIME',
                'null'    => true
            ]
        ]);

        $this->forge->addKey('id', true);
        // $this->forge->addForeignKey('block_id', 'blocks', 'id', 'CASCADE', 'CASCADE');
        // $this->forge->addForeignKey('apartment_id', 'apartments', 'id', 'CASCADE', 'CASCADE');
        // $this->forge->addForeignKey('created_by', 'users', 'id', 'CASCADE', 'CASCADE');
        // $this->forge->addForeignKey('updated_by', 'users', 'id', 'SET NULL', 'CASCADE');

        $this->forge->createTable('owners');
    }

    public function down()
    {
        $this->forge->dropForeignKey('owners', 'owners_block_id_foreign');
        $this->forge->dropForeignKey('owners', 'owners_apartment_id_foreign');
        $this->forge->dropForeignKey('owners', 'owners_created_by_foreign');
        $this->forge->dropForeignKey('owners', 'owners_updated_by_foreign');

        $this->forge->dropTable('owners');
    }
}
