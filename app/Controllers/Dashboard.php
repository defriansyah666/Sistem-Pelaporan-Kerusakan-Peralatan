<?php
namespace App\Controllers;

class Dashboard extends BaseController
{
    public function index()
    {
        $data['title'] = 'Dashboard';
        $data['reports'] = model('ReportModel')->orderBy('created_at', 'DESC')->findAll(20);
        return view('dashboard/index', $data);
    }
}