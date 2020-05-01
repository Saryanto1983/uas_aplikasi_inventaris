<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Admin extends CI_Controller
{
    // Konstrutor
    function __construct()
    {
        parent::__construct();
        $this->load->model('UserModel');
        if (!isset($this->session->userdata['username'])) {
            redirect(base_url("login"));
        }
    }

    // Fungsi untuk menampilkan halaman utama admin
    public function index()
    {
        // Menampilkan data berdasarkan id-nya yaitu username
        $row = $this->UserModel->get_by_id($this->session->userdata['username']);
        $data = array(
            'wa' => 'Web administrator',
            'univ' => 'SMA Negeri 1 Bandung',
            'username' => $row->username,
            'email' => $row->email,
            'level' => $row->level,
        );
        $this->load->view('home', $data); // Menampilkan halaman utama admin
    }

    // Fungsi melakukan logout
    function logout()
    {
        $this->session->sess_destroy();
        redirect(base_url('login'));
    }
}