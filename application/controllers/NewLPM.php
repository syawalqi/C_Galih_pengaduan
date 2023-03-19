<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class NewLPM extends CI_Controller {


	public function __construct()
	{
		parent::__construct();
        $this->load->library('form_validation','upload');
		$this->load->model('mdl_LandingP');
	}

	public function landing()
	{
		$data['pengaduan']=$this->db->get('pengaduan')->result_array();
        $data['pe']=$this->db->get('pengaduan')->num_rows();
        $data['joinpengaduan']=$this->mdl_LandingP->joinpengaduan()->result_array();

        
		$this->load->view('Masyarakat/dashboardM', $data);
	}


    public function pengaduan()
	{
		$data['pengaduan']=$this->db->get('pengaduan')->result_array();
		$data['pe']=$this->db->get('pengaduan')->num_rows();
		$data['kategori']=$this->db->get('kategori')->result_array();
		$data['id_kategori']=$this->db->get('kategori')->result_array();
        // $data['data_pengaduan'] = $this->Pengaduan_m->data_pengaduan_masyarakat_nik($masyarakat['nik'])->result_array();

		$this->load->view('Masyarakat/pengaduanM', $data);

	}



    public function pengaduanbaru()
	{
		$data['pengaduan']=$this->db->get('pengaduan')->result_array();
		$data['pe']=$this->db->get('pengaduan')->num_rows();
		$data['kategori']=$this->db->get('kategori')->result_array();
		$data['id_kategori']=$this->db->get('kategori')->result_array();
		$data['joinpengaduan']=$this->mdl_LandingP->joinpengaduan()->result_array();
        // $data['data_pengaduan'] = $this->Pengaduan_m->data_pengaduan_masyarakat_nik($masyarakat['nik'])->result_array();

		$this->load->view('Masyarakat/pengaduantM', $data);

	}

    public function response($id)
	{
        $data['joinpengaduan2'] = $this->mdl_LandingP->joinpengaduan2($id)->result_array();
        $data['tanggapan'] = $this->mdl_LandingP->tanggapan($id)->result_array();

		$this->load->view('Masyarakat/responseM', $data);
	}


    public function tutorial()
	{
		// $data['pengaduan']=$this->db->get('pengaduan')->result_array();

		$this->load->view('Masyarakat/tutorialM');

	}


	public function delete($id)
    {
        $this->load->model('mdl_LandingP');
        $this->mdl_LandingP->delete($id);
        redirect('NewLPM/pengaduanbaru');
    }


	public function insertpengaduan()
    {

        $config['upload_path']          =  './assets/img/';
        $config['allowed_types']        = 'gif|jpg|png|jpeg';

        $this->upload->initialize($config);

        $this->upload->do_upload('foto');
        $upload_foto = $this->upload->data('file_name');

		$data = array(
            'nik' => $this->session->userdata('nik'),
            'tgl_pengaduan' => date('y-m-d'),
            'subkategori' => $this->input->post('subkategori'),
            'kategori' => $this->input->post('kategori'),
            'isi_laporan' => $this->input->post('isi'),
            'foto' => $upload_foto, 
            'status' => 'segera'
		); 

        $this->mdl_LandingP->insertpengaduan($data);
        $this->session->set_flashdata('NewLPM/pengaduanbaru', '<div class="alert alert-success" role="alert"> Berhasil ditambahkan! </div>');
        redirect('NewLPM/pengaduanbaru');
    }

    public function get_sub_kategori()
    {
        $id_kategori = $this->input->post('id');
        $subkategori = $this->db->get_where('subkategori', ['id_kategori' => $id_kategori])->result();
        echo json_encode($subkategori);
    }



}