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
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->form_validation->set_rules('nama_kegiatan', 'Nama_kegiatan', 'required|trim|callback_nama_kegiatan_check[similarity]');
        $this->form_validation->set_rules('nip[]', 'nip', 'required|trim');
        $this->form_validation->set_rules('divisi[]', 'divisi', 'trim');
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
                    'id' => uniqid(),
                    'user_id' => htmlspecialchars($this->input->post('user_id', true)),
                    'nip_kaprodikk' => $data['user']['prodi'],
                    'nama_kegiatan' => htmlspecialchars($this->input->post('nama_kegiatan', true)),
                    'tanggal_kegiatan' => htmlspecialchars($this->input->post('tanggal_kegiatan', true)),
                    'no_ememo' => htmlspecialchars($this->input->post('no_ememo', true)),
                    'nip' =>  json_encode(implode(",", $this->input->post('nip'))),
                    'divisi' =>  json_encode(implode(",", $this->input->post('divisi'))),
                    'jenis_penugasan' => htmlspecialchars($this->input->post('jenis_penugasan')),
                    'tempat_kegiatan' => htmlspecialchars($this->input->post('tempat_kegiatan')),
                    'periode_penugasan' =>  htmlspecialchars($this->input->post('periode_penugasan')),
                    'penyelenggara' => htmlspecialchars($this->input->post('penyelenggara'))
                ];
                $this->m_suratTugas->insertSurat($eviden, $data);
                redirect('user/list_pengajuan');
            }
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
            $periode =  $_POST['periode_penugasan'];
            $persentase = $this->similarity($nama_kegiatan, $post_namaKegiatan) * 100 . '%';
            if ($persentase > 50) {
                $hasil1 = $this->cek_periode();
                $this->db->where('periode_penugasan', $periode);
                $hasil2 = $this->db->get('surat_tugas')->result();
                if ($hasil1) {
                    echo 'Kondisi False=>';
                    echo 'Kemiripan 1:';
                    print_r($persentase);
                    $this->form_validation->set_message('nama_kegiatan_check', 'Nama Kegiatan terindikasi sudah diajukan sebelumnya');
                    return false;
                } else if ($hasil2) {
                    if ($ememo != $post_ememo) {
                        echo 'Kondisi False=>';
                        echo 'Kemiripan 2:';
                        print_r($persentase);
                        $this->form_validation->set_message('nama_kegiatan_check', 'Nama Kegiatan terindikasi sudah diajukan sebelumnya');
                        return false;
                    } else {

                        echo 'Kondisi True=>';
                        echo 'Kemiripan 3:';
                        print_r($persentase);
                        return true;
                    }
                } else {
                    echo 'Kondisi True=>';
                    echo 'Kemiripan 4:';
                    // print_r($persentase);
                    return true;
                }
            }
        }
        //nama kegiatan <50
        for ($x = 0; $x <= 50; $x++) {
            if ($persentase  == $x) {
                print_r($persentase);
                return TRUE;
            }
        }
    }


    public function list_pengajuan()
    {
        $idSurat = $this->input->post('idSurat');
        $data['surat'] = $this->m_suratTugas->getSuratbyID($idSurat);
        $data['title'] = $this->User_model->getRole(['id' => $this->session->userdata('role_id')]);
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['surat'] = $this->m_suratTugas->getSuratAll($data['user']['id']);
        $data['status'] = $this->m_suratTugas->getKeteranganStatus();
        //pagination
        $this->load->database();

        $jumlah_data = $this->m_suratTugas->getJumlahSurat($data['user']['id']);
        $this->load->library('pagination');

        $config['base_url'] = base_url() . "user/list_pengajuan/";
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
        $data['surat'] = $this->m_suratTugas->getSuratPagination($data['user']['id'], $config['per_page'], $data_start['start']);
        $data['jumlahSurat'] = $jumlah_data;
        $user = $this->m_suratTugas->getUserData($data['surat']);
        $data['dosen'] = array_column($user, null, 'id');
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
            $data = [
                'id' => uniqid(),
                'user_id' => htmlspecialchars($this->input->post('user_id')),
                'nip_kaprodikk' => $this->input->post('nip_kaprodikk'),
                'nama_kegiatan' => htmlspecialchars($this->input->post('nama_kegiatan')),
                'tanggal_kegiatan' => htmlspecialchars($this->input->post('tanggal_kegiatan')),
                'no_ememo' => htmlspecialchars($this->input->post('no_ememo')),
                'nip' =>  json_encode(implode(",", $this->input->post('nip'))),
                'divisi' =>  json_encode(implode(",", $this->input->post('divisi'))),
                // 'eviden' =>  $eviden,
                'jenis_penugasan' => htmlspecialchars($this->input->post('jenis_penugasan')),
                'tempat_kegiatan' => htmlspecialchars($this->input->post('tempat_kegiatan')),
                'periode_penugasan' => htmlspecialchars($this->input->post('periode_penugasan')),
                'penyelenggara' => htmlspecialchars($this->input->post('penyelenggara')),
                'stat' => $data['surat'][0]->stat,
            ];
            $idSurat = $this->input->post('idSurat');
            $this->input->post('editSurat');
            $this->load->library('upload');

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
                    // foreach ($data['surat'] as $e) {
                    //     $getEviden = explode(",", $e->eviden);

                    //     foreach ($getEviden as $row) {
                    //         $old_data = $row;
                    //     }
                    //     unlink(FCPATH . './assets/eviden/' . $old_data);
                    // }
                    // die;
                    $imageData = $this->upload->data();
                    $dataEviden[$i] = $imageData['file_name'];
                    $eviden = json_encode(implode(",",  $dataEviden));
                } else {
                    echo $this->upload->display_errors();
                }
            }
            if (!empty($eviden)) {
                $this->m_suratTugas->updateSurat($eviden, $data, $idSurat, $ctt);
                redirect('user/list_pengajuan');
            } else {
                $eviden = json_encode(implode(",", $this->input->post('eviden')));
                $this->m_suratTugas->updateSurat($eviden, $data, $idSurat, $ctt);
                redirect('user/list_pengajuan');
            }
        }
    }
    public function search()
    {
        if ($this->input->post('submit')) {
            $sortPencarian = $this->input->post('sortPencarian');
            $querySearch = $this->input->post('keywordPencarian');
            if ($querySearch == null) {
                redirect("user/surat_tugas");
            }
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

        $config['base_url'] = base_url() . "user/search";
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
        $foundSuratPagination = $this->m_suratTugas->getSearchSuratPagination($roleID,  $nipKaprodi, $querySearch, $sortPencarian, $config['per_page'], $data_start['start']);
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
}
