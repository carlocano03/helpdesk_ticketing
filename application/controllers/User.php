<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();

		date_default_timezone_set('Asia/Manila');
		$this->load->helper('url');
		$this->load->library('form_validation');
		$this->load->model('user_model');
		$this->load->database();
	}

	public function index()
	{
		$this->load->view('user/header');
		$this->load->view('user/login');
		$this->load->view('user/footer');
		$this->load->view('user/ajax_request/login_request');
	}

	public function register()
	{
		$this->load->view('user/header');
		$this->load->view('user/register');
		$this->load->view('user/footer');
		$this->load->view('user/ajax_request/register_request');
	}

	public function account_register()
	{
		$message = '';
		$exist = $this->user_model->existing_account($this->input->post('email'));
		if ($exist > 0) {
			$message = 'Account exist';
		} else {
			$date_created = date('Y-m-d H:i:s');
			$generatedID = 'HDST-' . date('Y') . '-' . rand(10, 1000);
			if (!empty($_FILES['inpFile']['name'])) {
				$config['upload_path'] = 'uploaded_file/profile';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['file_name'] = $generatedID . $_FILES['inpFile']['name'];
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				if ($this->upload->do_upload('inpFile')) {
					$uploadData = $this->upload->data();
					$uploadFile = $uploadData['file_name'];
				} else {
					$uploadFile = '';
				}
			} else {
				$uploadFile = '';
			}

			$insert_account = array(
				'generated_id' => $generatedID,
				'name' => $this->input->post('name'),
				'email' => $this->input->post('email'),
				'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
				'department' => $this->input->post('department'),
				'is_active' => 'Inactive',
				'photo' => $uploadFile,
				'created_at' => $date_created,
				'updated_at' => $date_created,
			);
			$this->db->insert('users', $insert_account);
		} //end of if else

		$output = array(
			'message' => $message,
		);

		echo json_encode($output);
	}

	public function login_process()
	{
		$success = '';
		$error = '';
		$username = $this->input->post('email');
		$password = $this->input->post('password');

		$session = $this->user_model->user_check($username, $password);
		if ($session) {
			if ($session->is_active == 'Inactive') {
				$error = '<div class="alert alert-danger">Your account is inactive. Please contact the administrator!</div>';
			} else {
				$sess_array = array(
					'id' => $session->id,
					'email' => $session->email,
					'name' => $session->name,
					'department' => $session->department,
					'generated_id' => $session->generated_id,
					'status' => $session->is_active,
					'access_level' => $session->is_active,
					'photo' => $session->photo,
				);
				$this->session->set_userdata('loggedIn', $sess_array);
				$success = '<div class="alert alert-success">Please wait redirecting...</div>';
			}
		} else {
			$error = '<div class="alert alert-danger">Please check your username and password!</div>';
		}
		$output = array(
			'success' => $success,
			'error' => $error,
		);
		echo json_encode($output);
	}

}
