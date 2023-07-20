<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kemahasiswaan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('m_suratRekomendasi');
        $this->load->model('Alamat_model', 'daerah');
        $this->load->library('form_validation');
        $this->load->helper(array('form', 'url'));
    }
    public function index()
    {
        $data['title'] = $this->User_model->getRole(['id' => $this->session->userdata('role_id')]);
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('template/header', $data);
        $this->load->view('template/navbar', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('surat/kemahasiswaan/index');
        $this->load->view('template/footer');
    }
    public function surat_rekomendasi()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = $this->User_model->getRole(['id' => $this->session->userdata('role_id')]);
        $roleID  = $this->session->userdata('role_id');
        $nip = $data['user']['nip'];
        $data['surat'] = $this->m_suratRekomendasi->get_SuratRekomendasi($roleID, $nip);
        //pagination
        $this->load->database();

        $jumlah_data = $this->m_suratRekomendasi->getJumlahSuratRekomendasi($roleID, $nip);

        $this->load->library('pagination');

        $config['base_url'] = base_url() . "kemahasiswaan/surat_rekomendasi";
        $config['total_rows'] = $jumlah_data;
        // echo ($jumlah_data);

        $config['per_page'] = 5;
        $data_start['start'] = $this->uri->segment(3);
        $this->pagination->initialize($config);

        $data['surat'] = $this->m_suratRekomendasi->get_SuratRekomendasiPagination($roleID, $nip, $config['per_page'], $data_start['start']);
        $data['jumlahSurat'] = $jumlah_data;
        $user = $this->m_suratRekomendasi->getUserData($data['surat']);
        $data['mhs'] = array_column($user, null, 'id');
        $data['status'] = $this->m_suratRekomendasi->getKeteranganStatus();

        $data['provinsi'] = $this->daerah->getProv();
        $data['kota'] = $this->daerah->getKota();
        $data['kec'] = $this->daerah->getKecamatan();
        $data['kel'] = $this->daerah->getKelurahan();
        $data['namaProvinsi'] = array_column($data['provinsi'], 'nama', 'id_prov');
        $data['namaKota'] = array_column($data['kota'], 'nama', 'id_kab');
        $data['namaKecamatan'] = array_column($data['kec'], 'nama', 'id_kec');
        $data['namaKelurahan'] = array_column($data['kel'], 'nama', 'id_kel');


        $this->load->view('template/header', $data);
        $this->load->view('template/navbar', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('surat/kemahasiswaan/surat_rekomendasi', $data);
        $this->load->view('template/footer');
    }
    public function surat_keterangan()
    {

        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = $this->User_model->getRole(['id' => $this->session->userdata('role_id')]);
        $roleID  = $this->session->userdata('role_id');
        $nip = $data['user']['nip'];
        $data['surat'] = $this->m_suratRekomendasi->get_SuratKeterangan($roleID, $nip);
        //pagination
        $this->load->database();

        $jumlah_data = $this->m_suratRekomendasi->getJumlahSuratKeterangan($roleID, $nip);
        // var_dump($jumlah_data);
        // die;
        $this->load->library('pagination');

        $config['base_url'] = base_url() . "kemahasiswaan/surat_keterangan";
        $config['total_rows'] = $jumlah_data;
        // echo ($jumlah_data);

        $config['per_page'] = 5;
        $data_start['start'] = $this->uri->segment(3);



        $this->pagination->initialize($config);

        $data['surat'] = $this->m_suratRekomendasi->get_SuratKeteranganPagination($roleID, $nip, $config['per_page'], $data_start['start']);
        $data['jumlahSurat'] = $jumlah_data;
        $user = $this->m_suratRekomendasi->getUserData($data['surat']);
        $data['mhs'] = array_column($user, null, 'id');
        $data['status'] = $this->m_suratRekomendasi->getKeteranganStatus();

        $data['provinsi'] = $this->daerah->getProv();
        $data['kota'] = $this->daerah->getKota();
        $data['kec'] = $this->daerah->getKecamatan();
        $data['kel'] = $this->daerah->getKelurahan();
        $data['namaProvinsi'] = array_column($data['provinsi'], 'nama', 'id_prov');
        $data['namaKota'] = array_column($data['kota'], 'nama', 'id_kab');
        $data['namaKecamatan'] = array_column($data['kec'], 'nama', 'id_kec');
        $data['namaKelurahan'] = array_column($data['kel'], 'nama', 'id_kel');


        $this->load->view('template/header', $data);
        $this->load->view('template/navbar', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('surat/kemahasiswaan/surat_keterangan', $data);
        $this->load->view('template/footer');
    }
    public function search()
    {
        if ($this->input->post('submitPencarian')) {
            $typeSurat = $this->input->post('jenis_surat');
            $sortPencarian = $this->input->post('sortPencarian');
            $querySearch = $this->input->post('keywordPencarian');
            if ($querySearch == null) {
                if ($typeSurat == 'Rekomendasi') {
                    redirect('surat/surat_rekomendasi');
                } else if ($typeSurat == 'Keterangan') {
                    redirect('surat/surat_keterangan');
                };
            }
            $this->session->set_userdata('querySearch', $querySearch);
            $this->session->set_userdata('sortPencarian', $sortPencarian);
            $this->session->set_userdata('typeSurat', $typeSurat);
        } else {
            $typeSurat = $this->session->userdata('typeSurat');
            $sortPencarian = $this->session->userdata('sortPencarian');
            $querySearch = $this->session->userdata('sortPencarian');
        }
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = $this->User_model->getRole(['id' => $this->session->userdata('role_id')]);
        $roleID  = $this->session->userdata('role_id');
        $nipDosenWali = $data['user']['nip'];
        $jumlahFoundSearch = $this->m_suratRekomendasi->getJumlahSearchSurat($roleID, $nipDosenWali,  $querySearch, $typeSurat, $sortPencarian);
        $foundSurat = $this->m_suratRekomendasi->getSearchSurat($roleID, $nipDosenWali, $typeSurat, $querySearch, $sortPencarian);

        $data['surat'] = $foundSurat;

        //pagination
        $this->load->database();

        $jumlah_data = $jumlahFoundSearch;
        $this->load->library('pagination');

        $config['base_url'] = base_url() . "kemahasiswaan/search";
        $config['total_rows'] = $jumlah_data;

        $config['per_page'] = 5;
        $data_start['start'] = $this->uri->segment(3);

        $this->pagination->initialize($config);
        $foundSuratPagination = $this->m_suratRekomendasi->getSearchSuratPagination($roleID, $nipDosenWali, $typeSurat, $querySearch, $sortPencarian, $config['per_page'], $data_start['start']);
        $data['surat'] = $foundSuratPagination;
        // print_r($foundSuratPagination);
        // die;
        $data['jumlahSurat'] = $jumlahFoundSearch;
        $user = $this->m_suratRekomendasi->getUserData($data['surat']);
        $data['mhs'] = array_column($user, null, 'id');
        $data['status'] = $this->m_suratRekomendasi->getKeteranganStatus();

        //data Daerah
        $data['provinsi'] = $this->daerah->getProv();
        $data['kota'] = $this->daerah->getKota();
        $data['kec'] = $this->daerah->getKecamatan();
        $data['kel'] = $this->daerah->getKelurahan();

        $data['namaProvinsi'] = array_column($data['provinsi'], 'nama', 'id_prov');
        $data['namaKota'] = array_column($data['kota'], 'nama', 'id_kab');
        $data['namaKecamatan'] = array_column($data['kec'], 'nama', 'id_kec');
        $data['namaKelurahan'] = array_column($data['kel'], 'nama', 'id_kel');
        if ($typeSurat == 'Rekomendasi') {
            $this->load->view('template/header', $data);
            $this->load->view('template/navbar', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('surat/kemahasiswaan/surat_rekomendasi', $data);
            $this->load->view('template/footer');
        } else if ($typeSurat == 'Keterangan') {
            $this->load->view('template/header', $data);
            $this->load->view('template/navbar', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('surat/kemahasiswaan/surat_keterangan', $data);
            $this->load->view('template/footer');
        }
    }
    public function action()
    {
        $idSurat = $this->input->post('idSurat');
        $data['surat'] = $this->m_suratRekomendasi->getSuratbyID($idSurat);
        // var_dump($data['surat']);
        $old_status = $this->input->post('status');

        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required');
        $data['status'] = $this->m_suratRekomendasi->getKeteranganStatus();
        if ($this->form_validation->run() == true) {
            $roleID  = $this->session->userdata('role_id');
            $actionType = $this->input->post('action');
            if ($roleID == '12') { //kmhs
                if ($actionType == 'Reject') {
                    if ($old_status == 5) {
                        $stat = '3';
                        $field_revisi =  implode(",", $this->input->post('check'));
                        $nilai = $this->input->post('nilai');
                        $alasan = $this->input->post('catatan');
                    } else {
                        $stat = '3';
                        $field_revisi =  implode(",", $this->input->post('check'));
                        $nilai = '';
                    }
                } else if ($actionType == 'Accept') {
                    if ($old_status == 5) {
                        $stat = '2';
                        $nilai = $this->input->post('nilai');
                        $alasan = $this->input->post('catatan');
                    } else {
                        $stat = '2';
                    }
                } else if ($actionType == 'Reset') {
                    $old_nilai = $this->input->post('nilai');
                    if ($old_nilai != '') {
                        $stat = '5';
                        $nilai = $this->input->post('nilai');
                        $alasan = $this->input->post('catatan');
                    } else {
                        $stat = '1';
                    }
                } else if ($actionType == 'LanjutSurat') {
                    $nilai = $this->input->post('nilai');
                    $alasan = $this->input->post('catatan');
                    $tujuan = $this->input->post('teruskanSurat');
                    if ($tujuan == 'Wadek') {
                        $stat = '6';
                    } else if ($tujuan == 'Dekan') {
                        $stat = '10';
                    }
                }
            } else if ($roleID == '14') { //wadek
                $nilai = $this->input->post('nilai');
                $alasan = $this->input->post('catatan');
                if ($actionType == 'Reject') {
                    $stat = '8';
                    $field_revisi =  implode(",", $this->input->post('check'));
                } else if ($actionType == 'Accept') {
                    $stat = '7';
                } else if ($actionType == 'Reset') {
                    $stat = '6';
                }
            } else if ($roleID == '13') { //dekan
                $nilai = $this->input->post('nilai');
                $alasan = $this->input->post('catatan');
                if ($actionType == 'Reject') {
                    $stat = '12';
                    $field_revisi =  implode(",", $this->input->post('check'));
                } else if ($actionType == 'Accept') {
                    $stat = '11';
                } else if ($actionType == 'Reset') {
                    $stat = '10';
                }
            } else if ($roleID == 3) {
                if ($actionType == 'Nilai') {
                    $stat = '5';
                    $nilai =  implode(",", $this->input->post('checkNilai'));
                    $alasan = $this->input->post('catatan');
                    $field_revisi = '';
                } else if ($actionType == 'Reset') {
                    $stat = '1';
                }
            }
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
            $params['data'] = base_url() . "scanSurat/getSuratKmhs/" . $idSurat;
            $params['level'] = 'H'; //H=High
            $params['size'] = 10;
            $params['savename'] = FCPATH . $config['imagedir'] . $qr_code;
            $this->ciqrcode->generate($params);
            $tipeSurat = $this->input->post('tipeSurat');
            $noSurat = $this->input->post('noSurat');
            $ctt = $this->input->post('keterangan');
            $instansi = $this->input->post('nama_instansi');
            $alamat_instansi = $this->input->post('alamat_instansi');
            $no_tlp = $this->input->post('no_tlp');
            $email = $this->input->post('email');
            $thn_akademik = $this->input->post('thn_akademik');
            // die;
            $this->m_suratRekomendasi->updateStatus($stat, $idSurat, $ctt,  $field_revisi, $noSurat, $qr_code,  $nilai, $alasan, $instansi, $alamat_instansi, $no_tlp, $email, $thn_akademik);

            if ($tipeSurat == 'Rekomendasi') {
                redirect('kemahasiswaan/surat_rekomendasi');
            } else if ($tipeSurat == 'Keterangan') {
                redirect('kemahasiswaan/surat_keterangan');
            };
        } else {
            redirect('kemahasiswaan/surat_rekomendasi');
        }
    }
    public function multiAcc()
    {
        $ids = $this->input->post('ids');

        $this->db->where_in('id', explode(",", $ids));
        $this->db->delete('items');

        echo json_encode(['success' => "Item Deleted successfully."]);
        $id = $this->input->post('idSurat');
        $data['surat'] = $this->m_suratRekomendasi->getSuratbyID($id);
        $user = $this->m_suratRekomendasi->getUserData($data['surat']);
        $data['mhs'] = array_column($user, null, 'id');
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $user = $this->m_suratRekomendasi->getUserData($data['surat']);
        $data['status'] = $this->m_suratRekomendasi->getKeteranganStatus();
        $data['mhs'] = array_column($user, null, 'id');
        $data['title'] = $this->User_model->getRole(['id' => $this->session->userdata('role_id')]);
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $jenisSurat = $data['surat'][0]->jenis_surat;
        if ($jenisSurat == 'Keterangan') {
            $this->load->view('template/header', $data);
            $this->load->view('template/navbar');
            $this->load->view('template/sidebar');
            $this->load->view('surat/kemahasiswaan/acc_keterangan', $data);
            $this->load->view('template/footer');
        } else if ($jenisSurat == 'Rekomendasi') {
            $this->load->view('template/header', $data);
            $this->load->view('template/navbar');
            $this->load->view('template/sidebar');
            $this->load->view('surat/kemahasiswaan/acc_rekomendasi', $data);
            $this->load->view('template/footer');
        }
    }
    public function detailSurat($idSurat)
    {
        $id = decrypt_url($idSurat);
        $data['surat'] = $this->m_suratRekomendasi->getSuratbyID($id);
        $data['title'] = $this->User_model->getRole(['id' => $this->session->userdata('role_id')]);
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $user = $this->m_suratRekomendasi->getUserData($data['surat']);
        $data['status'] = $this->m_suratRekomendasi->getKeteranganStatus();
        $data['mhs'] = array_column($user, null, 'id');
        $data['title'] = $this->User_model->getRole(['id' => $this->session->userdata('role_id')]);
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['provinsi'] = $this->daerah->getProv();
        $data['kota'] = $this->daerah->getKota();
        $data['kec'] = $this->daerah->getKecamatan();
        $data['kel'] = $this->daerah->getKelurahan();
        $data['namaProvinsi'] = array_column($data['provinsi'], 'nama', 'id_prov');
        $data['namaKota'] = array_column($data['kota'], 'nama', 'id_kab');
        $data['namaKecamatan'] = array_column($data['kec'], 'nama', 'id_kec');
        $data['namaKelurahan'] = array_column($data['kel'], 'nama', 'id_kel');

        $jenisSurat = $data['surat'][0]->jenis_surat;

        if ($jenisSurat == 'Keterangan') {
            $this->load->view('template/header', $data);
            $this->load->view('template/navbar');
            $this->load->view('template/sidebar');
            $this->load->view('surat/kemahasiswaan/detail_keterangan', $data);
            $this->load->view('template/footer');
        } else if ($jenisSurat == 'Rekomendasi') {
            $this->load->view('template/header', $data);
            $this->load->view('template/navbar');
            $this->load->view('template/sidebar');
            $this->load->view('surat/kemahasiswaan/detail_rekomendasi', $data);
            $this->load->view('template/footer');
        }
    }

    public function printSurat($idSurat)
    {
        $id = decrypt_url($idSurat);
        $data['surat'] = $this->m_suratRekomendasi->getSuratbyID($id);
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
            $this->pdf->setFileName('Surat Keterangan.pdf');
            $this->pdf->setPaper('A4', 'portrait');
            $this->pdf->loadView('surat/kemahasiswaan/print_surat_kelakuanBaik', $data);
        } else if ($jenisSurat == 'Rekomendasi') {
            $this->load->library('pdf');
            $this->pdf->setFileName('Surat Rekomendasi.pdf');
            $this->pdf->setPaper('A4', 'portrait');
            $this->pdf->loadView('surat/kemahasiswaan/print_surat_Rekomendasi', $data);
        }
    }










    public function getKab($id_prov)
    {
        $kab = $this->daerah->getKab($id_prov);
        echo "<option value=''>Pilih Kota/Kabupaten</option>";
        foreach ($kab as $k) {
            echo "<option value='{$k->id_kab}'>{$k->nama}</option>";
        }
    }

    public function getKec($id_kab)
    {
        $kec = $this->daerah->getKec($id_kab);
        echo "<option value=''>Pilih Kecamatan</option>";
        foreach ($kec as $k) {
            echo "<option value='{$k->id_kec}'>{$k->nama}</option>";
        }
    }

    public function getKel($id_kec)
    {
        $kel = $this->daerah->getKel($id_kec);
        echo "<option value=''>Pilih Kelurahan/Desa</option>";
        foreach ($kel as $k) {
            echo "<option value='{$k->id_kel}'>{$k->nama}</option>";
        }
    }
}
