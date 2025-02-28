<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ModifyApartmentTable extends Migration
{
    public function up()
    {
        // Remove columns from the 'apartment' table
        $this->forge->dropColumn('apartments', ['owner_name', 'contact_no', 'address', 'block', 'type', 'occupancy']); 

        $this->forge->addColumn('apartments', [
            'block_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => false,
                'after'     => 'id'
            ],
            'name' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => false,
                'after'     => 'block_id'
            ],
            'description' => [
                'type'       => 'TEXT',
                'null'       => true,
                'after'     => 'name'
            ],
            'parking_type_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true,
                'after'     => 'description'
            ],
            'apartment_type_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true,
                'after'     => 'parking_type_id'
            ],
        ]);
    }

    public function down()
    {
        // Re-add removed columns in case of rollback
        $this->forge->addColumn('apartments', [
            'id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'apartment_no' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'unique'     => true,
            ],
            'apartment_name' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'address' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'block' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
            ],
            'type' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
            ],
            'occupancy' => [
                'type'       => 'ENUM',
                'constraint' => ['vacant', 'occupied'],
                'default'    => 'vacant',
            ],
        ]);

        // Remove newly added columns
        $this->forge->dropColumn('apartments', ['block_id', 'name', 'description', 'parking_type_id', 'apartment_type_id']);
    }
}
