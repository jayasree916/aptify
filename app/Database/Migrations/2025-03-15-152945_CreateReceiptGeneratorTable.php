<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateReceiptGeneratorTable extends Migration
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
            'year' => [
                'type'       => 'YEAR',
                'null'       => false,
            ],
            'receipt_group' => [
                'type'       => 'SMALLINT',
                'constraint' => 5,
                'unsigned'   => true,
                'null'       => false,
            ],
            'last_receipt_no' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => false,
                'default'    => 0,
            ],
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->addUniqueKey(['year', 'receipt_group']); // Ensures unique records for each year-group combination
        $this->forge->createTable('receipt_generator', true);
    }

    public function down()
    {
        $this->forge->dropTable('receipt_generator', true);
    }
}
