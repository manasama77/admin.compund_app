<?php

defined('BASEPATH') or exit('No direct script access allowed');

class LoginController extends CI_Controller
{

	protected $datetime;
	protected $from;
	protected $from_alias;
	protected $ip_address;
	protected $user_agent;

	public function __construct()
	{
		parent::__construct();
		$this->load->helper(['cookie', 'string', 'otp_helper', 'domain_helper']);
		$this->load->model('M_log_send_email_admin');

		$this->datetime   = date('Y-m-d H:i:s');
		$this->from       = EMAIL_ADMIN;
		$this->from_alias = EMAIL_ALIAS;
		$this->ip_address = $this->input->ip_address();
		$this->user_agent = $this->input->user_agent();
	}


	public function index()
	{
		$cookies = get_cookie(KUE);

		if ($cookies != NULL) {
			$this->_check_cookies($cookies);
		} else {
			$data = [
				'title' => 'Edit Trade | Admin Sign In'
			];
			return $this->load->view('login', $data, FALSE);
		}
	}

	public function auth()
	{
		$email    = $this->input->post('email');
		$password = $this->input->post('password');
		$remember = $this->input->post('remember');

		$where = [
			'email'      => $email,
			'deleted_at' => null,
		];
		$arr_user = $this->M_core->get('admin', 'id, password, is_active', $where, null, null, 1);

		if ($arr_user->num_rows() == 0) {
			$this->session->set_flashdata('email_value', $email);
			$this->session->set_flashdata('email_state', 'is-invalid');
			$this->session->set_flashdata('email_state_message', 'Email Not Found');
			redirect('login');
		} elseif ($arr_user->row()->is_active == 'no') {
			$this->session->set_flashdata('email_value', $email);
			$this->session->set_flashdata('email_state', 'is-invalid');
			$this->session->set_flashdata('email_state_message', 'Account Disabled');
			redirect('login');
		} elseif (password_verify(UYAH . $password, $arr_user->row()->password) == false) {
			$this->session->set_flashdata('email_value', $email);
			$this->session->set_flashdata('email_state', 'is-valid');
			$this->session->set_flashdata('email_state_message', null);
			$this->session->set_flashdata('password_state', 'is-invalid');
			$this->session->set_flashdata('password_state_message', 'Password wrong!');
			redirect('login');
		} else {
			$id = $arr_user->row()->id;

			if ($remember) {
				$this->_set_cookie();
			}

			$this->session->set_userdata([
				SESI . 'id'    => $id,
				SESI . 'email' => $email,
			]);

			$send_otp = $this->_send_otp($id, $email);

			if ($send_otp === true) {
				redirect('otp');
			}

			return show_error('Failed to send Email, please try again', 500, 'An Error Was Encountered');
		}
	}

	public function otp()
	{
		if (!$this->session->userdata(SESI . 'email')) {
			redirect('logout');
			exit;
		}

		$data = [
			'title' => 'Edit Trade | OTP'
		];
		return $this->load->view('otp_login', $data, FALSE);
	}

	public function otp_auth()
	{
		$code  = 500;
		$id    = $this->session->userdata(SESI . 'id');
		$email = $this->session->userdata(SESI . 'email');
		$otp   = $this->input->post('otp');

		$where = [
			'email'      => $email,
			'otp'        => $otp,
			'is_active'  => 'yes',
			'deleted_at' => null,
		];
		$arr = $this->M_core->get('admin', '*', $where);

		if ($arr->num_rows() == 1) {
			$code      = 200;
			$id        = $arr->row()->id;
			$name      = $arr->row()->name;
			$email     = $arr->row()->email;
			$role      = $arr->row()->role;
			$cookies   = $arr->row()->cookies;
			$is_active = $arr->row()->is_active;
			$this->_set_session($id, $name, $email, $role, $cookies, $is_active);
		}

		echo json_encode(['code' => $code]);
	}

	public function otp_resend()
	{
		$email = ($this->session->userdata(SESI . 'email')) ? $this->session->userdata(SESI . 'email') : $this->input->post('email');

		$where = [
			'email'      => $email,
			'is_active'  => 'yes',
			'deleted_at' => null,
		];
		$arr = $this->M_core->get('admin', 'id', $where);

		$id = $arr->row()->id;

		$this->_send_otp($id, $email);
	}

	public function logout(): void
	{
		delete_cookie(KUE);
		$data = [
			SESI . 'id',
			SESI . 'name',
			SESI . 'email',
			SESI . 'role',
			SESI . 'is_active',
		];
		$this->session->unset_userdata($data);
		$this->session->set_flashdata('logout', 'Logout Success');
		redirect('login');
	}

	protected function _set_cookie(): string
	{
		$key_cookies = random_string('alnum', 64);
		set_cookie(KUE, $key_cookies, 86400);
		return $key_cookies;
	}

	protected function _set_session($id, $name, $email, $role, $cookies, $is_active): void
	{
		$data = [
			SESI . 'id'        => $id,
			SESI . 'name'      => $name,
			SESI . 'email'     => $email,
			SESI . 'role'      => $role,
			SESI . 'is_active' => $is_active,
		];
		$this->session->set_userdata($data);

		$data = [
			'cookies'    => $cookies,
			'ip_address' => $this->ip_address,
			'user_agent' => $this->user_agent,
			'updated_at' => $this->datetime,
			'updated_by' => $id,
		];
		$where = ['id' => $id];
		$this->M_core->update('admin', $data, $where);
	}

