<?php
class Autocomplete extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
        error_reporting(0);
    }

    // surat tugas
    function get_nama_kegiatan()
    {
        if (isset($_GET['term'])) {
            $result = $this->user_model->search_nama_kegiatan($_GET['term']);
            if (count($result) > 0) {
                foreach ($result as $row)
                    $arr_result[] = array(
                        'label'            => $row->nama_kegiatan,
                    );
                echo json_encode($arr_result);
            }
        }
    }
    function get_ememo()
    {
        if (isset($_GET['term'])) {
            $result = $this->user_model->search_ememo($_GET['term']);
            if (count($result) > 0) {
                foreach ($result as $row)
                    $arr_result[] = array(
                        'label' => $row->no_ememo,
                    );
                echo json_encode($arr_result);
            }
        }
    }
    function get_periode_penugasan()
    {
        if (isset($_GET['term'])) {
            $result = $this->user_model->search_periode_penugasan($_GET['term']);
            if (count($result) > 0) {
                foreach ($result as $row)
                    $arr_result[] = array(
                        'label' => $row->periode_penugasan,
                    );
                echo json_encode($arr_result);
            }
        }
    }

    public function get_nip()
    {
        if (isset($_GET['term'])) {
            $result = $this->user_model->search_nip($_GET['term']);
            if (count($result) > 0) {
                foreach ($result as $row)
                    $arr_result[] = array(
                        'label'   => $row->nip,
                        'name'    => $row->name,
                        'jabatan' => $row->koordinator,
                    );
                echo json_encode($arr_result);
            }
        }
    }

    public function get_stat()
    {
        if (isset($_GET['term'])) {
            $result = $this->user_model->search_stat($_GET['term']);
            if (count($result) > 0) {
                foreach ($result as $row)
                    $arr_result[] = array(
                        'label'  => $row->status,
                    );
                echo json_encode($arr_result);
            }
        }
    }

    //suratRekomendasi
    public function get_nim()
    {
        if (isset($_GET['term'])) {
            $result = $this->user_model->get_nim($_GET['term']);
            if (count($result) > 0) {
                foreach ($result as $row)
                    $arr_result[] = array(
                        'label' => $row->nim,
                        'name'  => $row->name,
                        'prodi'    => $row->prodi,
                    );
                echo json_encode($arr_result);
            }
        }
    }
    public function get_nimMhs()
    {
        if (isset($_GET['term'])) {
            $result = $this->user_model->search_nimMhs($_GET['term']);
            if (count($result) > 0) {
                foreach ($result as $row)
                    $arr_result[] = array(
                        'label' => $row->nim,
                        'name' => $row->name,
                    );
                echo json_encode($arr_result);
            }
        }
    }

    public function get_namaMhs()
    {
        if (isset($_GET['term'])) {
            $result = $this->user_model->search_namaMhs($_GET['term']);
            if (count($result) > 0) {
                foreach ($result as $row)
                    $arr_result[] = array(
                        'label'  => $row->name,
                    );
                echo json_encode($arr_result);
            }
        }
    }
    public function get_prodiMhs()
    {
        if (isset($_GET['term'])) {
            $result = $this->user_model->search_prodiMhs($_GET['term']);
            if (count($result) > 0) {
                foreach ($result as $row)
                    $arr_result[] = array(
                        'label'  => $row->prodi,
                    );
                echo json_encode($arr_result);
            }
        }
    }
    public function get_typeSurat()
    {
        if (isset($_GET['term'])) {
            $result = $this->user_model->search_typeSurat($_GET['term']);
            if (count($result) > 0) {
                foreach ($result as $row)
                    $arr_result[] = array(
                        'label'  => $row->type_surat,
                    );
                echo json_encode($arr_result);
            }
        }
    }

    public function get_statusMhs()
    {
        if (isset($_GET['term'])) {
            $result = $this->user_model->search_statusMhs($_GET['term']);
            if (count($result) > 0) {
                foreach ($result as $row)
                    $arr_result[] = array(
                        'label'  => $row->status,
                    );
                echo json_encode($arr_result);
            }
        }
    }
}
