<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterCollections extends Migration
{
    public function up()
    {
        $fields = [
            'bill_id' => [
                'type' => 'INT',
                'constraint' => 10,   // Define the length for the contact number
                'null' => false,       // Allow NULL values
                'after' => 'date', // Position the new column after `owner_name`
            ],
            'bill_no' => [
                'type' => 'VARCHAR',
                'constraint' => 20,   // Define the length for the contact number
                'null' => false,       // Allow NULL values
                'after' => 'bill_id', // Position the new column after `owner_name`
            ],
        ];
        $this->forge->addColumn('collections', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('collections', 'bill_id');
        $this->forge->dropColumn('collections', 'bill_no');
    }
}
