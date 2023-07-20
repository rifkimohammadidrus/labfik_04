<?php

class m_suratTugas extends CI_Model
{
    public function getSuratbyID($idSurat)
    {
        $this->db->reset_query();
        $this->db->where('id', $idSurat);
        $data = $this->db->get('surat_tugas')->result();
        return $data;
    }
    public function getKaprodiNip($prodi)
    {
        $data = $this->db->get_where('tb_kaprodi', ['prodi' => $prodi])->result();
        $nip = $data[0]->nip;
        return $nip;
    }
    public function insertSurat($eviden, $data)
    {
        $iseviden = str_replace('"', "", $eviden);
        date_default_timezone_set('Asia/Jakarta');
        $t = time();
        $id = uniqid();
        $idDosen = $this->buildIdDosen(str_replace('"', "", $data['nip']));
        $divisi = str_replace('"', "", $data['divisi']);
        $periode_penugasan = str_replace('"', "", $data['periode_penugasan']);
        if ($idDosen != 'Invalid NIP') {
            $nipKaprodiKK = $this->getKaprodiNip($data['nip_kaprodikk']);
            $newSuratTugas = array(
                'id' => $id,
                'user_id' => $data['user_id'],
                'nip_kaprodikk' => $nipKaprodiKK,
                'nama_kegiatan' => $data['nama_kegiatan'],
                'tanggal_kegiatan' => $data['tanggal_kegiatan'],
                'no_ememo' => $data['no_ememo'],
                'dosen_id' => $idDosen,
                'divisi' => $divisi,
                'jenis_penugasan' => $data['jenis_penugasan'],
                'tempat_kegiatan' => $data['tempat_kegiatan'],
                'periode_penugasan' =>  $periode_penugasan,
                'penyelenggara' => $data['penyelenggara'],
                'eviden' => $iseviden,
                'stat' => 1,
                'tgl_update_stat' => date("Y-m-d H:i:s", $t)
            );
            $this->db->insert('surat_tugas', $newSuratTugas);
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
        $this->db->SELECT('id');
        $roleUser = $this->db->get_where('user', ['nip' =>  $nip])->row_array();
        if ($roleUser != '' or $roleUser != null) {
            return $roleUser['id'];
        } else {
            return '';
        }
    }
    // public function input_eviden($eviden, $undangan, $bukti_kegiatan, $poster_kegiatan, $id)
    // {
    //     date_default_timezone_set('Asia/Jakarta');
    //     $t = time();
    //     $data = array(
    //         'eviden' => $eviden,
    //         'undangan' => $undangan,
    //         'bukti_kegiatan' => $bukti_kegiatan,
    //         'poster_kegiatan' => $poster_kegiatan,
    //         'stat' => '1',
    //         'tgl_update_stat' => date("Y-m-d H:i:s", $t)
    //     );
    //     $this->db->where('id', $id);
    //     $this->db->update('surat_tugas', $data);
    // }


    public function updateSurat($eviden, $data, $id, $ctt)
    {
        $iseviden = str_replace('"', "", $eviden);
        print_r($iseviden);
        date_default_timezone_set('Asia/Jakarta');
        $t = time();
        $idDosen = $this->buildIdDosen(str_replace('"', "", $data['nip']));
        $divisi = str_replace('"', "", $data['divisi']);
        $statSurat = $data['stat'];
        if ($statSurat == '3') { //rejct ketua kk
            $newStat = '4'; //revisi 
        } else if ($statSurat == '6') { //reject kaprodi
            $newStat = '7'; //revisi 
        } else if ($statSurat == '9') { //reject sekre fak
            $newStat = '10'; //revisi 
        } else {
            $newStat = $statSurat;
        }
        $updateSuratTugas = array(
            'user_id' => $data['user_id'],
            'nip_kaprodikk' => $data['nip_kaprodikk'],
            'nama_kegiatan' => $data['nama_kegiatan'],
            'tanggal_kegiatan' => $data['tanggal_kegiatan'],
            'no_ememo' => $data['no_ememo'],
            'dosen_id' => $idDosen,
            'divisi' => $divisi,
            'jenis_penugasan' => $data['jenis_penugasan'],
            'tempat_kegiatan' => $data['tempat_kegiatan'],
            'periode_penugasan' => $data['periode_penugasan'],
            'penyelenggara' => $data['penyelenggara'],
            'stat' => $newStat,
            'eviden' => $iseviden,
            'field_revisi' => '',
            'ctt_revisi' => $ctt,
            'tgl_update_stat' => date("Y-m-d H:i:s", $t)
        );
        $this->db->where('id', $id);
        $this->db->update('surat_tugas', $updateSuratTugas);
    }

    public function getRole($where)
    {
        $roleUser = $this->db->get_where('user_role', $where)->row_array();
        return $roleUser['role'];
    }

    public function getUserData($nip)
    {
        $this->db->reset_query();
        $this->fetchNIP($nip);
        $this->db->select("id, nip, name,koordinator");
        $this->fetchNIP($nip);
        $data = $this->db->get('user')->result();
        return $data;
    }
    public function fetchNIP($nip)
    {
        $no = 0;
        foreach ($nip as $srt) {
            $arrNip = explode(",", $srt->dosen_id);
            foreach ($arrNip as $nip) {
                $this->db->or_where('id', $nip);
            }
            $no++;
        }
    }



    //pagination 
    function getSuratAll($idUser)
    {
        $this->db->reset_query();
        $idSrtDosen = "dosen_id='" . $idUser . "' \n"
            . "OR dosen_id LIKE '" . $idUser . ",%'\n"
            . "OR dosen_id LIKE '%," . $idUser . ",%'\n";
        $this->db->where($idSrtDosen, NULL, False);

        return $this->db->get('surat_tugas')->result();
    }
    public function getJumlahSurat($idUser)
    {
        $this->db->reset_query();
        $this->db->like('user_id', $idUser);
        $data = $this->db->get('surat_tugas')->num_rows();
        return $data;
    }
    public function getSuratPagination($idUser, $limit, $start)
    {
        $this->db->reset_query();
        $this->db->like('user_id', $idUser);
        $this->db->limit($limit, $start);
        $this->db->order_by("tgl_update_stat", "DESC");
        $data = $this->db->get('surat_tugas')->result();
        return $data;
    }


    //KETUA KK DAN KAPRODI
    public function seleksiBerkas($roleID, $nipKaprodi)
    {
        if ($roleID == '9') { //ketua kk
            $getSurat = "nip_kaprodikk='" . $nipKaprodi . "'" . "AND(stat='1' or stat='2' or stat='3' or stat='4')";
            $this->db->where($getSurat, NULL, false);
            $this->db->order_by("tgl_update_stat", "DESC");
        } else if ($roleID == '10') { //kaprodi
            $getSurat = "nip_kaprodikk='" . $nipKaprodi . "'" . "AND(stat='1' or stat='5' or stat='6' or stat='7')";
            $this->db->where($getSurat, NULL, false);
            $this->db->order_by("tgl_update_stat", "DESC");
        } else if ($roleID == '11') { //sekre fak
            $getSurat = "stat='2' or stat='5' or stat='8' or stat='9' or stat='10'or stat='11'";
            $this->db->where($getSurat, NULL, false);
            $this->db->order_by("tgl_update_stat", "DESC");
        }
    }
    public function get_SuratTugas($roleID, $nipKaprodi)
    {
        $this->db->reset_query();
        $this->seleksiBerkas($roleID, $nipKaprodi);
        $data = $this->db->get('surat_tugas')->result();
        return $data;
    }

    public function get_JumlahSurat($roleID, $nipKaprodi)
    {
        $this->db->reset_query();
        $this->seleksiBerkas($roleID, $nipKaprodi);
        $data = $this->db->get('surat_tugas')->num_rows();
        return $data;
    }
    public function get_SuratPagination($roleID, $nipKaprodi, $limit, $start)
    {
        $this->db->reset_query();
        $this->seleksiBerkas($roleID, $nipKaprodi);
        $this->db->limit($limit, $start);
        $data = $this->db->get('surat_tugas')->result();
        return $data;
    }
    public function updateStatus($stat, $id, $ctt, $revisi, $noSurat, $qr_code)
    {
        date_default_timezone_set('Asia/Jakarta');
        $t = time();
        // if ($stat == '8') {
        //     $noSurat = ;
        // }
        $data = array(
            'stat' => $stat,
            'ctt_revisi' => $ctt,
            'field_revisi' => $revisi,
            'tgl_update_stat' => date("Y-m-d H:i:s", $t),
            'no_surat' => $noSurat,
            'qr_code' => $qr_code,
        );
        $this->db->where('id', $id);
        $this->db->update('surat_tugas', $data);
    }
    public function getLastNomerSurat()
    {
        $n = "/SDM10/IK-DEK/";
        date_default_timezone_set('Asia/Jakarta');

        $this->db->reset_query();
        $idSrt =
            " stat = '8'\n"
            . "AND NOT no_surat = '';";
        $this->db->where($idSrt, NULL, False);
        $noSurat = $this->db->get('surat_tugas')->num_rows() + 1;
        $noSurat = substr(str_repeat(0, 3) . $noSurat, -3);
        return $noSurat . $n . date('Y');
    }
    function tgl_indo($tanggal)
    {
        $bulan = array(
            1 =>   'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        );
        $data = explode('-', $tanggal);
        return $data[2] . ' ' . $bulan[(int)$data[1]] . ' ' . $data[0];
    }
    function tgl_surat($data)
    {
        $dateStr = $data[0]->tgl_update_stat;
        $dateTime = strtotime($dateStr);
        return $this->tgl_indo(date('Y-m-d', $dateTime));
    }
    function hari($data)
    {
        $dateStr = $data[0]->tgl_update_stat;
        $hari = date('D', strtotime($dateStr));
        $hari_indonesia = array(
            'Sun' => 'Minggu', 'Mon' => 'Senin', 'Tue' => 'Selasa', 'Wed' => 'Rabu', 'Thu' => 'Kamis', 'Fri' => 'Jumat', 'Sat' => 'Sabtu'
        );
        return $hari_indonesia[$hari];
    }
    //MENU PENCARI
    public function seleksiSearch($roleID, $nipKaprodi)
    {
        $this->db->from('surat_tugas');
        if ($roleID == '7') { //pick KK 
            $this->db->join('user', 'surat_tugas.user_id = user.id', 'left');
            $this->db->join('status_surat_tugas', 'surat_tugas.stat = status_surat_tugas.id', 'left');
            $selectBerkas =
                "user.role_id='" . $roleID . "' \n"
                . "AND(surat_tugas.stat='0' OR surat_tugas.stat='1' OR surat_tugas.stat='2' OR surat_tugas.stat='3' OR surat_tugas.stat='4' OR surat_tugas.stat='8' OR surat_tugas.stat='9' OR surat_tugas.stat='10' )\n";
            $this->db->where($selectBerkas, NULL, False);
        } else if ($roleID == '8') { //admin prodi
            $this->db->join('user', 'surat_tugas.user_id = user.id', 'left');
            $this->db->join('status_surat_tugas', 'surat_tugas.stat = status_surat_tugas.id', 'left');
            $selectBerkas =
                "user.role_id='" . $roleID . "' \n"
                . "AND(surat_tugas.stat='0' OR surat_tugas.stat='1' OR surat_tugas.stat='5' OR surat_tugas.stat='6' OR surat_tugas.stat='7' OR surat_tugas.stat='8' OR surat_tugas.stat='9' OR surat_tugas.stat='10' )\n";
            $this->db->where($selectBerkas, NULL, False);
        } else if ($roleID == '9') { //ketua KK
            $this->db->join('user', 'surat_tugas.user_id = user.id', 'left');
            $this->db->join('status_surat_tugas', 'surat_tugas.stat = status_surat_tugas.id', 'left');
            $selectBerkas = "nip_kaprodikk='" . $nipKaprodi . "'\n"
                . "AND user.role_id='7'\n"
                . "AND (surat_tugas.stat='1' OR surat_tugas.stat='2'OR surat_tugas.stat='3'OR surat_tugas.stat='4')\n";
            $this->db->where($selectBerkas, NULL, False);
        } else if ($roleID == '10') { //Kaprodi
            $this->db->join('user', 'surat_tugas.user_id = user.id', 'left');
            $this->db->join('status_surat_tugas', 'surat_tugas.stat = status_surat_tugas.id', 'left');
            $selectBerkas = "nip_kaprodikk='" . $nipKaprodi . "'\n"
                . "AND user.role_id='8'\n"
                . "AND(surat_tugas.stat='1' OR surat_tugas.stat='5'OR surat_tugas.stat='6'OR surat_tugas.stat='7')\n";
            $this->db->where($selectBerkas, NULL, False);
        } else if ($roleID == '11') { //sekre Fak
            $this->db->join('user', 'surat_tugas.user_id = user.id', 'left');
            $this->db->join('status_surat_tugas', 'surat_tugas.stat = status_surat_tugas.id', 'left');
            $selectBerkas =
                "(user.role_id='7' OR user.role_id='8'OR user.role_id='11')\n"
                . "AND(surat_tugas.stat='2' OR surat_tugas.stat='5' OR surat_tugas.stat='8'OR surat_tugas.stat='9'OR surat_tugas.stat='10'OR surat_tugas.stat='11')\n";
            $this->db->where($selectBerkas, NULL, False);
        }
    }
    public function getKeteranganStatus()
    {
        $this->db->reset_query();
        $status = $this->db->get_where('status_surat_tugas')->result();
        return $status;
    }
    public function addSort($sortPencarian)
    {
        if ($sortPencarian == '') {
            $sortPencarian = 'tgl_update_stat DESC';
        }
        $this->db->order_by($sortPencarian, NULL);
    }

    public function addSearchKeyword($query)
    {
        $query = str_replace("'", "\'", $query);
        $arrQuery = explode(' ', $query);
        foreach ($arrQuery as $querySearch) {
            $selectBerkas = "(
                surat_tugas.nama_kegiatan LIKE '%" . $querySearch . "%' "
                . "OR surat_tugas.nama_kegiatan LIKE '" . $querySearch . ",%'\n"
                . "OR surat_tugas.nama_kegiatan LIKE '" . $querySearch . "%'\n"
                . "OR surat_tugas.nama_kegiatan LIKE '" . $querySearch . "'\n"
                . "OR surat_tugas.nama_kegiatan LIKE '" . $querySearch . "'"
                . "OR surat_tugas.nama_kegiatan LIKE '%," . $querySearch . ",%'\n"
                . "OR surat_tugas.nama_kegiatan LIKE '%," . $querySearch . "'\n"
                . "OR surat_tugas.nama_kegiatan LIKE '%," . $querySearch . "'"
                . "OR surat_tugas.nama_kegiatan LIKE '%" . $querySearch . ",%'\n"
                . "OR surat_tugas.nama_kegiatan LIKE '%" . $querySearch . "'\n"
                . "OR surat_tugas.nama_kegiatan LIKE '%" . $querySearch . "'"
                . "OR surat_tugas.tanggal_kegiatan LIKE '%" . $querySearch . "%' "
                . "OR surat_tugas.no_ememo LIKE '%" . $querySearch . "%' "
                . "OR surat_tugas.no_ememo LIKE '%" . $querySearch . ",%' "
                . "OR surat_tugas.no_ememo LIKE '%" . $querySearch . "%'\n "
                . "OR surat_tugas.no_ememo LIKE '%" . $querySearch . "'"
                . "OR surat_tugas.no_ememo LIKE '" . $querySearch . ",%'\n"
                . "OR surat_tugas.no_ememo LIKE '" . $querySearch . "'\n"
                . "OR surat_tugas.no_ememo LIKE '" . $querySearch . "'"
                . "OR surat_tugas.jenis_penugasan LIKE '%" . $querySearch . "%' "
                . "OR surat_tugas.tempat_kegiatan LIKE '%" . $querySearch . "%' "
                . "OR surat_tugas.periode_penugasan LIKE '%" . $querySearch . "%' "
                . "OR surat_tugas.periode_penugasan LIKE '%" . $querySearch . ",%' "
                . "OR surat_tugas.periode_penugasan LIKE '%" . $querySearch . "%'\n "
                . "OR surat_tugas.periode_penugasan LIKE '" . $querySearch . ",%'\n"
                . "OR surat_tugas.penyelenggara LIKE '%" . $querySearch . "%' "
                . "OR status_surat_tugas.status LIKE '%" . $querySearch . "%' "
                . "OR status_surat_tugas.status LIKE '" . $querySearch . ",%'\n"
                . "OR status_surat_tugas.status LIKE '" . $querySearch . "%'\n"
                . "OR status_surat_tugas.status LIKE '" . $querySearch . "'\n"
                . "OR status_surat_tugas.status LIKE '" . $querySearch . "'"
                . "OR status_surat_tugas.status LIKE '%," . $querySearch . ",%'\n"
                . "OR status_surat_tugas.status LIKE '%," . $querySearch . "'\n"
                . "OR status_surat_tugas.status LIKE '%," . $querySearch . "'"
                . "OR status_surat_tugas.status LIKE '%" . $querySearch . ",%'\n"
                . "OR status_surat_tugas.status LIKE '%" . $querySearch . "'\n"
                . "OR status_surat_tugas.status LIKE '%" . $querySearch . "'"
                . ") \n";
            $this->db->where($selectBerkas, NULL, False);
        }
    }

    public function addPagination($limit, $start)
    {
        $this->db->limit($limit, $start);
    }

    public function getJumlahSearchSurat($roleID, $nipKaprodi, $searchQuery, $sortPencarian)
    {
        $this->db->reset_query();
        $this->seleksiSearch($roleID, $nipKaprodi, $searchQuery);
        $this->addSearchKeyword($searchQuery);
        $this->addSort($sortPencarian);
        $data = $this->db->get()->num_rows();
        return $data;
    }

    public function getSearchSurat($roleID, $nipKaprodi, $searchQuery, $sortPencarian)
    {
        $this->db->reset_query();
        $this->seleksiSearch($roleID, $nipKaprodi, $searchQuery);
        $this->addSearchKeyword($searchQuery);
        $this->addSort($sortPencarian);
        $data = $this->db->get()->result();
        return $data;
    }
    public function getSearchSuratPagination($roleID, $nipKaprodi, $searchQuery, $sortPencarian, $limit, $start)
    {
        $this->db->reset_query();
        $this->seleksiSearch($roleID, $nipKaprodi, $searchQuery);
        $this->addSearchKeyword($searchQuery);
        $this->addSort($sortPencarian);
        $this->addPagination($limit, $start);
        $data = $this->db->get()->result();
        return $data;
    }
    public function getRoleDekan()
    {
        $this->db->where('role_id=13');
        return $this->db->get('user')->result();
    }
    public function getDataKaprodiKK($srt)
    {
        $this->db->reset_query();
        $nip = $srt[0]->nip_kaprodikk;
        $data = $this->db->get_where('user', ['nip' => $nip])->result();
        return $data;
    }



    public function insertSuratSekreFak($eviden, $data)
    {
        $iseviden = str_replace('"', "", $eviden);
        // $tglk = str_replace('"', "", $data['tanggal_kegiatan']);
        // $periode_penugasan = str_replace('"', "", $data['periode_penugasan']);
        // print_r($tglk);
        // print_r($periode_penugasan);
        // die;
        $idSurat = uniqid();
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
        date_default_timezone_set('Asia/Jakarta');
        $t = time();
        $noSurat = $this->getLastNomerSurat();

        $idDosen = $this->buildIdDosen(str_replace('"', "", $data['nip']));
        $divisi = str_replace('"', "", $data['divisi']);
        if ($idDosen != 'Invalid NIP') {
            $newSuratTugas = array(
                'id' => $idSurat,
                'user_id' => $data['user_id'],
                'nip_kaprodikk' => $data['nip_kaprodikk'],
                'nama_kegiatan' => $data['nama_kegiatan'],
                'tanggal_kegiatan' => $data['tanggal_kegiatan'],
                'no_ememo' => $data['no_ememo'],
                'dosen_id' => $idDosen,
                'divisi' => $divisi,
                'jenis_penugasan' => $data['jenis_penugasan'],
                'tempat_kegiatan' => $data['tempat_kegiatan'],
                'periode_penugasan' => $data['periode_penugasan'],
                'penyelenggara' => $data['penyelenggara'],
                'eviden' => $iseviden,
                'stat' => 11,
                'tgl_update_stat' => date("Y-m-d H:i:s", $t),
                'no_surat' => $noSurat,
                'qr_code' => $qr_code,
            );
            $this->db->insert('surat_tugas', $newSuratTugas);
        }
    }
}
