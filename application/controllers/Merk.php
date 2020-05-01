<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

// Deklarasi pembuatan class Merk
class Merk extends CI_Controller
{
    // Konstrutor
    function __construct()
    {
        parent::__construct();
        $this->load->model('MerkModel'); // Memanggil MerkModel yang terdapat pada models
        $this->load->model('UserModel'); // Memanggil UserModel yang terdapat pada models
        $this->load->library('datatables'); // Memanggil datatables yang terdapat pada library
    }

    // Fungsi untuk menampilkan halaman utama jurusan
    public function index()
    {
        // Jika session data username tidak ada maka akan dialihkan kehalaman login
        if (!isset($this->session->userdata['username'])) {
            redirect(base_url("login"));
        }

        // Menampilkan data berdasarkan id-nya yaitu username
        $row = $this->UserModel->get_by_id($this->session->userdata['username']);
        $data = array(
            'wa' => 'Web administrator',
            'univ' => 'SMA Negeri 1 Bandung',
            'username' => $row->username,
            'email' => $row->email,
            'level' => $row->level,
        );
        $this->load->view('header_list', $data); // Menampilkan bagian header dan object data users
        $this->load->view('merk/merk_list'); // Menampilkan halaman utama merk
        $this->load->view('footer_list'); // Menampilkan bagian footer
    }

    // Fungsi JSON
    public function json()
    {
        header('Content-Type: application/json');
        echo $this->MerkModel->json(); // Menampilkan data json yang terdapat pada MerkModel
    }

    // Fungsi menampilkan form Create merk
    public function create()
    {
        // Jika session data username tidak ada maka akan dialihkan kehalaman login
        if (!isset($this->session->userdata['username'])) {
            redirect(base_url("login"));
        }

        // Menampilkan data berdasarkan id-nya yaitu username
        $row = $this->UserModel->get_by_id($this->session->userdata['username']);
        $dataAdm = array(
            'wa' => 'Web administrator',
            'univ' => 'SMA Negeri 1 Bandung',
            'username' => $row->username,
            'email' => $row->email,
            'level' => $row->level,
        );

        // Menampung data yang diinputkan
        $data = array(
            'button' => 'Create',
            'back' => site_url('merk'),
            'action' => site_url('merk/create_action'),
            
            'kodemerk' => set_value('kodemerk'),
            'namamerk' => set_value('namamerk'),
        );
        $this->load->view('header', $dataAdm); // Menampilkan bagian header dan object data users
        $this->load->view('merk/merk_form', $data); // Menampilkan form merk
        $this->load->view('footer'); // Menampilkan bagian footer
    }

    // Fungsi untuk melakukan aksi simpan data
    public function create_action()
    {
        // Jika session data username tidak ada maka akan dialihkan kehalaman login
        if (!isset($this->session->userdata['username'])) {
            redirect(base_url("login"));
        }

        $this->_rules(); // Rules atau aturan bahwa setiap form harus diisi

        // Jika form merk belum diisi dengan benar
        // maka sistem akan meminta user untuk menginput ulang
        if ($this->form_validation->run() == FALSE) {
            $this->create();
        }
        // Jika form merk telah diisi dengan benar
        // maka sistem akan menyimpan kedalam database
        else {
            $data = array(
                'kodemerk' => $this->input->post('kodemerk', TRUE),
                'namamerk' => $this->input->post('namamerk', TRUE),
            );

            $this->MerkModel->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('merk'));
        }
    }

    // Fungsi menampilkan form Update Merk
    public function update($id)
    {
        // Jika session data username tidak ada maka akan dialihkan kehalaman login
        if (!isset($this->session->userdata['username'])) {
            redirect(base_url("login"));
        }

        // Menampilkan data berdasarkan id-nya yaitu username
        $rowAdm = $this->UserModel->get_by_id($this->session->userdata['username']);
        $dataAdm = array(
            'wa' => 'Web administrator',
            'univ' => 'SMA Negeri 1 Bandung',
            'username' => $rowAdm->username,
            'email' => $rowAdm->email,
            'level' => $rowAdm->level,
        );

        // Menampilkan data berdasarkan id-nya yaitu Merk
        $row = $this->MerkModel->get_by_id($id);

        // Jika id-nya dipilih maka data merk ditampilkan ke form edit merk
        if ($row) {

            $data = array(
                'button' => 'Update',
                'back' => site_url('merk'),
                'action' => site_url('merk/update_action'),
                
                'kodemerk' => set_value('kodemerk', $row->kodemerk),
                'namamerk' => set_value('namamerk', $row->namamerk),
            );
            $this->load->view('header', $dataAdm); // Menampilkan bagian header dan object data users
            $this->load->view('merk/merk_form', $data); // Menampilkan form merk
            $this->load->view('footer'); // Menampilkan bagian footer
        } // Jika id-nya yang dipilih tidak ada maka akan menampilkan pesan 'Record Not Found'
        else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('merk'));
        }
    }

    // Fungsi untuk melakukan aksi update data
    public function update_action()
    {
        // Jika session data username tidak ada maka akan dialihkan kehalaman login
        if (!isset($this->session->userdata['username'])) {
            redirect(base_url("login"));
        }

        $this->_rules(); // Rules atau aturan bahwa setiap form harus diisi

        // Jika form merk belum diisi dengan benar
        // maka sistem akan meminta user untuk menginput ulang
        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('kodemerk', TRUE));
        }
        // Jika form merk telah diisi dengan benar
        // maka sistem akan melakukan update data merk kedalam database
        else {
            $data = array(
                'kodemerk' => $this->input->post('kodemerk', TRUE),
                'namamerk' => $this->input->post('namamerk', TRUE),
            );

            $this->MerkModel->update($this->input->post('kodemerk', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('merk'));
        }
    }

    // Fungsi untuk melakukan aksi delete data berdasarkan id yang dipilih
    public function delete($id)
    {
        // Jika session data username tidak ada maka akan dialihkan kehalaman login
        if (!isset($this->session->userdata['username'])) {
            redirect(base_url("login"));
        }

        $row = $this->MerkModel->get_by_id($id);

        //jika id merk yang dipilih tersedia maka akan dihapus
        if ($row) {
            $this->MerkModel->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('merk'));
        } //jika id merk yang dipilih tidak tersedia maka akan muncul pesan 'Record Not Found'
        else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('merk'));
        }
    }

    // Fungsi rules atau aturan untuk pengisian pada form (create/input dan update)
    public function _rules()
    {
        $this->form_validation->set_rules('kodemerk', 'kode merk', 'trim|required');
        $this->form_validation->set_rules('namamerk', 'nama merk', 'trim|required');
        $this->form_validation->set_rules('kodemerk', 'kodemerk', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
}