<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penerbit extends CI_Controller {

    public function __construct(){
        parent::__construct();

        if (empty($this->session->userdata('nip'))) {
            redirect('user/login');
        }

        $this->load->model('penerbit_model');
    }

    public function datatables()
    {
        //menunda loading (bisa dihapus, hanya untuk menampilkan pesan processing)
        sleep(2);

        //memanggil fungsi model datatables
        $list = $this->penerbit_model->get_datatables();
        $data = array();
        $no   = $this->input->post('start');

        //mencetak data json
        foreach ($list as $field) {
            $no++;
            $row   = array();
            $row[] = $field['id_penerbit'];
            $row[] = $field['nama_penerbit'];
            $row[] = '
                    <a href="' . site_url('kategori/update/' . $field['id_penerbit']) . '" class="btn btn-warning btn-sm" title="edit">
                        <i class="fas fa-pencil-alt"></i>
                    </a>
                    <a href="' . site_url('kategori/delete/' . $field['id_penerbit']) . '" class="btn btn-danger btn-sm hapus" title="hapus">
                        <i class="fas fa-trash-alt"></i>
                    </a>';

            $data[] = $row;
        }

        //mengirim data json
        $output = array(
            "draw"            => $this->input->post('draw'),
            "recordsTotal"    => $this->penerbit_model->count_all(),
            "recordsFiltered" => $this->penerbit_model->count_filtered(),
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
        $data_penerbit = $this->penerbit_model->read();

        $output = array(
                        'theme_page' =>'penerbit/penerbit_read',
                        'judul' => 'Daftar Penerbit Buku',
                        'data_penerbit' => $data_penerbit,
                        'petugas' => $nip
                    );

        $this->load->view('theme/index', $output);
    }

    public function insert(){
        $nip = $this->session->userdata('nama_petugas');
        $output = array(
                        'theme_page' =>'penerbit/penerbit_insert',
                        'judul' => 'Tambah Data Penerbit',
                        'petugas' => $nip
                    );
        
        $this->load->view('theme/index', $output);
    }

    public function insert_submit(){


        if($this->input->post('submit') == 'Simpan'){

            $this->form_validation->set_rules('penerbit', 'Penerbit','required');

            if($this->form_validation->run() == TRUE){
                
                $penerbit = $this->input->post('penerbit');
                $input = array(
                                'nama_penerbit' => $penerbit
                            );
                
                $data_penerbit = $this->penerbit_model->insert($input);

                $this->session->set_tempdata('message', 'Sukses, Data Berhasil Ditambahkan', 3);
                redirect('penerbit/read');
                
            }
        }
    }

    public function update(){
        $nip = $this->session->userdata('nama_petugas');
        $id = $this->uri->segment(3);

        $data_penerbit_single = $this->penerbit_model->read_single($id);

        $output = array(
                        'theme_page' => 'penerbit/penerbit_update',
                        'judul' => 'Ubah Data Penerbit',
                        'data_penerbit_single' => $data_penerbit_single,
                        'petugas' => $nip
                    );

        $this->load->view('theme/index',$output);
    }

    public function update_submit(){
        $id = $this->uri->segment(3);
    
        if($this->input->post('submit') == 'Simpan'){

            $this->form_validation->set_rules('penerbit', 'Penerbit','required');

            if($this->form_validation->run() == TRUE){
                
                $penerbit = $this->input->post('penerbit');
                $input = array(
                                'nama_penerbit' => $penerbit
                            );
                
                $data_penerbit = $this->penerbit_model->update($input,$id);

                $this->session->set_tempdata('message', 'Sukses, Data Berhasil Diubah', 3);
                redirect('penerbit/read');
                
            }
        }

    }

    public function delete(){
        $id = $this->uri->segment(3);

        $data_penerbit = $this->penerbit_model->delete($id);
        $this->session->set_tempdata('message', 'Sukses, Data Berhasil Dihapus', 3);

        redirect('penerbit/read');
    }

}
