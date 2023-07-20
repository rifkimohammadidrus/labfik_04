<?php

class m_suratRekomendasi extends CI_Model
{
    function getSuratMhs($idUser)
    {
        $this->db->where('id_mhs', $idUser);
        return $this->db->get('surat_kmhs')->result();
    }
    function getJumlahSuratMhs($idUser)
    {
        $this->db->where('id_mhs', $idUser);
        return $this->db->get('surat_kmhs')->num_rows();
    }
    public function getSuratMhsPagination($idUser, $limit, $start)
    {
        if ($start == '') {
            $start = 0;
        }
        $this->db->reset_query();
        $this->db->where('id_mhs', $idUser);
        $this->db->order_by("tgl_update_stat", "DESC");
        $this->db->limit($limit, $start);

        return $this->db->get('surat_kmhs')->result();
    }
    public function getUserData()
    {
        $this->db->reset_query();
        $this->db->select("id, nim, name, prodi");
        $data = $this->db->get('user')->result();
        return $data;
    }
    public function getKeteranganStatus()
    {
        $this->db->reset_query();
        $status = $this->db->get_where('status_surat_kmhs')->result();
        return $status;
    }
    public function getSuratbyID($idSurat)
    {
        $this->db->reset_query();
        $this->db->where('id', $idSurat);
        $data = $this->db->get('surat_kmhs')->result();
        return $data;
    }
    public function insertSurat($ktm, $transkrip, $iklan, $data)
    {
        date_default_timezone_set('Asia/Jakarta');
        $t = time();
        $id = uniqid();
        $penilaian = str_replace('"', "", $data['penilaian']);
        $idMhs = $this->getIDUser($data['nim']);
        $idDosenWali = $this->getDosenWali($data['nim']);
        $newSuratRekomendasi = array(
            'id' => $id,
            'type_surat' => $data['type_surat'], //nama beasiswa
            'jenis_surat' => $data['jenis_surat'], //Rekomendasi
            'id_mhs' => $idMhs,
            'dosen_wali' => $idDosenWali,
            'mhs_smt' => $data['mhs_smt'],
            'instansi' => $data['instansi'],
            'mhs_alamat' => $data['alamat'],
            'rt' => $data['rt'],
            'rw' => $data['rw'],
            'kel' => $data['kelurahan'],
            'kec' => $data['kecamatan'],
            'kota' => $data['kota'],
            'prov' => $data['provinsi'],
            'ipk' => $data['ipk'],
            'penilaian' => $penilaian,
            'ktm' => $ktm,
            'transkrip' => $transkrip,
            'iklan' => $iklan,
            'stat' => 1,
            'tgl_update_stat' => date("Y-m-d H:i:s", $t)
        );
        $this->db->insert('surat_kmhs', $newSuratRekomendasi);
    }
    public function insertSuratRekomendasi($ktm, $transkrip, $iklan, $data)
    {
        $data['type_surat'] = $this->tipeSurat($data);
        $this->insertSurat($ktm, $transkrip, $iklan, $data);
    }
    public function insertSuratKeterangan($ktm, $transkrip, $iklan, $data)
    {
        $data['type_surat'] = $this->tipeSurat($data);
        $this->insertSurat($ktm, $transkrip, $iklan, $data);
    }

    public function tipeSurat($data)
    {
        if ($data['tipe_surat'] != 'Lainnya') {
            return $data['tipe_surat'];
        } else {
            return $data['surat_lainnya'];
        }
    }
    public function getIDUser($nim)
    {
        $this->db->SELECT('id');
        $roleUser = $this->db->get_where('user', ['nim' =>  $nim])->row_array();
        if ($roleUser != '' or $roleUser != null) {
            return $roleUser['id'];
        } else {
            return '';
        }
    }
    public function getDosenWali($nim)
    {
        $this->db->SELECT('dosen_wali');
        $roleUser = $this->db->get_where('user', ['nim' =>  $nim])->row_array();
        if ($roleUser != '' or $roleUser != null) {
            return $roleUser['dosen_wali'];
        } else {
            return '';
        }
    }

