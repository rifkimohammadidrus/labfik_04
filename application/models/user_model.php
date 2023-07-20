<?php

class User_model extends CI_Model
{
    // surat tugas
    public function getRole($where)
    {
        $roleUser = $this->db->get_where('user_role', $where)->row_array();
        return $roleUser['role'];
    }
    function get_data()
    {
        return $this->db->get('surat_tugas');
    }
    function search_nama_kegiatan($nama_kegiatan)
    {
        $this->db->distinct('nama_kegiatan');
        $this->db->like('nama_kegiatan', $nama_kegiatan, 'both');
        $this->db->group_by('nama_kegiatan', 'ASC');
        $this->db->limit(10);
        return $this->db->get('surat_tugas')->result();
    }
    function search_nip($nip)
    {
        $this->db->distinct('nip');
        $this->db->like('nip', $nip, 'both');
        $this->db->group_by('nip', 'ASC');
        $this->db->limit(10);
        return $this->db->get('user')->result();
    }
    function search_ememo($no_ememo)
    {
        $this->db->distinct('no_ememo');
        $this->db->like('no_ememo', $no_ememo, 'both');
        $this->db->group_by('no_ememo');
        $this->db->limit(10);
        return $this->db->get('surat_tugas')->result();
    }
    function search_periode_penugasan($periode_penugasan)
    {
        $this->db->distinct('periode_penugasan');
        $this->db->like('periode_penugasan', $periode_penugasan, 'both');
        $this->db->group_by('periode_penugasan', 'ASC');
        $this->db->limit(10);
        return $this->db->get('surat_tugas')->result();
    }
    function search_stat($status)
    {
        $this->db->like('status', $status, 'both');
        $this->db->order_by('status', 'ASC');
        return $this->db->get('status_surat_tugas')->result();
    }
    //suratRekomendasi
    function get_nim($nim)
    {
        $this->db->like('nim', $nim, 'both');
        $this->db->order_by('nim', 'ASC');
        $this->db->limit(10);
        return $this->db->get('user')->result();
    }
    function search_nimMhs($nim)
    {
        $this->db->distinct('user.nim');
        $this->db->from('user');
        $this->db->join('surat_kmhs', 'surat_kmhs.id_mhs=user.id', 'left');
        $this->db->where('surat_kmhs.id_mhs = user.id ');
        $this->db->like('user.nim', $nim, 'both');
        $this->db->group_by('user.nim');
        $this->db->limit(10);
        return $this->db->get()->result();
    }
    function search_namaMhs($name)
    {

        $this->db->distinct('user.name');
        $this->db->from('user');
        $this->db->join('surat_kmhs', 'surat_kmhs.id_mhs=user.id', 'left');
        $this->db->where('surat_kmhs.id_mhs = user.id ');
        $this->db->like('user.name', $name, 'both');
        $this->db->group_by('user.name');
        $this->db->limit(10);
        return $this->db->get()->result();
    }
    function search_prodiMhs($prodi)
    {

        $this->db->distinct('user.prodi');
        $this->db->from('user');
        $this->db->join('surat_kmhs', 'surat_kmhs.id_mhs=user.id', 'left');
        $this->db->where('surat_kmhs.id_mhs = user.id ');
        $this->db->like('user.prodi', $prodi, 'both');
        $this->db->group_by('user.prodi');
        $this->db->limit(10);
        return $this->db->get()->result();
    }
    function search_typeSurat($type_surat)
    {
        $this->db->from('surat_kmhs');
        $this->db->like('type_surat', $type_surat, 'both');
        $this->db->order_by('type_surat', 'ASC');
        $this->db->limit(10);
        return $this->db->get()->result();
    }

    function search_statusMhs($status)
    {
        $this->db->like('status', $status, 'both');
        $this->db->order_by('status', 'ASC');
        $this->db->limit(10);
        return $this->db->get('status_surat_kmhs')->result();
    }
}
