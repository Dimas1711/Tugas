<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Riwayat extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Models', 'model');
    }

    public function index()
    {
        $data['user'] = $this->session->userdata();
        $id_user = $data['user']['id_user'];
        $data['data'] = $this->db->query("SELECT Date(created_at) as date, TIME(created_at) as time, id_riwayat, id_user, status FROM riwayat WHERE id_user = '$id_user' AND status != '2' ORDER BY created_at DESC")->result_array();
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar', $data);
        $this->load->view('penilaian/riwayat', $data);
        $this->load->view('templates/footer');
    }
    public function detail($id)
    {
        $now = date('Y-m-d');
        $data['user'] = $this->session->userdata();
        $data['hama_penyakit'] = $this->db->query("SELECT * FROM hasil, hama_penyakit WHERE hasil.id_hama_penyakit = hama_penyakit.id_hama_penyakit AND hasil.id_riwayat = '$id' ORDER BY hasil.persentase DESC")->row();
        $data['gejalapilih'] = $this->db->query("SELECT * FROM detail_riwayat, gejala WHERE detail_riwayat.id_riwayat = '$id' AND detail_riwayat.id_gejala = gejala.id_gejala")->result_array();
        // $data['penanganan'] = $this->db->query("SELECT * FROM penanganan WHERE tanggal_mulai = '$now' AND id_riwayat = '$id'")->row();
        $data['kondisinya'] = $this->db->query("SELECT DISTINCT status FROM penanganan WHERE id_riwayat = '$id' ORDER BY tanggal_selesai DESC")->row();
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar', $data);
        $this->load->view('penilaian/detail_riwayat', $data);
        $this->load->view('templates/footer');
    }
    public function pertanyaan()
    {
        $id = $this->input->post('id');
        $kondisi = $this->input->post('kondisi');
        $datapertanyaan = $this->db->query("SELECT * FROM pertanyaan WHERE id_hama_penyakit = '$id' AND kondisi_tanaman = '$kondisi' ORDER BY created_at ASC")->result();
        echo json_encode($datapertanyaan);
    }
    public function detailpenanganan()
    {
        $id = $this->input->post('id');
        $datapertanyaan = $this->db->query("SELECT * FROM detail_penanganan, pertanyaan WHERE detail_penanganan.id_pertanyaan = pertanyaan.id_pertanyaan AND detail_penanganan.id_penanganan = '$id'")->result();
        echo json_encode($datapertanyaan);
    }
    public function detailsolusi()
    {
        $id = $this->input->post('id');
        $datasolusi = $this->db->query("SELECT DISTINCT solusi FROM detail_penanganan, pertanyaan WHERE detail_penanganan.id_pertanyaan = pertanyaan.id_pertanyaan AND detail_penanganan.id_penanganan = '$id'")->result();
        echo json_encode($datasolusi);
    }
    public function penanganan()
    {
        $id = $this->input->post('id');
        $json = array();
        $data = $this->db->query("SELECT * FROM penanganan WHERE id_riwayat = '$id'")->result_array();
        foreach ($data as $d) {
            if ($d['status'] == 0) {
                $penanganan = 'Belum ada penanganan';
                $background = 'rgb(3, 171, 255)';
                $textcolor = 'rgb(10,10,10)';
            } else if ($d['status'] == 1) {
                $penanganan = 'Tanaman mati';
                $background = 'rgb(10, 10, 10)';
                $textcolor = 'rgb(255,255,255)';
            } else if ($d['status'] == 2) {
                $penanganan = 'Tanaman memburuk';
                $background = 'rgb(252, 111, 3)';
                $textcolor = 'rgb(10,10,10)';
            } else if ($d['status'] == 3) {
                $penanganan = 'Tanaman membaik';
                $background = 'rgb(205, 255, 3)';
                $textcolor = 'rgb(10,10,10)';
            } else {
                $penanganan = 'Tanaman sembuh';
                $background = 'rgb(3, 252, 32)';
                $textcolor = 'rgb(10,10,10)';
            }
            $json[] = array(
                'id' => $d['id_penanganan'],
                'title' => $penanganan,
                'start' => $d['tanggal_mulai'],
                'end' => $d['tanggal_selesai'],
                'backgroundColor' => $background,
                'textColor' => $textcolor,
            );
        }
        echo json_encode($json);
    }
    public function editpenanganan()
    {
        // ////insert penanganan/////
        // for ($i = 0; $i <= 6; $i++) {
        //     $tanggal = date('Y-m-d', time() + 86400 * $i);
        //     $arr_penanganan = [
        //         'id_riwayat' => $id_riwayat,
        //         'tanggal_mulai' => $tanggal,
        //         'tanggal_selesai' => $tanggal,
        //         'status' => 0,
        //     ];

        //     $queryriwayat = $this->model->insert('penanganan', $arr_penanganan);
        // }
        // ////---------------------------------------------------////

        // $id = $this->input->post('id');
        $id_penanganan = $this->model->randomkode(5);
        $id_riwayat = $this->input->post('id_riwayat');
        $tanggal = $this->input->post('tanggal');
        $penanganan = $this->input->post('penanganan');
        $tanya = $this->input->post('tanya');


        $query = $this->db->query("SELECT * FROM penanganan WHERE id_riwayat = '$id_riwayat' AND tanggal_mulai = '$tanggal'")->row();

        if ($query) {
            //kalo ada di db, hapus sek seng detail_penanganan, update tabel penanganan, if tanya != null insert tabel detail_penanganan
            $idpenanganandb = $query->id_penanganan;
            if ($tanya == null) {
                $this->model->hapus($idpenanganandb, 'id_penanganan', 'detail_penanganan');
                $data = [
                    'status' => $penanganan
                ];
                $ganti = $this->model->ubah($data, $idpenanganandb, 'id_penanganan', 'penanganan');
                if ($ganti) {
                    $this->session->set_flashdata(
                        'message',
                        '<div class="alert alert-success mb-3" role="alert">Berhasil mengubah data!</div>'
                    );
                    redirect('Riwayat/detail/' . $id_riwayat);
                } else {
                    $this->session->set_flashdata(
                        'message',
                        '<div class="alert alert-danger mb-3" role="alert">Gagal mengubah data!</div>'
                    );
                    redirect('Riwayat/detail/' . $id_riwayat);
                }
            } else {
                $this->model->hapus($idpenanganandb, 'id_penanganan', 'detail_penanganan');
                $data = [
                    'status' => $penanganan
                ];
                foreach ($tanya as $t) {
                    $arr_detail_penanganan = [
                        'id_penanganan' => $idpenanganandb,
                        'id_pertanyaan' => $t,
                    ];

                    $this->model->insert('detail_penanganan', $arr_detail_penanganan);
                }
                $ganti = $this->model->ubah($data, $idpenanganandb, 'id_penanganan', 'penanganan');
                if ($ganti) {
                    $this->session->set_flashdata(
                        'message',
                        '<div class="alert alert-success mb-3" role="alert">Berhasil mengubah data!</div>'
                    );
                    redirect('Riwayat/detail/' . $id_riwayat);
                } else {
                    $this->session->set_flashdata(
                        'message',
                        '<div class="alert alert-danger mb-3" role="alert">Gagal mengubah data!</div>'
                    );
                    redirect('Riwayat/detail/' . $id_riwayat);
                }
            }
        } else {
            $arr_penanganan = [
                'id_penanganan' => $id_penanganan,
                'id_riwayat' => $id_riwayat,
                'tanggal_mulai' => $tanggal,
                'tanggal_selesai' => $tanggal,
                'status' => $penanganan,
            ];
            foreach ($tanya as $t) {
                $arr_detail_penanganan = [
                    'id_penanganan' => $id_penanganan,
                    'id_pertanyaan' => $t,
                ];

                $this->model->insert('detail_penanganan', $arr_detail_penanganan);
            }
            $querypenanganan = $this->model->insert('penanganan', $arr_penanganan);
            if ($querypenanganan) {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-success mb-3" role="alert">Berhasil mengubah data!</div>'
                );
                redirect('Riwayat/detail/' . $id_riwayat);
            } else {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-danger mb-3" role="alert">Gagal mengubah data!</div>'
                );
                redirect('Riwayat/detail/' . $id_riwayat);
            }
        }
    }
    public function hapus($id)
    {
        $data = [
            'status' => 2
        ];
        $hapus = $this->model->ubah($data, $id, 'id_riwayat', 'riwayat');
        if ($hapus) {
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success mb-3" role="alert">Berhasil menghapus data!</div>'
            );
            redirect('Riwayat');
        } else {
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-danger mb-3" role="alert">Gagal menghapus data!</div>'
            );
            redirect('Riwayat');
        }
    }
}
