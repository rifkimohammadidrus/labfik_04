<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Surat extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('user_model');
		$this->load->model('m_ifik003');
	}
	public function index()
	{
		$roleID  = $this->session->userdata('role_id');
		if ($roleID == '7' or $roleID == '8') {
			redirect('user');
		} else if ($roleID == '9' or $roleID == '10' or $roleID == '11') {
			redirect('suratTugas');
		} else if ($roleID == 4) {
			redirect('mahasiswa');
		} else if ($roleID == 12 or $roleID == 3 or $roleID == 13 or $roleID = 14) {
			redirect('kemahasiswaan');
			// } else if ($roleID == 3) {
			// 	redirect('dosen');
		}
	}
	public function flash_surat_tugas()
	{
		$this->session->userdata('role_id');
		$this->session->set_flashdata('massage', '<div class="alert alert-danger" role="alert">Surat gagal ditolak, Mohon pilih kolom yang harus direvisi dan berikan catatan! </div>');
		redirect('suratTugas/surat_tugas');
	}
}
