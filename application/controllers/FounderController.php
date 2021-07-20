<?php

defined('BASEPATH') or exit('No direct script access allowed');

class FounderController extends CI_Controller
{

	protected $datetime;
	protected $from;
	protected $from_alias;

	public function __construct()
	{
		parent::__construct();
		$this->load->library('L_admin', null, 'template');
		$this->load->library('Nested_set', null, 'Nested_set');
		$this->load->library('L_genuine_mail', null, 'genuine_mail');
		$this->load->helper(['cookie', 'string', 'Otp_helper', 'Domain_helper']);
		$this->load->model('M_member');
		$this->load->model('M_log_send_email_admin');

		$this->datetime   = date('Y-m-d H:i:s');
		$this->from       = EMAIL_ADMIN;
		$this->from_alias = EMAIL_ALIAS;

		$this->Nested_set->setControlParams('tree', 'lft', 'rgt', 'id', 'id_upline', 'email');
		$this->Nested_set->setPrimaryKeyColumn('id_member');
	}


	public function index()
	{
		$id_admin = $this->session->userdata(SESI . 'id');
		if ($id_admin) {
			$arr_founder = [];
			$arr = $this->M_member->get_list_founder();
			if ($arr->num_rows() > 0) {
				foreach ($arr->result() as $key) {
					$id                         = $key->id;
					$profile_picture            = $key->profile_picture;
					$fullname                   = $key->fullname;
					$email                      = $key->email;
					$phone_number               = $key->phone_number;
					$is_active                  = $key->is_active;
					$total_invest_trade_manager = $key->total_invest_trade_manager;
					$total_invest_crypto_asset  = $key->total_invest_crypto_asset;
					$total_asset                = $total_invest_trade_manager + $total_invest_crypto_asset;
					$count_downline             = $this->_tree_count_downline($id);

					if (is_file(FCPATH . $profile_picture)) {
						$pp = 'public/img/pp/' . $profile_picture;
					} else {
						$pp = "public/img/pp/default_avatar.svg";
					}

					$arr_nested = [
						'id'                         => $id,
						'profile_picture'            => $pp,
						'fullname'                   => $fullname,
						'email'                      => $email,
						'phone_number'               => $phone_number,
						'is_active'                  => $is_active,
						'total_invest_trade_manager' => $total_invest_trade_manager,
						'total_invest_crypto_asset'  => $total_invest_crypto_asset,
						'total_asset'                => $total_asset,
						'count_downline'             => $count_downline,
					];

					array_push($arr_founder, $arr_nested);
				}
			}
		}

		$data = [
			'title'       => 'Edit Trade | Founder Management',
			'content'     => 'founder/main',
			'vitamin_js'  => 'founder/main_js',
			'arr_founder' => $arr_founder,
		];
		$this->template->render($data);
	}

