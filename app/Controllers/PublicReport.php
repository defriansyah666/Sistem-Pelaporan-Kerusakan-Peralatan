<?php
namespace App\Controllers;

use App\Models\ReportModel;

class PublicReport extends BaseController
{
    public function index()
    {
        return view('public/report_form');
    }

    public function store()
    {
        $rules = [
            'nama_pelapor' => 'required|min_length[3]',
            'unit_kerja'   => 'required',
            'jenis_barang' => 'required',
            'deskripsi'    => 'required',
            'foto'         => 'uploaded[foto]|max_size[foto,5120]|is_image[foto]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $foto = $this->request->getFile('foto');
        $namaFoto = $foto->getRandomName();
        $foto->move('writable/uploads/reports', $namaFoto);

        $model = new ReportModel();
        $model->save([
            'nama_pelapor' => $this->request->getPost('nama_pelapor'),
            'unit_kerja'   => $this->request->getPost('unit_kerja'),
            'jenis_barang' => $this->request->getPost('jenis_barang'),
            'deskripsi'    => $this->request->getPost('deskripsi'),
            'foto'         => $namaFoto,
            'status'       => 'baru',
            'created_at'   => date('Y-m-d H:i:s')
        ]);

        return redirect()->to('/')->with('success', 'Laporan berhasil dikirim. Terima kasih!');
    }
}