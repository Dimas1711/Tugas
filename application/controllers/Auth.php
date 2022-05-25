<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Models', 'model');
    }

    public function index()
    {
        $this->load->view('templates/header');
        $this->load->view('auth/login');
    }

    public function regis()
    {
        $this->load->view('templates/header');
        $this->load->view('auth/regis');
    }
    public function login()
    {
        $email = $this->input->post("email");
        $pass = $this->input->post("password");

        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header');
            $this->load->view('auth/login');
        } else {
            $user = $this->db->get_where("user", ['email' => $email])->row_array();
            if ($user) {
                if ($user['is_active'] == '1') {
                    $passmd5 = md5($pass);
                    if ($passmd5 == $user['password']) {
                        $data = [
                            'email' => $user['email'],
                            'id_user' => $user['id_user'],
                            'nama' => $user['nama'],
                            'status' => $user['status'],
                        ];
                        $this->session->set_userdata($data);
                        if ($data['status'] == 1) {
                            redirect('Dashboard');
                        } else {
                            redirect('Dashboard_User');
                        }
                    } else {
                        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
						Wrong Password!
						</div>');
                        redirect('Auth');
                    }
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                        This email has not been actived!
                        </div>');
                    redirect('Auth');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
			Email is not registered!
			</div>');
                redirect('Auth');
            }
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('nama');
        $this->session->unset_userdata('id_user');
        $this->session->unset_userdata('status');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
			You have been logged out!
			</div>');
        redirect('Auth');
    }

    public function Registrasi()
    {
        $this->form_validation->set_rules('nama', 'Nama', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]');
        $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[3]|matches[konfirmasi_password]', ['min_length' => 'Password too short']);
        $this->form_validation->set_rules('konfirmasi_password', 'Konfirmasi password', 'required|trim|min_length[3]|matches[password]');
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header');
            $this->load->view('auth/regis');
        } else {
            $data = array(
                'email' => $this->input->post('email'),
                'nama' => $this->input->post('nama'),
                'password' => md5($this->input->post('password')),
                'is_active' => 0,
                'status' => 2
            );
            $query = $this->model->insert('user', $data);
            if ($query) {
                $this->_sendEmail('verify');
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
				Berhasil membuat akun. Selanjutnya, silahkan aktifkan akun Anda melalui email yang terdaftar!</div>');
                redirect('Auth');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
				Gagal membuat akun!</div>');
                redirect('Auth');
            }
        }
    }

    public function _sendEmail($type)
    {
        $config = [
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_user' => 'gumball4869@gmail.com',
            'smtp_pass' => 'dimas2019',
            'smtp_port' => 465,
            'mailtype' => 'html',
            'charset' => 'utf-8',
            'newline' => "\r\n",
        ];
        // $this->load->library('email' , $config);
        $this->email->initialize($config);
        $this->email->from('gumball4869@gmail.com', 'Sistem Pakar Anggrek Bulan'); //pengirim
        $this->email->to($this->input->post('email')); //ditujukann
        if ($type == 'verify') {

            $this->email->subject('Verifikasi Akun');
            $this->email->message('Klik link berikut untuk mengaktifkan akun Anda : <a href="' . base_url() . 'Auth/verify/?email=' . $this->input->post('email') . '">Aktifkan</a>');
        }
        // else if ($type == 'forgot') {
        //     $this->email->subject('Forgot Password');
        //     $this->email->message('Click this link to reset your password : <a href="'.base_url() . 'Daftar/forgot?email=' .$this->input->post('email'). '">Reset Password</a>');

        // }

        if ($this->email->send()) {
            return true;
        } else {
            echo $this->email->print_debugger();
            die;
        }
    }

    public function verify()
    {
        $email = $this->input->get('email');
        $user = $this->db->get_where('user', ['email' => $email])->row_array();

        if ($user) {
            $this->db->set('is_active', 1);
            $this->db->where('email', $email);
            $this->db->update('user');

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
			' . $email . 'telah aktif, silahkan login. </div>');
            redirect('Auth');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
			Email tidak valid. Aktivasi akun gagal!
			</div>');
            redirect('Auth');
        }
    }

    public function forgot()
    {

        $email = $this->input->get('email');

        $user = $this->db->get_where('user', ['email' => $email])->row_array();

        if ($user) {
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
			Email tidak valid. Reset password gagal!
			</div>');
            redirect('auth/login');
        }
    }
}
