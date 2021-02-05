<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if (empty($this->session->userdata('nip'))) {
            redirect('user/login');
        }

        //memanggil model
        $this->load->model(array('dashboard_model','petugas_model','buku_model','peminjaman_model'));
    }

    public function index()
    {
        //mengarahkan ke function read
        $this->read();
    }

    public function read()
    {
        $nip = $this->session->userdata('nama_petugas');
        $data_anggota = $this->dashboard_model->anggota();
        $data_buku = $this->dashboard_model->buku();
        $buku = $this->buku_model->read();
        $peminjaman = $this->peminjaman_model->read();
        $data_peminjaman = $this->dashboard_model->peminjaman();
        $data_pengembalian = $this->dashboard_model->pengembalian();

        $output = array(
            'judul' => 'Dashboard',
            'theme_page' => 'dashboard_read',
            'data_anggota' => $data_anggota,
            'data_buku' => $data_buku,
            'data_peminjaman' => $data_peminjaman,
            'data_pengembalian' => $data_pengembalian,
            'buku' => $buku,
            'peminjaman' => $peminjaman,
            'petugas' => $nip
        );

        $this->load->view('theme/index', $output);
    }
}