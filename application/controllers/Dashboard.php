<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function index()
    {

        $data['user'] = $this->session->userdata();
        $data['total'] = $this->db->query("SELECT COUNT(id_penanganan) as total FROM penanganan")->row();
        $data['mati'] = $this->db->query("SELECT COUNT(id_penanganan) as mati FROM penanganan WHERE status = 1")->row();
        $data['memburuk'] = $this->db->query("SELECT COUNT(id_penanganan) as memburuk FROM penanganan WHERE status = 2")->row();
        $data['membaik'] = $this->db->query("SELECT COUNT(id_penanganan) as membaik FROM penanganan WHERE status = 3")->row();
        $data['sembuh'] = $this->db->query("SELECT COUNT(id_penanganan) as sembuh FROM penanganan WHERE status = 4")->row();
        $data['usernya'] = $this->db->query("SELECT COUNT(id_user) as user FROM user WHERE status = 2 AND is_active = 1")->row();
        $data['nilai'] = $this->db->query("SELECT COUNT(id_riwayat) as nilai FROM riwayat")->row();
        $data['hamapenyakit'] = $this->db->query("SELECT COUNT(id_hama_penyakit) as hamapenyakit FROM hama_penyakit")->row();
        $data['penanganan'] = $this->db->query("SELECT COUNT(id_penanganan) as penanganan FROM penanganan")->row();
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar', $data);
        $this->load->view('admin/dashboard', $data);
        $this->load->view('templates/footer');
    }
}
