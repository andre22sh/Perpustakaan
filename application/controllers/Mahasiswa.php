<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mahasiswa extends CI_Controller {

    public function __construct(){
        parent::__construct();

        if (empty($this->session->userdata('nip'))) {
            redirect('user/login');
        }

        $this->load->model('mahasiswa_model');
    }

    public function datatables()
    {
        //menunda loading (bisa dihapus, hanya untuk menampilkan pesan processing)
        sleep(1);

        //memanggil fungsi model datatables
        $list = $this->mahasiswa_model->get_datatables();
        $data = array();
        $no   = $this->input->post('start');

        //mencetak data json
        foreach ($list as $field) {
            $no++;
            $row   = array();
            $row[] = $field['nim'];
            $row[] = $field['nama_mhs'];
            $row[] = $field['prodi_mhs'];
            $row[] = $field['alamat_mhs'];
            $row[] = $field['notelp_mhs'];
            $row[] = '
                    <a href="' . site_url('mahasiswa/update/' . $field['nim']) . '" class="btn btn-warning btn-sm" title="edit">
                        <i class="fas fa-pencil-alt"></i>
                    </a>
                    <a href="' . site_url('mahasiswa/delete/' . $field['nim']) . '" class="btn btn-danger btn-sm hapus" title="hapus">
                        <i class="fas fa-trash-alt"></i>
                    </a>';

            $data[] = $row;
        }

        //mengirim data json
        $output = array(
            "draw"            => $this->input->post('draw'),
            "recordsTotal"    => $this->mahasiswa_model->count_all(),
            "recordsFiltered" => $this->mahasiswa_model->count_filtered(),
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
        $data_mahasiswa = $this->mahasiswa_model->read();

        $output = array(
                        'theme_page' =>'mahasiswa/mahasiswa_read',
                        'judul' => 'Daftar Anggota',
                        'data_mahasiswa' => $data_mahasiswa,
                        'petugas' => $nip
                    );

        $this->load->view('theme/index', $output);
    }

    public function insert(){
        $nip = $this->session->userdata('nama_petugas');

        $output = array(
                        'theme_page' =>'mahasiswa/mahasiswa_insert',
                        'judul' => 'Tambah Data Anggota',
                        'petugas' => $nip
                    );        
        
        $this->load->view('theme/index', $output);
    }

    public function insert_submit(){

        if($this->input->post('submit') == 'Simpan'){

            $this->form_validation->set_rules('nim', 'NIM','required');
            $this->form_validation->set_rules('nama_mhs', 'Nama Mahasiswa','required');
            $this->form_validation->set_rules('alamat_mhs', 'Alamat','required');
            $this->form_validation->set_rules('jurusan_mhs', 'Jurusan','required');
            $this->form_validation->set_rules('notelp_mhs', 'No.Telp','required');

            if($this->form_validation->run() == TRUE){
                
                $nim = $this->input->post('nim');
                $nama = $this->input->post('nama_mhs');
                $alamat = $this->input->post('alamat_mhs');
                $jurusan = $this->input->post('jurusan_mhs');
                $notelp = $this->input->post('notelp_mhs');

                $input = array(
                                'nim' => $nim,
                                'nama_mhs' => $nama,
                                'alamat_mhs' => $alamat,
                                'prodi_mhs' => $jurusan,
                                'notelp_mhs' => $notelp
                );

                $data_mahasiswa = $this->mahasiswa_model->insert($input);

                $this->session->set_tempdata('message', 'Sukses, Data Berhasil Ditambahkan', 3);
                redirect('mahasiswa/read');
                
            }
        }
    }

    public function update(){
        $nip = $this->session->userdata('nama_petugas');
        $nim = $this->uri->segment(3);

        $data_mahasiswa_single = $this->mahasiswa_model->read_single($nim);

        $output = array(
                        'theme_page' => 'mahasiswa/mahasiswa_update',
                        'judul' => 'Ubah Data Anggota',
                        'data_mahasiswa_single' => $data_mahasiswa_single,
                        'petugas' => $nip
                    );

        $this->load->view('theme/index',$output);
    }

    public function update_submit(){
        $nim = $this->uri->segment(3);

        if($this->input->post('submit') == 'Simpan'){

            $this->form_validation->set_rules('nim', 'NIM','required');
            $this->form_validation->set_rules('nama_mhs', 'Nama Mahasiswa','required');
            $this->form_validation->set_rules('alamat_mhs', 'Alamat','required');
            $this->form_validation->set_rules('jurusan_mhs', 'Jurusan','required');
            $this->form_validation->set_rules('notelp_mhs', 'No.Telp','required');

            if($this->form_validation->run() == TRUE){
                
                $nim = $this->input->post('nim');
                $nama = $this->input->post('nama_mhs');
                $alamat = $this->input->post('alamat_mhs');
                $jurusan = $this->input->post('jurusan_mhs');
                $notelp = $this->input->post('notelp_mhs');

                $input = array(
                                'nim' => $nim,
                                'nama_mhs' => $nama,
                                'alamat_mhs' => $alamat,
                                'prodi_mhs' => $jurusan,
                                'notelp_mhs' => $notelp
                );

                $data_mahasiswa = $this->mahasiswa_model->update($input,$nim);

                $this->session->set_tempdata('message', 'Sukses, Data Berhasil Diubah', 3);
                redirect('mahasiswa/read');
                
            }
        }

    }

    public function delete(){
        $nim = $this->uri->segment(3);

        $data_mahasiswa = $this->mahasiswa_model->delete($nim);
        $this->session->set_tempdata('message', 'Sukses, Data Berhasil Dihapus', 3);

        redirect('mahasiswa/read');
    }

    public function export(){
        $data_mahasiswa = $this->mahasiswa_model->read();

		//mengirim data ke view
		$output = array(
						'judul' => 'Daftar Anggota Perpustakaan',

						//data provinsi dikirim ke view
						'data_mahasiswa' => $data_mahasiswa
					);

		//memanggil file view
		$this->load->view('mahasiswa/mahasiswa_export', $output);
    }
}
