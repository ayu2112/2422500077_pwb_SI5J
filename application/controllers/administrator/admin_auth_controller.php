<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_auth_controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Administrator_model');
    }

    public function index() {
        if ($this->session->userdata('admin_login')) {
            redirect('admin');
        }

        // Cek jika ada input POST dari tombol Sign In
        if ($this->input->post('username')) {
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            $check = $this->Administrator_model->check_login($username, $password);

            if ($check->num_rows() > 0) {
                $data_user = $check->row();
                $data_session = array(
                    'username'    => $username,
                    'full_name'   => $data_user->full_name,
                    'admin_login' => TRUE
                );
                $this->session->set_userdata($data_session);
                redirect('admin');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger text-center" role="alert">Username atau Password Salah!</div>');
                redirect('admin/login');
            }
        }

        // Jika tidak ada POST, tampilkan halaman login
        $this->load->view('administrator/login');
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect('admin/login');
    }
}