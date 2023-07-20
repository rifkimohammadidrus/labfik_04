<?php

class Alamat_model extends CI_Model
{
    public function getProv()
    {
        return $this->db->get('provinsi')->result();
    }
    public function getKota()
    {
        return $this->db->get('kabupaten')->result();
    }
    public function getKecamatan()
    {
        return $this->db->get('kecamatan')->result();
    }
    public function getKelurahan()
    {
        return $this->db->get('kelurahan')->result();
    }

    public function getKab($id_prov)
    {
        $this->db->where('id_prov', $id_prov);
        $this->db->order_by('nama', 'ASC');
        return $this->db->get('kabupaten')->result();
    }

    public function getKec($id_kab)
    {
        $this->db->where('id_kab', $id_kab);
        $this->db->order_by('nama', 'ASC');
        return $this->db->get('kecamatan')->result();
    }

    public function getKel($id_kec)
    {
        $this->db->where('id_kec', $id_kec);
        $this->db->order_by('nama', 'ASC');
        return $this->db->get('kelurahan')->result();
    }
}
