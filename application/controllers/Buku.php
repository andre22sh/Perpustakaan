<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Buku extends CI_Controller{

    public function __construct(){
        parent::__construct();

        if (empty($this->session->userdata('nip'))) {
            redirect('user/login');
        }

        $this->load->model(array('buku_model','pengarang_model','penerbit_model','kategori_model'));
    }

    public function datatables()
    {
        //menunda loading (bisa dihapus, hanya untuk menampilkan pesan processing)
        sleep(2);

        //memanggil fungsi model datatables
        $list = $this->buku_model->get_datatables();
        $data = array();
        $no   = $this->input->post('start');

        //mencetak data json
        foreach ($list as $field) {
            $no++;
            $row   = array();
            $row[] = $field['id_buku'];
            $row[] = $field['nama_buku'];
            $row[] = $field['nama_kategori'];
            $row[] = $field['nama_pengarang'];
            $row[] = $field['nama_penerbit'];
            $row[] = $field['jumlah_buku'];
            $row[] = '<img src="'.base_url('upload_folder/' .$field['cover_buku']).'" class="img-fluid" style="height:70px;" alt="">';
            $row[] = '
                    <a href="' . site_url('buku/update/' . $field['id_buku']) . '" class="btn btn-warning btn-sm" title="edit">
                        <i class="fas fa-pencil-alt"></i>
                    </a>
                    <a href="' . site_url('buku/delete/' . $field['id_buku']) . '" class="btn btn-danger btn-sm hapus" title="hapus">
                        <i class="fas fa-trash-alt"></i>
                    </a>';

            $data[] = $row;
        }

        //mengirim data json
        $output = array(
            "draw"            => $this->input->post('draw'),
            "recordsTotal"    => $this->buku_model->count_all(),
            "recordsFiltered" => $this->buku_model->count_filtered(),
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
        $data_buku = $this->buku_model->read();
        // $data_pengarang = $this->pengarang_model->read();
        // $data_penerbit = $this->penrbit_model->read();
        // $data_kategori = $this->kategori_model->read();

        $output = array(    
                        'theme_page' => 'buku/buku_read',
                        'judul' => 'Daftar Buku',
                        'data_buku' => $data_buku,
                        'petugas' => $nip
                    );
        
        $this->load->view('theme/index', $output);
    }

    public function insert(){
        $nip = $this->session->userdata('nama_petugas');
        $data_kategori = $this->kategori_model->read();
        $data_penerbit = $this->penerbit_model->read();
        $data_pengarang = $this->pengarang_model->read();

        $output = array(
                        'theme_page' => 'buku/buku_insert',
                        'judul' => 'Tambah Data Buku',
                        'data_kategori' => $data_kategori,
                        'data_penerbit' => $data_penerbit,
                        'data_pengarang' => $data_pengarang,
                        'petugas' => $nip
                    );

        $this->load->view('theme/index', $output);
    }

    public function insert_submit(){

        if ($this->input->post('submit') == 'Simpan') {

            //aturan validasi input login
            $this->form_validation->set_rules('id_buku', 'ID Buku', 'required');
            $this->form_validation->set_rules('nama_buku', 'Nama Buku', 'required');
            $this->form_validation->set_rules('kategori', 'Kategori', 'required');
            $this->form_validation->set_rules('pengarang', 'Pengarang', 'required');
            $this->form_validation->set_rules('penerbit', 'Penerbit', 'required');
            $this->form_validation->set_rules('jumlah_buku', 'Jumlah Buku', 'required');
            
            //setting library upload
            $config = array (
                'upload_path'    => './upload_folder/',
                'allowed_types'  => 'gif|jpg|png',
                'max_size'       => 10000
            );

            $this->load->library('upload', $config);

            if ($this->form_validation->run() == TRUE) {
                
                $id_buku = $this->input->post('id_buku');
                $nama_buku = $this->input->post('nama_buku');
                $kategori = $this->input->post('kategori');
                $pengarang = $this->input->post('pengarang');
                $penerbit = $this->input->post('penerbit');
                $jumlah_buku = $this->input->post('jumlah_buku');
                $gambar = $this->input->post('gambar');
          
                //jika gagal upload
                if (!$this->upload->do_upload('gambar')) {
        
                    $data_kategori = $this->kategori_model->read();
                    $data_penerbit = $this->penerbit_model->read();
                    $data_pengarang = $this->pengarang_model->read();
        
                    //respon alasan kenapa gagal upload
                    $response = $this->upload->display_errors();
        
                    //mengirim data ke view
                    $output = array(
                                    'theme_page' => 'buku/buku_insert',
                                    'judul' => 'Tambah Data Buku',
                                    'data_kategori' => $data_kategori,
                                    'data_penerbit' => $data_penerbit,
                                    'data_pengarang' => $data_pengarang,
                                	'response' => $response
                              );
                                    
                    $this->load->view('theme/index', $output);
        
                //jika berhasil upload
                } else {
                    $this->upload->do_upload('gambar');
                    $upload_data = $this->upload->data('file_name');
        
                    //mengirim data ke model
                    $input = array(
                                    'id_buku' => $id_buku,
                                    'nama_buku' => $nama_buku,
                                    'id_kategori' => $kategori,
                                    'id_penerbit' => $penerbit,
                                    'id_pengarang' =>$pengarang,
                                    'jumlah_buku' => $jumlah_buku,
                                    'cover_buku' => $upload_data
                				);
        
                    //memanggil function insert pada kota model
                    //function insert berfungsi menyimpan/create data ke table buku di database
                    $data_buku = $this->buku_model->insert($input);
        
                    //mengembalikan halaman ke function read
                    $this->session->set_tempdata('message', 'Sukses, Data berhasil ditambahkan', 3);
                    Redirect('buku/read'); 
                }
            }

        }
    }

    public function update(){
        $nip = $this->session->userdata('nama_petugas');

        $id = $this->uri->segment(3);

        $data_buku_single = $this->buku_model->read_single($id);
        $data_kategori = $this->kategori_model->read();
        $data_penerbit = $this->penerbit_model->read();
        $data_pengarang = $this->pengarang_model->read();

        $output = array(
                        'theme_page' => 'buku/buku_update',
                        'judul' => 'Ubah Data Buku',
                        'data_buku_single' => $data_buku_single,
                        'data_kategori' => $data_kategori,
                        'data_penerbit' => $data_penerbit,
                        'data_pengarang' => $data_pengarang,
                        'petugas' => $nip
                    );
           
        $this->load->view('theme/index', $output);
    }

    public function update_submit(){

        $id = $this->uri->segment(3);

        if ($this->input->post('submit') == 'Simpan') {

            //aturan validasi input login
            $this->form_validation->set_rules('id_buku', 'ID Buku', 'required');
            $this->form_validation->set_rules('nama_buku', 'Nama Buku', 'required');
            $this->form_validation->set_rules('kategori', 'Kategori', 'required');
            $this->form_validation->set_rules('pengarang', 'Pengarang', 'required');
            $this->form_validation->set_rules('penerbit', 'Penerbit', 'required');
            $this->form_validation->set_rules('jumlah_buku', 'Jumlah Buku', 'required');
            
            //setting library upload
            $config = array (
                'upload_path'    => './upload_folder/',
                'allowed_types'  => 'gif|jpg|png',
                'max_size'       => 10000
            );

            $this->load->library('upload', $config);

            if ($this->form_validation->run() == TRUE) {
                
                $id_buku = $this->input->post('id_buku');
                $nama_buku = $this->input->post('nama_buku');
                $kategori = $this->input->post('kategori');
                $pengarang = $this->input->post('pengarang');
                $penerbit = $this->input->post('penerbit');
                $jumlah_buku = $this->input->post('jumlah_buku');
                $gambar = $this->input->post('gambar');
          
                //jika gagal upload
                if (!$this->upload->do_upload('gambar')) {
        
                    $data_kategori = $this->kategori_model->read();
                    $data_penerbit = $this->penerbit_model->read();
                    $data_pengarang = $this->pengarang_model->read();
        
                    //respon alasan kenapa gagal upload
                    $response = $this->upload->display_errors();
        
                    //mengirim data ke view
                    $output = array(
                                    'theme_page' => 'buku/buku_insert',
                                    'judul' => 'Tambah Data Buku',
                                    'data_kategori' => $data_kategori,
                                    'data_penerbit' => $data_penerbit,
                                    'data_pengarang' => $data_pengarang,
                                	'response' => $response
                              );
                                    
                    $this->load->view('theme/index', $output);
        
                //jika berhasil upload
                } else {
                    $this->upload->do_upload('gambar');
                    $upload_data = $this->upload->data('file_name');
        
                    //mengirim data ke model
                    $input = array(
                                    'id_buku' => $id_buku,
                                    'nama_buku' => $nama_buku,
                                    'id_kategori' => $kategori,
                                    'id_penerbit' => $penerbit,
                                    'id_pengarang' =>$pengarang,
                                    'jumlah_buku' => $jumlah_buku,
                                    'cover_buku' => $upload_data
                				);
        
                    //memanggil function insert pada kota model
                    //function insert berfungsi menyimpan/create data ke table buku di database
                    $data_buku = $this->buku_model->update($input,$id);
        
                    //mengembalikan halaman ke function read
                    $this->session->set_tempdata('message', 'Sukses, Data berhasil di Ubah', 3);
                    Redirect('buku/read'); 
                }
            }

        }
    }

    public function delete(){

        $id = $this->uri->segment(3);
        
        $data_buku = $this->buku_model->delete($id);
        $this->session->set_tempdata('message', 'Sukses, Data Berhasil Dihapus', 3);

        redirect('buku/read');
    }

    public function export(){
        $data_buku = $this->buku_model->read(); 

        $output = array(
                        'judul' => 'Daftar Buku',
                        'data_buku' => $data_buku    
                    );

        $this->load->view('buku/buku_export', $output);
    }
}