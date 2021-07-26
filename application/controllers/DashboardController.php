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
		// INVESTMENT DATA START
		$arr_investment                 = $this->M_dashboard->get_total_investment();
		$sum_total_invest_trade_manager = $arr_investment->row()->sum_total_invest_trade_manager;
		$sum_total_invest_crypto_asset  = $arr_investment->row()->sum_total_invest_crypto_asset;
		$total_investment               = $sum_total_invest_trade_manager + $sum_total_invest_crypto_asset;
		// INVESTMENT DATA END

		// COUNT MEMBER ACTIVE START
		$where_member = [
			'is_active'  => 'yes',
			'deleted_at' => null,
		];
		$count_total_member = $this->M_core->count('member', $where_member);
		// COUNT MEMBER ACTIVE END

		// GET LIST MEMBER START
		$arr_member = $this->M_member->get_list_member();
		// GET LIST MEMBER END

		// GET COIN BALANCE START
		$arr_coin_balance = $this->_coinpayments_api_call('balances', ['all' => 0]);
		// GET COIN BALANCE END

		$data = [
			'title'                          => 'Edit Trade | Dashboard',
			'content'                        => 'dashboard/main',
			'sum_total_invest_trade_manager' => $sum_total_invest_trade_manager,
			'sum_total_invest_crypto_asset'  => $sum_total_invest_crypto_asset,
			'total_investment'               => number_format($total_investment, 8),
			'count_total_member'             => number_format($count_total_member, 0),
			'arr_member'                     => $arr_member,
		];
		$this->template->render($data);
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
