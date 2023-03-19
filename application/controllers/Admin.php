<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('mdl_AdminL');
    }

    public function index()
    {
        $this->form_validation->set_rules('nama_petugas', 'Nama_petugas', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        if ($this->form_validation->run() == false) {
            $this->load->view('LoginA/loginA');
        } else {
            $this->_login();
        }
    }

    private function _login()
    {
        $nama = $this->input->post('nama_petugas');
        $password = $this->input->post('password');
        $login = $this->mdl_AdminL->login($nama);

        if($login) 
        {
                if(password_verify($password, $login['password'])) 
                {
                    $data = [
                        'level' => $login['level'],
                        'nama_petugas' => $login['nama_petugas'],
                        'isLogin' => true
                    ];
                    $this->session->set_userdata($data);
                    if($login['level'] == 'admin') {
                        redirect('NewLPA/landing');

                    }else if($login['level'] == 'petugas' ) {
                        redirect('NewLPP/landing');
                    }
                    else {
                        redirect('NewLPM/landing');
                    }

                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    password salah!
                    </div>');
                    redirect('Admin');
                }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Nama tidak ditemukan!
            </div>');
            redirect('Admin');
        }
    }

    public function register()
    {
        $this->form_validation->set_rules('nama_petugas', 'Nama_petugas', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[8]|trim', [
            'min_length' => 'Password to short!'
        ]);
        $this->form_validation->set_rules('username', 'Username', 'required|trim');
        $this->form_validation->set_rules('telp', 'Telp', 'required|trim');
        
        if ( $this->form_validation->run() == false) {
            $this->load->view('LoginA/registerA');
        } else {
            $data = [
                'nama_petugas' => htmlspecialchars($this->input->post('nama_petugas', true)),
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT), 
                'username' => htmlspecialchars($this->input->post('username', true)),
                'telp' => htmlspecialchars($this->input->post('telp', true)),
                'is_active' => 1,
                'level' => 1
            ];

            $this->db->insert('petugas', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                Berhasil ditambahkan!
                  </div>');
                redirect('Admin');
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('Admin');
    }

}