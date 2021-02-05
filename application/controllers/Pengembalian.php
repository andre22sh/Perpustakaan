<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengembalian extends CI_Controller{

    public function __construct(){
        parent::__construct();

        if (empty($this->session->userdata('nip'))) {
            redirect('user/login');
        }

        $this->load->model(array('peminjaman_model','mahasiswa_model','petugas_model','buku_model','pengembalian_model'));
    }
    //fungsi menampilkan data dalam bentuk json
    public function datatables()
    {
        //menunda loading (bisa dihapus, hanya untuk menampilkan pesan processing)
        sleep(2);

        //memanggil fungsi model datatables
        $list = $this->pengembalian_model->get_datatables();
        $data = array();
        

        //mencetak data json
        foreach ($list as $field) {
            $row   = array();
            $row[] = $field['id_pengembalian'];
            $row[] = $field['nama_mhs'];
            $row[] = $field['nama_buku'];
            $row[] = $field['batas_peminjaman'];
            $row[] = $field['tgl_pengembalian'];
            $row[] = $field['jumlah_pengembalian'];
            $row[] = $field['denda_telat'];
            $row[] = $field['denda_hilang'];
            $row[] = $field['denda_rusak'];
            $row[] = $field['total_denda'];
            $row[] = '
                    <a href="' . site_url('pengembalian/update/' . $field['id_pengembalian']) . '" class="btn btn-warning btn-sm" title="edit">
                        <i class="fas fa-pencil-alt"></i>
                    </a>
                    <a href="' . site_url('pengembalian/delete/' . $field['id_pengembalian']) . '" class="btn btn-danger btn-sm hapus" title="hapus">
                        <i class="fas fa-trash-alt"></i>
                    </a>';

            $data[] = $row;
        }

        //mengirim data json
        $output = array(
            "draw"            => $this->input->post('draw'),
            "recordsTotal"    => $this->pengembalian_model->count_all(),
            "recordsFiltered" => $this->pengembalian_model->count_filtered(),
            "data"            => $data,
        );

        //output dalam format JSON
        echo json_encode($output);
    }

    public function index(){
        
        $this->read();
    }

    public function read(){
        $nip = $this->session->userdata('nama_petugas');

        $data_pengembalian = $this->pengembalian_model->read();

        $output = array(
                        'theme_page' => 'pengembalian/pengembalian_read',
                        'judul' => 'Daftar Pengembalian Buku',
                        'data_pengembalian' => $data_pengembalian,
                        'petugas' => $nip
                    );

        $this->load->view('theme/index', $output);
    }

    public function insert(){
        $nip = $this->session->userdata('nama_petugas');
        $data_peminjaman = $this->peminjaman_model->read();
        $data_buku = $this->buku_model->read();

        $output = array(
                        'theme_page' => 'pengembalian/pengembalian_insert',
                        'judul' => 'Tambah Data Pengembalian',
                        'data_peminjaman' => $data_peminjaman,
                        'data_buku' => $data_buku,
                        'petugas' => $nip
                    );

        $this->load->view('theme/index', $output);
    }

    public function insert_submit(){

       
                
                $id_peminjaman = $this->input->post('id_peminjaman');
                $buku = $this->input->post('buku');
                $tgl_pengembalian = $this->input->post('tgl_pengembalian');
                $jumlah_pengembalian = $this->input->post('jumlah_pengembalian');
                $telat = $this->input->post('denda_telat');
                $hilang = $this->input->post('denda_hilang');
                $rusak = $this->input->post('denda_rusak');

                $input = array(
                                'id_peminjaman' => $id_peminjaman,
                                'id_buku' => $buku,
                                'tgl_pengembalian' => $tgl_pengembalian,
                                'jumlah_pengembalian' => $jumlah_pengembalian,
                                'denda_telat' => $telat,
                                'denda_hilang' => $hilang,
                                'denda_rusak' => $rusak
                            );
                
                $data_pengembalian = $this->pengembalian_model->insert($input);

                $this->session->set_tempdata('message', 'Sukses, Data Berhasil Ditambahkan', 3);
                redirect('pengembalian/read');
                  
    }

    public function update(){

        $nip = $this->session->userdata('nama_petugas');
        $id = $this->uri->segment(3);

        $data_pengembalian_single = $this->pengembalian_model->read_single($id);
        $data_peminjaman = $this->peminjaman_model->read();
        $data_buku = $this->buku_model->read();

        $output = array(
                        'theme_page' => 'pengembalian/pengembalian_update',
                        'judul' => 'Ubah Data Pengembalian',
                        'data_pengembalian_single' => $data_pengembalian_single,
                        'data_peminjaman' => $data_peminjaman,
                        'data_buku' => $data_buku,
                        'petugas' => $nip
        
                    );

        $this->load->view('theme/index', $output);
    }

    public function update_submit(){

        $id = $this->uri->segment(3);

       
                
                $id_peminjaman = $this->input->post('id_peminjaman');
                $buku = $this->input->post('buku');
                $tgl_pengembalian = $this->input->post('tgl_pengembalian');
                $jumlah_pengembalian = $this->input->post('jumlah_pengembalian');
                $telat = $this->input->post('denda_telat');
                $hilang = $this->input->post('denda_hilang');
                $rusak = $this->input->post('denda_rusak');

                $input = array(
                                'id_peminjaman' => $id_peminjaman,
                                'id_buku' => $buku,
                                'tgl_pengembalian' => $tgl_pengembalian,
                                'jumlah_pengembalian' => $jumlah_pengembalian,
                                'denda_telat' => $telat,
                                'denda_hilang' => $hilang,
                                'denda_rusak' => $rusak
                            );
                
                $data_pengembalian = $this->pengembalian_model->update($input,$id);

                $this->session->set_tempdata('message', 'Sukses, Data Berhasil Diubah', 3);
                redirect('pengembalian/read');
                
            
        
    }

    public function delete(){

        $id = $this->uri->segment(3);

        $data_pengembalian = $this->pengembalian_model->delete($id);
        $this->session->set_tempdata('message', 'Sukses, Data Berhasil Dihapus', 3);


        redirect('pengembalian/read');
    }

    public function export(){

        $data_pengembalian = $this->pengembalian_model->read();

		//mengirim data ke view
		$output = array(
						'judul' => 'Daftar Transaksi Pengembalian',

						//data provinsi dikirim ke view
						'data_pengembalian' => $data_pengembalian
					);

		//memanggil file view
		$this->load->view('pengembalian/pengembalian_export', $output);
    
    }
}