<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateBillItemsTable extends Migration
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
            'bill_id' => [
                'type'       => 'INT',
                'constraint' => 10,
                'unsigned'   => true,
                'null'       => false,
            ],
            'bill_type_id' => [
                'type'       => 'INT',
                'constraint' => 10,
                'unsigned'   => true,
                'null'       => false,
                'comment'    => 'Foreign key referencing billing_types table',
            ],
            'item_name' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => false,
                'comment'    => 'Name of the item or service',
            ],
            'amount' => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2',
                'null'       => false,
                'comment'    => 'Amount for this specific charge',
            ],
        ]);

        // Define primary key
        $this->forge->addKey('id', true);

        // Define foreign keys
        $this->forge->addForeignKey('bill_id', 'bills', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('bill_type_id', 'billing_types', 'id', 'CASCADE', 'CASCADE');

        // Create the table
        $this->forge->createTable('bill_items');
    }

    public function down()
    {
        $this->forge->dropTable('bill_items');
    }
}
