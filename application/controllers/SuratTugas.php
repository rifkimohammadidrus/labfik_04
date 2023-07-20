<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SuratTugas extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->helper('url');
        $this->load->model('User_model');
        $this->load->model('m_suratTugas');
        $this->load->library('form_validation');
    }
    public function index()
    {
        $data['title'] = $this->User_model->getRole(['id' => $this->session->userdata('role_id')]);
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('template/header', $data);
        $this->load->view('template/navbar', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('suratTugas/index');
        $this->load->view('template/footer');
    }
    public function surat_tugas()
    {
        $idSurat = $this->input->post('idSurat');
        $data['surat'] = $this->m_suratTugas->getSuratbyID($idSurat);
        $data['title'] = $this->User_model->getRole(['id' => $this->session->userdata('role_id')]);
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $roleID  = $this->session->userdata('role_id');
        $nip = $data['user']['nip'];
        $data['surat'] = $this->m_suratTugas->get_SuratTugas($roleID, $nip);
        $data['status'] = $this->m_suratTugas->getKeteranganStatus();
        //pagination
        $this->load->database();

        $jumlah_data = $this->m_suratTugas->get_JumlahSurat($roleID, $nip);
        $this->load->library('pagination');

        $config['base_url'] = base_url() . "suratTugas/surat_tugas/";
        $config['total_rows'] = $jumlah_data;
        $config['per_page'] = 6;
        $data_start['start'] = $this->uri->segment(3);

        $this->pagination->initialize($config);
        $data['jumlahSurat'] = $jumlah_data;
        $data['surat'] = $this->m_suratTugas->get_SuratPagination($roleID, $nip, $config['per_page'], $data_start['start']);

        // print_r($data['surat']);
        // die;
        $user = $this->m_suratTugas->getUserData($data['surat']);
        $data['dosen'] = array_column($user, null, 'id');
        $this->load->view('template/header', $data);
        $this->load->view('template/navbar', $data);
        $this->load->view('template/sidebar');
        $this->load->view('suratTugas/surat_tugas', $data);
        $this->load->view('template/footer');
    }
    public function getRoleId()
    {
        $this->db->select('role_id');
        $this->db->where('id', $this->input->post('user_id'));
        $role_idSurat = $this->db->get('user')->result_array();
        return $role_idSurat;
    }
    public function action()
    {
        $idSurat = $this->input->post('idSurat');
        // $noSurat = $this->input->post('noSurat');
        $ctt = $this->input->post('keterangan');
        $revisi = $this->input->post('check');
        $role_idSurat = $this->getRoleId();
        // print_r($role_idSurat);
        // die;
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required');
        $data['status'] = $this->m_suratTugas->getKeteranganStatus();
        if ($this->form_validation->run() == true) {
            $roleID  = $this->session->userdata('role_id');
            $actionType = $this->input->post('action');
            if ($roleID == '9') { // ketua kk
                if ($actionType == 'Reject') {
                    $stat = '3';
                } else if ($actionType == 'Accept') {
                    $stat = '2';
                } else if ($actionType == 'Reset') {
                    $stat = '1';
                }
            } else if ($roleID == '10') { //kaprodi 
                if ($actionType == 'Reject') {
                    $stat = '6';
                } else if ($actionType == 'Accept') {
                    $stat = '5';
                } else if ($actionType == 'Reset') {
                    $stat = '1';
                }
            } else if ($roleID == '11') { //sekre fak
                if ($actionType == 'Reject') {
                    $stat = '9';
                } else if ($actionType == 'Accept') {
                    $stat = '8';
                    $noSurat = $this->input->post('noSurat');
                    $this->load->library('ciqrcode');

                    $config['cacheable']    = true;
                    $config['cachedir']     = './assets/';
                    $config['errorlog']     = './assets/';
                    $config['imagedir']     = './assets/img/qrcode/'; //direktori penyimpanan qr code
                    $config['quality']      = true;
                    $config['size']         = '1024';
                    $config['black']        = array(224, 255, 255);
                    $config['white']        = array(70, 130, 180);
                    $this->ciqrcode->initialize($config);

                    $qr_code = $idSurat . '.png';
                    $params['data'] = base_url() . "scanSurat/getSuratTugas/" . $idSurat;
                    $params['level'] = 'H'; //H=High
                    $params['size'] = 10;
                    $params['savename'] = FCPATH . $config['imagedir'] . $qr_code;
                    $this->ciqrcode->generate($params);
                } else if ($actionType == 'Reset') {
                    foreach ($role_idSurat as $row) {
                        if ($row['role_id'] == 7) {
                            $stat = '2';
                        } else if ($row['role_id'] == 8) {
                            $stat = '5';
                        }
                    }
                }
            }
            $this->m_suratTugas->updateStatus($stat, $idSurat, $ctt, implode(",", $revisi), $noSurat, $qr_code);
            redirect('suratTugas/surat_tugas');
        } else {
            redirect('surat/flash_surat_tugas');
        }
    }
    public function search()
    {

        if ($this->input->post('submit')) {
            $sortPencarian = $this->input->post('sortPencarian');
            $querySearch = $this->input->post('keywordPencarian');
            // if ($querySearch == null) {
            //     redirect("suratTugas/surat_tugas");
            // }
            $this->session->set_userdata('querySearch', $querySearch);
            $this->session->set_userdata('sortPencarian', $sortPencarian);
        } else {
            $sortPencarian = $this->session->userdata('sortPencarian');
            $querySearch = $this->session->userdata('sortPencarian');
        }

        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = $this->User_model->getRole(['id' => $this->session->userdata('role_id')]);
        $roleID  = $this->session->userdata('role_id');
        $nipKaprodi = $data['user']['nip'];
        $jumlahFoundSearch = $this->m_suratTugas->getJumlahSearchSurat($roleID, $nipKaprodi,  $querySearch, $sortPencarian);
        $foundSurat = $this->m_suratTugas->getSearchSurat($roleID, $nipKaprodi, $querySearch, $sortPencarian);
        $data['surat'] = $foundSurat;

        //pagination
        $this->load->database();

        $jumlah_data = $jumlahFoundSearch;
        $this->load->library('pagination');

        $config['base_url'] = base_url() . "suratTugas/surat_tugas";
        $config['total_rows'] = $jumlah_data;

        $config['per_page'] = 5;
        $data_start['start'] = $this->uri->segment(3);



        $this->pagination->initialize($config);
        $foundSuratPagination = $this->m_suratTugas->getSearchSuratPagination($roleID,  $nipKaprodi, $querySearch, $sortPencarian, $config['per_page'], $data_start['start']);
        $data['surat'] = $foundSuratPagination;
        $data['jumlahSurat'] = $jumlahFoundSearch;
        $user = $this->m_suratTugas->getUserData($data['surat']);
        $data['dosen'] = array_column($user, null, 'id');
        $data['status'] = $this->m_suratTugas->getKeteranganStatus();
        $this->load->view('template/header', $data);
        $this->load->view('template/navbar', $data);
        $this->load->view('template/sidebar');
        $this->load->view('suratTugas/surat_tugas', $data);
        $this->load->view('template/footer');
    }
    public function printSurat()
    {
        // header_remove();

        $idSurat = $this->input->post('idSurat');
        $data['surat'] = $this->m_suratTugas->getSuratbyID($idSurat);
        $data['kaprodikk'] = $this->m_suratTugas->getDataKaprodiKK($data['surat']);
        $data['title'] = $this->User_model->getRole(['id' => $this->session->userdata('role_id')]);
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['status'] = $this->m_suratTugas->getKeteranganStatus();
        $data['dekan'] = $this->m_suratTugas->getRoleDekan();
        $user = $this->m_suratTugas->getUserData($data['surat']);
        $data['dosen'] = array_column($user, null, 'id');
        $data['tgl'] = $this->m_suratTugas->tgl_surat($data['surat']);
        $data['hari'] = $this->m_suratTugas->hari($data['surat']);
        $actionType = $this->input->post('printSurat');
        if ($actionType == 'printSuratKelompok') {
            $this->load->library('pdf');
            $this->pdf->setFileName('Surat Tugas.pdf');
            $this->pdf->setPaper('A4', 'portrait');
            $this->pdf->loadView('user/print_surat_kelompok', $data);
        } else if ($actionType == 'printSuratPerorangan') {
            $this->load->library('pdf');
            $this->pdf->setFileName('Surat Tugas.pdf');
            $this->pdf->setPaper('A4', 'portrait');
            $this->pdf->loadView('user/print_surat_perorang', $data);
        }
    }
    //input surat sekre Fakultas
    public function inputSurat()
    {
        $role = $this->session->userdata('role_id');
        if ($role == 11) {
            $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
            $this->form_validation->set_rules('nama_kegiatan', 'Nama_kegiatan', 'required|trim|callback_nama_kegiatan_check[similarity]');
            if ($this->form_validation->run() == false) {
                $data['surat_tugas'] = $this->User_model->get_data()->result();
                $data['title'] = $this->User_model->getRole(['id' => $this->session->userdata('role_id')]);
                $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
                $this->load->view('template/header', $data);
                $this->load->view('template/navbar');
                $this->load->view('template/sidebar');
                $this->load->view('suratTugas/inputSurat', $data);
                $this->load->view('template/footer');
            } else {
                $this->load->library('upload');
                $image = array();
                $ImageCount = count($_FILES['eviden']['name']);
                for ($i = 0; $i < $ImageCount; $i++) {
                    $_FILES['file']['name']       = $_FILES['eviden']['name'][$i];
                    $_FILES['file']['type']       = $_FILES['eviden']['type'][$i];
                    $_FILES['file']['tmp_name']   = $_FILES['eviden']['tmp_name'][$i];
                    $_FILES['file']['error']      = $_FILES['eviden']['error'][$i];
                    $_FILES['file']['size']       = $_FILES['eviden']['size'][$i];

                    $config['upload_path']          = './assets/eviden/';
                    $config['allowed_types']        = 'pdf|jpg|png|jpeg';

                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);

                    if ($this->upload->do_upload('file')) {
                        $imageData = $this->upload->data();
                        $dataEviden[$i] = $imageData['file_name'];
                        $eviden = json_encode(implode(",",  $dataEviden));
                    }
                }
                if (!empty($eviden)) {
                    $data = [
                        'user_id' => htmlspecialchars($this->input->post('user_id', true)),
                        'nip_kaprodikk' => $data['user']['nip'],
                        'nama_kegiatan' => htmlspecialchars($this->input->post('nama_kegiatan', true)),
                        'tanggal_kegiatan' => htmlspecialchars($this->input->post('tanggal_kegiatan', true)),
                        'no_ememo' => htmlspecialchars($this->input->post('no_ememo', true)),
                        'nip' =>  json_encode(implode(",", $this->input->post('nip'))),
                        'divisi' =>  json_encode(implode(",", $this->input->post('divisi'))),
                        'jenis_penugasan' => htmlspecialchars($this->input->post('jenis_penugasan')),
                        'tempat_kegiatan' => htmlspecialchars($this->input->post('tempat_kegiatan')),
                        'periode_penugasan' => $this->input->post('periode_penugasan'),
                        'penyelenggara' => htmlspecialchars($this->input->post('penyelenggara'))
                    ];
                    // print_r($data);
                    // // $this->m_suratTugas->insertSurat($eviden, $data);
                    // die;
                    $this->m_suratTugas->insertSuratSekreFak($eviden, $data);
                    redirect('suratTugas/surat_tugas');
                }

                // $data = [
                //     'user_id' => htmlspecialchars($this->input->post('user_id', true)),
                //     'nip_kaprodikk' => $data['user']['nip'],
                //     'nama_kegiatan' => htmlspecialchars($this->input->post('nama_kegiatan', true)),
                //     'tanggal_kegiatan' => htmlspecialchars($this->input->post('tanggal_kegiatan', true)),
                //     'no_ememo' => htmlspecialchars($this->input->post('no_ememo', true)),
                //     'nip' =>  json_encode(implode(",", $this->input->post('nip'))),
                //     'divisi' =>  json_encode(implode(",", $this->input->post('divisi'))),
                //     'jenis_penugasan' => htmlspecialchars($this->input->post('jenis_penugasan')),
                //     'tempat_kegiatan' => htmlspecialchars($this->input->post('tempat_kegiatan')),
                //     'periode_penugasan' => htmlspecialchars($this->input->post('periode_penugasan')),
                //     'penyelenggara' => htmlspecialchars($this->input->post('penyelenggara'))
                // ];
                // $this->m_suratTugas->insertSuratSekreFak($data);
                // redirect('suratTugas/surat_tugas');
            }
        } else {
            redirect('suratTugas/surat_tugas');
        }
    }
    public function similarity($str1, $str2)
    {
        $len1 = strlen($str1);
        $len2 = strlen($str2);

        $max = max($len1, $len2);
        $similarity = $i = $j = 0;

        while (($i < $len1) && isset($str2[$j])) {
            if ($str1[$i] == $str2[$j]) {
                $similarity++;
                $i++;
                $j++;
            } elseif ($len1 < $len2) {
                $len1++;
                $j++;
            } elseif ($len1 > $len2) {
                $i++;
                $len1--;
            } else {
                $i++;
                $j++;
            }
        }
        return round($similarity / $max, 2);
    }
    public function cek_periode()
    {
        $post_ememo = $_POST['no_ememo'];
        $periode = $_POST['periode_penugasan'];
        $this->db->where('no_ememo', $post_ememo);
        $this->db->where('periode_penugasan', $periode);
        return $this->db->get('surat_tugas')->result();
    }
    public function nama_kegiatan_check($similarity)
    {
        $data['surat_tugas'] = $this->User_model->get_data()->result();
        foreach ($data['surat_tugas'] as $rslt) {
            $nama_kegiatan = $rslt->nama_kegiatan;
            $post_namaKegiatan = $_POST['nama_kegiatan'];
            $ememo = $rslt->no_ememo;
            $post_ememo = $_POST['no_ememo'];
            $periode = $_POST['periode_penugasan'];
            $persentase = $this->similarity($nama_kegiatan, $post_namaKegiatan) * 100 . '%';

            if ($persentase > 50) {
                $hasil1 = $this->cek_periode();
                $this->db->where('periode_penugasan', $periode);
                $hasil2 = $this->db->get('surat_tugas')->result();
                if ($hasil1) {
                    $this->form_validation->set_message('nama_kegiatan_check', 'Nama Kegiatan terindikasi sudah diajukan sebelumnya');
                    return false;
                } else if ($hasil2) {
                    if ($ememo != $post_ememo) {
                        $this->form_validation->set_message('nama_kegiatan_check', 'Nama Kegiatan terindikasi sudah diajukan sebelumnya');
                        return false;
                    } else {
                        return true;
                    }
                } else {
                    return true;
                }
            }
        }
        //nama kegiatan <50
        for ($p = 0; $p <= 50; $p++) {
            if ($persentase  == $p) {
                return TRUE;
            }
        }
    }
    public function detail()
    {
        $idSurat = $this->input->post('idSurat');
        $data['title'] = $this->User_model->getRole(['id' => $this->session->userdata('role_id')]);
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['surat'] = $this->m_suratTugas->getSuratbyID($idSurat);
        $user = $this->m_suratTugas->getUserData($data['surat']);
        $data['status'] = $this->m_suratTugas->getKeteranganStatus();
        $data['dosen'] = array_column($user, null, 'id');
        $data['jenisPenugasan'] = ['Juri', 'Pembicara', 'Narasumber', 'Kepanitiaan'];

        $data['surat'] = $this->m_suratTugas->getSuratbyID($idSurat);
        $data['surat_tugas'] = $this->User_model->get_data()->result();
        $data['title'] = $this->User_model->getRole(['id' => $this->session->userdata('role_id')]);
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('template/header', $data);
        $this->load->view('template/navbar');
        $this->load->view('template/sidebar');
        $this->load->view('suratTugas/detail', $data);
        $this->load->view('template/footer');




        // $idSurat = $this->input->post('idSurat');
        // $data['surat'] = $this->m_suratTugas->getSuratbyID($idSurat);
        // $data['title'] = $this->User_model->getRole(['id' => $this->session->userdata('role_id')]);
        // $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        // $roleID  = $this->session->userdata('role_id');
        // $nip = $data['user']['nip'];
        // $data['surat'] = $this->m_suratTugas->get_SuratTugas($roleID, $nip);
        // $data['status'] = $this->m_suratTugas->getKeteranganStatus();

        // $user = $this->m_suratTugas->getUserData($data['surat']);
        // $data['dosen'] = array_column($user, null, 'id');
        // $this->load->view('template/header', $data);
        // $this->load->view('template/navbar', $data);
        // $this->load->view('template/sidebar');
        // $this->load->view('suratTugas/detail', $data);
        // $this->load->view('template/footer');
        // redirect('suratTugas/detail');
    }
}
