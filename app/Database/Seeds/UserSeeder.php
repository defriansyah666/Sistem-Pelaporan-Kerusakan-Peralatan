<?php
namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'username'     => 'admin',
                'nama_lengkap' => 'Administrator PA Lubuksikaping',
                'role'         => 'admin',
                'password'     => password_hash('admin123', PASSWORD_DEFAULT),
                'created_at'   => date('Y-m-d H:i:s'),
            ],
            [
                'username'     => 'it',
                'nama_lengkap' => 'Tim IT PA Lubuksikaping',
                'role'         => 'it',
                'password'     => password_hash('it123', PASSWORD_DEFAULT),
                'created_at'   => date('Y-m-d H:i:s'),
            ],
            [
                'username'     => 'atasan',
                'nama_lengkap' => 'Kepala Tata Usaha',
                'role'         => 'atasan',
                'password'     => password_hash('atasan123', PASSWORD_DEFAULT),
                'created_at'   => date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table('users')->insertBatch($data);
    }
}