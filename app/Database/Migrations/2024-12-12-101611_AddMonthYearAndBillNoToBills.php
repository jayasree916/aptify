<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddMonthYearAndBillNoToBills extends Migration
{
    public function up()
    {
        $this->forge->addColumn('bills', [
            'year' => [
                'type'       => 'SMALLINT',
                'constraint' => 4,
                'unsigned'   => true,
                'null'       => false,
                'after'      => 'tenant_id',
                'comment'    => 'Year of the bill',
            ],
            'month' => [
                'type'       => 'TINYINT',
                'constraint' => 2,
                'unsigned'   => true,
                'null'       => false,
                'after'      => 'year',
                'comment'    => 'Month of the bill (1-12)',
            ],
            'bill_no' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
                'null'       => false,
                'unique'     => true,
                'after'      => 'month',
                'comment'    => 'Unique Bill Number',
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('bills', ['year', 'month', 'bill_no']);
    }
}
