<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct() {
		parent::__construct();
		
        //memanggil model
        $this->load->model(array('user_model'));
    }

	public function index() {
		//mengarahkan ke function read
		$this->login();
	}

	public function login() {
		
		//memanggil fungsi login submit	(agar di view tidak dilihat fungsi login submit)
		$this->login_submit();

		//mengirim data ke view
		$output = array(
						'judul' => 'Login'
					);

		//memanggil file view
		$this->load->view('login', $output);
	}

	private function login_submit() {
		
		//proses jika tombol login di submit
		if($this->input->post('submit') == 'Login') {

			//aturan validasi input login
			$this->form_validation->set_rules('username', 'Username', 'required|alpha_numeric|callback_login_check');
			$this->form_validation->set_rules('password', 'Password', 'required|alpha_numeric|min_length[5]');

			//jika validasi sukses 
			if ($this->form_validation->run() == TRUE) {

				//redirect ke provinsi (bisa dirubah ke controller & fungsi manapun)
				redirect('dashboard/read');
			} 

		}
	}

	public function login_check() {
		//menangkap data input dari view
		$username = $this->input->post('username');	
		$password = $this->input->post('password');

		//password encrypt
		$password_encrypt = md5($password);

		//check username & password sesuai dengan di database
		$data_user = $this->user_model->read_single($username, $password_encrypt);
		
		//jika cocok : dikembalikan ke fungsi login_submit (validasi sukses)
		if(!empty($data_user)) {

			//buat session user 
			$this->session->set_userdata('nip', $data_user['nip']);
			$this->session->set_userdata('nama_petugas', $data_user['nama_petugas']);

			return TRUE;

		//jika tidak cocok : dikembalikan ke fungsi login_submit (validasi gagal)
		}else {

			//membuat pesan error
			$this->form_validation->set_message('login_check', 'Username & password tidak tepat');
			
			return FALSE;

		}
	}

	public function logout() {

		//hapus session user
		$this->session->unset_userdata('nip');
		$this->session->unset_userdata('nama_petugas');

		//mengembalikan halaman ke function read
		redirect('user/login');
	}

	public function reset_password() {

		$this->reset_submit();
		//mengirim data ke view
		$nip = $this->session->userdata('nama_petugas');
		$output = array(
						'theme_page' => 'reset_password',
						'judul' => 'Reset Password',
						'petugas' => $nip
					);

		//memanggil file view
		$this->load->view('theme/index', $output);
	}

	private function reset_submit(){

		if ($this->input->post('submit') == 'Simpan') {

			//aturan validasi input login
			$this->form_validation->set_rules('password_lama', 'Current Password', 'required|trim|callback_reset_check');
			$this->form_validation->set_rules('password_baru', 'New Password', 'required|trim');
			$this->form_validation->set_rules('password_baru_ulangi', 'Confirm New Password', 'required|trim|min_length[5]');
			
			if($this->form_validation->run() == TRUE){
				//redirect ke provinsi (bisa dirubah ke controller & fungsi manapun)
				$this->session->set_tempdata('message', 'Success, password has changed !', 10);
				redirect('user/reset_password');
			}
		}
	}

	public function reset_check()
	{
		//menangkap data input dari view
		$currentPassword = $this->input->post('password_lama');
		$newPassword = $this->input->post('password_baru');
		$confirmPassword = $this->input->post('password_baru_ulangi');
		
		//password encrypt
		$currentPassword= md5($currentPassword);
		$Password = md5($newPassword);
		$confirmPassword = md5($confirmPassword);
		
		//check username & password sesuai dengan di database
		$nama = $this->session->userdata('nip');
		$data_user = $this->user_model->read($currentPassword);

		//jika data user sesuai dengan di database
		if (!empty($data_user)) {

			//jika password baru sama dengan password yang lama
			if ($Password == $currentPassword) {

				$this->form_validation->set_message('reset_check','New Password cannot be same with Current Password');
				return FALSE;
				
			//jika konfirmasi password berbeda dengan password baru 
			} else if ($confirmPassword != $Password) {
				
				$this->form_validation->set_message('reset_check', 'The Confirm New Password field does not match the New Password field.');
				return FALSE;
				
			//jika panjang karakter password baru sama dengan 5
			} else if ( strlen($newPassword) < 5) {
				
				$this->form_validation->set_message('reset_check', 'The New Password field must be at least 5 characters in length');
				return FALSE;
				
			//jika cocok : dikembalikan ke fungsi login_submit (validasi sukses)	
			} else {
				
				//mengirim data ke model
				$input = array(
					//format : nama field/kolom table => data input dari view
					'password' => $Password,
				);
				
				//memanggil function insert pada user model
				$petugas = $this->user_model->update($input, $nama);
				
				return TRUE;
			}
					
		//jika tidak cocok : dikembalikan ke fungsi login_submit (validasi gagal)
		}else {
			
			//membuat pesan error
			$this->form_validation->set_message('reset_check', 'Wrong Current Password');
			return FALSE;

		}
	}

}