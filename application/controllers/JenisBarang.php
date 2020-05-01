<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

// Deklarasi pembuatan class JenisBarang
class JenisBarang extends CI_Controller
{
    // Konstrutor
    function __construct()
    {
        parent::__construct();
        $this->load->model('JenisBarangModel'); // Memanggil JenisBarangModel yang terdapat pada models
        $this->load->model('UserModel'); // Memanggil UserModel yang terdapat pada models
        $this->load->library('datatables'); // Memanggil datatables yang terdapat pada library
    }

    // Fungsi untuk menampilkan halaman utama jenis barang
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
        $this->load->view('jenisbarang/jenisbarang_list'); // Menampilkan halaman utama jenis barang
        $this->load->view('footer_list'); // Menampilkan bagian footer
    }

    // Fungsi JSON
    public function json()
    {
        header('Content-Type: application/json');
        echo $this->JenisBarangModel->json(); // Menampilkan data json yang terdapat pada JenisBarangModel
    }

    // Fungsi menampilkan form Create JenisBarang
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
            'back' => site_url('jenisbarang'),
            'action' => site_url('jenisbarang/create_action'),
            'kodejenis' => set_value('kodejenis'),
            'namajenis' => set_value('namajenis'),
        );
        $this->load->view('header', $dataAdm); // Menampilkan bagian header dan object data users
        $this->load->view('jenisbarang/jenisbarang_form', $data); // Menampilkan form JenisBarang
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

        // Jika form jenis barang belum diisi dengan benar
        // maka sistem akan meminta user untuk menginput ulang
        if ($this->form_validation->run() == FALSE) {
            $this->create();
        }
        // Jika form jenis barang telah diisi dengan benar
        // maka sistem akan menyimpan kedalam database
        else {
            $data = array(
                'kodejenis' => $this->input->post('kodejenis', TRUE),
                'namajenis' => $this->input->post('namajenis', TRUE),
            );

            $this->JenisBarangModel->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('jenisbarang'));
        }
    }

    // Fungsi menampilkan form Update JenisBarang
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

        // Menampilkan data berdasarkan id-nya yaitu JenisBarang
        $row = $this->JenisBarangModel->get_by_id($id);

        // Jika id-nya dipilih maka data jurusan ditampilkan ke form edit JenisBarang
        if ($row) {

            $data = array(
                'button' => 'Update',
                'back' => site_url('jenisbarang'),
                'action' => site_url('jenisbarang/update_action'),
                'kodejenis' => set_value('kodejenis', $row->kodejenis),
                'namajenis' => set_value('namajenis', $row->namajenis),
            );
            $this->load->view('header', $dataAdm); // Menampilkan bagian header dan object data users
            $this->load->view('jenisbarang/jenisbarang_form', $data); // Menampilkan form JenisBarang
            $this->load->view('footer'); // Menampilkan bagian footer
        } // Jika id-nya yang dipilih tidak ada maka akan menampilkan pesan 'Record Not Found'
        else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('jenisbarang'));
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

        // Jika form JenisBarang belum diisi dengan benar
        // maka sistem akan meminta user untuk menginput ulang
        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('kodejenis', TRUE));
        }
        // Jika form JenisBarang telah diisi dengan benar
        // maka sistem akan melakukan update data JenisBarang kedalam database
        else {
            $data = array(
                'kodejenis' => $this->input->post('kodejenis', TRUE),
                'namajenis' => $this->input->post('namajenis', TRUE),
            );

            $this->JenisBarangModel->update($this->input->post('kodejenis', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('jenisbarang'));
        }
    }

    // Fungsi untuk melakukan aksi delete data berdasarkan id yang dipilih
    public function delete($id)
    {
        // Jika session data username tidak ada maka akan dialihkan kehalaman login
        if (!isset($this->session->userdata['username'])) {
            redirect(base_url("login"));
        }

        $row = $this->JenisBarangModel->get_by_id($id);

        //jika id JenisBarang yang dipilih tersedia maka akan dihapus
        if ($row) {
            $this->JenisBarangModel->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('jenisbarang'));
        } //jika id jurusan yang dipilih tidak tersedia maka akan muncul pesan 'Record Not Found'
        else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('jenisbarang'));
        }
    }

    // Fungsi rules atau aturan untuk pengisian pada form (create/input dan update)
    public function _rules()
    {
        $this->form_validation->set_rules('kodejenis', 'kodejenis', 'trim|required');
        $this->form_validation->set_rules('namajenis', 'namajenis', 'trim|required');
        $this->form_validation->set_rules('kodejenis', 'kodejenis', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
}