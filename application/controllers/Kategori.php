<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori extends CI_Controller {

    public function __construct(){
        parent::__construct();

        if (empty($this->session->userdata('nip'))) {
            redirect('user/login');
        }

        $this->load->model('kategori_model');
    }
    
    public function datatables()
    {
        //menunda loading (bisa dihapus, hanya untuk menampilkan pesan processing)
        sleep(2);

        //memanggil fungsi model datatables
        $list = $this->kategori_model->get_datatables();
        $data = array();
        $no   = $this->input->post('start');

        //mencetak data json
        foreach ($list as $field) {
            $no++;
            $row   = array();
            $row[] = $field['id_kategori'];
            $row[] = $field['nama_kategori'];
            $row[] = '
                    <a href="' . site_url('kategori/update/' . $field['id_kategori']) . '" class="btn btn-warning btn-sm" title="edit">
                        <i class="fas fa-pencil-alt"></i>
                    </a>
                    <a href="' . site_url('kategori/delete/' . $field['id_kategori']) . '" class="btn btn-danger btn-sm hapus" title="hapus">
                        <i class="fas fa-trash-alt"></i>
                    </a>';

            $data[] = $row;
        }

        //mengirim data json
        $output = array(
            "draw"            => $this->input->post('draw'),
            "recordsTotal"    => $this->kategori_model->count_all(),
            "recordsFiltered" => $this->kategori_model->count_filtered(),
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
        $data_kategori = $this->kategori_model->read();

        $output = array(
                        'theme_page' =>'kategori/kategori_read',
                        'judul' => 'Daftar Kategori Buku',
                        'data_kategori' => $data_kategori,
                        'petugas' => $nip
                    );

        $this->load->view('theme/index', $output);
    }

    public function insert(){
        $nip = $this->session->userdata('nama_petugas');
        $output = array(
                        'theme_page' =>'kategori/kategori_insert',
                        'judul' => 'Tambah Data Kategori',
                        'petugas' => $nip
                    );
        
        $this->load->view('theme/index', $output);
    }

    public function insert_submit(){

        if($this->input->post('submit') == 'Simpan'){

            $this->form_validation->set_rules('kategori', 'Kategori','required');

            if($this->form_validation->run() == TRUE){
                
                $kategori = $this->input->post('kategori');
                $input = array(
                                'nama_kategori' => $kategori
                            );
                
                $data_kategori = $this->kategori_model->insert($input);
        
                redirect('kategori/read');

                $data_kategori = $this->kategori_model->insert($input);

                $this->session->set_tempdata('message', 'Sukses, Data Berhasil Ditambahkan', 3);
                redirect('kategori/read');
                
            }
        }
    }

    public function update(){
        $nip = $this->session->userdata('nama_petugas');
        $id = $this->uri->segment(3);

        $data_kategori_single = $this->kategori_model->read_single($id);

        $output = array(
                        'theme_page' => 'kategori/kategori_update',
                        'judul' => 'Ubah Data Kategori',
                        'data_kategori_single' => $data_kategori_single,
                        'petugas' => $nip
                    );

        $this->load->view('theme/index',$output);
    }

    public function update_submit(){
        $id = $this->uri->segment(3);
    
        if($this->input->post('submit') == 'Simpan'){

            $this->form_validation->set_rules('kategori', 'Kategori','required');

            if($this->form_validation->run() == TRUE){
                
                $kategori = $this->input->post('kategori');
                $input = array(
                                'nama_kategori' => $kategori
                            );
                

                $data_kategori = $this->kategori_model->update($input,$id);

                $this->session->set_tempdata('message', 'Sukses, Data Berhasil Diubah', 3);
                redirect('kategori/read');
                
            }
        }

    }

    public function delete(){
        $id = $this->uri->segment(3);

        $data_kategori = $this->kategori_model->delete($id);
        $this->session->set_tempdata('message', 'Sukses, Data Berhasil Dihapus', 3);

        redirect('kategori/read');
    }

}
