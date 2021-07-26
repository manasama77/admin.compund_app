<?php
defined('BASEPATH') or exit('No direct script access allowed');

class L_admin
{

	protected $ci;

	public function __construct()
	{
		$this->ci = &get_instance();
		$this->ci->load->model('M_core', 'mcore');
		$this->ci->load->helper(['cookie', 'string']);
	}

	public function render($data)
	{
		$check_cookies = $this->check_cookies();

		if ($check_cookies === TRUE) {
			$this->render_view($data);
		} else {
			$check_session = $this->check_session();

			if ($check_session === TRUE) {
				$this->render_view($data);
			} else {
				$this->reject();
			}
		}
	}

	protected function check_cookies()
	{
		$cookies = get_cookie(KUE);

		if ($cookies === NULL) {
			return FALSE;
		} else {
			$where = [
				'cookies'    => $cookies,
				'is_active'  => 'yes',
				'deleted_at' => null,
			];
			$arr = $this->ci->mcore->get('admin', '*', $where);

			if ($arr->num_rows() == 1) {
				$id         = $arr->row()->id;
				$email      = $arr->row()->email;
				$name       = $arr->row()->name;
				$role       = $arr->row()->role;
				$cookies_db = $arr->row()->cookies;
				$is_active  = $arr->row()->is_active;

				if ($cookies == $cookies_db) {
					return $this->reset_session($id, $email, $name, $role, $is_active);
				}
				return FALSE;
			} else {
				return FALSE;
			}
		}
	}

	public function check_session()
	{
		$id        = $this->ci->session->userdata(SESI . 'id');
		$email     = $this->ci->session->userdata(SESI . 'email');
		$name      = $this->ci->session->userdata(SESI . 'name');
		$role      = $this->ci->session->userdata(SESI . 'role');
		$is_active = $this->ci->session->userdata(SESI . 'is_active');

		if ($id && $email && $name && $role && $is_active) {
			if ($is_active == "yes") {
				return TRUE;
			} else {
				return false;
			}
		}
		return FALSE;
	}

	public function render_view($data)
	{
		if (file_exists(APPPATH . 'views/pages/admin/' . $data['content'] . '.php')) {
			$this->ci->load->view('layouts/admin/main', $data, FALSE);
		} else {
			show_404();
		}
	}

	public function reject()
	{
		$this->ci->session->set_flashdata('expired', 'Sesi berakhir');
		redirect('logout');
	}

	protected function reset_session($id, $email, $name, $role, $is_active)
	{
		$this->ci->session->set_userdata(SESI . 'id', $id);
		$this->ci->session->set_userdata(SESI . 'email', $email);
		$this->ci->session->set_userdata(SESI . 'name', $name);
		$this->ci->session->set_userdata(SESI . 'role', $role);
		$this->ci->session->set_userdata(SESI . 'is_active', $is_active);

		return $this->check_session();
	}
}
                                                
/* End of file L_admin.php */
