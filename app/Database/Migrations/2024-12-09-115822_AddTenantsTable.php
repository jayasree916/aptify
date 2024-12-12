<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddTenantsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'tenant_name' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null' => false,
            ],
            'address' => [
                'type' => 'TEXT',
            ],
            'contact_number' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
            ],
            'apartment_id' => [
                'type'       => 'INT',
                'unsigned'   => true,
                'null' => false,
            ],
            'from_date' => [
                'type' => 'DATE',
            ],
            'to_date' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'remarks' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'created_by' => [
                'type'       => 'INT',
                'unsigned'   => true,
            ],
            'created_at' => [
                'type'    => 'DATETIME',
                'null'    => true,
            ],
            'updated_by' => [
                'type'       => 'INT',
                'unsigned'   => true,
                'null'       => true,
            ],
            'updated_at' => [
                'type'    => 'DATETIME',
                'null'    => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('apartment_id', 'apartments', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('tenants');
    }

    public function down()
    {
        $this->forge->dropTable('tenants');
    }
}
