<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Buku_model extends CI_Model{

    var $table = array('buku', 'kategori', 'penerbit', 'pengarang');

    //field yang ditampilkan
    var $column_order = array(null, 'id_buku', 'nama_buku', 'nama_kategori','nama_pengarang', 'nama_penerbit', 'jumlah_buku', 'cover_buku');

    //field yang diizin untuk pencarian 
    var $column_search = array('id_buku', 'nama_buku', 'nama_kategori','nama_pengarang', 'nama_penerbit', 'jumlah_buku', 'cover_buku');

    //field pertama yang diurutkan
    var $order = array('id_buku' => 'ASC');

    public function __construct()
    {
        parent::__construct();
    }

    private function _get_datatables_query()
    {

        $this->db->select('*');
        $this->db->from('buku');
        $this->db->join('kategori', 'buku.id_kategori=kategori.id_kategori');
        $this->db->join('penerbit', 'buku.id_penerbit=penerbit.id_penerbit');
        $this->db->join('pengarang', 'buku.id_pengarang=pengarang.id_pengarang');


        $i = 0;

        foreach ($this->column_search as $item) // looping awal
        {
            $search = $this->input->post('search');
            if ($search['value'])

            // jika datatable mengirimkan pencarian dengan metode POST
            {
                // looping awal 
                if ($i === 0) {
                    $this->db->group_start();
                    $this->db->like($item, $search['value']);
                } else {
                    $this->db->or_like($item, $search['value']);
                }

                if (count($this->column_search) - 1 == $i)
                $this->db->group_end();
            }
            $i++;
        }

        if ($this->input->post('order')) {
            $order = $this->input->post('order');
            $this->db->order_by($this->column_order[$order['0']['column']], $order['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatables()
    {
        $this->_get_datatables_query();
        if ($this->input->post('length') != -1)
        $this->db->limit($this->input->post('length'), $this->input->post('start'));

        $query = $this->db->get();
        return $query->result_array();
    }
    //menghitung tota data sesuai filter/pagination
    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
 
    //menghitung total data di table
    public function count_all() {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    public function read(){

        $this->db->select('*');
        $this->db->from('buku');
        $this->db->join('kategori', 'buku.id_kategori=kategori.id_kategori');
        $this->db->join('penerbit', 'buku.id_penerbit=penerbit.id_penerbit');
        $this->db->join('pengarang', 'buku.id_pengarang=pengarang.id_pengarang');

        $query = $this->db->get();

        return $query->result_array();
    }

    public function read_single($id){

        $this->db->select('*');
        $this->db->from('buku');
        $this->db->where('id_buku',$id);

        $query = $this->db->get();

        return $query->row_array();
    }

    public function insert($input){

        return $this->db->insert('buku',$input); 
    }

    public function update($input,$id){

        $this->db->where('id_buku',$id);
    
        return $this->db->update('buku', $input);
    }

    public function delete($id){

        $this->db->where('id_buku', $id);
        return $this->db->delete('buku');
    }
}