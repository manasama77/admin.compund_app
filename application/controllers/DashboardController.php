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
			'vitamin_js'        => 'dashboard/main_js',
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
		$arr_member = $this->M_dashboard->get_latest_member(10);
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

	public function downline_detail()
	{
		header('Content-Type: application/json');

		$id_member = $this->input->get('id_member');

		// TRADE MANAGER START
		$where_package_tm = [
			'id_member'  => $id_member,
			'deleted_at' => null,
		];
		$arr_package_tm = $this->M_core->get('member_trade_manager', '*', $where_package_tm);

		$data_package_tm = [];
		if ($arr_package_tm->num_rows() > 0) {
			foreach ($arr_package_tm->result() as $key) {
				$package_name     = $key->package_name;
				$amount_1         = check_float($key->amount_1);
				$share_self_value = check_float($key->share_self_value);
				$expired_package  = $key->expired_package;
				$state            = $key->state;

				$now_obj     = new DateTime('now');
				$expired_obj = new DateTime($expired_package);
				$diff        = $now_obj->diff($expired_obj);

				if ($diff->format('%r') == "-") {
					$duration = $diff->format('+%a hari tidak aktif');
				} else {
					$duration = $diff->format('%r%a hari lagi');
				}

				if ($state == "waiting payment") {
					$badge_color = 'info';
					$text        = "Menunggu Pembayaran";
				} elseif ($state == "pending") {
					$badge_color = 'secondary';
					$text        = "Pembayaran Sedang Diproses";
				} elseif ($state == "active") {
					$badge_color = 'success';
					$text        = "Aktif";
				} elseif ($state == "inactive") {
					$badge_color = 'dark';
					$text        = "Tidak Aktif";
				} elseif ($state == "cancel") {
					$badge_color = 'warning';
					$text        = "Transaksi Dibatalkan";
				} elseif ($state == "expired") {
					$badge_color = 'danger';
					$text        = "Pembayaran Melewati Batas Waktu";
				}

				$status_badge = '<span class="badge badge-' . $badge_color . '">' . ucwords($text) . '</span>';

				$nested = [
					'package'        => $package_name,
					'amount'         => $amount_1,
					'profit_per_day' => $share_self_value,
					'duration'       => $duration,
					'status'         => $status_badge,
				];

				array_push($data_package_tm, $nested);
			}
		}
		// TRADE MANAGER END

		// CRYPTO ASSET START
		$where_package_ca = [
			'id_member'  => $id_member,
			'deleted_at' => null,
		];
		$arr_package_ca = $this->M_core->get('member_crypto_asset', '*', $where_package_ca);

		$data_package_ca = [];
		if ($arr_package_ca->num_rows() > 0) {
			foreach ($arr_package_ca->result() as $key) {
				$package_name     = $key->package_name;
				$amount_1         = check_float($key->amount_1);
				$share_self_value = check_float($key->share_self_value);
				$expired_package  = $key->expired_package;
				$state            = $key->state;

				$now_obj     = new DateTime('now');
				$expired_obj = new DateTime($expired_package);
				$diff        = $now_obj->diff($expired_obj);

				if ($diff->format('%r') == "-") {
					$duration = $diff->format('+%a hari tidak aktif');
				} else {
					$duration = $diff->format('%r%a hari lagi');
				}

				if ($state == "waiting payment") {
					$badge_color = 'info';
					$text        = "Menunggu Pembayaran";
				} elseif ($state == "pending") {
					$badge_color = 'secondary';
					$text        = "Pembayaran Sedang Diproses";
				} elseif ($state == "active") {
					$badge_color = 'success';
					$text        = "Aktif";
				} elseif ($state == "inactive") {
					$badge_color = 'dark';
					$text        = "Tidak Aktif";
				} elseif ($state == "cancel") {
					$badge_color = 'warning';
					$text        = "Transaksi Dibatalkan";
				} elseif ($state == "expired") {
					$badge_color = 'danger';
					$text        = "Pembayaran Melewati Batas Waktu";
				}

				$status_badge = '<span class="badge badge-' . $badge_color . '">' . ucwords($text) . '</span>';

				$nested = [
					'package'        => $package_name,
					'amount'         => $amount_1,
					'profit_per_day' => $share_self_value,
					'duration'       => $duration,
					'status'         => $status_badge,
				];

				array_push($data_package_ca, $nested);
			}
		}
		// CRYPTO ASSET START

		$data_downline = $this->_latest_downline($id_member);

		echo json_encode([
			'code'            => 200,
			'data_package_tm' => $data_package_tm,
			'data_package_ca' => $data_package_ca,
			'data_downline'   => $data_downline,
		]);
	}

	protected function _latest_downline($id_member)
	{
		$arr = $this->M_dashboard->get_latest_downline($id_member, null, 5);
		return $arr;
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
