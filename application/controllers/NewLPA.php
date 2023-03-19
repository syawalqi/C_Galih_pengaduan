<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class NewLPA extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('mdl_LandingP');
		$this->load->model('mdl_AdminL');
		// $this->load->model('mdl_TanggapanA');
	}

	public function landing()
	{		
		$data['pengaduan']=$this->db->get('pengaduan')->result_array();
		$data['pen']=$this->db->get('pengaduan')->num_rows();
		$data['petugas']=$this->db->get('petugas')->num_rows();
		$data['masyarakat']=$this->db->get('masyarakat')->num_rows();
		$data['joinpengaduan']=$this->mdl_LandingP->joinpengaduan()->result_array();


		$this->load->view('Admin/dashboardA', $data);
	}


    public function pengaduan()
	{
		$data['pengaduan']=$this->db->get('pengaduan')->result_array();
		$data['joinpengaduan'] = $this->mdl_LandingP->joinpengaduanD2()->result_array();


		$this->load->view('Admin/pengaduanA', $data);
	}


    public function tanggapan($id)
	{

		$data['pengaduan'] = $this->mdl_LandingP->joinpengaduan2($id)->result_array();
		$data['tanggapan'] = $this->mdl_LandingP->tambahpengaduan($id)->result_array();


		$this->load->view('Admin/tanggapanA', $data);
	}


    public function masyarakat()
	{
		$data['pe']=$this->db->get('petugas')->num_rows();
		$data['ma']=$this->db->get('masyarakat')->num_rows();
		$data['masyarakat']=$this->db->get('masyarakat')->result_array();


		$this->load->view('Admin/masyarakatA', $data);
	}


    public function petugas()
	{
		$data['pe']=$this->db->get('petugas')->num_rows();
		$data['masyarakat']=$this->db->get('masyarakat')->num_rows();
		$data['petugas']=$this->db->get('petugas')->result_array();


		$this->load->view('Admin/petugasA', $data);
	}
	public function tambahdatapetugas()
	{
		$this->form_validation->set_rules('nama_petugas', 'Nama_petugas', 'reqiured|trim');
		$this->form_validation->set_rules('username', 'Username', 'reqiured|trim');
		$this->form_validation->set_rules('telp', 'Telp', 'reqiured|trim');
		$this->form_validation->set_rules('password', 'Password', 'reqiured|trim');
		$this->form_validation->set_rules('level', 'Level', 'reqiured|trim');

		$data = [
			'nama_petugas' => htmlspecialchars($this->input->post('nama_petugas')),
			'username' => htmlspecialchars($this->input->post('username')),
			'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
			'telp' => htmlspecialchars($this->input->post('telp')),
			'level' => htmlspecialchars($this->input->post('level'))
		];

		$this->mdl_AdminL->tambahdatapetugas($data);
		redirect('NewLPA/petugas');
	}


    public function kategori()
	{

		$data['kategori']=$this->db->get('kategori')->result_array();
		$data['joinkategori']=$this->mdl_LandingP->joinkategori()->result_array();
		$data['subkategori']=$this->db->get('subkategori')->result_array();
		$data['kat']=$this->db->get('kategori')->num_rows();
		$data['subk']=$this->db->get('subkategori')->num_rows();


		$this->load->view('Admin/kategoriA', $data);
	}


// tambah data kategori /kategori
	public function tambahkategori()
	{
		$data=[
            // 'id_kategori' => $this->input->post('id_kategori'),
            'kategori' => $this->input->post('kategori'),
        ];

        $this->load->model('mdl_LandingP');
        $this->mdl_LandingP->tambah_kategori($data);
        redirect('NewLPA/kategori');
	}

	// deletekategori
		public function deletekategori($id)
		{
			$this->load->model('mdl_LandingP');
			$this->mdl_LandingP->deletekategori($id);
			redirect('NewLPA/kategori');
		}



	// tambah data kategori /kategori
	public function tambahsubkategori()
	{
		$data=[
            // 'id_kategori' => $this->input->post('id_kategori'),
            'id_kategori' => $this->input->post('kategori'),
            'subkategori' => $this->input->post('subkategori'),
        ];

        $this->load->model('mdl_LandingP');
		$this->mdl_LandingP->joinkategori();
        $this->mdl_LandingP->tambah_subkategori($data);
        redirect('NewLPA/kategori');
	}


	
	// deletekategori
	public function deletesubkategori($id)
    {
        $this->load->model('mdl_LandingP');
        $this->mdl_LandingP->deletesubkategori($id);
        redirect('NewLPA/kategori');
    }


	public function editkategori($id)
    {
        $data=[
            'kategori'  => $this->input->post('kategori'),
        ];

        $this->load->model('mdl_LandingP');
        $this->mdl_LandingP->editkategori($data, $id);
        redirect('NewLPA/kategori');
    }


	public function editsubkategori($id)
    {
        $data=[
            'subkategori'  => $this->input->post('subkategori'),
        ];

        $this->load->model('mdl_LandingP');
        $this->mdl_LandingP->editsubkategori($data, $id);
        redirect('NewLPA/kategori');
    }



	public function inserttindakanpengaduan($id)
    {
        $data = [
            'id_pengaduan' => $id,
            'tgl_tanggapan' => date('Y-m-d'),
            'tanggapan' => $this->input->post('tanggapan'),
            'nama_petugas' => $this->session->userdata('nama_petugas'),
        ];

        $this->mdl_LandingP->tambahtindakan($data);

        $update = [
            'status' => $this->input->post('status'),
        ];

        $this->mdl_LandingP->tambahtindakan2($update, $id);
        $this->session->set_flashdata('tindakan', '<div class="alert alert-success" role="alert"> Data berhasil di tambahkan </div>');
        redirect('NewLPA/pengaduan');
    }


	public function laporan_pdf()
    {
        $data['masyarakat'] = $this->mdl_LandingP->masyarakat();
		$data['petugas'] = $this->mdl_LandingP->tampilpetugas();
        $data['pengaduan'] = $this->mdl_LandingP->joinpengaduanD2()->result_array();

        // $data = array(
        //     "dataku" => array(
        //         "nama" => "Petani Kode",
        //         "url" => "http://petanikode.com"
        //     ),
        //     'pengaduan' => $pengaduan
        // );
    
        $this->load->library('pdf');
        $data['title'] = 'Laporan';
        $this->pdf->setPaper('A4', 'potrait');
        $this->pdf->filename = "laporan_Rakyat.pdf";
        $this->pdf->load_view('Admin/rakyatA', $data);
    
    
    }



}