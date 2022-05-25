<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penilaian extends CI_Controller
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
        $this->load->view('penilaian/penilaian', $data);
        $this->load->view('templates/footer');
    }

    public function detail()
    {
        $id = $this->input->post('id');
        $datahamapenyakit = $this->db->query("SELECT * FROM hama_penyakit WHERE id_hama_penyakit = '$id'")->result();
        echo json_encode($datahamapenyakit);
    }

    public function detailgejala()
    {
        $id = $this->input->post('id');
        $datahamapenyakit = $this->db->query("SELECT * FROM gejala, detail WHERE detail.id_gejala = gejala.id_gejala AND detail.id_hama_penyakit = '$id'")->result();
        echo json_encode($datahamapenyakit);
    }

    public function hitung()
    {
        $data['user'] = $this->session->userdata();
        $a = $this->input->post('gejala');
        $id_riwayat = $this->model->randomkode(5);
        $now = date('Y-m-d H:i:s');
        $totalgejala = $this->db->query("SELECT COUNT(id_gejala) as total FROM gejala")->row();

        if ($a == null) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Silahkan pilih gejala terlebih dahulu!
                </div>');
            redirect('Penilaian');
        } elseif (count($a) == $totalgejala->total) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Terjadi kesalahan, pilih gejala dengan benar!
                </div>');
            redirect('Penilaian');
        } else {
            ////insert data riwayat & detail riwayat////
            $arr_riwayat = [
                'id_riwayat' => $id_riwayat,
                'id_user' => $data['user']['id_user'],
                'created_at' => $now,
                'status' => 1,
            ];

            $queryriwayat = $this->model->insert('riwayat', $arr_riwayat);

            foreach ($a as $gejala) {
                $arr_riwayatdetail = [
                    'id_riwayat' => $id_riwayat,
                    'id_gejala' => $gejala,
                ];
                $queryriwayatdetail = $this->model->insert('detail_riwayat', $arr_riwayatdetail);
            }
            ////---------------------------------------------------////
            $array = implode("','", $a); //mecah arrayne gae query
            $dataarraynya = array(); //set array anyar gae di push
            $tes = $this->db->query("SELECT DISTINCT id_hama_penyakit FROM detail WHERE id_gejala IN ('$array')")->result_array(); //jekek id ne where in array gejala ne
            foreach ($tes as $q) {
                $id = $q['id_hama_penyakit'];
                $totalbobotatas = $this->db->query("SELECT sum(bobot) as total, detail.id_hama_penyakit, hama_penyakit.nama_hama_penyakit as nama_hama_penyakit FROM detail, hama_penyakit WHERE detail.id_hama_penyakit = hama_penyakit.id_hama_penyakit AND detail.id_hama_penyakit = '$id' AND detail.id_gejala IN('$array')")->row(); //total bobot seng ngisor (iki seng seng podo tok)
                $totalbobotbawah = $this->db->query("SELECT sum(bobot) as total FROM detail WHERE id_hama_penyakit = '$id'")->row(); //total bobot seng ngisor (iki seng total kabeh)
                array_push($dataarraynya, array($totalbobotatas->nama_hama_penyakit, $totalbobotatas->id_hama_penyakit, number_format((($totalbobotatas->total / $totalbobotbawah->total) * 100), 2)),); //ngisi array seng dek duwur
                $arr_hasil = [
                    'id_riwayat' => $id_riwayat,
                    'id_hama_penyakit' => $totalbobotatas->id_hama_penyakit,
                    'persentase' => number_format((($totalbobotatas->total / $totalbobotbawah->total) * 100), 2),
                ];

                $queryhasil = $this->model->insert('hasil', $arr_hasil);
            }
            if ($queryriwayat && $queryriwayatdetail && $queryhasil) {
                $data['arraynya'] = $dataarraynya; //set data gae dek view ne
                // $data['arraynya'] = $this->db->query("SELECT * FROM hasil WHERE id_riwayat = '$id_riwayat'  ORDER BY persentase DESC LIMIT 3")->result_array();
                $data['arrayteratas'] = $this->db->query("SELECT * FROM hasil, hama_penyakit WHERE hasil.id_hama_penyakit = hama_penyakit.id_hama_penyakit AND hasil.id_riwayat = '$id_riwayat'  ORDER BY persentase DESC LIMIT 5")->result_array();
                $data['gejalapilih'] = $a;
                $this->load->view('templates/header');
                $this->load->view('templates/sidebar', $data);
                $this->load->view('penilaian/hasil', $data);
                $this->load->view('templates/footer');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Terjadi kesalahan pada proses input data!
            </div>');
                redirect('Penilaian');
            }
        }
    }
}
