<?php
namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateItEstimationsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'               => ['type' => 'INT', 'unsigned' => true, 'auto_increment' => true],
            'report_id'        => ['type' => 'INT', 'unsigned' => true],
            'estimasi_biaya'   => ['type' => 'DECIMAL', 'constraint' => '15,2', 'null' => true],
            'estimasi_waktu'   => ['type' => 'VARCHAR', 'constraint' => 50, 'null' => true],
            'catatan_it'       => ['type' => 'TEXT', 'null' => true],
            'created_at'       => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('report_id', 'reports', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('it_estimations');
    }

    public function down()
    {
        $this->forge->dropTable('it_estimations');
    }
}