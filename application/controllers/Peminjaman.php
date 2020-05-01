<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

// Deklarasi pembuatan class Peminjaman
class Peminjaman extends CI_Controller
{
    // Konstruktor
    function __construct()
    {
        parent::__construct();
        $this->load->model('PeminjamanModel'); // Memanggil PeminjamanModel yang terdapat pada models
        $this->load->model('UserModel'); // Memanggil UserModel yang terdapat pada models
        $this->load->library('form_validation'); // Memanggil form_validation yang terdapat pada library
        $this->load->helper(array('form', 'url')); // Memanggil form dan url yang terdapat pada helper
        $this->load->library('datatables'); // Memanggil datatables yang terdapat pada library
    }

    // Fungsi untuk menampilkan halaman peminjaman
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
        $this->load->view('peminjaman/peminjaman_list'); // Menampilkan halaman utama peminjaman
        $this->load->view('footer_list'); // Menampilkan bagian footer
    }

    // Fungsi JSON
    public function json() {
        header('Content-Type: application/json');
        echo $this->PeminjamanModel->json();
    }

    // Fungsi untuk menampilkan halaman mahasiswa secara detail
    public function read($id){
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

        // Menampilkan data peminjaman yang ada di database berdasarkan id-nya yaitu nim
        $row = $this->PeminjamanModel->get_by_id($id);

        // Jika data peminjaman tersedia maka akan ditampilkan
        if ($row) {
            $data = array(
                'button' => 'Read',
                'back'   => site_url('peminjaman'),
                'no' => $row->no,
                'namapeminjam' => $row->namapeminjam,
                'idpeminjam' => $row->idpeminjam,
                'kodebarang' => $row->kodebarang,
                'tanggalpeminjaman' => $row->tanggalpeminjaman,
                'kondisisebelum' => $row->kondisisebelum,
                'kondisisesudah' => $row->kondisisesudah,
                'keterangan' => $row->keterangan,
                
            );
            $this->load->view('header', $dataAdm); // Menampilkan bagian header dan object data users
            $this->load->view('peminjaman/peminjaman_read', $data); // Menampilkan halaman detail peminjaman
            $this->load->view('footer'); // Menampilkan bagian footer
        }
        // Jika data peminjaman tidak tersedia maka akan ditampilkan informasi 'Record Not Found'
        else {
            $this->load->view('header', $dataAdm); // Menampilkan bagian header dan object data users
            $this->session->set_flashdata('message', 'Record Not Found');
            $this->load->view('footer'); // Menampilkan bagian footer
            redirect(site_url('peminjaman'));
        }
    }

    // Fungsi menampilkan form Create Peminjaman
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
            'back'   => site_url('peminjaman'),
            'action' => site_url('peminjaman/create_action'),
            'no' => set_value('no'),
            'namapeminjam' => set_value('namapeminjam'),
            'idpeminjam' => set_value('idpeminjam'),
            'kodebarang' => set_value('kodebarang'),
            'tanggalpeminjaman' => set_value('tanggalpeminjaman'),
            'kondisisebelum' => set_value('kondisisebelum'),
            'kondisisesudah' => set_value('kondisisesudah'),
            'keterangan' => set_value('keterangan'),
            
        );
        $this->load->view('header',$dataAdm ); // Menampilkan bagian header dan object data users
        $this->load->view('peminjaman/peminjaman_form', $data); // Menampilkan halaman form peminjaman
        $this->load->view('footer'); // Menampilkan bagian footer
    }

    // Fungsi untuk melakukan aksi simpan data
    public function create_action(){

        // Jika session data username tidak ada maka akan dialihkan kehalaman login
        if (!isset($this->session->userdata['username'])) {
            redirect(base_url("login"));
        }

        $this->_rules(); // Rules atau aturan bahwa setiap form harus diisi

        // Jika form peminjaman belum diisi dengan benar
        // maka sistem akan meminta user untuk menginput ulang
        if ($this->form_validation->run() == FALSE) {
            $this->create();
        }
        // Jika form peminjaman telah diisi dengan benar
        // maka sistem akan menyimpan kedalam database
        else {
                $data = array(
                        'no' => $this->input->post('no',TRUE),
                        'namapeminjam' => $this->input->post('namapeminjam',TRUE),
                        'idpeminjam' => $this->input->post('idpeminjam',TRUE),
                        'kodebarang' => $this->input->post('kodebarang',TRUE),
                        'tanggalpeminjaman' => $this->input->post('tanggalpeminjaman',TRUE),
                        'kondisisebelum' => $this->input->post('kondisisebelum',TRUE),
                        'kondisisesudah' => $this->input->post('kondisisesudah',TRUE),
                        'keterangan' => $this->input->post('keterangan',TRUE),
                );

                $this->PeminjamanModel->insert($data);
                $this->session->set_flashdata('message', 'Create Record Success');
                redirect(site_url('peminjaman'));
            }

    }

    // Fungsi menampilkan form Update Peminjaman
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

        // Menampilkan data berdasarkan id-nya yaitu nim
        $row = $this->PeminjamanModel->get_by_id($id);

        // Jika id-nya dipilih maka data peminjaman ditampilkan ke form edit peminjaman
        if ($row) {
            $data = array(
                'button' => 'Update',
                'back'   => site_url('peminjaman'),
                'action' => site_url('peminjaman/update_action'),
                'no' => set_value('no', $row->no),
                'namapeminjam' => set_value('namapeminjam', $row->namapeminjam),
                'idpeminjam' => set_value('idpeminjam', $row->idpeminjam),
                'kodebarang' => set_value('kodebarang', $row->kodebarang),
                'tanggalpeminjaman' => set_value('tanggalpeminjaman', $row->tanggalpeminjaman),
                'kondisisebelum' => set_value('kondisisebelum', $row->kondisisebelum),
                'kondisisesudah' => set_value('kondisisesudah', $row->kondisisesudah),
                'keterangan' => set_value('keterangan', $row->keterangan),
            );
            $this->load->view('header',$dataAdm); // Menampilkan bagian header dan object data users
            $this->load->view('peminjaman/peminjaman_form', $data); // Menampilkan form peminjaman
            $this->load->view('footer'); // Menampilkan bagian footer
        }
        // Jika id-nya yang dipilih tidak ada maka akan menampilkan pesan 'Record Not Found'
        else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('peminjaman'));
        }
    }

    // Fungsi untuk melakukan aksi update data
    public function update_action(){

        // Jika session data username tidak ada maka akan dialihkan kehalaman login
        if (!isset($this->session->userdata['username'])) {
            redirect(base_url("login"));
        }

        $this->_rules(); // Rules atau aturan bahwa setiap form harus diisi

        // Jika form peminjaman belum diisi dengan benar
        // maka sistem akan meminta user untuk menginput ulang
        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('no', TRUE));
        }
        // Jika form peminjaman telah diisi dengan benar
        // maka sistem akan melakukan update data peminjaman kedalam database
        else{
                
                // Menampung data yang diinputkan
                $data = array(
                    'no' => $this->input->post('no',TRUE),
                    'namapeminjam' => $this->input->post('namapeminjam',TRUE),
                    'idpeminjam' => $this->input->post('idpeminjam',TRUE),
                    'kodebarang' => $this->input->post('kodebarang',TRUE),
                    'tanggalpeminjaman' => $this->input->post('tanggalpeminjaman',TRUE),
                    'kondisisebelum' => $this->input->post('kondisisebelum',TRUE),
                    'kondisisesudah' => $this->input->post('kondisisesudah',TRUE),
                    'keterangan' => $this->input->post('keterangan',TRUE),
                );

                $this->PeminjamanModel->update($this->input->post('no', TRUE), $data);
                $this->session->set_flashdata('message', 'Update Record Success');
                redirect(site_url('peminjaman'));
            }
        
    }

     // Fungsi untuk melakukan aksi delete data berdasarkan id yang dipilih
     public function delete($id)
     {
         // Jika session data username tidak ada maka akan dialihkan kehalaman login
         if (!isset($this->session->userdata['username'])) {
             redirect(base_url("login"));
         }
 
         $row = $this->PeminjamanModel->get_by_id($id);
 
         //jika id peminjaman yang dipilih tersedia maka akan dihapus
         if ($row) {
             $this->PeminjamanModel->delete($id);
             $this->session->set_flashdata('message', 'Delete Record Success');
             redirect(site_url('peminjaman'));
         } //jika id peminjaman yang dipilih tidak tersedia maka akan muncul pesan 'Record Not Found'
         else {
             $this->session->set_flashdata('message', 'Record Not Found');
             redirect(site_url('peminjaman'));
         }
     }

    // Fungsi rules atau aturan untuk pengisian pada form (create/input dan update)
    public function _rules()
    {
        $this->form_validation->set_rules('no', 'no', 'trim|required');
        $this->form_validation->set_rules('namapeminjam', 'namapeminjam', 'trim|required');
        $this->form_validation->set_rules('idpeminjam', 'idpeminjam', 'trim|required');
        $this->form_validation->set_rules('kodebarang', 'kodebarang', 'trim|required');
        $this->form_validation->set_rules('tanggalpeminjaman', 'tannggalpeminjaman', 'trim|required');
        $this->form_validation->set_rules('kondisisebelum', 'kondisisebelum', 'trim|required');
        $this->form_validation->set_rules('kondisisesudah', 'kondisisesudah', 'trim|required');
        $this->form_validation->set_rules('keterangan', 'keterangan', 'trim|required');
        $this->form_validation->set_rules('no', 'no', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}