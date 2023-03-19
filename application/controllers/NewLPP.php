<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class NewLPP extends CI_Controller {

// construct
	public function __construct()
	{
		parent::__construct();
		$this->load->model('mdl_LandingP');
	}

// landing
	public function landing()
	{		
		$data['pengaduan']=$this->db->get('pengaduan')->result_array();
		$data['joinpengaduan']=$this->mdl_LandingP->joinpengaduan()->result_array();


		$this->load->view('Petugas/dashboardP', $data);
	}


// masyarakat
	public function masyarakat()
	{

		$data['masyarakat']=$this->db->get('masyarakat')->result_array();


		$this->load->view('Petugas/masyarakatP', $data);
	}

// pengaduan
	public function pengaduan()
	{		

		$data['pengaduan']=$this->db->get('pengaduan')->result_array();
		$data['joinpengaduan'] = $this->mdl_LandingP->joinpengaduanD2()->result_array();


		$this->load->view('Petugas/pengaduanP', $data);
	}


	public function response($id)
	{		
		
		$data['pengaduan'] = $this->mdl_LandingP->joinpengaduan2($id)->result_array();
        $data['tanggapan'] = $this->mdl_LandingP->tambahpengaduan($id)->result_array();

		$this->load->view('Petugas/responseP', $data);
	}

// Kategori
	public function kategori()
	{
		$data['kat']=$this->db->get('kategori')->num_rows();
		$data['subk']=$this->db->get('subkategori')->num_rows();
		$data['kategori']=$this->db->get('kategori')->result_array();
		$data['joinkategori']=$this->mdl_LandingP->joinkategori()->result_array();
		$data['subkategori']=$this->db->get('subkategori')->result_array();


		$this->load->view('Petugas/kategoriP', $data);
	}


	public function inserttindakanpengaduan2($id)
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
        redirect('NewLPP/pengaduan');
    }


}