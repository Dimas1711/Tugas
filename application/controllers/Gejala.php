<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Gejala extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Models', 'model');
    }

    public function index()
    {
        $data['user'] = $this->session->userdata();
        $data['data'] = $this->db->query("SELECT * FROM gejala ORDER BY no_gejala ASC")->result_array();
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar', $data);
        $this->load->view('gejala/gejala', $data);
        $this->load->view('templates/footer');
    }
    public function tambahgejala()
    {
        $data['user'] = $this->session->userdata();
        $data['id'] = $this->db->query("SELECT MAX(no_gejala) as id FROM gejala")->row_array();
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar', $data);
        $this->load->view('gejala/tambah', $data);
        $this->load->view('templates/footer');
    }
    public function editgejala($id)
    {
        $data['user'] = $this->session->userdata();
        $data['data'] = $this->db->query("SELECT * FROM gejala WHERE id_gejala = '$id'")->result_array();
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar', $data);
        $this->load->view('gejala/edit', $data);
        $this->load->view('templates/footer');
    }
    public function tambah()
    {
        $arr = [
            'id_gejala' => $this->input->post('id'),
            'no_gejala' => $this->input->post('no'),
            'nama_gejala' => $this->input->post('nama'),
        ];
        if ($this->model->insert('gejala', $arr)) {
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success mb-3" role="alert">Berhasil tambah data!</div>'
            );
            redirect('Gejala');
        } else {
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-danger mb-3" role="alert">Gagal tambah data!</div>'
            );
            redirect('Gejala');
        }
    }
    public function edit()
    {
        $id = $this->input->post('id_gejala');
        $data = [
            'nama_gejala' => $this->input->post('nama'),
        ];
        $hapus = $this->model->ubah($data, $id, 'id_gejala', 'gejala');
        if ($hapus) {
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success mb-3" role="alert">Berhasil mengubah data!</div>'
            );
            redirect('Gejala');
        } else {
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-danger mb-3" role="alert">Gagal mengubah data!</div>'
            );
            redirect('Gejala');
        }
    }
    public function hapus($id)
    {
        $hapus = $this->model->hapus($id, 'id_gejala', 'gejala');
        if ($hapus) {
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success mb-3" role="alert">Berhasil menghapus data!</div>'
            );
            redirect('Gejala');
        } else {
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-danger mb-3" role="alert">Gagal menghapus data!</div>'
            );
            redirect('Gejala');
        }
    }
}
