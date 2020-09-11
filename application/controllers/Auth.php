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
        if ($this->session->userdata('username')) {
            redirect('user');
        }

        $this->form_validation->set_rules('username', 'Username', 'required|trim', [
            'required' => 'username harus diisi!'
        ]);
        $this->form_validation->set_rules('password', 'Password', 'required|trim', [
            'required' => 'password harus diisi!'
        ]);

        if ($this->form_validation->run()  == false) {
            $data['title'] = 'Login Page';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/login');
            $this->load->view('templates/auth_footer');
        } else {

            $this->_login();
        }
    }

    private function _login()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $user = $this->db->get_where('user', ['username' => $username])->row_array();

        if ($user) {

            if ($user['is_active'] ==  1) {
                if (password_verify($password, $user['password'])) {
                    $data = [
                        'id' => $user['id'],
                        'username' => $user['username'],
                        'role_id' => $user['role_id']
                    ];
                    $this->session->set_userdata($data);
                    if ($user['role_id'] == 1) {
                        echo 'berhasil';
                    }else {
                        echo 'error123';
                    }
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger mx-auto" role="alert">Password salah boss!</div>');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger mx-auto" role="alert">Username belum aktif, silahkan menunggu atau hubungi Admin</div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger mx-auto" role="alert">username tidak terdaftar!</div>');
            redirect('auth');
        }
    }

    public function registration()
    {
        $this->load->model('Auth_model', 'auth');

        if ($this->session->userdata('username')) {
            redirect('user');
        }

        $this->form_validation->set_rules('name', 'Name', 'required|trim', [
            'required' => 'nama harus diisi!',
        ]);

        $this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[user.username]', [
            'required' => 'username harus diisi!',
            'is_unique' => 'username ini sudah terdaftar!'
        ]);

        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [
            'required' => 'password harus diisi!',
            'matches' => 'password tidak sama!',
            'min_length' => 'password terlalu pendek!'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]', [
            'required' => 'password harus diisi!'
        ]);

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Pendaftaran Operator';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/registration');
            $this->load->view('templates/auth_footer');
        } else {
            $data = [
                'name' => htmlspecialchars($this->input->post('name', true)),
                'username' => htmlspecialchars($this->input->post('username', true)),
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'role_id' => 2,
                'is_active' => 0,
            ];

            $insert = $this->auth->create('user', $data);
            $this->session->set_flashdata('message','<div class="alert alert-success mx-auto" role="alert">Selamat! Akun Operator anda telah berhasil dibuat. Silahkan Tunggu Konfirmasi dari Admin!  </div>');
            redirect('auth');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role_id');

        $this->session->set_flashdata('message', '<div class="alert alert-success mx-auto" role="alert">Anda telah berhasil Logout</div>');
        redirect('welcome');
    }

    public function blocked()
    {
        $this->load->view('auth/blocked');
    }
}
