<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Galih_login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }

    public function index()
    {

            $this->load->view('landingP');

    }

    public function login()
    {
        $this->form_validation->set_rules('nama', 'Nama', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        if ($this->form_validation->run() == false) {
            $this->load->view('galih_login');
        } else {
            $this->_login();
        }
    }

    private function _login()
    {
        $nama = $this->input->post('nama');
        $password = $this->input->post('password');
        $login = $this->mdl_Newlogin->login($nama);

        if($login) 
        {
                if(password_verify($password, $login['password'])) 
                {
                    $data = [
                        'nik' => $login['nik'],
                        'level' => $login['level'],
                        'nama' => $login['nama'],
                        'isLogin' => true
                    ];
                    $this->session->set_userdata($data);
                    if($login['level'] == 1) {
                        redirect('NewLPA/landing');

                    }else if($login['level'] == 2 ) {
                        redirect('NewLPP/landing');
                    }
                    else {
                        redirect('NewLPM/landing');
                    }

                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    password salah!
                    </div>');
                    redirect('galih_login/login');
                }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Nama tidak ditemukan!
            </div>');
            redirect('galih_login/login');
        }
    }

    public function register()
    {
        $this->form_validation->set_rules('nik', 'Nik', 'required|trim');
        $this->form_validation->set_rules('nama', 'Nama', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[8]|trim', [
            'min_length' => 'Password to short!'
        ]);
        $this->form_validation->set_rules('username', 'Username', 'required|trim');
        $this->form_validation->set_rules('telp', 'Telp', 'required|trim');
        
        if ( $this->form_validation->run() == false) {
            $this->load->view('galih_register');
        } else {
            $data = [
                'nik' => htmlspecialchars($this->input->post('nik', true)),
                'nama' => htmlspecialchars($this->input->post('nama', true)),
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT), 
                'username' => htmlspecialchars($this->input->post('username', true)),
                'telp' => htmlspecialchars($this->input->post('telp', true)),
                'level' => 3
            ];

            $this->db->insert('masyarakat', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                Berhasil ditambahkan!
                  </div>');
                redirect('Galih_login/login');
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('Galih_login');
    }


}