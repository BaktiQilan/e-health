<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }

    public function role()
    {
        $data['title'] = 'Role';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['role'] = $this->db->get_where('user_role', ['id' => $this->session->userdata('role_id')])->row_array();

        $data['grole'] = $this->db->get('user_role')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/role', $data);
        $this->load->view('templates/footer');
    }


    public function roleAccess($role_id)
    {
        $data['title'] = 'Role Access';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['role'] = $this->db->get_where('user_role', ['id' => $this->session->userdata('role_id')])->row_array();

        $data['grole'] = $this->db->get_where('user_role', ['id' => $role_id])->row_array();

        $this->db->where('id !=', 1);
        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/role-access', $data);
        $this->load->view('templates/footer');
    }


    public function changeAccess()
    {
        $menu_id = $this->input->post('menuId');
        $role_id = $this->input->post('roleId');

        $data = [
            'role_id' => $role_id,
            'menu_id' => $menu_id
        ];

        $result = $this->db->get_where('user_access_menu', $data);

        if ($result->num_rows() < 1) {
            $this->db->insert('user_access_menu', $data);
        } else {
            $this->db->delete('user_access_menu', $data);
        }

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Access Changed!</div>');
    }

    public function poli()
    {
        $data['title'] = 'Kelola Data Poli';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['role'] = $this->db->get_where('user_role', ['id' => $this->session->userdata('role_id')])->row_array();

        $data['poli'] = $this->db->get('poly')->result_array();

        $this->form_validation->set_rules('name', 'Name', 'required', [
            'required' => 'Nama poli harus diisi!'
        ]);

        $this->form_validation->set_rules('cost', 'Cost', 'required', [
            'required' => 'Biaya administrasi harus diisi!'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/poli', $data);
            $this->load->view('templates/footer');
        } else {
            $query = [
                'name' => $this->input->post('name'),
                'cost' => $this->input->post('cost'),
            ];
            $this->db->insert('poly', $query);
            $this->session->set_flashdata('message', '<div class="alert alert-success mx-auto" role="alert">Data Poli telah ditambahkan!</div>');
            redirect('admin/poli');
        }
    }

    public function hapusP($id)
    {
        $this->load->model('Admin_model', 'poli');
        $this->poli->hapusPoli($id);
        $this->session->set_flashdata('message', '<div class="alert alert-success mx-auto" role="alert">Data Poli berhasil dihapus</div>');
        redirect('admin/poli');
    }

    public function editP()
    {
        $this->form_validation->set_rules('name', 'Jenis Poli', 'required', [
            'required' => 'Jenis Poli harus diisi!'
        ]);
        $this->form_validation->set_rules('cost2', 'Cost', 'required', [
            'required' => 'Biaya administrasi harus diisi!'
        ]);

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger mx-auto" role="alert">Data Poli gagal di edit!</div>');
            redirect('admin/poli');
        } else {
            $data = [
                'name' => $this->input->post('name'),
                'cost' => $this->input->post('cost2')
            ];
            $this->db->where('id', $_POST['id']);
            $this->db->update('poly', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success mx-auto" role="alert">Data Poli berhasil di edit!</div>');
            redirect('admin/poli');
        }
    }
}
