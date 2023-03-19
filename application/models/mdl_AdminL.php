<?php
defined('BASEPATH') or exit('No direct script access allowed');

class mdl_AdminL extends CI_Model
{
    function login($nama)
    {
        return $this->db->get_where('petugas', ['nama_petugas' => $nama])->row_array();
    }

    function tambahdatapetugas($data)
    {
        $this->db->insert('petugas', $data);
    }








    
    // function pisahuser($id)
    // {
    //     $this->db->select('*');
    //     $this->db->from('isi_data');
    //     // $this->db->join('user_id', $id);
    //     $this->db->where('user_id', $id);
    //     return $this->db->get();
    // }
}