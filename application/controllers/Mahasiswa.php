<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mahasiswa extends CI_Controller
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
        $this->load->view('surat/mahasiswa/index');
        $this->load->view('template/footer');
    }
    public function surat_rekomendasi()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['provinsi'] = $this->daerah->getProv();
        $this->form_validation->set_rules('nim', 'nim', 'trim');
        if ($this->form_validation->run() == false) {
            $data['title'] = $this->User_model->getRole(['id' => $this->session->userdata('role_id')]);
            $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
            $this->load->view('template/header', $data);
            $this->load->view('template/navbar');
            $this->load->view('template/sidebar');
            $this->load->view('surat/mahasiswa/surat_rekomendasi', $data);
            $this->load->view('template/footer');
        } else {
            $ktm = $_FILES['ktm'];
            $transkrip = $_FILES['transkrip'];
            $iklan = $_FILES['iklan'];
            $config['upload_path']          = './assets/kmhs/';
            $config['allowed_types']        = 'pdf|jpg|png|jpeg';
            $this->load->library('upload', $config);
            if ($ktm) {
                if (!$this->upload->do_upload('ktm')) {
                    echo $this->upload->display_errors();
                } else {
                    $ktm = $this->upload->data('file_name');
                }
            }
            if ($transkrip) {
                if (!$this->upload->do_upload('transkrip')) {
                    echo $this->upload->display_errors();
                } else {
                    $transkrip = $this->upload->data('file_name');
                }
            }
            if ($iklan) {
                if (!$this->upload->do_upload('iklan')) {
                    echo $this->upload->display_errors();
                } else {
                    $iklan = $this->upload->data('file_name');
                }
            }
            $data = [
                'tipe_surat' => htmlspecialchars($this->input->post('tipe_surat', true)),
                'surat_lainnya' => htmlspecialchars($this->input->post('surat_lainnya')),
                'jenis_surat' => htmlspecialchars($this->input->post('jenis_surat')),
                'dosen_wali' =>  $data['user']['dosen_wali'],
                'nim' => $data['user']['nim'],
                'ipk' => htmlspecialchars($this->input->post('ipk', true)),
                'penilaian' =>  json_encode(implode(",", $this->input->post('penilaian'))),
                'mhs_smt' => '',
                'instansi' => htmlspecialchars($this->input->post('instansi', true)),
                'alamat' => htmlspecialchars($this->input->post('alamat', true)),
                'rt' => htmlspecialchars($this->input->post('rt')),
                'rw' => htmlspecialchars($this->input->post('rw')),
                'provinsi' => htmlspecialchars($this->input->post('provinsi')),
                'kota' => htmlspecialchars($this->input->post('kota')),
                'kecamatan' => htmlspecialchars($this->input->post('kec')),
                'kelurahan' => htmlspecialchars($this->input->post('kel')),
            ];
            $this->m_suratRekomendasi->insertSuratRekomendasi($ktm, $transkrip, $iklan, $data);
            redirect('mahasiswa/list_pengajuan');
        }
    }
    public function suratKeterangan()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['provinsi'] = $this->daerah->getProv();
        $this->form_validation->set_rules('nim', 'nim', 'trim');
        if ($this->form_validation->run() == false) {
            $data['title'] = $this->User_model->getRole(['id' => $this->session->userdata('role_id')]);
            $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
            $this->load->view('template/header', $data);
            $this->load->view('template/navbar');
            $this->load->view('template/sidebar');
            $this->load->view('surat/mahasiswa/suratKeterangan', $data);
            $this->load->view('template/footer');
        } else {
            $ktm = $_FILES['ktm'];
            $transkrip = $_FILES['transkrip'];
            $iklan = $_FILES['iklan'];
            $config['upload_path']          = './assets/kmhs/';
            $config['allowed_types']        = 'pdf|jpg|png|jpeg';
            $this->load->library('upload', $config);
            if ($ktm) {
                if (!$this->upload->do_upload('ktm')) {
                    echo $this->upload->display_errors();
                } else {
                    $ktm = $this->upload->data('file_name');
                }
            }
            if ($transkrip) {
                if (!$this->upload->do_upload('transkrip')) {
                    echo $this->upload->display_errors();
                } else {
                    $transkrip = $this->upload->data('file_name');
                }
            }
            if ($iklan) {
                if (!$this->upload->do_upload('iklan')) {
                    echo $this->upload->display_errors();
                } else {
                    $iklan = $this->upload->data('file_name');
                }
            }
            $data = [
                'tipe_surat' => htmlspecialchars($this->input->post('tipe_surat', true)),
                'surat_lainnya' => '',
                'jenis_surat' => htmlspecialchars($this->input->post('jenis_surat')),
                'nim' => $data['user']['nim'],
                'mhs_smt' => htmlspecialchars($this->input->post('mhs_smt')),
                'alamat' => htmlspecialchars($this->input->post('alamat', true)),
                'rt' => htmlspecialchars($this->input->post('rt')),
                'rw' => htmlspecialchars($this->input->post('rw')),
                'provinsi' => htmlspecialchars($this->input->post('provinsi')),
                'kota' => htmlspecialchars($this->input->post('kota')),
                'kecamatan' => htmlspecialchars($this->input->post('kec')),
                'kelurahan' => htmlspecialchars($this->input->post('kel')),
                'ipk' => '',
                'instansi' => htmlspecialchars($this->input->post('instansi', true)),
                'dosen_wali' => '',
                'penilaian' =>  '',
            ];
            $this->m_suratRekomendasi->insertSuratKeterangan($ktm, $transkrip, $iklan, $data);
            redirect('mahasiswa/list_pengajuan');
        }
    }

    public function list_pengajuan()
    {
        $data['title'] = $this->User_model->getRole(['id' => $this->session->userdata('role_id')]);
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['surat'] = $this->m_suratRekomendasi->getSuratMhs($data['user']['id']);
        //pagination
        $this->load->database();

        $jumlah_data = $this->m_suratRekomendasi->getJumlahSuratMhs($data['user']['id']);
        $this->load->library('pagination');

        $config['base_url'] = base_url() . "mahasiswa/list_pengajuan/";
        $config['total_rows'] = $jumlah_data;
        $config['per_page'] = 5;
        $data_start['start'] = $this->uri->segment(3);
        $this->pagination->initialize($config);
        $data['surat'] = $this->m_suratRekomendasi->getSuratMhsPagination($data['user']['id'], $config['per_page'], $data_start['start']);
        $data['jumlahSurat'] = $jumlah_data;
        $user = $this->m_suratRekomendasi->getUserData($data['surat']);
        $data['mhs'] = array_column($user, null, 'id');
        $data['status'] = $this->m_suratRekomendasi->getKeteranganStatus();
        $this->load->view('template/header', $data);
        $this->load->view('template/navbar', $data);
        $this->load->view('template/sidebar');
        $this->load->view('surat/mahasiswa/list_pengajuan', $data);
        $this->load->view('template/footer');
    }

    public function editSuratKmhs()
    {
        $idSurat = $this->input->post('idSurat');
        $ctt = $this->input->post('keterangan');
        $data['title'] = $this->User_model->getRole(['id' => $this->session->userdata('role_id')]);
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['provinsi'] = $this->daerah->getProv();
        $data['surat'] = $this->m_suratRekomendasi->getSuratbyID($idSurat);
        $user = $this->m_suratRekomendasi->getUserData($data['surat']);
        $data['status'] = $this->m_suratRekomendasi->getKeteranganStatus();
        $data['mhs'] = array_column($user, null, 'id');
        $tipeSurat = $data['surat'][0]->jenis_surat;

        $this->form_validation->set_rules('nim', 'nim', 'required');
        if ($tipeSurat == 'Rekomendasi') {
            if ($this->form_validation->run() == false) {
                $data['surat'] = $this->m_suratRekomendasi->getSuratbyID($idSurat);
                $data['title'] = $this->User_model->getRole(['id' => $this->session->userdata('role_id')]);
                $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
                $this->load->view('template/header', $data);
                $this->load->view('template/navbar');
                $this->load->view('template/sidebar');
                $this->load->view('surat/mahasiswa/editSuratRekomendasi', $data);
                $this->load->view('template/footer');
            } else {
                $ktm = $_FILES['ktm'];
                $transkrip = $_FILES['transkrip'];
                $iklan = $_FILES['iklan'];
                $config['upload_path']          = './assets/kmhs/';
                $config['allowed_types']        = 'pdf|jpg|png|jpeg';

                $this->load->library('upload', $config);
                if ($ktm) {
                    if ($this->upload->do_upload('ktm')) {
                        $old_data = $data['surat'][0]->ktm;
                        unlink(FCPATH . './assets/kmhs/' . $old_data);
                        $ktm = $this->upload->data('file_name');
                        $this->db->set('ktm', $ktm);
                    } else {
                        echo $this->upload->display_errors();
                    }
                } else {
                    $ktm = $this->input->post('ktm');
                }
                if ($transkrip) {
                    if ($this->upload->do_upload('transkrip')) {
                        $old_data = $data['surat'][0]->transkrip;
                        unlink(FCPATH . './assets/kmhs/' . $old_data);
                        $transkrip = $this->upload->data('file_name');
                        $this->db->set('transkrip', $transkrip);
                    } else {
                        echo $this->upload->display_errors();
                    }
                } else {
                    $transkrip = $this->input->post('transkrip');
                }
                if ($iklan) {
                    if ($this->upload->do_upload('iklan')) {
                        $old_data = $data['surat'][0]->iklan;
                        unlink(FCPATH . './assets/kmhs/' . $old_data);
                        $iklan = $this->upload->data('file_name');
                        $this->db->set('iklan', $iklan);
                    } else {
                        echo $this->upload->display_errors();
                    }
                } else {
                    $iklan = $this->input->post('iklan');
                }

                $data = [
                    'tipe_surat' => htmlspecialchars($this->input->post('tipe_surat', true)),
                    'surat_lainnya' => htmlspecialchars($this->input->post('surat_lainnya')),
                    'jenis_surat' => htmlspecialchars($this->input->post('jenis_surat')),
                    'nim' => $data['user']['nim'],
                    'ipk' => htmlspecialchars($this->input->post('ipk', true)),
                    'instansi' => htmlspecialchars($this->input->post('instansi', true)),
                    'penilaian' =>  $this->input->post('penilaian'),
                    'keterangan' =>  $this->input->post('nilaiDosenWali'),
                    'ctt_rekomendasi' =>  $this->input->post('ctt_rekomendasi'),
                    'mhs_smt' => '',
                    'instansi' => htmlspecialchars($this->input->post('instansi', true)),
                    'alamat' => htmlspecialchars($this->input->post('alamat', true)),
                    'rt' => htmlspecialchars($this->input->post('rt')),
                    'rw' => htmlspecialchars($this->input->post('rw')),
                    'provinsi' => htmlspecialchars($this->input->post('provinsi')),
                    'kota' => htmlspecialchars($this->input->post('kota')),
                    'kecamatan' => htmlspecialchars($this->input->post('kec')),
                    'kelurahan' => htmlspecialchars($this->input->post('kel')),
                    'stat' => $data['surat'][0]->stat,
                ];
                $idSurat = $this->input->post('idSurat');
                $this->input->post('editSurat');
                $this->m_suratRekomendasi->updateSuratRekomendasi($ktm, $transkrip, $iklan, $data, $idSurat, $ctt);
                redirect('mahasiswa/list_pengajuan');
            }
        } else if ($tipeSurat == 'Keterangan') {
            $data['semester'] = ['I (Satu) - Ganjil', 'II (Dua) - Genap', 'III (Tiga) - Ganjil', 'IV (Empat) - Genap', 'V (Lima) - Ganjil', 'VI (Enam) - Genap', 'VII (Tujuh) - Ganjil', 'VIII (Delapan) - Genap'];
            if ($this->form_validation->run() == false) {
                $data['surat'] = $this->m_suratRekomendasi->getSuratbyID($idSurat);
                $data['title'] = $this->User_model->getRole(['id' => $this->session->userdata('role_id')]);
                $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
                $this->load->view('template/header', $data);
                $this->load->view('template/navbar');
                $this->load->view('template/sidebar');
                $this->load->view('surat/mahasiswa/editSuratKeterangan', $data);
                $this->load->view('template/footer');
            } else {
                $ktm = $_FILES['ktm'];
                $transkrip = $_FILES['transkrip'];
                $iklan = $_FILES['iklan'];
                $config['upload_path']          = './assets/kmhs/';
                $config['allowed_types']        = 'pdf|jpg|png|jpeg';

                $this->load->library('upload', $config);
                if ($ktm) {
                    if ($this->upload->do_upload('ktm')) {
                        $old_data = $data['surat'][0]->ktm;
                        unlink(FCPATH . './assets/kmhs/' . $old_data);
                        $ktm = $this->upload->data('file_name');
                        $this->db->set('ktm', $ktm);
                    } else {
                        echo $this->upload->display_errors();
                    }
                } else {
                    $ktm = $this->input->post('ktm');
                }
                if ($transkrip) {
                    if ($this->upload->do_upload('transkrip')) {
                        $old_data = $data['surat'][0]->transkrip;
                        unlink(FCPATH . './assets/kmhs/' . $old_data);
                        $transkrip = $this->upload->data('file_name');
                        $this->db->set('transkrip', $transkrip);
                    } else {
                        echo $this->upload->display_errors();
                    }
                } else {
                    $transkrip = $this->input->post('transkrip');
                }
                if ($iklan) {
                    if ($this->upload->do_upload('iklan')) {
                        $old_data = $data['surat'][0]->iklan;
                        unlink(FCPATH . './assets/kmhs/' . $old_data);
                        $iklan = $this->upload->data('file_name');
                        $this->db->set('iklan', $iklan);
                    } else {
                        echo $this->upload->display_errors();
                    }
                } else {
                    $iklan = $this->input->post('iklan');
                }

                $data = [
                    'tipe_surat' => htmlspecialchars($this->input->post('tipe_surat', true)),
                    'surat_lainnya' => '',
                    'jenis_surat' => htmlspecialchars($this->input->post('jenis_surat')),
                    'nim' => $data['user']['nim'],
                    'mhs_smt' => htmlspecialchars($this->input->post('mhs_smt')),
                    'alamat' => htmlspecialchars($this->input->post('alamat', true)),
                    'rt' => htmlspecialchars($this->input->post('rt')),
                    'rw' => htmlspecialchars($this->input->post('rw')),
                    'provinsi' => htmlspecialchars($this->input->post('provinsi')),
                    'kota' => htmlspecialchars($this->input->post('kota')),
                    'kecamatan' => htmlspecialchars($this->input->post('kec')),
                    'kelurahan' => htmlspecialchars($this->input->post('kel')),
                    'ipk' => '',
                    'instansi' => htmlspecialchars($this->input->post('instansi', true)),
                    'dosen_wali' => '',
                    'penilaian' =>  '',
                    'stat' => $data['surat'][0]->stat,
                ];
                $idSurat = $this->input->post('idSurat');
                $this->input->post('editSurat');
                $this->m_suratRekomendasi->updateSuratKeterangan($ktm, $transkrip, $iklan, $data, $idSurat, $ctt);
                redirect('mahasiswa/list_pengajuan');
            }
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
