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
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        if ($this->form_validation->run() == false) {
            $this->load->view('galih_login');
        } else {
            $this->_login();
        }
    }

    private function _login()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $login = $this->db->get_where('masyarakat', ['email' => $email])->row_array();

        if($login) 
        {
            // jika belum
            if($login['is_active'] == 1) 
            {
                // jika sudah
                
                if(password_verify($password, $login['password'])) 
                {
                    $data = [
                        'email' => $login['email'],
                        'level' => $login['level'],
                        'nama' => $login['nama'],
                        'isLogin' => true
                    ];
                    $this->session->set_userdata($data);
                    if($login['level'] == 1) {
                        redirect('Galih_admin');

                    }else if($login['level'] == 2 ) {
                        redirect('Galih_resepsionis');
                    }
                    else {
                        redirect('Galih_user');
                    }

                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    password salah!
                    </div>');
                    redirect('galih_login');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Email tidak aktif!
                </div>');
                redirect('galih_login');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Email tidak ditemukan!
            </div>');
            redirect('galih_login');
        }
    }

    public function register()
    {
        $this->form_validation->set_rules('nama', 'Nama', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[galih_user.email]', [
            'is_unique' => 'Email is already taken!'
        ]);
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[8]|trim', [
            'min_length' => 'Password to short!'
        ]);
        $this->form_validation->set_rules('username', 'Username', 'required|trim');
        $this->form_validation->set_rules('tempat_lahir', 'Tempat_lahir', 'required|trim');
        $this->form_validation->set_rules('tgl_lahir', 'Tgl_lahir', 'required|trim');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim');
        
        if ( $this->form_validation->run() == false) {
            $this->load->view('galih_register');
        } else {
            $data = [
                'nama' => htmlspecialchars($this->input->post('nama', true)),
                'username' => htmlspecialchars($this->input->post('username', true)),
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT), 
                'email' => htmlspecialchars($this->input->post('email', true)),
                'tempat_lahir' => htmlspecialchars($this->input->post('tempat_lahir', true)),
                'tgl_lahir' => $this->input->post('tgl_lahir', true),
                'alamat' => htmlspecialchars($this->input->post('alamat', true)),
                'is_active' => 1,
                'level' => 3
            ];

            $this->db->insert('masyarakat', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                Berhasil ditambahkan!
                  </div>');
                redirect('Galih_login');
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('Galih_user');
    }


    // public function elseifsss($var = '5')
    // {
    //     if ($var > 50) {
    //         echo "Besar";
    //     }elseif($var> 30){
    //         echo "menengah";
    //     }else{
    //         echo "apa oini";
    //     }
    // }

}