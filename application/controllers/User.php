<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Models', 'model');
    }

    public function index()
    {

        $data['user'] = $this->session->userdata();
        $data['pengguna'] = $this->db->query("SELECT * FROM user WHERE status = 2 AND is_active != 3")->result_array();
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar', $data);
        $this->load->view('admin/user', $data);
        $this->load->view('templates/footer');
    }

    public function hapus($id)
    {
        $data = [
            'is_active' => 3
        ];
        $hapus = $this->model->ubah($data, $id, 'id_user', 'user');
        if ($hapus) {
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success mb-3" role="alert">Berhasil menghapus data!</div>'
            );
            redirect('User');
        } else {
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-danger mb-3" role="alert">Gagal menghapus data!</div>'
            );
            redirect('User');
        }
    }
}
