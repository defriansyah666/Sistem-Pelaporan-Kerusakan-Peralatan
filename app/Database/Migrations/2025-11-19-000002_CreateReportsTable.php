<?php
namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateReportsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'            => ['type' => 'INT', 'unsigned' => true, 'auto_increment' => true],
            'nama_pelapor'  => ['type' => 'VARCHAR', 'constraint' => 100],
            'unit_kerja'    => ['type' => 'VARCHAR', 'constraint' => 100],
            'jenis_barang'  => ['type' => 'VARCHAR', 'constraint' => 100],
            'deskripsi'     => ['type' => 'TEXT'],
            'foto'          => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'status'        => ['type' => 'ENUM("baru","diproses","estimasi","disetujui","ditolak","selesai")', 'default' => 'baru'],
            'created_at'    => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('reports');
    }

    public function down()
    {
        $this->forge->dropTable('reports');
    }
}