<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengembalian_model extends CI_Model{

    var $table = array('pengembalian, peminjaman, buku, petugas, anggota');

    //field yang ditampilkan
    var $column_order = array(null, 'id_pengembalian', 'nama_mhs', 'nama_buku', 'batas_peminjaman', 'tgl_pengembalian', 'jumlah_pengembalian', 'denda_telat', 'denda_hilang', 'denda_rusak', 'total_denda');

    //field yang diizin untuk pencarian 
    var $column_search = array('id_pengembalian', 'nama_mhs', 'nama_buku', 'batas_peminjaman', 'tgl_pengembalian', 'jumlah_pengembalian', 'denda_telat', 'denda_hilang', 'denda_rusak', 'total_denda');

    //field pertama yang diurutkan
    var $order = array('id_pengembalian' => 'DESC');

    public function __construct()
    {
        parent::__construct();
    }

    private function _get_datatables_query()
    {

        $this->db->select('a.*,b.*,c.*,d.*,e.*, (denda_telat+denda_hilang+denda_rusak) as total_denda');
        $this->db->from('peminjaman a');
        $this->db->join('pengembalian b' ,'a.id_peminjaman = b.id_peminjaman');
        $this->db->join('buku c', 'a.id_buku=c.id_buku');
        $this->db->join('petugas d','a.nip=d.nip');
        $this->db->join('anggota e','a.nim=e.nim');

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
    public function count_all()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    public function read(){

        $this->db->select('a.*,b.*,c.*,d.*,e.*, (denda_telat+denda_hilang+denda_rusak) as total_denda');
        $this->db->from('peminjaman a');
        $this->db->join('pengembalian b' ,'a.id_peminjaman = b.id_peminjaman');
        $this->db->join('buku c', 'a.id_buku=c.id_buku');
        $this->db->join('petugas d','a.nip=d.nip');
        $this->db->join('anggota e','a.nim=e.nim');

        $query = $this->db->get();

        return $query->result_array();
    }

    public function read_single($id){

        $this->db->select('*');
        $this->db->from('pengembalian');
        $this->db->where('id_pengembalian', $id);

        $query = $this->db->get();

        return $query->row_array();
    }

    public function insert($input){

        return $this->db->insert('pengembalian', $input);
    }

    public function update($input,$id){

        $this->db->where('id_pengembalian',$id);

        return $this->db->update('pengembalian', $input);
    }

    public function delete($id){

        $this->db->where('id_pengembalian', $id);

        return $this->db->delete('pengembalian');
    }
}