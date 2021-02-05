<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_model extends CI_Model 
{
	// function read berfungsi mengambil/read data dari table denda di database
	public function anggota() {
		// sql read
        $this->db->select('COUNT(nim)  as total');
        $this->db->from('anggota');
        $query = $this->db->get();

		// $query -> result_array = mengirim data ke controller dalam bentuk semua data
        return $query->result_array();
    }

    public function buku()
    {
        // sql read
        $this->db->select('COUNT(nama_buku)  as total');
        $this->db->from('buku');
        $query = $this->db->get();

        // $query -> result_array = mengirim data ke controller dalam bentuk semua data
        return $query->result_array();
    }

    public function peminjaman()
    {
        // sql read
        $this->db->select('count(id_peminjaman)  as total');
        $this->db->from('peminjaman');
        $query = $this->db->get();

        // $query -> result_array = mengirim data ke controller dalam bentuk semua data
        return $query->result_array();
    }

    public function pengembalian()
    {
        // sql read
        $this->db->select('COUNT(id_pengembalian)  as total');
        $this->db->from('pengembalian');
        $query = $this->db->get();

        // $query -> result_array = mengirim data ke controller dalam bentuk semua data
        return $query->result_array();
    }
}