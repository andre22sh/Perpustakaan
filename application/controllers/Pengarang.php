<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengarang extends CI_Controller {

    public function __construct(){
        parent::__construct();

        if (empty($this->session->userdata('nip'))) {
            redirect('user/login');
        }

        $this->load->model('pengarang_model');
    }

    public function datatables()
    {
        //menunda loading (bisa dihapus, hanya untuk menampilkan pesan processing)
        sleep(2);

        //memanggil fungsi model datatables
        $list = $this->pengarang_model->get_datatables();
        $data = array();
        $no   = $this->input->post('start');

        //mencetak data json
        foreach ($list as $field) {
            $no++;
            $row   = array();
            $row[] = $field['id_pengarang'];
            $row[] = $field['nama_pengarang'];
            $row[] = '
                    <a href="' . site_url('pengarang/update/' . $field['id_pengarang']) . '" class="btn btn-warning btn-sm" title="edit">
                        <i class="fas fa-pencil-alt"></i>
                    </a>
                    <a href="' . site_url('pengarang/delete/' . $field['id_pengarang']) . '" class="btn btn-danger btn-sm hapus" title="hapus">
                        <i class="fas fa-trash-alt"></i>
                    </a>';

            $data[] = $row;
        }

        //mengirim data json
        $output = array(
            "draw"            => $this->input->post('draw'),
            "recordsTotal"    => $this->pengarang_model->count_all(),
            "recordsFiltered" => $this->pengarang_model->count_filtered(),
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
        $data_pengarang = $this->pengarang_model->read();

        $output = array(
                        'theme_page' =>'pengarang/pengarang_read',
                        'judul' => 'Daftar Pengarang Buku',
                        'data_pengarang' => $data_pengarang,
                        'petugas' => $nip
                    );

        $this->load->view('theme/index', $output);
    }

    public function insert(){
        $nip = $this->session->userdata('nama_petugas');
        $output = array(
                        'theme_page' =>'pengarang/pengarang_insert',
                        'judul' => 'Tambah Data Pengarang',
                        'petugas' => $nip
                    );
        
        $this->load->view('theme/index', $output);
    }

    public function insert_submit(){
        // $pengarang = $this->input->post('pengarang');
        // $input = array(
        //                 'nama_kategori' => $pengarang
        //             );
        
        // $data_pengarang = $this->pengarang_model->insert($input);

        // redirect('pengarang/read');

        if($this->input->post('submit') == 'Simpan'){

            $this->form_validation->set_rules('pengarang', 'pengarang', 'required');

            if($this->form_validation->run() == TRUE){
                
                $pengarang = $this->input->post('pengarang');
                $input = array(
                                'nama_pengarang' => $pengarang
                            );

                $data_pengarang = $this->pengarang_model->insert($input);

                $this->session->set_tempdata('message', 'Sukses, Data Berhasil Ditambahkan', 3);
                redirect('pengarang/read');
                
            }
        }
    }

    public function update(){
        $nip = $this->session->userdata('nama_petugas');
        $id = $this->uri->segment(3);

        $data_pengarang_single = $this->pengarang_model->read_single($id);

        $output = array(
                        'theme_page' => 'pengarang/pengarang_update',
                        'judul' => 'Ubah Data Pengarang',
                        'data_pengarang_single' => $data_pengarang_single,
                        'petugas' => $nip
                    );

        $this->load->view('theme/index',$output);
    }

    public function update_submit(){
        $id = $this->uri->segment(3);
    
        if($this->input->post('submit') == 'Simpan'){

            $this->form_validation->set_rules('pengarang', 'pengarang', 'required');

            if($this->form_validation->run() == TRUE){
                
                $pengarang = $this->input->post('pengarang');
                $input = array(
                                'nama_pengarang' => $pengarang
                            );

                $data_pengarang = $this->pengarang_model->update($input,$id);

                $this->session->set_tempdata('message', 'Sukses, Data Berhasil Diubah', 3);
                redirect('pengarang/read');
                
            }
        }

    }

    public function delete(){
        $id = $this->uri->segment(3);

        $data_pengarang = $this->pengarang_model->delete($id);
        $this->session->set_tempdata('message', 'Sukses, Data Berhasil Dihapus', 3);

        redirect('pengarang/read');
    }

}
