<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

// Deklarasi pembuatan class PeminjamanModel
class PeminjamanModel extends CI_Model
{
    // Property yang bersifat public
    public $table = 'peminjaman';
    public $id = 'no';
    public $order = 'DESC';

    // Konstrutor
    function __construct()
    {
        parent::__construct();
    }

    // Tabel data dengan nama peminjaman
    function json()
    {
        $this->datatables->select("no, namapeminjam, idpeminjam, kodebarang, tanggalpeminjaman, kondisisebelum, kondisisesudah, keterangan");
        $this->datatables->from('peminjaman');
        $this->datatables->add_column('action', anchor(site_url('peminjaman/read/$1'), '<button type="button" class="btn btn-primary"><i class="fa fa-eye" aria-hidden="true"></i></button>') . "  " . anchor(site_url('peminjaman/update/$1'), '<button type="button" class="btn btn-warning"><i class="fa fa-pencil" aria-hidden="true"></i></button>') . "  " . anchor(site_url('peminjaman/delete/$1'), '<button type="button" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button>', 'onclick="javasciprt: return confirm(\'Are You Sure ?\')"'), 'no');
        return $this->datatables->generate();
    }

    // Menampilkan semua data
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // Menampilkan semua data berdasarkan id-nya
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }

    // menampilkan jumlah data
    function total_rows($q = NULL)
    {
        $this->db->like('no', $q);
        
        $this->db->or_like('namapeminjam', $q);
        $this->db->or_like('idpeminjam', $q);
        $this->db->or_like('kodebarang', $q);
        $this->db->or_like('tanggalpeminjaman', $q);
        $this->db->or_like('kondisisebelum', $q);
        $this->db->or_like('kondisisesudah', $q);
        $this->db->or_like('keterangan', $q);
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // Menampilkan data dengan jumlah limit
    function get_limit_data($limit, $start = 0, $q = NULL)
    {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('no', $q);
        
        $this->db->or_like('namapeminjam', $q);
        $this->db->or_like('idpeminjam', $q);
        $this->db->or_like('kodebarang', $q);
        $this->db->or_like('tanggalpeminjaman', $q);
        $this->db->or_like('kondisisebelum', $q);
        $this->db->or_like('kondisisesudah', $q);
        $this->db->or_like('keterangan', $q);
        $this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // Menambahkan data kedalam database
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    // Merubah data kedalam database
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    // Menghapus data kedalam database
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }
}