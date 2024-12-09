<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterApartment extends Migration
{
    public function up()
    {
        $fields = [
            'apartment_name' => [
                'name' => 'owner_name', // Rename the column
                'type' => 'VARCHAR',
                'constraint' => 100,   // Define the column's properties
                'null' => false,
            ],
        ];
        $this->forge->modifyColumn('apartment', $fields);

        // Add a new column `contact_no`
        $fields = [
            'contact_no' => [
                'type' => 'VARCHAR',
                'constraint' => 15,   // Define the length for the contact number
                'null' => false,       // Allow NULL values
                'after' => 'owner_name', // Position the new column after `owner_name`
            ],
        ];
        $this->forge->addColumn('apartment', $fields);
    }

    public function down()
    {
        $fields = [
            'owner_name' => [
                'name' => 'apartment_name', // Rename back to the original name
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false,
            ],
        ];
        $this->forge->modifyColumn('apartment', $fields);

        // Remove the `contact_no` column
        $this->forge->dropColumn('apartment', 'contact_no');
    }
}
