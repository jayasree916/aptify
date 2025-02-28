<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateApartmentTypesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'name' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'unique'     => true,
            ],
            'description' => [
                'type'       => 'TEXT',
                'null'       => true,
            ],
            'created_at' => [
                'type'    => 'DATETIME',
                'null'    => true,
            ],
            'created_by' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => false
            ],
            'updated_at' => [
                'type'    => 'DATETIME',
                'null'    => true,
            ],
            'updated_by' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('apartment_types');
    }

    public function down()
    {
        $this->forge->dropTable('apartment_types');
    }
}
