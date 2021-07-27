<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_trade_manager extends CI_Model
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
				'member_trade_manager.created_at',
				'member_trade_manager.buyer_name',
				'member_trade_manager.buyer_email',
				'member_trade_manager.invoice',
				'member_trade_manager.item_name as package_name',
				'member_trade_manager.amount_usd as amount',
				'member_trade_manager.profit_self_per_day',
				'member_trade_manager.profit_upline_per_day',
				'member_trade_manager.profit_company_per_day',
				'member_trade_manager.profit_company_per_day',
				'member_trade_manager.expired_at',
				'member_trade_manager.is_extend as extend_mode',
				'member_trade_manager.state',
			])
			->from('member_trade_manager as member_trade_manager')
			->where('member_trade_manager.deleted_at', null)
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
				$expired_at             = $key->expired_at;
				$extend_mode            = $key->extend_mode;
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
					'expired_at'             => $expired_at,
					'extend_mode'            => $extend_mode,
					'state'                  => $state,
				];
				array_push($return, $nested);
			}
		}

		return $return;
	}
}
                        
/* End of file M_trade_manager.php */
