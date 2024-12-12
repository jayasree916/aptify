<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class RenameApartmentTableToApartments extends Migration
{
    public function up()
    {
        $this->forge->renameTable('apartment', 'apartments');
    }

    public function down()
    {
        $this->forge->renameTable('apartments', 'apartment');
    }
}
