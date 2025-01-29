<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterCollections extends Migration
{
    public function up()
    {
        $fields = [
            'apartment_id' => [
                'type' => 'INT',
                'constraint' => 10,   // Define the length for the contact number
                'null' => false,       // Allow NULL values
                'after' => 'amount', // Position the new column after `amount`
            ],
            'billing_item' => [
                'type' => 'VARCHAR',
                'constraint' => 225,   // Define the length for the contact number
                'null' => false,       // Allow NULL values
                'after' => 'billing_type', // Position the new column after `billing_type`
            ],
        ];
        $this->forge->addColumn('collections', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('collections', 'apartment_id');
        $this->forge->dropColumn('collections', 'billing_item');
    }
}
