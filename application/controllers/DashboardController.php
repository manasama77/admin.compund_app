<?php

defined('BASEPATH') or exit('No direct script access allowed');

class DashboardController extends CI_Controller
{
	protected $date;
	protected $datetime;
	protected $api_link;
	protected $public_key;
	protected $private_key;
	protected $merchant_id;
	protected $ipn_secret_key;
	protected $from;
	protected $from_alias;

	public function __construct()
	{
		parent::__construct();
		$this->load->library('L_admin', null, 'template');
		$this->load->model('M_dashboard');
		$this->load->model('M_member');
		$this->load->helper('floating_helper');


		$this->date           = date('Y-m-d');
		$this->datetime       = date('Y-m-d H:i:s');
		$this->api_link       = CP_API_LINK;
		$this->public_key     = CP_PUB_KEY;
		$this->private_key    = CP_PRV_KEY;
		$this->merchant_id    = CP_MERCH_ID;
		$this->ipn_secret_key = CP_IPN_SEC_KEY;
		$this->from           = EMAIL_ADMIN;
		$this->from_alias     = EMAIL_ALIAS;
	}


	public function index()
	{
		$card              = $this->_card();
		$arr_latest_member = $this->_get_latest_member();

		$data = [
			'title'             => APP_NAME . ' | Dashboard',
			'content'           => 'dashboard/main',
			'card'              => $card,
			'arr_latest_member' => $arr_latest_member,
		];
		$this->template->render($data);
	}

	protected function _card()
	{
		$arr_investment     = $this->_get_total_investment();
		$arr_profit_bonus   = $this->_get_total_profit_bonus();
		$arr_withdraw       = $this->_get_total_withdraw();
		$arr_withdraw_today = $this->_get_today_withdraw();
		$arr_member         = $this->_get_total_member();
		$arr_coin_balance   = $this->_get_coin_balance();

		$return  = compact('arr_investment', 'arr_profit_bonus', 'arr_withdraw', 'arr_withdraw_today', 'arr_member', 'arr_coin_balance');
		return $return;
	}

	protected function _get_total_investment()
	{
		$arr_investment       = $this->M_dashboard->get_total_investment();
		$arr_investment_today = $this->M_dashboard->get_total_investment_today();

		$return = [
			$arr_investment,
			$arr_investment_today
		];
		return $return;
	}

	protected function _get_total_profit_bonus()
	{
		$arr = $this->M_dashboard->get_total_profit_bonus_member();
		return $arr;
	}

	protected function _get_total_withdraw()
	{
		$arr_withdraw = $this->M_dashboard->get_total_withdraw();
		return $arr_withdraw;
	}

	protected function _get_today_withdraw()
	{
		$arr_withdraw = $this->M_dashboard->get_today_withdraw();
		return $arr_withdraw;
	}

	protected function _get_total_member()
	{
		$arr_member = $this->M_dashboard->get_total_member();
		return $arr_member;
	}

	protected function _get_latest_member()
	{
		$arr_member = $this->M_dashboard->get_latest_member();
		return $arr_member;
	}

	protected function _get_coin_balance()
	{
		$arr_coin_balance = $this->_coinpayments_api_call('balances', ['all' => 0]);

		$bnb  = 0;
		$trx  = 0;
		$usdt = 0;
		$ltct = 0;

		if ($arr_coin_balance['error'] == "ok") {
			$bnb  = ($arr_coin_balance['result']['BNB.BSC']['balancef']) ?? 0;
			$trx  = ($arr_coin_balance['result']['TRX']['balancef']) ?? 0;
			$usdt = ($arr_coin_balance['result']['USDT.ERC20']['balancef']) ?? 0;
			$ltct = ($arr_coin_balance['result']['LTCT']['balancef']) ?? 0;
		}
		$return = compact('bnb', 'trx', 'usdt', 'ltct');
		return $return;
	}

	/*
	============================
	MASTER COINPAYMENT API CALL
	============================
	*/
	protected function _coinpayments_api_call($cmd, $req = array())
	{
		// Set the API command and required fields
		$req['version'] = 1;
		$req['cmd']     = $cmd;
		$req['key']     = $this->public_key;
		$req['format']  = 'json';

		// Generate the URL query string
		$post_data = http_build_query($req, '', '&');

		// Hash $post_data + $private_key
		$hmac = hash_hmac('sha512', $post_data, $this->private_key);

		// Create cURL handle and initialize
		$ch = NULL;
		$ch = curl_init($this->api_link);
		curl_setopt($ch, CURLOPT_FAILONERROR, TRUE);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('HMAC: ' . $hmac));
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);

		// Execute the call
		$data = curl_exec($ch);

		// Parse and return data if successful.
		if ($data !== FALSE) {
			if (PHP_INT_SIZE < 8 && version_compare(PHP_VERSION, '5.4.0') >= 0) {
				// We are on 32-bit PHP, so use the bigint as string option. If you are using any API calls with Satoshis it is highly NOT recommended to use 32-bit PHP
				$result = json_decode($data, TRUE, 512, JSON_BIGINT_AS_STRING);
			} else {
				$result = json_decode($data, TRUE);
			}
			if ($result !== NULL && count($result)) {
				return $result;
			} else {
				// If you are using PHP 5.5.0 or higher you can use json_last_error_msg() for a better error message
				return array('error' => 'Unable to parse JSON result (' . json_last_error_msg() . ')');
			}
		} else {
			return array('error' => 'cURL error: ' . curl_error($ch));
		}

		curl_close($ch);
	}
}
        
/* End of file DashboardController.php */
