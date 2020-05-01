<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

// Deklarasi pembuatan class Barang
class Barang extends CI_Controller
{
    // Konstruktor
    function __construct()
    {
        parent::__construct();
        $this->load->model('BarangModel'); // Memanggil BarangModel yang terdapat pada models
        $this->load->model('UserModel'); // Memanggil UserModel yang terdapat pada models
        $this->load->library('form_validation'); // Memanggil form_validation yang terdapat pada library
        $this->load->helper(array('form', 'url')); // Memanggil form dan url yang terdapat pada helper
        $this->load->library('datatables'); // Memanggil datatables yang terdapat pada library
    }

    // Fungsi untuk menampilkan halaman barang
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
        $this->load->view('barang/barang_list'); // Menampilkan halaman utama barang
        $this->load->view('footer_list'); // Menampilkan bagian footer
    }

    // Fungsi JSON
    public function json() {
        header('Content-Type: application/json');
        echo $this->BarangModel->json();
    }

    // Fungsi untuk menampilkan halaman barang secara detail
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

        // Menampilkan data barang yang ada di database berdasarkan id-nya yaitu no
        $row = $this->BarangModel->get_by_id($id);

        // Jika data barang tersedia maka akan ditampilkan
        if ($row) {
            $data = array(
                'button' => 'Read',
                'back'   => site_url('barang'),
                'no' => $row->no,
                'kodebarang' => $row->kodebarang,
                'namabarang' => $row->namabarang,
                'kodemerk' => $row->kodemerk,
                'kodejenis' => $row->kodejenis,
                'jumlah' => $row->jumlah,
                'harga' => $row->harga,
                'kondisi' => $row->kondisi,
                
            );
            $this->load->view('header', $dataAdm); // Menampilkan bagian header dan object data users
            $this->load->view('barang/barang_read', $data); // Menampilkan halaman detail barang
            $this->load->view('footer'); // Menampilkan bagian footer
        }
        // Jika data barang tidak tersedia maka akan ditampilkan informasi 'Record Not Found'
        else {
            $this->load->view('header', $dataAdm); // Menampilkan bagian header dan object data users
            $this->session->set_flashdata('message', 'Record Not Found');
            $this->load->view('footer'); // Menampilkan bagian footer
            redirect(site_url('barang'));
        }
    }

    // Fungsi menampilkan form Create Barang
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
            'back'   => site_url('barang'),
            'action' => site_url('barang/create_action'),
            'no' => set_value('no'),
            'kodebarang' => set_value('kodebarang'),
            'namabarang' => set_value('namabarang'),
            'kodemerk' => set_value('kodemerk'),
            'kodejenis' => set_value('kodejenis'),
            'jumlah' => set_value('jumlah'),
            'harga' => set_value('harga'),
            'kondisi' => set_value('kondisi'),
            
        );
        $this->load->view('header',$dataAdm ); // Menampilkan bagian header dan object data users
        $this->load->view('barang/barang_form', $data); // Menampilkan halaman form barang
        $this->load->view('footer'); // Menampilkan bagian footer
    }

    // Fungsi untuk melakukan aksi simpan data
    public function create_action(){

        // Jika session data username tidak ada maka akan dialihkan kehalaman login
        if (!isset($this->session->userdata['username'])) {
            redirect(base_url("login"));
        }

        $this->_rules(); // Rules atau aturan bahwa setiap form harus diisi

        // Jika form barang belum diisi dengan benar
        // maka sistem akan meminta user untuk menginput ulang
        if ($this->form_validation->run() == FALSE) {
            $this->create();
        }
        // Jika form barang telah diisi dengan benar
        // maka sistem akan menyimpan kedalam database
        else {
                $data = array(
                        'no' => $this->input->post('no',TRUE),
                        'kodebarang' => $this->input->post('kodebarang',TRUE),
                        'namabarang' => $this->input->post('namabarang',TRUE),
                        'kodemerk' => $this->input->post('kodemerk',TRUE),
                        'kodejenis' => $this->input->post('kodejenis',TRUE),
                        'jumlah' => $this->input->post('jumlah',TRUE),
                        'harga' => $this->input->post('harga',TRUE),
                        'kondisi' => $this->input->post('kondisi',TRUE),
                );

                $this->BarangModel->insert($data);
                $this->session->set_flashdata('message', 'Create Record Success');
                redirect(site_url('barang'));
            }

    }

    // Fungsi menampilkan form Update Barang
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
        $row = $this->BarangModel->get_by_id($id);

        // Jika id-nya dipilih maka data barang ditampilkan ke form edit barang
        if ($row) {
            $data = array(
                'button' => 'Update',
                'back'   => site_url('barang'),
                'action' => site_url('barang/update_action'),
                'no' => set_value('no', $row->no),
                'kodebarang' => set_value('kodebarang', $row->kodebarang),
                'namabarang' => set_value('namabarang', $row->namabarang),
                'kodemerk' => set_value('kodemerk', $row->kodemerk),
                'kodejenis' => set_value('kodejenis', $row->kodejenis),
                'jumlah' => set_value('jumlah', $row->jumlah),
                'harga' => set_value('harga', $row->harga),
                'kondisi' => set_value('kondisi', $row->kondisi),
            );
            $this->load->view('header',$dataAdm); // Menampilkan bagian header dan object data users
            $this->load->view('barang/barang_form', $data); // Menampilkan form barang
            $this->load->view('footer'); // Menampilkan bagian footer
        }
        // Jika id-nya yang dipilih tidak ada maka akan menampilkan pesan 'Record Not Found'
        else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('barang'));
        }
    }

    // Fungsi untuk melakukan aksi update data
    public function update_action(){

        // Jika session data username tidak ada maka akan dialihkan kehalaman login
        if (!isset($this->session->userdata['username'])) {
            redirect(base_url("login"));
        }

        $this->_rules(); // Rules atau aturan bahwa setiap form harus diisi

        // Jika form barang belum diisi dengan benar
        // maka sistem akan meminta user untuk menginput ulang
        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('no', TRUE));
        }
        // Jika form barang telah diisi dengan benar
        // maka sistem akan melakukan update data barang kedalam database
        else{
                
                // Menampung data yang diinputkan
                $data = array(
                    'no' => $this->input->post('no',TRUE),
                    'kodebarang' => $this->input->post('kodebarang',TRUE),
                    'namabarang' => $this->input->post('namabarang',TRUE),
                    'kodemerk' => $this->input->post('kodemerk',TRUE),
                    'kodejenis' => $this->input->post('kodejenis',TRUE),
                    'jumlah' => $this->input->post('jumlah',TRUE),
                    'harga' => $this->input->post('harga',TRUE),
                    'kondisi' => $this->input->post('kondisi',TRUE),
                );

                $this->BarangModel->update($this->input->post('no', TRUE), $data);
                $this->session->set_flashdata('message', 'Update Record Success');
                redirect(site_url('barang'));
            }
        
    }

     // Fungsi untuk melakukan aksi delete data berdasarkan id yang dipilih
     public function delete($id)
     {
         // Jika session data username tidak ada maka akan dialihkan kehalaman login
         if (!isset($this->session->userdata['username'])) {
             redirect(base_url("login"));
         }
 
         $row = $this->BarangModel->get_by_id($id);
 
         //jika id jurusan yang dipilih tersedia maka akan dihapus
         if ($row) {
             $this->BarangModel->delete($id);
             $this->session->set_flashdata('message', 'Delete Record Success');
             redirect(site_url('barang'));
         } //jika id jurusan yang dipilih tidak tersedia maka akan muncul pesan 'Record Not Found'
         else {
             $this->session->set_flashdata('message', 'Record Not Found');
             redirect(site_url('barang'));
         }
     }

    // Fungsi rules atau aturan untuk pengisian pada form (create/input dan update)
    public function _rules()
    {
        $this->form_validation->set_rules('no', 'no', 'trim|required');
        $this->form_validation->set_rules('kodebarang', 'kodebarang', 'trim|required');
        $this->form_validation->set_rules('namabarang', 'namabarang', 'trim|required');
        $this->form_validation->set_rules('kodemerk', 'kodemerk', 'trim|required');
        $this->form_validation->set_rules('kodejenis', 'kodejenis', 'trim|required');
        $this->form_validation->set_rules('jumlah', 'jumlah', 'trim|required');
        $this->form_validation->set_rules('harga', 'harga', 'trim|required');
        $this->form_validation->set_rules('kondisi', 'kondisi', 'trim|required');
        $this->form_validation->set_rules('no', 'no', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}