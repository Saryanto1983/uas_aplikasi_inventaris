<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

// Deklarasi pembuatan class BarangMasuk
class BarangMasuk extends CI_Controller
{
    // Konstruktor
    function __construct()
    {
        parent::__construct();
        $this->load->model('BarangMasukModel'); // Memanggil BarangMasukModel yang terdapat pada models
        $this->load->model('UserModel'); // Memanggil UserModel yang terdapat pada models
        $this->load->library('datatables'); // Memanggil datatables yang terdapat pada library
    }

    // Fungsi untuk menampilkan halaman barang masuk
    public function index(){
        // Jika session data username tidak ada maka akan dialihkan kehalaman login
        if (!isset($this->session->userdata['username'])) {
            redirect(base_url("login"));
        }

        // Menampilkan data berdasarkan id-nya yaitu username
        $rowAdm = $this->UserModel->get_by_id($this->session->userdata['username']);
        $dataAdm = array(
            'wa'       => 'Web administrator',
            'univ'     => 'SMA Negeri 1 Bandung',
            'username' => $rowAdm->username,
            'email'    => $rowAdm->email,
            'level'    => $rowAdm->level,
        );

        $this->load->view('header_list', $dataAdm); // Menampilkan bagian header dan object data users
        $this->load->view('barangmasuk/barangmasuk_list'); // Menampilkan halaman utama barang masuk
        $this->load->view('footer_list'); // Menampilkan bagian footer
    }

    // Fungsi JSON
    public function json() {
        header('Content-Type: application/json');
        echo $this->BarangMasukModel->json();
    }

    
    // Fungsi menampilkan form Create Barang Masuk
    public function create(){
        // Jika session data username tidak ada maka akan dialihkan kehalaman login
        if (!isset($this->session->userdata['username'])) {
            redirect(base_url("login"));
        }

        // Menampilkan data berdasarkan id-nya yaitu username
        $rowAdm = $this->UserModel->get_by_id($this->session->userdata['username']);
        $dataAdm = array(
            'wa'       => 'Web administrator',
            'univ'     => 'SMA Negeri 1 Bandung',
            'username' => $rowAdm->username,
            'email'    => $rowAdm->email,
            'level'    => $rowAdm->level,
        );
// Menampung data yang diinputkan
        $data = array(
            'button' => 'Create',
            'back'   => site_url('barangmasuk'),
            'action' => site_url('barangmasuk/create_action'),
            'no' => set_value('no'),
            'kodebarang' => set_value('kodebarang'),
            'jumlah' => set_value('jumlah'),
            'tanggalmasuk' => set_value('tanggalmasuk'),
            
        );
        $this->load->view('header',$dataAdm ); // Menampilkan bagian header dan object data users
        $this->load->view('barangmasuk/barangmasuk_form', $data); // Menampilkan halaman form barang masuk
        $this->load->view('footer'); // Menampilkan bagian footer
    }

    // Fungsi untuk melakukan aksi simpan data
    public function create_action(){

        // Jika session data username tidak ada maka akan dialihkan kehalaman login
        if (!isset($this->session->userdata['username'])) {
            redirect(base_url("login"));
        }

        $this->_rules(); // Rules atau aturan bahwa setiap form harus diisi

        // Jika form barang masuk belum diisi dengan benar
        // maka sistem akan meminta user untuk menginput ulang
        if ($this->form_validation->run() == FALSE) {
            $this->create();
        }
        // Jika form barang masuk telah diisi dengan benar
        // maka sistem akan menyimpan kedalam database
        else {
           

                $data = array(
                        'no' => $this->input->post('no',TRUE),
                        'kodebarang' => $this->input->post('kodebarang',TRUE),
                        'jumlah' => $this->input->post('jumlah',TRUE),
                        'tanggalmasuk' => $this->input->post('tanggalmasuk',TRUE),
                );

                $this->BarangMasukModel->insert($data);
                $this->session->set_flashdata('message', 'Create Record Success');
                redirect(site_url('barangmasuk'));

        }
    }

