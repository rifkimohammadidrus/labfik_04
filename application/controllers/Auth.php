<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }
    public function index()
    {
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');
        if ($this->form_validation->run() == false) {
            $data['title'] = 'LABFIK | Login';
            // $this->load->view('template/auth_header', $data);
            $this->load->view('auth/login');
            // $this->load->view('template/auth_header');
        } else {
            $this->_login();
        }
    }

    private function _login()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $user = $this->db->get_where('user', ['email' => $email])->row_array();
        //jika user ada
        if ($user) {
            //jika user aktif
            if ($user['is_active'] == 1) {
                if (password_verify($password, $user['password']) or ($password == $user['password'])) {
                    $data = [
                        'email' => $user['email'],
                        'role_id' => $user['role_id']
                    ];
                    $this->session->set_userdata($data);
                    redirect('surat');
                } else {
                    $this->session->set_flashdata('massage', '<div class="alert alert-danger" role="alert">
            Wrong Password!
          </div>');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('massage', '<div class="alert alert-danger" role="alert">
            Email is not activate!
          </div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('massage', '<div class="alert alert-danger" role="alert">
            Email is not registerd!
          </div>');
            redirect('auth');
        }
    }


    public function registration()
    {
        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
            'is_unique' => 'Email sudah terdaftrar'
        ]);
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [
            'matches' => 'password dont match!',
            'min_length' => 'password is short!'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');
        if ($this->form_validation->run() == false) {
            $data['title'] = ' User Registration';
            $this->load->view('template/auth_header', $data);
            $this->load->view('auth/registration');
            $this->load->view('template/auth_header');
        } else {
            $data = [
                'id' => uniqid(),
                'name' => htmlspecialchars($this->input->post('name', true)),
                'email' => htmlspecialchars($this->input->post('email', true)),
                'image' => 'default.jpg',
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'role_id' => 4,
                'is_active' => 1,
                'date_create' => time()
            ];
            $this->db->insert('user', $data);
            $this->session->set_flashdata('massage', '<div class="alert alert-info" role="alert">
            Your Account has been created! Please Login!
          </div>');
            redirect('auth');
        }
    }
    public function logout()
    {
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role_id');
        $this->session->set_flashdata('massage', '<div class="alert alert-info" role="alert">
            you have been logout!
          </div>');
        redirect('auth');
    }
    public function blocked()
    {
        $this->load->view('auth/blocked');
    }
}
