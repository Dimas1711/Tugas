<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard_User extends CI_Controller
{
    public function index()
    {

        $data['user'] = $this->session->userdata();
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar', $data);
        $this->load->view('admin/dashboard_user');
        $this->load->view('templates/footer');
    }
}