	public function store()
	{
		$this->db->trans_begin();

		$email           = $this->input->post('email');
		$password        = $this->input->post('password');
		$verify_password = $this->input->post('verify_password');
		$id_card_number  = $this->input->post('id_card_number');
		$fullname        = $this->input->post('fullname');
		$phone_number    = $this->input->post('phone_number');

		$check = $this->genuine_mail->check($email);
		if ($check !== TRUE) {
			echo json_encode(['code' => '400', 'msg' => $check]);
			exit;
		}

		$check = $this->M_core->count('member', ['id_card_number' => $id_card_number]);

		if ($check >= 1) {
			echo json_encode(['code' => '400', 'msg' => 'ID Card Number already registered']);
			exit;
		}

		$check = $this->M_core->count('member', ['email' => $email]);

		if ($check >= 1) {
			echo json_encode(['code' => '400', 'msg' => 'Email already registered']);
			exit;
		}

		if ($verify_password != $password) {
			echo json_encode(['code' => '400', 'msg' => 'Password & Verify Password Different']);
			exit;
		}

		$data = [
			'email'                => $email,
			'password'             => password_hash(UYAH . $password, PASSWORD_BCRYPT),
			'id_card_number'       => $id_card_number,
			'fullname'             => $fullname,
			'phone_number'         => $phone_number,
			'id_upline'            => null,
			'country_code'         => null,
			'profile_picture'      => null,
			'otp'                  => null,
			'is_active'            => 'no',
			'activation_code'      => null,
			'forgot_password_code' => null,
			'is_founder'           => 'yes',
			'cookies'              => null,
			'ip_address'           => null,
			'user_agent'           => null,
			'created_at'           => $this->datetime,
			'updated_at'           => $this->datetime,
			'deleted_at'           => null,
		];

		$exec = $this->M_core->store_uuid('member', $data);

		if (!$exec) {
			$this->db->trans_rollback();
			echo json_encode(['code' => '500', 'msg' => 'Cannot Connect to Database, please check your connection!']);
			exit;
		}

		$where     = ['email' => $email];
		$arr       = $this->M_core->get('member', 'id', $where);
		$id_member = $arr->row()->id;

		$data = [
			'id_member'                  => $id_member,
			'total_invest_trade_manager' => 0,
			'count_trade_manager'        => 0,
			'total_invest_crypto_asset'  => 0,
			'count_crypto_asset'         => 0,
			'profit'                     => 0,
			'bonus'                      => 0,
			'created_at'                 => $this->datetime,
			'updated_at'                 => $this->datetime,
			'deleted_at'                 => null,
		];

		$exec = $this->M_core->store_uuid('member_balance', $data);

		if (!$exec) {
			$this->db->trans_rollback();
			echo json_encode(['code' => '500', 'msg' => 'Cannot Connect to Database, please check your connection!']);
			exit;
		}

		$add_tree_founder = $this->_add_tree_founder($id_member, $email);

		if ($this->Nested_set->checkIsValidNode($add_tree_founder) == FALSE) {
			$this->db->trans_rollback();
			echo json_encode(['code' => '500', 'msg' => 'Cannot Connect to Database, please check your connection!']);
			exit;
		}

		$data_reward = [
			'id_member'     => $id_member,
			'reward_1'      => 'no',
			'reward_1_date' => null,
			'reward_1_done' => 'no',
			'reward_2'      => 'no',
			'reward_2_date' => null,
			'reward_2_done' => 'no',
			'reward_3'      => 'no',
			'reward_3_date' => null,
			'reward_3_done' => 'no',
			'reward_4'      => 'no',
			'reward_4_date' => null,
			'reward_4_done' => 'no',
			'reward_5'      => 'no',
			'reward_5_date' => null,
			'reward_5_done' => 'no',
		];
		$exec = $this->M_core->store('member_reward', $data_reward);

		$check = $this->_send_email_activation($id_member, $email);

		if ($check == "no") {
			$this->db->trans_rollback();
			echo json_encode(['code' => '500', 'msg' => 'Cannot Send Email, Please check your Email Address']);
			exit;
		}

		$this->db->trans_commit();
		echo json_encode(['code' => '200', 'msg' => 'Add Founder Success, Please inform Founder to check email']);
	}

	public function _add_tree_founder($id_member, $email)
	{
		$data_hie = [
			'id_member' => $id_member,
			'email'     => $email,
			'depth'     => 0,
		];
		return $this->Nested_set->initialiseRoot($data_hie);
	}

	protected function _send_email_activation($id, $to)
	{
		$subject = "EDI TRADE | Account Activation";
		$message = "";

		$this->email->set_newline("\r\n");
		$this->email->from($this->from, $this->from_alias);
		$this->email->to($to);
		$this->email->subject($subject);

		$activation_code         = hash('sha1', UYAH . $to . $this->datetime);
		$data['email']           = $to;
		$data['activation_code'] = $activation_code;

		$message = $this->load->view('emails/activation_template', $data, TRUE);

		$this->email->message($message);

		$is_success = ($this->email->send()) ? 'yes' : 'no';

		$this->M_core->update('member', ['activation_code' => $activation_code], ['id' => $id]);
		$this->M_log_send_email_admin->write_log($to, $subject, $message, $is_success);
	}

	public function _tree_count_downline($id_member)
	{
		$where_member = ['id_member' => $id_member];
		$data_member  = $this->Nested_set->getNodeWhere($where_member);

		return $this->Nested_set->getNumberOfChildren($data_member);
	}

	public function change_status()
	{
		$code      = 500;
		$id        = $this->input->post('id');
		$is_active = $this->input->post('is_active');

		$data  = [
			'is_active'       => $is_active,
			'activation_code' => null,
			'updated_at'      => $this->datetime
		];
		$where = ['id' => $id];
		$exec  = $this->M_core->update('member', $data, $where);

		if ($exec) {
			$code = 200;
		}

		echo json_encode(['code' => $code]);
	}
}
        
/* End of file FounderController.php */
