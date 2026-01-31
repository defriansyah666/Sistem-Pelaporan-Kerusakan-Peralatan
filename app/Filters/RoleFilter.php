<?php
namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class RoleFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Pastikan session aktif
        helper('session');

        $userRole = session('role'); // Ambil role user

        // Jika tidak ada role, langsung tolak
        if (!$userRole) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Role tidak ditemukan.');
        }

        // Ambil role yang diizinkan dari arguments
        $allowedRoles = $arguments ?? [];

        // Jika arguments adalah string, pecah menjadi array
        if (!is_array($allowedRoles)) {
            $allowedRoles = explode(',', $allowedRoles);
        }

        // Cek apakah user memiliki role yang diizinkan
        if (!in_array($userRole, $allowedRoles)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Akses ditolak.');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
    }
}
