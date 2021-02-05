<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Peminjaman extends CI_Controller{

     public function datatables()
    {
        //menunda loading (bisa dihapus, hanya untuk menampilkan pesan processing)
        sleep(2);

        //memanggil fungsi model datatables
        $list = $this->peminjaman_model->get_datatables();
        $data = array();
        $no   = $this->input->post('start');

        //mencetak data json
        foreach ($list as $field) {
            $no++;
            $row   = array();
            $row[] = $field['id_peminjaman'];
            $row[] = $field['nama_mhs'];
            $row[] = $field['nama_petugas'];
            $row[] = $field['nama_buku'];
            $row[] = $field['jumlah_peminjaman'];
            $row[] = $field['tgl_peminjaman'];
            $row[] = $field['batas_peminjaman'];
            $row[] = $field['status'];
            $row[] = '
                    <a href="' . site_url('peminjaman/update/' . $field['id_peminjaman']) . '" class="btn btn-warning btn-sm" title="edit">
                        <i class="fas fa-pencil-alt"></i>
                    </a>
                    <a href="' . site_url('peminjaman/delete/' . $field['id_peminjaman']) . '" class="btn btn-danger btn-sm hapus" title="hapus">
                        <i class="fas fa-trash-alt"></i>
                    </a>';

            $data[] = $row;
        }

        //mengirim data json
        $output = array(
            "draw"            => $this->input->post('draw'),
            "recordsTotal"    => $this->peminjaman_model->count_all(),
            "recordsFiltered" => $this->peminjaman_model->count_filtered(),
            "data"            => $data,
        );

        //output dalam format JSON
        echo json_encode($output);
    }

    public function __construct(){
        parent::__construct();

        if (empty($this->session->userdata('nip'))) {
            redirect('user/login');
        }

        $this->load->model(array('peminjaman_model','mahasiswa_model','petugas_model','buku_model'));
    }

    public function index(){
        
        $this->read();
    }

    public function read(){

        $nip = $this->session->userdata('nama_petugas');

        $data_peminjaman = $this->peminjaman_model->read();

        $output = array(
                        'theme_page' => 'peminjaman/peminjaman_read',
                        'judul' => 'Daftar Peminjaman Buku',
                        'data_peminjaman' => $data_peminjaman,
                        'petugas' => $nip
                    );

        $this->load->view('theme/index', $output);
    }

    public function insert(){

        $nip = $this->session->userdata('nama_petugas');
        $data_mahasiswa = $this->mahasiswa_model->read();
        $data_petugas = $this->petugas_model->read();
        $data_buku = $this->buku_model->read();
        $data_peminjaman = $this->peminjaman_model->read();

        $output = array(
                        'theme_page' => 'peminjaman/peminjaman_insert',
                        'judul' => 'Tambah Data Peminjaman',
                        'data_mahasiswa' => $data_mahasiswa,
                        'data_petugas' => $data_petugas,
                        'data_buku' => $data_buku,
                        'petugas' => $nip
        );

        $this->load->view('theme/index', $output);
    }

    public function insert_submit(){

        // $mahasiswa = $this->input->post('mahasiswa');
        // $petugas = $this->input->post('petugas');
        // $buku = $this->input->post('buku');
        // $jumlah = $this->input->post('jumlah_peminjaman');
        // $tgl_peminjaman = $this->input->post('tgl_peminjaman');
        // $batas_peminjaman = $this->input->post('batas_peminjaman');
        // $status = $this->input->post('status');

        // $input = array(
        //                 'nim' => $mahasiswa,
        //                 'nip' => $petugas,
        //                 'id_buku' => $buku,
        //                 'jumlah_peminjaman' => $jumlah,
        //                 'tgl_peminjaman' => $tgl_peminjaman,
        //                 'batas_peminjaman' => $batas_peminjaman,
        //                 'status' => $status
        //             );
        
        // $data_peminjaman = $this->peminjaman_model->insert($input);

        // redirect('peminjaman/read');

        if($this->input->post('submit') == 'Simpan'){

            $this->form_validation->set_rules('mahasiswa', 'Mahasiswa','required');
            $this->form_validation->set_rules('petugas', 'Petugas','required');
            $this->form_validation->set_rules('buku', 'Buku','required');
            $this->form_validation->set_rules('tgl_peminjaman', 'Tanggal Peminjaman','required');
            $this->form_validation->set_rules('batas_peminjaman', 'Batas Peminjaman','required');
            $this->form_validation->set_rules('status', 'Status','required');

            if($this->form_validation->run() == TRUE){
                
                $mahasiswa = $this->input->post('mahasiswa');
                $petugas = $this->input->post('petugas');
                $buku = $this->input->post('buku');
                $jumlah = $this->input->post('jumlah_peminjaman');
                $tgl_peminjaman = $this->input->post('tgl_peminjaman');
                $batas_peminjaman = $this->input->post('batas_peminjaman');
                $status = $this->input->post('status');

                $input = array(
                                    'nim' => $mahasiswa,
                                    'nip' => $petugas,
                                    'id_buku' => $buku,
                                    'jumlah_peminjaman' => $jumlah,
                                    'tgl_peminjaman' => $tgl_peminjaman,
                                    'batas_peminjaman' => $batas_peminjaman,
                                    'status' => $status
                                );

                $data_peminjaman = $this->peminjaman_model->insert($input);

                $this->session->set_tempdata('message', 'Sukses, Data Berhasil Ditambahkan', 3);
                redirect('peminjaman/read');
                
            }
        }
    }

    public function update(){

        $id = $this->uri->segment(3);

        $nip = $this->session->userdata('nama_petugas');
        $status = ['Belum Dikembalikan', 'Telah Dikembalikan'];
        $data_peminjaman_single = $this->peminjaman_model->read_single($id);
        $data_mahasiswa = $this->mahasiswa_model->read();
        $data_petugas = $this->petugas_model->read();
        $data_buku = $this->buku_model->read();

        $output = array(
                        'theme_page' => 'peminjaman/peminjaman_update',
                        'judul' => 'Ubah Data Peminjaman',
                        'data_peminjaman_single' => $data_peminjaman_single,
                        'data_mahasiswa' => $data_mahasiswa,
                        'data_petugas' => $data_petugas,
                        'data_buku' => $data_buku,
                        'status' => $status,
                        'petugas' => $nip
        
                    );

        $this->load->view('theme/index', $output);
    }

    public function update_submit(){

        $id = $this->uri->segment(3);

        if($this->input->post('submit') == 'Simpan'){

            $this->form_validation->set_rules('mahasiswa', 'Mahasiswa','required');
            $this->form_validation->set_rules('petugas', 'Petugas','required');
            $this->form_validation->set_rules('buku', 'Buku','required');
            $this->form_validation->set_rules('tgl_peminjaman', 'Tanggal Peminjaman','required');
            $this->form_validation->set_rules('batas_peminjaman', 'Batas Peminjaman','required');
            $this->form_validation->set_rules('status', 'Status','required');

            if($this->form_validation->run() == TRUE){
                
                $mahasiswa = $this->input->post('mahasiswa');
                $petugas = $this->input->post('petugas');
                $buku = $this->input->post('buku');
                $jumlah = $this->input->post('jumlah_peminjaman');
                $tgl_peminjaman = $this->input->post('tgl_peminjaman');
                $batas_peminjaman = $this->input->post('batas_peminjaman');
                $status = $this->input->post('status');

                $input = array(
                                    'nim' => $mahasiswa,
                                    'nip' => $petugas,
                                    'id_buku' => $buku,
                                    'jumlah_peminjaman' => $jumlah,
                                    'tgl_peminjaman' => $tgl_peminjaman,
                                    'batas_peminjaman' => $batas_peminjaman,
                                    'status' => $status
                                );

                $data_peminjaman = $this->peminjaman_model->update($input, $id);

                $this->session->set_tempdata('message', 'Sukses, Data Berhasil Diubah', 3);
                redirect('peminjaman/read');
                
            }
        }
    }

    public function delete(){

        $id = $this->uri->segment(3);

        $data_peminjaman = $this->peminjaman_model->delete($id);
        $this->session->set_tempdata('message', 'Sukses, Data Berhasil Dihapus', 3);

        redirect('peminjaman/read');
    }

    public function export(){

        $data_peminjaman = $this->peminjaman_model->read();

		//mengirim data ke view
		$output = array(
						'judul' => 'Daftar Transaksi Peminjaman',

						//data provinsi dikirim ke view
						'data_peminjaman' => $data_peminjaman
					);

		//memanggil file view
		$this->load->view('peminjaman/peminjaman_export', $output);
    
    }
}