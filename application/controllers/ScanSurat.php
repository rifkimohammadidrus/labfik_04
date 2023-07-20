<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ScanSurat extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('pdf');
        $this->load->helper('url', 'date');
        // Load model
        $this->load->model('User_model');
        $this->load->model('m_suratTugas');
        $this->load->model('m_suratRekomendasi');
        $this->load->model('Alamat_model', 'daerah');
    }

    //Surat Tugas
    public function getSuratTugas($idSurat = NULL)
    {
        $data['surat'] = $this->m_suratTugas->getSuratbyID($idSurat);
        $data['title'] = $this->User_model->getRole(['id' => $this->session->userdata('role_id')]);
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['status'] = $this->m_suratTugas->getKeteranganStatus();
        $data['dekan'] = $this->m_suratTugas->getRoleDekan();
        $user = $this->m_suratTugas->getUserData($data['surat']);
        $data['dosen'] = array_column($user, null, 'id');
        $tipeSurat = $data['surat'][0]->jenis_penugasan;
        if ($tipeSurat == 'Kepanitiaan') {
            $data['tgl'] = $this->m_suratTugas->tgl_surat($data['surat']);
            $data['hari'] = $this->m_suratTugas->hari($data['surat']);
            $this->load->library('pdf');
            $this->pdf->setFileName('Surat Tugas.pdf');
            $this->pdf->setPaper('A4', 'portrait');
            $this->pdf->loadView('print_surat_kelompok', $data);
        } else {
            $data['tgl'] = $this->m_suratTugas->tgl_surat($data['surat']);
            $data['hari'] = $this->m_suratTugas->hari($data['surat']);
            $this->load->library('pdf');
            $this->pdf->setFileName('Surat Tugas.pdf');
            $this->pdf->setPaper('A4', 'portrait');
            $this->pdf->loadView('print_surat_perorang', $data);
        }
    }
    public function getSuratKmhs($idSurat = NULL)
    {

        $data['surat'] = $this->m_suratRekomendasi->getSuratbyID($idSurat);
        // $data['title'] = $this->User_model->getRole(['id' => $this->session->userdata('role_id')]);
        // $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $user = $this->m_suratRekomendasi->getUserData($data['surat']);
        $data['mhs'] = array_column($user, null, 'id');
        $data['approver'] = $this->m_suratRekomendasi->getApproverRole($data['surat']);

        $data['provinsi'] = $this->daerah->getProv();
        $data['kota'] = $this->daerah->getKota();
        $data['kec'] = $this->daerah->getKecamatan();
        $data['kel'] = $this->daerah->getKelurahan();
        $data['namaProvinsi'] = array_column($data['provinsi'], 'nama', 'id_prov');
        $data['namaKota'] = array_column($data['kota'], 'nama', 'id_kab');
        $data['namaKecamatan'] = array_column($data['kec'], 'nama', 'id_kec');
        $data['namaKelurahan'] = array_column($data['kel'], 'nama', 'id_kel');

        $data['tgl'] = $this->m_suratRekomendasi->tgl_surat($data['surat']);
        // print_r($data['surat']);

        $jenisSurat = $data['surat'][0]->jenis_surat;

        if ($jenisSurat == 'Keterangan') {
            $this->load->library('pdf');
            $this->pdf->setFileName('Surat Tugas.pdf');
            $this->pdf->setPaper('A4', 'portrait');
            $this->pdf->loadView('print_surat_kelakuanBaik', $data);
        } else if ($jenisSurat == 'Rekomendasi') {
            $this->load->library('pdf');
            $this->pdf->setFileName('Surat Tugas.pdf');
            $this->pdf->setPaper('A4', 'portrait');
            $this->pdf->loadView('print_surat_Rekomendasi', $data);
        }
    }
}