    public function updateSurat($ktm, $transkrip, $iklan, $data)
    {
        date_default_timezone_set('Asia/Jakarta');
        $t = time();
        $statSurat = $data['stat'];
        if ($statSurat == '3') {
            $newStat = '4';
        } else if ($statSurat == '8') {
            $newStat = '9';
        } else if ($statSurat == '12') {
            $newStat = '13';
        } else {
            $newStat = $statSurat;
        }
        $newSuratRekomendasi = array(
            'type_surat' => $data['type_surat'], //nama beasiswa
            'jenis_surat' => $data['jenis_surat'], //Rekomendasi
            'mhs_smt' => $data['mhs_smt'],
            'instansi' => $data['instansi'],
            'mhs_alamat' => $data['alamat'],
            'rt' => $data['rt'],
            'rw' => $data['rw'],
            'kel' => $data['kelurahan'],
            'kec' => $data['kecamatan'],
            'kota' => $data['kota'],
            'prov' => $data['provinsi'],
            'ipk' => $data['ipk'],
            'penilaian' => $data['penilaian'],
            'keterangan' => $data['keterangan'],
            'ctt_rekomendasi' => $data['ctt_rekomendasi'],
            'ktm' => $ktm,
            'transkrip' => $transkrip,
            'iklan' => $iklan,
            'stat' => $newStat,
            'field_revisi' => '',
            'tgl_update_stat' => date("Y-m-d H:i:s", $t)
        );
        $this->db->update('surat_kmhs', $newSuratRekomendasi);
    }
    public function updateSuratRekomendasi($ktm, $transkrip, $iklan, $data, $id)
    {
        $this->db->where('id', $id);
        $data['type_surat'] = $this->tipeSurat($data);
        $this->updateSurat($ktm, $transkrip, $iklan, $data, $id);
    }
    public function updateSuratKeterangan($ktm, $transkrip, $iklan, $data, $id)
    {
        $this->db->where('id', $id);
        $data['type_surat'] = $this->tipeSurat($data);
        $this->updateSurat($ktm, $transkrip, $iklan, $data, $id);
    }


    // kmhs
    public function get_SuratRekomendasi($roleID, $nipDosenWali)
    {
        $this->db->reset_query();
        $type = 'Rekomendasi';
        $this->seleksiBerkas($roleID, $nipDosenWali, $type);
        $data = $this->db->get('surat_kmhs')->result();
        return $data;
    }

    public function get_SuratKeterangan($roleID, $nipDosenWali)
    {
        $this->db->reset_query();
        $type = 'Keterangan';
        $this->seleksiBerkas($roleID, $nipDosenWali, $type);
        $data = $this->db->get('surat_kmhs')->result();
        return $data;
    }
    public function getJumlahSuratRekomendasi($roleID, $nipDosenWali)
    {
        $this->db->reset_query();
        $type = 'Rekomendasi';
        $this->seleksiBerkas($roleID, $nipDosenWali, $type);
        $data = $this->db->get('surat_kmhs')->num_rows();
        return $data;
    }

    public function getJumlahSuratKeterangan($roleID, $nipDosenWali)
    {
        $this->db->reset_query();
        $type = 'Keterangan';
        $this->seleksiBerkas($roleID, $nipDosenWali, $type);
        $data = $this->db->get('surat_kmhs')->num_rows();
        return $data;
    }
    public function get_SuratRekomendasiPagination($roleID, $nipDosenWali, $limit, $start)
    {
        $this->db->reset_query();
        $type = 'Rekomendasi';
        $this->seleksiBerkasPagination($roleID, $nipDosenWali, $type, $limit, $start);
        $data = $this->db->get('surat_kmhs')->result();
        return $data;
    }

