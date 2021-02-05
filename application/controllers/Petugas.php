<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Petugas extends CI_Controller {
    public function __construct(){
        parent::__construct();

        if (empty($this->session->userdata('nip'))) {
            redirect('user/login');
        }
    
        $this->load->model('petugas_model');
    }
    //fungsi menampilkan data dalam bentuk json
    public function datatables()
    {
        //menunda loading (bisa dihapus, hanya untuk menampilkan pesan processing)
        sleep(1);

        //memanggil fungsi model datatables
        $list = $this->petugas_model->get_datatables();
        $data = array();
        $no   = $this->input->post('start');

        //mencetak data json
        foreach ($list as $field) {
            $no++;
            $row   = array();
            $row[] = $field['nip'];
            $row[] = $field['nama_petugas'];
            $row[] = $field['alamat_petugas'];
            $row[] = $field['notelp_petugas'];
            $row[] = '
                    <a href="' . site_url('petugas/update/' . $field['nip']) . '" class="btn btn-warning btn-sm" title="edit">
                        <i class="fas fa-pencil-alt"></i>
                    </a>
                    <a href="' . site_url('petugas/delete/' . $field['nip']) . '" class="btn btn-danger btn-sm hapus" title="hapus">
                        <i class="fas fa-trash-alt"></i>
                    </a>';

            $data[] = $row;
        }

        //mengirim data json
        $output = array(
            "draw"            => $this->input->post('draw'),
            "recordsTotal"    => $this->petugas_model->count_all(),
            "recordsFiltered" => $this->petugas_model->count_filtered(),
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
        $data_petugas = $this->petugas_model->read();

        $output = array(
                        'theme_page' =>'petugas/petugas_read',
                        'judul' => 'Daftar Petugas',
                        'data_petugas' => $data_petugas,
                        'petugas' => $nip
                    );

        $this->load->view('theme/index', $output);
    }

    public function insert(){
        $nip = $this->session->userdata('nama_petugas');
        $output = array(
                        'theme_page' =>'petugas/petugas_insert',
                        'judul' => 'Tambah Data Petugas',
                        'petugas' => $nip
                    );
        
        $this->load->view('theme/index', $output);
    }

    public function insert_submit(){

        // $nip = $this->input->post('nip');
        // $nama = $this->input->post('nama_petugas');
        // $alamat = $this->input->post('alamat_petugas');
        // $notelp = $this->input->post('notelp_petugas');
        // $password = $this->input->post('password');

        // $password = md5($password);
    
        // $input = array(
        //                 'nip' => $nip,
        //                 'nama_petugas' => $nama,
        //                 'alamat_petugas' => $alamat,
        //                 'notelp_petugas' => $notelp,
        //                 'password' => $password,
        //             );
        
        // $data_petugas = $this->petugas_model->insert($input);

        // redirect('petugas/read');

        if($this->input->post('submit') == 'Simpan'){

            $this->form_validation->set_rules('nip', 'NIP','required');
            $this->form_validation->set_rules('nama_petugas', 'Nama Petugas','required');
            $this->form_validation->set_rules('alamat_petugas', 'Alamat Petugas','required');
            $this->form_validation->set_rules('notelp_petugas', 'No Telpon','required');
            $this->form_validation->set_rules('password', 'Password','required');

            if($this->form_validation->run() == TRUE){
                
                $nip = $this->input->post('nip');
                $nama = $this->input->post('nama_petugas');
                $alamat = $this->input->post('alamat_petugas');
                $notelp = $this->input->post('notelp_petugas');
                $password = $this->input->post('password');

                $password = md5($password);

                $input = array(
                                'nip' => $nip,
                                'nama_petugas' => $nama,
                                'alamat_petugas' => $alamat,
                                'notelp_petugas' => $notelp,
                                'password' => $password,
                            );

                $data_petugas = $this->petugas_model->insert($input);

                $this->session->set_tempdata('message', 'Sukses, Data Berhasil Ditambahkan', 3);
                redirect('petugas/read');
                
            }
        }
    }

    public function update(){
        $nip = $this->uri->segment(3);

        $nip1 = $this->session->userdata('nama_petugas');

        $data_petugas_single = $this->petugas_model->read_single($nip);

        $output = array(
                        'theme_page' => 'petugas/petugas_update',
                        'judul' => 'Ubah Data Petugas',
                        'data_petugas_single' => $data_petugas_single,
                        'petugas' => $nip1
                    );

        $this->load->view('theme/index',$output);
    }

    public function update_submit(){
        $nip = $this->uri->segment(3);

        if($this->input->post('submit') == 'Simpan'){

            $this->form_validation->set_rules('nip', 'NIP','required');
            $this->form_validation->set_rules('nama_petugas', 'Nama Petugas','required');
            $this->form_validation->set_rules('alamat_petugas', 'Alamat Petugas','required');
            $this->form_validation->set_rules('notelp_petugas', 'No Telpon','required');


            if($this->form_validation->run() == TRUE){
                
                $nip = $this->input->post('nip');
                $nama = $this->input->post('nama_petugas');
                $alamat = $this->input->post('alamat_petugas');
                $notelp = $this->input->post('notelp_petugas');

                $password = md5($password);

                $input = array(
                                'nip' => $nip,
                                'nama_petugas' => $nama,
                                'alamat_petugas' => $alamat,
                                'notelp_petugas' => $notelp,
                            );

                $data_petugas = $this->petugas_model->update($input, $nip);

                $this->session->set_tempdata('message', 'Sukses, Data Berhasil Diubah', 3);
                
                redirect('petugas/read');
                
            }
        }

    }

    public function delete(){
        $nip = $this->uri->segment(3);

        $data_petugas = $this->petugas_model->delete($nip);
        $this->session->set_tempdata('message', 'Sukses, Data Berhasil Dihapus', 3);
        redirect('petugas/read');
    }

    public function export(){
        $data_petugas = $this->petugas_model->read();

		//mengirim data ke view
		$output = array(
						'judul' => 'Daftar Petugas',

						//data provinsi dikirim ke view
						'data_petugas' => $data_petugas
					);

		//memanggil file view
		$this->load->view('petugas/petugas_export', $output);
    }

}