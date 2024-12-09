<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Apartment extends Migration
{
    public function up()
    {
        $this->forge->addField([
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
            'created_by' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true,
            ],
            'created_at' => [
                'type'    => 'DATETIME',
                'null'    => true,
            ],
            'updated_by' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true,
            ],
            'updated_at' => [
                'type'    => 'DATETIME',
                'null'    => true,
            ],
        ]);

        // Adding Primary Key
        $this->forge->addKey('id', true);

        // Create the table
        $this->forge->createTable('apartment');

        // Add foreign key constraint to created_by
        $this->db->query('
            ALTER TABLE apartment
            ADD CONSTRAINT fk_apartment_created_by FOREIGN KEY (created_by) REFERENCES users(id) ON DELETE SET NULL
        ');
        // Add foreign key constraint to updated_by
        $this->db->query('
        ALTER TABLE apartment
        ADD CONSTRAINT fk_apartment_updated_by FOREIGN KEY (updated_by) REFERENCES users(id) ON DELETE SET NULL
    ');
    }

    public function down()
    {
        $this->forge->dropTable('apartment');
    }
}