	protected function _check_cookies($cookies): void
	{
		$where_cookies = [
			'cookies'    => $cookies,
			'is_active'  => 'yes',
			'ip_address' => $this->ip_address,
			'user_agent' => $this->user_agent,
			'deleted_at' => null,
		];
		$check_cookies = $this->M_core->get('admin', '*', $where_cookies);

		if ($check_cookies->num_rows() == 1) {
			$id    = $check_cookies->row()->id;
			$name  = $check_cookies->row()->name;
			$email = $check_cookies->row()->email;
			$role  = $check_cookies->row()->role;
			$is_active  = $check_cookies->row()->is_active;

			$this->_set_session($id, $name, $email, $role, $cookies, $is_active);
			$this->session->set_flashdata('first_login', 'Login Success, Never share your Email and Password to the others');
			redirect('dashboard');
		} else {
			delete_cookie(KUE);
			redirect(site_url('logout'));
		}
	}

	protected function _send_otp($id, $to): bool
	{
		$subject = "EDI TRADE | OTP (One Time Password)";
		$message = "";

		$this->email->set_newline("\r\n");
		$this->email->from($this->from, $this->from_alias);
		$this->email->to($to);
		$this->email->subject($subject);

		$otp = Generate_otp();

		$data['otp'] = $otp;
		$message     = $this->load->view('emails/otp_template', $data, TRUE);

		$this->email->message($message);

		$is_success = ($this->email->send()) ? 'yes' : 'no';

		$this->M_core->update('admin', ['otp' => $otp], ['id' => $id]);
		$this->M_log_send_email_admin->write_log($to, $subject, $message, $is_success);

		if ($is_success == "yes") {
			return true;
		}

		return false;
	}

	public function forgot_password()
	{
		$data = [
			'title' => 'EDI TRADE | Forgot Password'
		];
		$this->load->view('forgot_password', $data);
	}

	public function send_forgot_password()
	{
		$code  = 200;
		$email = $this->input->post('email');

		$where = [
			'email'      => $email,
			'deleted_at' => null,
		];
		$arr = $this->M_core->get('admin', 'id, email, is_active', $where);

		if ($arr->num_rows() == 0) {
			echo json_encode(['code' => 404]);
			exit;
		}

		if ($arr->row()->is_active == 'no') {
			echo json_encode(['code' => 403]);
			exit;
		}

		$id = $arr->row()->id;

		$check = $this->_send_email_forgot_password($id, $email);

		if ($check == "no") {
			$code = 500;
		}

		echo json_encode(['code' => $code]);
	}

	public function _send_email_forgot_password($id, $to)
	{
		$subject = "EDI TRADE | Forgot Password";
		$message = "";

		$this->email->set_newline("\r\n");
		$this->email->from($this->from, $this->from_alias);
		$this->email->to($to);
		$this->email->subject($subject);

		$forgot_password_code         = hash('sha1', UYAH . $to . $this->datetime);
		$data['email']                = $to;
		$data['email_decode']         = base64_encode(UYAH . $to);
		$data['forgot_password_code'] = $forgot_password_code;

		$message = $this->load->view('emails/forgot_password_template', $data, TRUE);

		$this->email->message($message);

		$is_success = ($this->email->send()) ? 'yes' : 'no';

		$this->M_core->update('admin', ['forgot_password_code' => $forgot_password_code], ['id' => $id]);
		$this->M_log_send_email_admin->write_log($to, $subject, $message, $is_success);

		return $is_success;
	}

	public function reset_password($email, $forgot_password_code)
	{
		$email_decode = urldecode(str_replace(UYAH, "", base64_decode($email)));

		if (!Is_base64($email_decode)) {
			return show_error('Reset Password Code Invalid. Please try using Feature <a href="' . site_url('forgot_password') . '"><mark>Forgot Password</mark></a> again!', 403, '[403] - Access Forbidden');
		}

		$where = [
			'email'      => $email_decode,
			'is_active'  => 'yes',
			'deleted_at' => null,
		];
		$arr = $this->M_core->get('admin', 'id, forgot_password_code', $where);

		if ($arr->num_rows() == 0 || $arr->row()->forgot_password_code != $forgot_password_code) {
			return show_error('Reset Password Invalid', 404, 'Something Wrong!');
		}

		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_rules('verify_password', 'Verify Password', 'required|matches[password]');

		if ($this->form_validation->run() === false) {

			$data = [
				'title' => 'EDI TRADE | Reset Password',
				'email' => $email_decode,
			];
			return $this->load->view('reset_password', $data);
		} else {
			$password = password_hash(UYAH . $this->input->post('password'), PASSWORD_BCRYPT);

			$data = [
				'password'             => $password,
				'forgot_password_code' => null,
				'updated_at'           => $this->datetime,
			];

			$where = ['email' => $email_decode];

			$exec = $this->M_core->update('admin', $data, $where);

			if (!$exec) {
				return show_error('Reset password failed, Connection Issue. Please try again', 500, 'Something Wrong!');
			}

			$data = [
				'title' => 'EDI TRADE | Reset Password Success',
			];
			return $this->load->view('reset_password_success', $data);
		}
	}
}
        
/* End of file LoginController.php */
