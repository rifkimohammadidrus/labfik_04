<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('User_model');
        $this->load->model('m_suratTugas');
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
        $this->load->view('user/index');
        $this->load->view('template/footer');
    }
    public function surat_tugas()
    {
        $this->form_validation->set_rules('nama_kegiatan', 'Nama_kegiatan', 'required|trim|callback_nama_kegiatan_check[similarity]');
        if ($this->form_validation->run() == false) {

            $data['surat_tugas'] = $this->User_model->get_data()->result();
            $data['title'] = $this->User_model->getRole(['id' => $this->session->userdata('role_id')]);
            $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
            $this->load->view('template/header', $data);
            $this->load->view('template/navbar');
            $this->load->view('template/sidebar');
            $this->load->view('user/surat_tugas', $data);
            $this->load->view('template/footer');
        } else {
            $data = [
                'id' => uniqid(),
                'role_id' => htmlspecialchars($this->input->post('role_id', true)),
                'nama_kegiatan' => htmlspecialchars($this->input->post('nama_kegiatan', true)),
                'tanggal_kegiatan' => htmlspecialchars($this->input->post('tanggal_kegiatan', true)),
                'no_ememo' => htmlspecialchars($this->input->post('no_ememo', true)),
                'nip' =>  json_encode(implode(",", $this->input->post('nip'))),
                'jenis_penugasan' => htmlspecialchars($this->input->post('jenis_penugasan')),
                'tempat_kegiatan' => htmlspecialchars($this->input->post('tempat_kegiatan')),
                'periode_penugasan' => htmlspecialchars($this->input->post('periode_penugasan')),
                'penyelenggara' => htmlspecialchars($this->input->post('penyelenggara'))
            ];
            $this->m_suratTugas->insertSurat($data);
            redirect('user/list_pengajuan');
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
        $str4 = $_POST['no_ememo'];
        $str6 = $_POST['periode_penugasan'];
        $this->db->where('no_ememo', $str4);
        $this->db->where('periode_penugasan', $str6);
        return $this->db->get('surat_tugas')->result();
    }
    public function nama_kegiatan_check($similarity)
    {
        $data['surat_tugas'] = $this->User_model->get_data()->result();
        foreach ($data['surat_tugas'] as $rslt) {
            $str1 = $rslt->nama_kegiatan;
            // $this->db->get_where();
            $str3 = $rslt->no_ememo;
            $str5 = $rslt->periode_penugasan;
            $str2 = $_POST['nama_kegiatan'];
            $str4 = $_POST['no_ememo'];
            $str6 = $_POST['periode_penugasan'];
            $persentase = $this->similarity($str1, $str2) * 100 . '%';
            if ($persentase > 50) {
                $this->db->where('periode_penugasan', $str6);
                $hasil = $this->cek_periode();
                $hasil1 = $this->db->get('surat_tugas')->result();
                if ($hasil) {
                    echo 'Kondisi False=>';
                    echo 'Kemiripan 1:';
                    print_r($persentase);
                    // echo '-(';
                    // print_r($str3);
                    // echo '-';
                    // print_r($str4);
                    // echo ')-(';
                    // print_r($str5);
                    // echo '-';
                    // print_r($str6);
                    // echo ')';
                    $this->form_validation->set_message('nama_kegiatan_check', 'Nama Kegiatan terindikasi sudah diajukan sebelumnya');
                    return false;
                } else if ($hasil1) {
                    if ($str3 != $str4) {
                        echo 'Kondisi False=>';
                        echo 'Kemiripan 2:';
                        print_r($persentase);
                        // echo '-(';
                        // print_r($str3);
                        // echo '-';
                        // print_r($str4);
                        // echo ')-(';
                        // print_r($str5);
                        // echo '-';
                        // print_r($str6);
                        // echo ')';
                        $this->form_validation->set_message('nama_kegiatan_check', 'Nama Kegiatan terindikasi sudah diajukan sebelumnya');
                        return false;
                    } else {

                        echo 'Kondisi True=>';
                        echo 'Kemiripan 3:';
                        print_r($persentase);
                        // echo '-(';
                        // print_r($str3);
                        // echo '-';
                        // print_r($str4);
                        // echo ')-(';
                        // print_r($str5);
                        // echo '-';
                        // print_r($str6);
                        // echo ')';
                        // die;
                        return true;
                    }
                } else {
                    echo 'Kondisi True=>';
                    echo 'Kemiripan 4:';
                    print_r($persentase);
                    // echo '-(';
                    // print_r($str3);
                    // echo '-';
                    // print_r($str4);
                    // echo ')-(';
                    // print_r($str5);
                    // echo '-';
                    // print_r($str6);
                    // echo ')';
                    // die;
                    return true;
                }
                # code...
            }
        }
        //nama kegiatan beda
        for ($x = 0; $x <= 50; $x++) {

            // print_r($persentase);
            if ($persentase  == $x) {
                // echo 'hjk';
                print_r($persentase);
                // die;
                return TRUE;
                // return false;
            }
        }
    }
    public function buildIdDosen($nip)
    {
        $no = 0;
        $id = array();
        $arrNip = explode(",", $nip);
        foreach ($arrNip as $idNip) {
            $idUser = $this->getIDUser($idNip);
            if ($idUser != '' or $idUser != null) {
                $id[$no] = $this->getIDUser($idNip);
                $no++;
            }
        }
        $idDosenPertama = $id[0];
        if ($idDosenPertama != '' or $idDosenPertama != null) {
            $id = implode(',', $id);
            print_r($id);
            return $id;
        } else {
            return 'Invalid NIP';
        }
    }
    public function getIDUser($nip)
    {
        //echo $nim;
        //echo '  ';
        $this->db->SELECT('id');
        $roleUser = $this->db->get_where('user', ['nip' =>  $nip])->row_array();
        if ($roleUser != '' or $roleUser != null) {
            return $roleUser['id'];
        } else {
            return '';
        }
    }

    public function list_pengajuan()
    {
        $idSurat = $this->input->post('idSurat');
        $data['surat'] = $this->m_suratTugas->getSuratbyID($idSurat);
        $data['title'] = $this->User_model->getRole(['id' => $this->session->userdata('role_id')]);
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $roleID  = $this->session->userdata('role_id');
        $data['surat'] = $this->m_suratTugas->getSuratDosen($roleID);
        $data['status'] = $this->m_suratTugas->getKeteranganStatus();
        //pagination
        $this->load->database();

        $jumlah_data = $this->m_suratTugas->getJumlahSurat($roleID);
        $this->load->library('pagination');

        $config['base_url'] = base_url() . "user/list_pengajuan/";
        $config['total_rows'] = $jumlah_data;
        $config['per_page'] = 6;
        $data_start['start'] = $this->uri->segment(3);

        $config['full_tag_open'] = '<nav"><ul class="pagination justify-content-end">';
        $config['full_tag_close'] = '</ul></nav>';

        $config['first_link'] = 'First';
        $config['first_tag_open'] = '<li class="page-item">';
        $config['first_tag_close'] = '</li>';

        $config['last_link'] = 'Last';
        $config['last_tag_open'] = '<li class="page-item">';
        $config['last_tag_close'] = '</li>';

        $config['next_link'] = '&raquo';
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tag_close'] = '</li>';

        $config['prev_link'] = '&laquo';
        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_tag_close'] = '</li>';

        $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
        $config['cur_tag_close'] = '</a></li>';

        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';

        $config['attributes'] = array('class' => 'page-link');


        $this->pagination->initialize($config);

        $data['surat'] = $this->m_suratTugas->getSuratPagination($roleID, $config['per_page'], $data_start['start']);
        $user = $this->m_suratTugas->getUserData($data['surat']);
        $data['dosen'] = array_column($user, null, 'id');
        $this->load->view('template/header', $data);
        $this->load->view('template/navbar', $data);
        $this->load->view('template/sidebar');
        $this->load->view('user/list_pengajuan', $data);
        $this->load->view('template/footer');
    }
    public function input_eviden()
    {
        $data['title'] = $this->User_model->getRole(['id' => $this->session->userdata('role_id')]);
        $idSurat = $this->input->post('idSurat');
        $eviden = $_FILES['eviden'];
        $undangan = $_FILES['undangan'];
        $bukti_kegiatan = $_FILES['bukti_kegiatan'];
        $poster_kegiatan = $_FILES['poster_kegiatan'];
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['surat'] = $this->m_suratTugas->getSuratbyID($idSurat);
        $user = $this->m_suratTugas->getUserData($data['surat']);
        $data['status'] = $this->m_suratTugas->getKeteranganStatus();
        $data['dosen'] = array_column($user, null, 'id');
        $config['upload_path']          = './assets/eviden/';
        $config['allowed_types']        = 'pdf|jpg|png|jpeg';
        $config['file_name']            = 'eviden-' . date('ymd') . '-' . substr(md5(rand()), 0, 10);
        $this->load->library('upload', $config);
        if ($eviden = '') {
        } else {
            if (!$this->upload->do_upload('eviden')) {
                echo "Upload Gagal";
            } else {
                $eviden = $this->upload->data('file_name');
            }
        }
        if ($undangan = '') {
        } else {
            if (!$this->upload->do_upload('undangan')) {
                echo "Upload Gagal";
            } else {
                $undangan = $this->upload->data('file_name');
            }
        }
        if ($bukti_kegiatan = '') {
        } else {
            if (!$this->upload->do_upload('bukti_kegiatan')) {
                echo "Upload Gagal";
            } else {
                $bukti_kegiatan = $this->upload->data('file_name');
            }
        }
        if ($poster_kegiatan = '') {
        } else {
            if (!$this->upload->do_upload('poster_kegiatan')) {
                echo "Upload Gagal";
            } else {
                $poster_kegiatan = $this->upload->data('file_name');
            }
        }
        $this->m_suratTugas->input_eviden($eviden, $undangan, $bukti_kegiatan, $poster_kegiatan, $idSurat);
        redirect('user/list_pengajuan');
    }

    public function search()
    {
        if ($this->input->post('submit')) {
            //echo " no session";
            $sortPencarian = $this->input->post('sortPencarian');
            $querySearch = $this->input->post('keywordPencarian');
            //echo($querySearch);
            if ($querySearch == null) {
                redirect("user/surat_tugas");
            }
            $this->session->set_userdata('querySearch', $querySearch);
            $this->session->set_userdata('sortPencarian', $sortPencarian);
        } else {
            //echo 'Session';
            $sortPencarian = $this->session->userdata('sortPencarian');
            $querySearch = $this->session->userdata('sortPencarian');
        }

        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = $this->User_model->getRole(['id' => $this->session->userdata('role_id')]);
        $roleID  = $this->session->userdata('role_id');
        $jumlahFoundSearch = $this->m_suratTugas->getJumlahSearchSurat($roleID,  $querySearch, $sortPencarian);
        $foundSurat = $this->m_suratTugas->getSearchSurat($roleID,  $querySearch, $sortPencarian);
        $data['surat'] = $foundSurat;

        //pagination
        $this->load->database();

        $jumlah_data = $jumlahFoundSearch;
        $this->load->library('pagination');

        $config['base_url'] = base_url() . "laa/searchSurat";
        $config['total_rows'] = $jumlah_data;

        $config['per_page'] = 5;
        $data_start['start'] = $this->uri->segment(3);

        $config['full_tag_open'] = '<nav"><ul class="pagination justify-content-end">';
        $config['full_tag_close'] = '</ul></nav>';

        $config['first_link'] = 'First';
        $config['first_tag_open'] = '<li class="page-item">';
        $config['first_tag_close'] = '</li>';

        $config['last_link'] = 'Last';
        $config['last_tag_open'] = '<li class="page-item">';
        $config['last_tag_close'] = '</li>';

        $config['next_link'] = '&raquo';
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tag_close'] = '</li>';

        $config['prev_link'] = '&laquo';
        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_tag_close'] = '</li>';

        $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
        $config['cur_tag_close'] = '</a></li>';

        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';

        $config['attributes'] = array('class' => 'page-link');

        $this->pagination->initialize($config);
        $foundSuratPagination = $this->m_suratTugas->getSearchSuratPagination($roleID,  $querySearch, $sortPencarian, $config['per_page'], $data_start['start']);
        $data['surat'] = $foundSuratPagination;
        $data['jumlahSurat'] = $jumlahFoundSearch;
        $user = $this->m_suratTugas->getUserData($data['surat']);
        $data['dosen'] = array_column($user, null, 'id');
        $data['status'] = $this->m_suratTugas->getKeteranganStatus();
        $this->load->view('template/header', $data);
        $this->load->view('template/navbar', $data);
        $this->load->view('template/sidebar');
        $this->load->view('user/list_pengajuan', $data);
        $this->load->view('template/footer');
    }
    public function editSurat()
    {
        $idSurat = $this->input->post('idSurat');
        $ctt = $this->input->post('keterangan');
        $data['title'] = $this->User_model->getRole(['id' => $this->session->userdata('role_id')]);
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['surat'] = $this->m_suratTugas->getSuratbyID($idSurat);
        $user = $this->m_suratTugas->getUserData($data['surat']);
        $data['status'] = $this->m_suratTugas->getKeteranganStatus();
        $data['dosen'] = array_column($user, null, 'id');
        $data['jenisPenugasan'] = ['Juri', 'Pembicara', 'Narasumber', 'Kepanitiaan'];
        $this->form_validation->set_rules('nip[]', 'NIP', 'required|numeric');

        if ($this->form_validation->run() == false) {
            $data['surat'] = $this->m_suratTugas->getSuratbyID($idSurat);
            $data['surat_tugas'] = $this->User_model->get_data()->result();
            $data['title'] = $this->User_model->getRole(['id' => $this->session->userdata('role_id')]);
            $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
            $this->load->view('template/header', $data);
            $this->load->view('template/navbar');
            $this->load->view('template/sidebar');
            $this->load->view('user/editSurat', $data);
            $this->load->view('template/footer');
        } else {
            $eviden = $_FILES['eviden'];
            $undangan = $_FILES['undangan'];
            $bukti_kegiatan = $_FILES['bukti_kegiatan'];
            $poster_kegiatan = $_FILES['poster_kegiatan'];
            $config['upload_path']          = './assets/eviden/';
            $config['allowed_types']        = 'pdf|jpg|png|jpeg';
            $config['file_name']            = 'eviden-' . date('ymd') . '-' . substr(md5(rand()), 0, 10);
            $this->load->library('upload', $config);
            if ($eviden) {
                if ($this->upload->do_upload('eviden')) {
                    $old_data = $data['surat'][0]->eviden;
                    unlink(FCPATH . './assets/eviden/' . $old_data);
                    $eviden = $this->upload->data('file_name');
                    $this->db->set('eviden', $eviden);
                } else {
                    echo $this->upload->display_errors();
                }
            } else {
                $eviden = $this->input->post('eviden');
            }
            if ($undangan) {
                if ($this->upload->do_upload('undangan')) {
                    $old_data = $data['surat'][0]->undangan;
                    unlink(FCPATH . './assets/eviden/' . $old_data);
                    $undangan = $this->upload->data('file_name');
                    $this->db->set('undangan', $undangan);
                } else {
                    echo $this->upload->display_errors();
                }
            } else {
                $undangan = $this->input->post('undangan');
            }
            if ($bukti_kegiatan) {
                if ($this->upload->do_upload('bukti_kegiatan')) {
                    $old_data = $data['surat'][0]->bukti_kegiatan;
                    unlink(FCPATH . './assets/eviden/' . $old_data);
                    $bukti_kegiatan = $this->upload->data('file_name');
                    $this->db->set('bukti_kegiatan', $bukti_kegiatan);
                } else {
                    echo $this->upload->display_errors();
                }
            } else {
                $bukti_kegiatan = $this->input->post('bukti_kegiatan');
            }
            if ($poster_kegiatan) {
                if ($this->upload->do_upload('poster_kegiatan')) {
                    $old_data = $data['surat'][0]->poster_kegiatan;
                    unlink(FCPATH . './assets/eviden/' . $old_data);
                    $poster_kegiatan = $this->upload->data('file_name');
                    $this->db->set('poster_kegiatan', $poster_kegiatan);
                } else {
                    echo $this->upload->display_errors();
                }
            } else {
                $poster_kegiatan = $this->input->post('poster_kegiatan');
            }
            $data = [
                'nama_kegiatan' => htmlspecialchars($this->input->post('nama_kegiatan', true)),
                'tanggal_kegiatan' => htmlspecialchars($this->input->post('tanggal_kegiatan', true)),
                'no_ememo' => htmlspecialchars($this->input->post('no_ememo', true)),
                'nip' =>  json_encode(implode(",", $this->input->post('nip'))),
                'jenis_penugasan' => htmlspecialchars($this->input->post('jenis_penugasan')),
                'tempat_kegiatan' => htmlspecialchars($this->input->post('tempat_kegiatan')),
                'periode_penugasan' => htmlspecialchars($this->input->post('periode_penugasan')),
                'penyelenggara' => htmlspecialchars($this->input->post('penyelenggara')),
                'stat' => $data['surat'][0]->stat,
            ];
            $idSurat = $this->input->post('idSurat');
            $this->input->post('editSurat');
            $this->m_suratTugas->updateSurat($eviden, $undangan, $bukti_kegiatan, $poster_kegiatan, $data, $idSurat, $ctt);
            redirect('user/list_pengajuan');
        }
    }
    public function printSurat()
    {
        $idSurat = $this->input->post('idSurat');
        $data['surat'] = $this->m_suratTugas->getSuratbyID($idSurat);
        $data['title'] = $this->User_model->getRole(['id' => $this->session->userdata('role_id')]);
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['status'] = $this->m_suratTugas->getKeteranganStatus();
        $data['dekan'] = $this->m_suratTugas->getRoleDekan();
        $user = $this->m_suratTugas->getUserData($data['surat']);
        $data['dosen'] = array_column($user, null, 'id');
        $actionType = $this->input->post('printSurat');
        if ($actionType == 'printSuratKelompok') {
            $data['tgl'] = $this->m_suratTugas->tgl_surat($data['surat']);
            $data['hari'] = $this->m_suratTugas->hari($data['surat']);
            $this->load->library('pdf');
            $this->pdf->setFileName('Surat Tugas.pdf');
            $this->pdf->setPaper('A4', 'portrait');
            $this->pdf->loadView('user/print_surat_kelompok', $data);
        } else if ($actionType == 'printSuratPerorangan') {
            $data['hari'] = $this->m_suratTugas->hari($data['surat']);
            $data['tgl'] = $this->m_suratTugas->tgl_surat($data['surat']);
            $this->load->library('pdf');
            $this->pdf->setFileName('Surat Tugas.pdf');
            $this->pdf->setPaper('A4', 'portrait');
            $this->pdf->loadView('user/print_surat_perorang', $data);
        }
    }
}
