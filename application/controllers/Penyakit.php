<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penyakit extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Models', 'model');
    }

    public function index()
    {
        $data['user'] = $this->session->userdata();
        $data['data'] = $this->db->query("SELECT * FROM hama_penyakit WHERE status = '2' ORDER BY no_hama_penyakit ASC")->result_array();
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar', $data);
        $this->load->view('penyakit/penyakit', $data);
        $this->load->view('templates/footer');
    }
    public function list()
    {
        $data['user'] = $this->session->userdata();
        $data['data'] = $this->db->query("SELECT * FROM hama_penyakit WHERE status = '2' ORDER BY no_hama_penyakit ASC")->result_array();
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar', $data);
        $this->load->view('penyakit/list', $data);
        $this->load->view('templates/footer');
    }
    public function detailhama()
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
    public function pertanyaan($id)
    {
        $data['user'] = $this->session->userdata();
        $data['data'] = $this->db->query("SELECT * FROM hama_penyakit WHERE id_hama_penyakit = '$id'")->result_array();
        $data['pertanyaan'] = $this->db->query("SELECT * FROM pertanyaan WHERE id_hama_penyakit = '$id'")->result_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('penyakit/pertanyaan', $data);
        $this->load->view('templates/footer');
    }
    public function gejala()
    {
        $this->db->query("SELECT * FROM gejala")->result_array();
    }
    public function edit($id)
    {
        $data['user'] = $this->session->userdata();
        $data['data'] = $this->db->query("SELECT * FROM hama_penyakit WHERE id_hama_penyakit = '$id'")->result_array();
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar', $data);
        $this->load->view('penyakit/edit', $data);
        $this->load->view('templates/footer');
    }
    public function editnya()
    {
        $id = $this->input->post('id_hama_penyakit');
        $arr = [
            'nama_hama_penyakit' => $this->input->post('nama'),
            'solusi' => $this->input->post('solusi'),
        ];
        $update = $this->model->ubah($arr, $id, "id_hama_penyakit", "hama_penyakit");

        if ($update) {
            $ubahfoto = $_FILES['foto']['name'];

            if ($ubahfoto) {
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $config['max_size'] = '2048';
                $config['upload_path'] = './uploads/penyakit/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('foto')) {
                    $penyakit = $this->db->get_where('hama_penyakit', ['id_hama_penyakit' => $id])->row_array();
                    $fotolama = $penyakit['foto'];
                    if ($fotolama) {
                        unlink(FCPATH . '/uploads/penyakit/' . $fotolama);
                    }
                    $fotobaru = $this->upload->data('file_name');
                    $this->db->set('foto', '/uploads/penyakit/' . $fotobaru);
                    $this->db->where('id_hama_penyakit', $id);
                    $this->db->update('hama_penyakit');
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                Berhasil Mengubah Data!
                </div>');
                    redirect('Penyakit');
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">'
                        . $this->upload->display_errors() .
                        '</div>');
                    redirect('Penyakit');
                }
            } else {

                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Berhasil Mengubah Data!
            </div>');
                redirect('Penyakit');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
        Gagal Mengubah Data!
        </div>');
            redirect('Penyakit');
        }
    }
    public function detail($id)
    {
        $data['user'] = $this->session->userdata();
        $detail = $this->db->query("SELECT * FROM detail WHERE id_hama_penyakit = '$id'")->result_array();
        if ($detail > 0) {
            $data['gejala'] = $this->db->query("SELECT DISTINCT * FROM gejala WHERE id_gejala NOT IN(SELECT id_gejala FROM detail WHERE id_hama_penyakit = '$id')")->result_array();
            $data['data'] = $this->db->query("SELECT * FROM hama_penyakit WHERE id_hama_penyakit = '$id'")->result_array();
            $data['datadetail'] = $this->db->query("SELECT * FROM detail, gejala, hama_penyakit WHERE detail.id_hama_penyakit = hama_penyakit.id_hama_penyakit AND detail.id_gejala = gejala.id_gejala AND hama_penyakit.id_hama_penyakit = '$id'")->result_array();
            $this->load->view('templates/header');
            $this->load->view('templates/sidebar', $data);
            $this->load->view('penyakit/detail', $data);
            $this->load->view('templates/footer');
        } else {
            $data['gejala'] = $this->db->query("SELECT * FROM gejala")->result_array();
            $data['data'] = $this->db->query("SELECT * FROM hama_penyakit WHERE id_hama_penyakit = '$id'")->result_array();
            $data['datadetail'] = $this->db->query("SELECT * FROM detail, gejala, hama_penyakit WHERE detail.id_hama_penyakit = hama_penyakit.id_hama_penyakit AND detail.id_gejala = gejala.id_gejala AND hama_penyakit.id_hama_penyakit = '$id'")->result_array();
            $this->load->view('templates/header');
            $this->load->view('templates/sidebar', $data);
            $this->load->view('penyakit/detail', $data);
            $this->load->view('templates/footer');
        }
    }
    public function tambahpenyakit()
    {
        $data['user'] = $this->session->userdata();
        $data['id'] = $this->db->query("SELECT MAX(no_hama_penyakit) as id FROM hama_penyakit WHERE status = '2'")->row_array();
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar', $data);
        $this->load->view('penyakit/tambah', $data);
        $this->load->view('templates/footer');
    }
    public function tambah()
    {
        $config['allowed_types'] = 'jpg|png|gif|jpeg';
        $config['max_size'] = '2048';
        $config['upload_path'] = './uploads/penyakit';
        $this->load->library('upload', $config);
        if ($this->upload->do_upload('foto')) {
            $foto_namaBaru = $this->upload->data('file_name');
            $arr = [
                'id_hama_penyakit' => $this->input->post('id'),
                'no_hama_penyakit' => $this->input->post('no'),
                'nama_hama_penyakit' => $this->input->post('nama'),
                'solusi' => $this->input->post('solusi'),
                'status' => '2',
                'foto' => '/uploads/penyakit/' . $foto_namaBaru,
            ];
            if ($this->model->insert('hama_penyakit', $arr)) {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-success mb-3" role="alert">Berhasil tambah data!</div>'
                );
                redirect('Penyakit');
            } else {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-danger mb-3" role="alert">Gagal tambah data!</div>'
                );
                redirect('Penyakit');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">'
                . $this->upload->display_errors() .
                '</div>');
            redirect('Penyakit');
        }
    }
    public function tambahdetail()
    {
        $id_hama_penyakit = $this->input->post('id_hama_penyakit');
        $arr = [
            'id_hama_penyakit' => $this->input->post('id_hama_penyakit'),
            'id_gejala' => $this->input->post('gejala'),
            'bobot' => $this->input->post('bobot'),
        ];
        if ($this->model->insert('detail', $arr)) {
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success mb-3" role="alert">Berhasil tambah data!</div>'
            );
            redirect('Penyakit/detail/' . $id_hama_penyakit);
        } else {
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-danger mb-3" role="alert">Gagal tambah data!</div>'
            );
            redirect('Penyakit/detail/' . $id_hama_penyakit);
        }
    }
    public function tambahpertanyaan()
    {
        $id_hama_penyakit = $this->input->post('id_hama_penyakit');
        $id_pertanyaan = $this->model->randomkode(5);
        $kondisi = $this->input->post('kondisi_tanaman');
        $now = date('Y-m-d H:i:s');
        $pertanyaan = $this->input->post('pertanyaan');
        $solusi = $this->input->post('solusi');
        $arr = [
            'id_pertanyaan' => $id_pertanyaan,
            'id_hama_penyakit' => $id_hama_penyakit,
            'pertanyaan' => $pertanyaan,
            'kondisi_tanaman' => $kondisi,
            'solusi' => $solusi,
            'created_at' => $now,
        ];
        $query = $this->model->insert('pertanyaan', $arr);
        if ($query) {
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success mb-3" role="alert">Berhasil tambah data!</div>'
            );
            redirect('Hama/pertanyaan/' . $id_hama_penyakit);
        } else {
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-danger mb-3" role="alert">Gagal tambah data!</div>'
            );
            redirect('Hama/pertanyaan/' . $id_hama_penyakit);
        }
    }
    public function hapus($id)
    {
        $hapus = $this->model->hapus($id, 'id_hama_penyakit', 'hama_penyakit');
        if ($hapus) {
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success mb-3" role="alert">Berhasil menghapus data!</div>'
            );
            redirect('Penyakit');
        } else {
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-danger mb-3" role="alert">Gagal menghapus data!</div>'
            );
            redirect('Penyakit');
        }
    }
    public function hapusdetail($id)
    {
        $hapus = $this->model->hapus($id, 'id_detail', 'detail');
        if ($hapus) {
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success mb-3" role="alert">Berhasil menghapus data!</div>'
            );
            redirect('Penyakit');
        } else {
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-danger mb-3" role="alert">Gagal menghapus data!</div>'
            );
            redirect('Penyakit');
        }
    }
    public function hapuspertanyaan($id)
    {
        $idp = $this->db->query("SELECT id_hama_penyakit FROM pertanyaan WHERE id_pertanyaan = '$id'")->row();
        $hapus = $this->model->hapus($id, 'id_pertanyaan', 'pertanyaan');
        if ($hapus) {
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success mb-3" role="alert">Berhasil menghapus data!</div>'
            );
            redirect('Hama/pertanyaan/' . $idp->id_hama_penyakit);
        } else {
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-danger mb-3" role="alert">Gagal menghapus data!</div>'
            );
            redirect('Hama/pertanyaan/' . $idp->id_hama_penyakit);
        }
    }
}