    // Fungsi menampilkan form Update Barang Masuk
    public function update($id){
        // Jika session data username tidak ada maka akan dialihkan kehalaman login
        if (!isset($this->session->userdata['username'])) {
            redirect(base_url("login"));
        }

        // Menampilkan data berdasarkan id-nya yaitu username
        $rowAdm = $this->UserModel->get_by_id($this->session->userdata['username']);
        $dataAdm = array(
            'wa'       => 'Web administrator',
            'univ'     => 'SMA Negeri 1 Bandung',
            'username' => $rowAdm->username,
            'email'    => $rowAdm->email,
            'level'    => $rowAdm->level,
        );

        // Menampilkan data berdasarkan id-nya yaitu no
        $row = $this->BarangMasukModel->get_by_id($id);

        // Jika id-nya dipilih maka data barang masuk ditampilkan ke form edit barang masuk
        if ($row) {
            $data = array(
                'button' => 'Update',
                'back'   => site_url('barangmasuk'),
                'action' => site_url('barangmasuk/update_action'),
                'no' => set_value('no', $row->no),
                'kodebarang' => set_value('kodebarang', $row->kodebarang),
                'jumlah' => set_value('jumlah', $row->jumlah),
                'tanggalmasuk' => set_value('tanggalmasuk', $row->tanggalmasuk),
            );
            $this->load->view('header',$dataAdm); // Menampilkan bagian header dan object data users
            $this->load->view('barangmasuk/barangmasuk_form', $data); // Menampilkan form barang masuk
            $this->load->view('footer'); // Menampilkan bagian footer
        }
        // Jika id-nya yang dipilih tidak ada maka akan menampilkan pesan 'Record Not Found'
        else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('barangmasuk'));
        }
    }

    // Fungsi untuk melakukan aksi update data
    public function update_action(){

        // Jika session data username tidak ada maka akan dialihkan kehalaman login
        if (!isset($this->session->userdata['username'])) {
            redirect(base_url("login"));
        }

        $this->_rules(); // Rules atau aturan bahwa setiap form harus diisi

        // Jika form  barang masuk belum diisi dengan benar
        // maka sistem akan meminta user untuk menginput ulang
        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('no', TRUE));
        }
        // Jika form barang masuk telah diisi dengan benar
        // maka sistem akan melakukan update data barang masuk kedalam database
        else{
                // Menampung data yang diinputkan
                $data = array(
                    'no' => $this->input->post('no',TRUE),
                        'kodebarang' => $this->input->post('kodebarang',TRUE),
                        'jumlah' => $this->input->post('jumlah',TRUE),
                        'tanggalmasuk' => $this->input->post('tanggalmasuk',TRUE),
                );

                $this->BarangMasukModel->update($this->input->post('no', TRUE), $data);
                $this->session->set_flashdata('message', 'Update Record Success');
                redirect(site_url('barangmasuk'));
            

        }
    }

     // Fungsi untuk melakukan aksi delete data berdasarkan id yang dipilih
     public function delete($id)
     {
         // Jika session data username tidak ada maka akan dialihkan kehalaman login
         if (!isset($this->session->userdata['username'])) {
             redirect(base_url("login"));
         }
 
         $row = $this->BarangMasukModel->get_by_id($id);
 
         //jika id barang masuk yang dipilih tersedia maka akan dihapus
         if ($row) {
             $this->BarangMasukModel->delete($id);
             $this->session->set_flashdata('message', 'Delete Record Success');
             redirect(site_url('barangmasuk'));
         } //jika id barang masuk yang dipilih tidak tersedia maka akan muncul pesan 'Record Not Found'
         else {
             $this->session->set_flashdata('message', 'Record Not Found');
             redirect(site_url('barangmasuk'));
         }
     }

    // Fungsi rules atau aturan untuk pengisian pada form (create/input dan update)
    public function _rules()
    {
        $this->form_validation->set_rules('no', 'no', 'trim|required');
        $this->form_validation->set_rules('kodebarang', 'kodebarang', 'trim|required');
        $this->form_validation->set_rules('jumlah', 'jumlah', 'trim|required');
        $this->form_validation->set_rules('tanggalmasuk', 'tanggalmasuk', 'trim|required');
        $this->form_validation->set_rules('no', 'no', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}