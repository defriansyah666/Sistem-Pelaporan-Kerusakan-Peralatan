<?php
namespace App\Models;

use CodeIgniter\Model;

class ReportModel extends Model
{
    protected $table = 'reports';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama_pelapor','unit_kerja','jenis_barang','deskripsi','foto','status'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
}