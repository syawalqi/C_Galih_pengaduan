<?php
defined('BASEPATH') or exit('No direct script access allowed');

class mdl_LandingP extends CI_Model
{

	// private $table = 'pengaduan';
	// private $primary_key = 'id_pengaduan';

	// public function create($data)
	// {
	// 	return $this->db->insert($this->table, $data);
	// }

// insert and delete pengaduan

    function insertpengaduan($data)
    {
        $this->db->insert('pengaduan', $data);
    }


    function delete($id)
    {
        $this->db->where('id_pengaduan', $id);
        $this->db->delete('pengaduan');
    }

// |||||||||||||||||||||||||||||||||||||||||||||||



//  Kategori
    function tambah_kategori($data)
    {
        $this->db->insert('kategori', $data);
    }


    
    function editkategori($data, $id)
    {
        $this->db->where('id_kategori', $id);
        $this->db->update('kategori', $data);
    }


    function tambah_subkategori($data)
    {
        $this->db->insert('subkategori', $data);
    }

    function editsubkategori($data, $id)
    {
        $this->db->where('subkategori', $id);
        $this->db->update('subkategori', $data);
    }

    function joinkategori()
    {
        $this->db->select('*');
        $this->db->from('subkategori');
        $this->db->join('kategori', 'kategori.id_kategori=subkategori.id_kategori');
        return $this->db->get();
    }


    function deletekategori($id)
    {
        $this->db->where('id_kategori', $id);
        $this->db->delete('kategori');
    }


    function deletesubkategori($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('subkategori');
    }


    function tampilsubkat()
    {
        return $this->db->get('subkategori');
    }

    function tampilkategori()
    {
        return $this->db->get('kategori');
    }

    function joinsubkat()
    {
        $this->db->select('*');
        $this->db->from('subkategori');
        $this->db->join('kategori', 'kategori.id_kategori=subkategori.id_kategori');
        return $this->db->get();
    }


// ||||||||||||||||||||||||||||||||||||||||||||||||||||||||| pengaduan


    function siji() //asdihauidgadjadsvhj
    {
        $this->db->select('*');
        $this->db->from('tanggapan');
        $this->db->join('petugas', 'petugas.id_petugas=tanggapan.id_petugas');
        $this->db->join('pengaduan', 'pengaduan.id_pengaduan=tanggapan.id_pengaduan');
        // $this->db->where('pengaduan.id_pengaduan');
        $this->db->get();
    }


    function joinpengaduan()
    {
        $this->db->select('*');
        $this->db->from('pengaduan');
        $this->db->join('kategori', 'kategori.id_kategori=pengaduan.kategori');
        return $this->db->get();
    }

    function joinpengaduan2($id)
    {
        $this->db->select('*');
        $this->db->from('pengaduan');
        $this->db->join('kategori', 'kategori.id_kategori=pengaduan.kategori');
        // $this->db->join('subkategori', 'subkategori.id_kategori=pengaduan.kategori');
        $this->db->join('masyarakat', 'masyarakat.nik=pengaduan.nik');
        $this->db->where('pengaduan.id_pengaduan', $id);
        return $this->db->get();
    }

    function joinpengaduandata2()
    {

        $this->db->select('*');
        $this->db->from('pengaduan');
        $this->db->join('kategori', 'kategori.id_kategori=pengaduan.id_pengaduan');
        $this->db->join('subkategori', 'subkategori.id=pengaduan.subkategori');
        $this->db->join('masyarakat', 'masyarakat.nik=pengaduan.nik');
        return $this->db->get();
    }


    function joinpengaduanD2()
    {
        $this->db->select('*');
        $this->db->from('pengaduan');
        $this->db->join('subkategori', 'subkategori.id_kategori=pengaduan.kategori');
        $this->db->join('masyarakat', 'masyarakat.nik=pengaduan.nik');
        return $this->db->get();
    }


    function tambahpengaduan($id)
    {
        $this->db->select('*');
        $this->db->from('tanggapan');
        $this->db->join('pengaduan', 'pengaduan.id_pengaduan=tanggapan.id_pengaduan');
        $this->db->join('petugas', 'petugas.nama_petugas=tanggapan.nama_petugas');
        $this->db->where('pengaduan.id_pengaduan', $id);
        return $this->db->get();
    }


    function tanggapan($id)
    {
        $this->db->select('*');
        $this->db->from('pengaduan');
        $this->db->join('tanggapan', 'tanggapan.id_pengaduan=pengaduan.id_pengaduan');
        $this->db->where('pengaduan.id_pengaduan', $id);
        return $this->db->get();
    }

    function tambahtindakan($data)
    {
        $this->db->insert('tanggapan', $data);
    }
    function tambahtindakan2($update, $id)
    {
        $this->db->where('id_pengaduan', $id);
        $this->db->update('pengaduan', $update);
    }


    function tampilpetugas()
    {
        return $this->db->get('petugas')->result_array();
    }

    function masyarakat()
    {
        return $this->db->get('masyarakat')->result_array();
    }
    
}