    public function get_SuratKeteranganPagination($roleID, $nipDosenWali, $limit, $start)
    {
        $this->db->reset_query();
        $type = 'Keterangan';
        $this->seleksiBerkasPagination($roleID, $nipDosenWali, $type, $limit, $start);
        $data = $this->db->get('surat_kmhs')->result();
        return $data;
    }
    public function seleksiBerkasPagination($roleID, $nipDosenWali, $type, $limit, $start)
    {
        if ($start == '') {
            $start = 0;
        };
        if ($roleID == '12') { //kmhs
            $selectBerkas = "jenis_surat='" . $type . "'\n"
                . "AND (((stat='1'and penilaian='') and (stat='1' and type_surat !='LPDP')) OR stat='2' OR stat='3' OR stat='4' or stat='5'or stat='6'or stat='7'or stat='10'or stat='11')\n";
            $this->db->where($selectBerkas, NULL, False);
            $this->db->order_by("tgl_update_stat", "DESC");
            $this->db->limit($limit, $start);
        } else if ($roleID == '3') { //dosen wali
            $selectBerkas = "dosen_wali='" . $nipDosenWali . "'\n"
                . "AND jenis_surat='" . $type . "'\n"
                . "AND ((stat='1' and penilaian!='')or(stat='1' and type_surat='LPDP') or stat='5')\n";
            $this->db->where($selectBerkas, NULL, False);
            $this->db->order_by("tgl_update_stat", "DESC");
            $this->db->limit($limit, $start);
        } else if ($roleID == '14') { //wadek
            $selectBerkas = "jenis_surat='" . $type . "'\n"
                . "AND (stat='6' or stat='7'  or stat='8'or stat='9')\n";
            $this->db->where($selectBerkas, NULL, False);
            $this->db->order_by("tgl_update_stat", "DESC");
            $this->db->limit($limit, $start);
        } else if ($roleID == '13') { //dekan
            $selectBerkas = "jenis_surat='" . $type . "'\n"
                . "AND (stat='10' or stat='11' or stat='12'or stat='13')\n";
            $this->db->where($selectBerkas, NULL, False);
            $this->db->order_by("tgl_update_stat", "DESC");
            $this->db->limit($limit, $start);
        }
    }

    public function seleksiBerkas($roleID, $nipDosenWali, $type)
    {
        if ($roleID == '12') { //kmhs
            $getSurat = "jenis_surat='" . $type . "'\n" . "AND (((stat='1'and penilaian='') and (stat='1' and type_surat != 'LPDP' )) or stat='2' or stat='3' or stat='4' or stat='5'or stat='6'or stat='7'or stat='10'or stat='11')";
            $this->db->where($getSurat, NULL, false);
            $this->db->order_by("tgl_update_stat", "DESC");
        } else if ($roleID == '3') { //dosen wali
            $getSurat = "dosen_wali='" . $nipDosenWali . "'" . "AND jenis_surat='" . $type . "'\n" . "AND ((stat='1' and penilaian !='') or (stat='1'and type_surat='LPDP')or stat='5')";
            $this->db->where($getSurat, NULL, false);
            $this->db->order_by("tgl_update_stat", "DESC");
        } else if ($roleID == '13') { //wadek
            $getSurat = "jenis_surat='" . $type . "'\n"
                . "AND (stat='6' or stat='7'  or stat='8'or stat='9')\n";
            $this->db->where($getSurat, NULL, false);
            $this->db->order_by("tgl_update_stat", "DESC");
        } else if ($roleID == '14') { //wadek
            $getSurat =  "jenis_surat='" . $type . "'\n"
                . "AND (stat='10' or stat='11' or stat='12'or stat='13')\n";
            $this->db->where($getSurat, NULL, false);
            $this->db->order_by("tgl_update_stat", "DESC");
        }
    }




    public function updateStatus($stat, $id, $ctt, $field_revisi, $noSurat, $qr_code, $nilai, $alasan, $instansi, $alamat_instansi, $no_tlp, $email, $thn_akademik)
    {
        date_default_timezone_set('Asia/Jakarta');
        $t = time();
        $data = array(
            'stat' => $stat,
            'tgl_update_stat' => date("Y-m-d H:i:s", $t),
            'field_revisi' => $field_revisi,
            'ctt_revisi' => $ctt,
            'no_surat' => $noSurat,
            'qr_code' => $qr_code,
            'keterangan' => $nilai,
            'ctt_rekomendasi' => $alasan,
            'nama_instansi' => $instansi,
            'alamat_instansi' => $alamat_instansi,
            'no_tlp' => $no_tlp,
            'email' => $email,
            'thn_akademik' => $thn_akademik

        );
        $this->db->where('id', $id);
        $this->db->update('surat_kmhs', $data);
    }


