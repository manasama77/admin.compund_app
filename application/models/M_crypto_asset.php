<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_crypto_asset extends CI_Model
{


	public function __construct()
	{
		parent::__construct();
		$this->load->helper('floating_helper');
	}


	public function get_list()
	{
		$arr = $this->db
			->select([
				'member_crypto_asset.created_at',
				'member_crypto_asset.buyer_name',
				'member_crypto_asset.buyer_email',
				'member_crypto_asset.invoice',
				'member_crypto_asset.item_name as package_name',
				'member_crypto_asset.amount_usd as amount',
				'member_crypto_asset.profit_self_per_day',
				'member_crypto_asset.profit_upline_per_day',
				'member_crypto_asset.profit_company_per_day',
				'member_crypto_asset.profit_company_per_day',
				'member_crypto_asset.profit_asset',
				'member_crypto_asset.expired_at',
				'member_crypto_asset.state',
			])
			->from('member_crypto_asset as member_crypto_asset')
			->where('member_crypto_asset.deleted_at', null)
			->get();

		if ($arr->num_rows() == 0) {
			$return = [];
		} else {
			$return = [];
			foreach ($arr->result() as $key) {
				$created_at             = $key->created_at;
				$buyer_name             = $key->buyer_name;
				$buyer_email            = $key->buyer_email;
				$invoice                = $key->invoice;
				$package_name           = $key->package_name;
				$amount                 = check_float($key->amount);
				$profit_self_per_day    = check_float($key->profit_self_per_day);
				$profit_upline_per_day  = check_float($key->profit_upline_per_day);
				$profit_company_per_day = check_float($key->profit_company_per_day);
				$profit_asset           = check_float($key->profit_asset);
				$expired_at             = $key->expired_at;
				$state                  = $key->state;

				$nested = [
					'created_at'             => $created_at,
					'buyer_name'             => $buyer_name,
					'buyer_email'            => $buyer_email,
					'invoice'                => $invoice,
					'package_name'           => $package_name,
					'amount'                 => $amount,
					'profit_self_per_day'    => $profit_self_per_day,
					'profit_upline_per_day'  => $profit_upline_per_day,
					'profit_company_per_day' => $profit_company_per_day,
					'profit_asset'           => $profit_asset,
					'expired_at'             => $expired_at,
					'state'                  => $state,
				];
				array_push($return, $nested);
			}
		}

		return $return;
	}
}
                        
/* End of file M_crypto_asset.php */