    //MENU PENCARI
    public function seleksiSearch($roleID, $nipDosenWali, $type)
    {
        $this->db->from('surat_kmhs');
        if ($roleID == '12') {
            $this->db->select('surat_kmhs.*');
            $this->db->join('user', 'surat_kmhs.id_mhs = user.id', 'left');
            $this->db->join('status_surat_kmhs', 'surat_kmhs.stat = status_surat_kmhs.id', 'left');
            $selectBerkas = "jenis_surat='" . $type . "'\n"
                . "AND (((surat_kmhs.stat='1' and surat_kmhs.penilaian='') and (surat_kmhs.stat='1'and surat_kmhs.type_surat!='LPDP')) or (surat_kmhs.stat='2'  OR surat_kmhs.stat='3' or surat_kmhs.stat='4'or surat_kmhs.stat='5'or surat_kmhs.stat='6'or surat_kmhs.stat='7'or surat_kmhs.stat='10'or surat_kmhs.stat='11' ))\n";
            $this->db->where($selectBerkas, NULL, False);
        } else if ($roleID == '3') { //admin prodi
            $this->db->select('surat_kmhs.*');
            $this->db->join('user', 'surat_kmhs.id_mhs = user.id', 'left');
            $this->db->join('status_surat_kmhs', 'surat_kmhs.stat = status_surat_kmhs.id', 'left');
            $selectBerkas = "surat_kmhs.dosen_wali='" . $nipDosenWali . "'\n" .
                "AND ( surat_kmhs.stat='1'and surat_kmhs.penilaian!='') or (surat_kmhs.stat='1'and surat_kmhs.type_surat='LPDP')or surat_kmhs.stat='5' \n";
            $this->db->where($selectBerkas, NULL, False);
        } else if ($roleID == '14') { //wadek
            $this->db->select('surat_kmhs.*');
            $this->db->join('user', 'surat_kmhs.id_mhs = user.id', 'left');
            $this->db->join('status_surat_kmhs', 'surat_kmhs.stat = status_surat_kmhs.id', 'left');
            $selectBerkas = "jenis_surat='" . $type . "'\n" .
                "AND ( surat_kmhs.stat='6' or surat_kmhs.stat='7'or surat_kmhs.stat='8' or surat_kmhs.stat='9') \n";
            $this->db->where($selectBerkas, NULL, False);
        } else if ($roleID == '13') { //dekan
            $this->db->select('surat_kmhs.*');
            $this->db->join('user', 'surat_kmhs.id_mhs = user.id', 'left');
            $this->db->join('status_surat_kmhs', 'surat_kmhs.stat = status_surat_kmhs.id', 'left');
            $selectBerkas = "jenis_surat='" . $type . "'\n" .
                "AND ( surat_kmhs.stat='10' or surat_kmhs.stat='11'or surat_kmhs.stat='12' or surat_kmhs.stat='13') \n";
            $this->db->where($selectBerkas, NULL, False);
        }
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
            $selectBerkas = "(user.name LIKE '%" . $querySearch . "%' "
                . "OR user.name LIKE '" . $querySearch . ",%'\n"
                . "OR user.name LIKE '%," . $querySearch . ",%'\n"
                . "OR user.name LIKE '%," . $querySearch . "%'\n"
                . "OR user.nim LIKE '%" . $querySearch . "%' "
                . "OR user.prodi LIKE '%" . $querySearch . "%' "
                . "OR surat_kmhs.mhs_smt LIKE '%" . $querySearch . "%' "
                . "OR surat_kmhs.dosen_wali LIKE '%" . $querySearch . "%' "
                . "OR surat_kmhs.type_surat LIKE '%" . $querySearch . "%' "
                . "OR surat_kmhs.type_surat LIKE '" . $querySearch . ",%'\n"
                . "OR surat_kmhs.type_surat LIKE '" . $querySearch . "%'\n"
                . "OR surat_kmhs.type_surat LIKE '" . $querySearch . "'\n"
                . "OR surat_kmhs.type_surat LIKE '" . $querySearch . "'"
                . "OR surat_kmhs.jenis_surat LIKE '%" . $querySearch . "'"
                . "OR surat_kmhs.mhs_smt LIKE '%" . $querySearch . "%' "
                . "OR surat_kmhs.mhs_alamat LIKE '%" . $querySearch . "%' "
                . "OR surat_kmhs.rt LIKE '%" . $querySearch . "%' "
                . "OR surat_kmhs.rw LIKE '%" . $querySearch . "%' "
                . "OR surat_kmhs.kel LIKE '%" . $querySearch . "%' "
                . "OR surat_kmhs.kec LIKE '%" . $querySearch . "%' "
                . "OR surat_kmhs.prov LIKE '%" . $querySearch . "%' "
                . "OR status_surat_kmhs.status LIKE '" . $querySearch . ",%'\n"
                . "OR status_surat_kmhs.status LIKE '" . $querySearch . "%'\n"
                . "OR status_surat_kmhs.status LIKE '" . $querySearch . "'\n"
                . "OR status_surat_kmhs.status LIKE '" . $querySearch . "'"
                . "OR status_surat_kmhs.status LIKE '%," . $querySearch . ",%'\n"
                . "OR status_surat_kmhs.status LIKE '%," . $querySearch . "'\n"
                . "OR status_surat_kmhs.status LIKE '%," . $querySearch . "'"
                . "OR status_surat_kmhs.status LIKE '%" . $querySearch . ",%'\n"
                . "OR status_surat_kmhs.status LIKE '%" . $querySearch . "'\n"
                . "OR status_surat_kmhs.status LIKE '%" . $querySearch . "'"
                . ") \n";
            $this->db->where($selectBerkas, NULL, False);
        }
    }

    public function addPagination($limit, $start)
    {
        $this->db->limit($limit, $start);
    }

    public function getJumlahSearchSurat($roleID, $nipDosenWali, $typeSurat, $searchQuery, $sortPencarian)
    {
        $this->db->reset_query();
        $this->seleksiSearch($roleID, $nipDosenWali, $typeSurat, $searchQuery);
        $this->addSearchKeyword($searchQuery);
        $this->addSort($sortPencarian);
        $data = $this->db->get()->num_rows();
        // print_r($data);
        // die;
        return $data;
    }

    public function getSearchSurat($roleID, $nipDosenWali, $typeSurat, $searchQuery, $sortPencarian)
    {
        $this->db->reset_query();
        $this->seleksiSearch($roleID, $nipDosenWali, $typeSurat, $searchQuery);
        $this->addSearchKeyword($searchQuery);
        $this->addSort($sortPencarian);
        $data = $this->db->get()->result();
        // print_r($data);
        // die;
        return $data;
    }
    public function getSearchSuratPagination($roleID, $nipDosenWali, $typeSurat,  $searchQuery, $sortPencarian, $limit, $start)
    {
        $this->db->reset_query();
        $this->seleksiSearch($roleID, $nipDosenWali, $typeSurat, $searchQuery);
        $this->addSearchKeyword($searchQuery);
        $this->addSort($sortPencarian);
        $this->addPagination($limit, $start);
        $data = $this->db->get()->result();
        return $data;
    }

    //Function untuk print
    public function tgl_surat($data)
    {
        $dateStr = $data[0]->tgl_update_stat;
        $dateTime = strtotime($dateStr);
        return date('d M Y', $dateTime);
    }

    public function getApproverRole($data)
    {
        $stat = $data[0]->stat;
        if ($stat == '2') {
            return $this->getKemahasiswaan();
        } else if ($stat == '7') {
            return $this->getRoleWadekan();
        } else if ($stat == '11') {
            return $this->getRoleDekan();
        }
    }

    public function getRoleDekan()
    {
        $this->db->where('role_id=13');
        return $this->db->get('user')->result();
    }

    public function getRoleWadekan()
    {
        $this->db->where('role_id=14');
        return $this->db->get('user')->result();
    }

    public function getKemahasiswaan()
    {
        $this->db->where('role_id=12');
        return $this->db->get('user')->result();
    }
}
