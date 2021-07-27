<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_dashboard extends CI_Model
{
	protected $date;

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('floating_helper');

		$this->date = date('Y-m-d');
	}


	public function get_total_investment()
	{
		$query = $this->db
			->select([
				'SUM( et_member_balance.total_invest_trade_manager ) AS sum_total_invest_trade_manager',
				'SUM( et_member_balance.count_trade_manager ) AS sum_count_trade_manager',
				'SUM( et_member_balance.total_invest_crypto_asset ) AS sum_total_invest_crypto_asset',
				'SUM( et_member_balance.count_crypto_asset ) AS sum_count_crypto_asset',
			])
			->from('et_member')
			->join('et_member_balance', 'et_member_balance.id_member = et_member.id', 'left')
			->where('et_member.is_active', 'yes')
			->where('et_member.deleted_at', null)
			->where('et_member_balance.deleted_at', null)
			->get();

		if ($query->num_rows() == 0) {
			$return = [
				'sum_total_invest_trade_manager' => 0,
				'sum_total_invest_crypto_asset'  => 0,
				'sum_count_trade_manager'        => 0,
				'sum_count_crypto_asset'         => 0,
			];
		} else {
			$sum_total_invest_trade_manager = $query->row()->sum_total_invest_trade_manager;
			$sum_total_invest_crypto_asset  = $query->row()->sum_total_invest_crypto_asset;
			$total_investment               = $sum_total_invest_trade_manager + $sum_total_invest_crypto_asset;
			$sum_count_trade_manager        = $query->row()->sum_count_trade_manager;
			$sum_count_crypto_asset         = $query->row()->sum_count_crypto_asset;
			$return = [
				'sum_total_invest_trade_manager' => check_float($sum_total_invest_trade_manager),
				'sum_total_invest_crypto_asset'  => check_float($sum_total_invest_crypto_asset),
				'total_investment'               => check_float($total_investment),
				'sum_count_trade_manager'        => check_float($sum_count_trade_manager),
				'sum_count_crypto_asset'         => check_float($sum_count_crypto_asset),
			];
		}

		return $return;
	}

	public function get_total_investment_today()
	{
		$arr_tm = $this->db
			->select([
				'SUM( amount_usd ) as sum_amount_usd',
				'COUNT( amount_usd ) as count',
			])
			->from('member_trade_manager')
			->where('deleted_at', null)
			->where('state', 'active')
			->where('DATE(created_at)', $this->date)
			->get();

		if ($arr_tm->num_rows() == 0) {
			$return['trade_manager'] = 0;
			$return['count_trade_manager'] = 0;
		} else {
			$return['trade_manager']       = check_float($arr_tm->row()->sum_amount_usd);
			$return['count_trade_manager'] = check_float($arr_tm->row()->count);
		}

		$arr_ca = $this->db
			->select([
				'SUM( amount_usd ) as sum_amount_usd',
				'COUNT( amount_usd ) as count',
			])
			->from('member_crypto_asset')
			->where('deleted_at', null)
			->where('state', 'active')
			->where('DATE(created_at)', $this->date)
			->get();

		if ($arr_ca->num_rows() == 0) {
			$return['crypto_asset'] = 0;
			$return['count_crypto_asset'] = 0;
		} else {
			$return['crypto_asset']       = check_float($arr_ca->row()->sum_amount_usd);
			$return['count_crypto_asset'] = check_float($arr_ca->row()->count);
		}

		return $return;
	}

	public function get_total_withdraw()
	{
		$arr_profit_usdt = $this->db
			->select([
				'SUM( amount_1 ) as sum_usdt'
			])
			->from('member_withdraw')
			->where('deleted_at', null)
			->where('source', 'profit')
			->where('state', 'success')
			->get();

		if ($arr_profit_usdt->num_rows() == 0) {
			$return['sum_wd_profit_usdt'] = 0;
		} else {
			$return['sum_wd_profit_usdt'] = check_float($arr_profit_usdt->row()->sum_usdt);
		}

		$arr_profit_bnb = $this->db
			->select([
				'SUM( amount_2 ) as sum_bnb'
			])
			->from('member_withdraw')
			->where('deleted_at', null)
			->where('source', 'profit')
			->where('state', 'success')
			->where('currency_2', 'BNB.BSC')
			->get();

		if ($arr_profit_bnb->num_rows() == 0) {
			$return['sum_wd_profit_bnb'] = 0;
		} else {
			$return['sum_wd_profit_bnb'] = check_float($arr_profit_bnb->row()->sum_bnb);
		}

		$arr_profit_trx = $this->db
			->select([
				'SUM( amount_2 ) as sum_trx'
			])
			->from('member_withdraw')
			->where('deleted_at', null)
			->where('source', 'profit')
			->where('state', 'success')
			->where('currency_2', 'TRX')
			->get();

		if ($arr_profit_trx->num_rows() == 0) {
			$return['sum_wd_profit_trx'] = 0;
		} else {
			$return['sum_wd_profit_trx'] = check_float($arr_profit_trx->row()->sum_trx);
		}

		$arr_profit_ltct = $this->db
			->select([
				'SUM( amount_2 ) as sum_ltct'
			])
			->from('member_withdraw')
			->where('deleted_at', null)
			->where('source', 'profit')
			->where('state', 'success')
			->where('currency_2', 'LTCT')
			->get();

		if ($arr_profit_ltct->num_rows() == 0) {
			$return['sum_wd_profit_ltct'] = 0;
		} else {
			$return['sum_wd_profit_ltct'] = check_float($arr_profit_ltct->row()->sum_ltct);
		}

		$arr_bonus_usdt = $this->db
			->select([
				'SUM( amount_1 ) as sum_usdt'
			])
			->from('member_withdraw')
			->where('deleted_at', null)
			->where('source', 'bonus')
			->where('state', 'success')
			->get();

		if ($arr_bonus_usdt->num_rows() == 0) {
			$return['sum_wd_bonus_usdt'] = 0;
		} else {
			$return['sum_wd_bonus_usdt'] = check_float($arr_bonus_usdt->row()->sum_usdt);
		}

		$arr_bonus_bnb = $this->db
			->select([
				'SUM( amount_2 ) as sum_bnb'
			])
			->from('member_withdraw')
			->where('deleted_at', null)
			->where('source', 'bonus')
			->where('state', 'success')
			->where('currency_2', 'BNB.BSC')
			->get();

		if ($arr_bonus_bnb->num_rows() == 0) {
			$return['sum_wd_bonus_bnb'] = 0;
		} else {
			$return['sum_wd_bonus_bnb'] = check_float($arr_bonus_bnb->row()->sum_bnb);
		}

		$arr_bonus_trx = $this->db
			->select([
				'SUM( amount_2 ) as sum_trx'
			])
			->from('member_withdraw')
			->where('deleted_at', null)
			->where('source', 'bonus')
			->where('state', 'success')
			->where('currency_2', 'TRX')
			->get();

		if ($arr_bonus_trx->num_rows() == 0) {
			$return['sum_wd_bonus_trx'] = 0;
		} else {
			$return['sum_wd_bonus_trx'] = check_float($arr_bonus_trx->row()->sum_trx);
		}

		$arr_bonus_ltct = $this->db
			->select([
				'SUM( amount_2 ) as sum_ltct'
			])
			->from('member_withdraw')
			->where('deleted_at', null)
			->where('source', 'bonus')
			->where('state', 'success')
			->where('currency_2', 'LTCT')
			->get();

		if ($arr_bonus_ltct->num_rows() == 0) {
			$return['sum_wd_bonus_ltct'] = 0;
		} else {
			$return['sum_wd_bonus_ltct'] = check_float($arr_bonus_ltct->row()->sum_ltct);
		}

		return $return;
	}

	public function get_today_withdraw()
	{
		$arr_profit_usdt = $this->db
			->select([
				'SUM( amount_1 ) as sum_usdt'
			])
			->from('member_withdraw')
			->where('deleted_at', null)
			->where('source', 'profit')
			->where('state', 'success')
			->where('DATE(created_at)', $this->date)
			->get();

		if ($arr_profit_usdt->num_rows() == 0) {
			$return['sum_wd_profit_usdt'] = 0;
		} else {
			$return['sum_wd_profit_usdt'] = check_float($arr_profit_usdt->row()->sum_usdt);
		}

		$arr_profit_bnb = $this->db
			->select([
				'SUM( amount_2 ) as sum_bnb'
			])
			->from('member_withdraw')
			->where('deleted_at', null)
			->where('source', 'profit')
			->where('state', 'success')
			->where('currency_2', 'BNB.BSC')
			->where('DATE(created_at)', $this->date)
			->get();

		if ($arr_profit_bnb->num_rows() == 0) {
			$return['sum_wd_profit_bnb'] = 0;
		} else {
			$return['sum_wd_profit_bnb'] = check_float($arr_profit_bnb->row()->sum_bnb);
		}

		$arr_profit_trx = $this->db
			->select([
				'SUM( amount_2 ) as sum_trx'
			])
			->from('member_withdraw')
			->where('deleted_at', null)
			->where('source', 'profit')
			->where('state', 'success')
			->where('currency_2', 'TRX')
			->where('DATE(created_at)', $this->date)
			->get();

		if ($arr_profit_trx->num_rows() == 0) {
			$return['sum_wd_profit_trx'] = 0;
		} else {
			$return['sum_wd_profit_trx'] = check_float($arr_profit_trx->row()->sum_trx);
		}

		$arr_profit_ltct = $this->db
			->select([
				'SUM( amount_2 ) as sum_ltct'
			])
			->from('member_withdraw')
			->where('deleted_at', null)
			->where('source', 'profit')
			->where('state', 'success')
			->where('currency_2', 'LTCT')
			->where('DATE(created_at)', $this->date)
			->get();

		if ($arr_profit_ltct->num_rows() == 0) {
			$return['sum_wd_profit_ltct'] = 0;
		} else {
			$return['sum_wd_profit_ltct'] = check_float($arr_profit_ltct->row()->sum_ltct);
		}

		$arr_bonus_usdt = $this->db
			->select([
				'SUM( amount_1 ) as sum_usdt'
			])
			->from('member_withdraw')
			->where('deleted_at', null)
			->where('source', 'bonus')
			->where('state', 'success')
			->where('DATE(created_at)', $this->date)
			->get();

		if ($arr_bonus_usdt->num_rows() == 0) {
			$return['sum_wd_bonus_usdt'] = 0;
		} else {
			$return['sum_wd_bonus_usdt'] = check_float($arr_bonus_usdt->row()->sum_usdt);
		}

		$arr_bonus_bnb = $this->db
			->select([
				'SUM( amount_2 ) as sum_bnb'
			])
			->from('member_withdraw')
			->where('deleted_at', null)
			->where('source', 'bonus')
			->where('state', 'success')
			->where('currency_2', 'BNB.BSC')
			->where('DATE(created_at)', $this->date)
			->get();

		if ($arr_bonus_bnb->num_rows() == 0) {
			$return['sum_wd_bonus_bnb'] = 0;
		} else {
			$return['sum_wd_bonus_bnb'] = check_float($arr_bonus_bnb->row()->sum_bnb);
		}

		$arr_bonus_trx = $this->db
			->select([
				'SUM( amount_2 ) as sum_trx'
			])
			->from('member_withdraw')
			->where('deleted_at', null)
			->where('source', 'bonus')
			->where('state', 'success')
			->where('currency_2', 'TRX')
			->where('DATE(created_at)', $this->date)
			->get();

		if ($arr_bonus_trx->num_rows() == 0) {
			$return['sum_wd_bonus_trx'] = 0;
		} else {
			$return['sum_wd_bonus_trx'] = check_float($arr_bonus_trx->row()->sum_trx);
		}

		$arr_bonus_ltct = $this->db
			->select([
				'SUM( amount_2 ) as sum_ltct'
			])
			->from('member_withdraw')
			->where('deleted_at', null)
			->where('source', 'bonus')
			->where('state', 'success')
			->where('currency_2', 'LTCT')
			->where('DATE(created_at)', $this->date)
			->get();

		if ($arr_bonus_ltct->num_rows() == 0) {
			$return['sum_wd_bonus_ltct'] = 0;
		} else {
			$return['sum_wd_bonus_ltct'] = check_float($arr_bonus_ltct->row()->sum_ltct);
		}

		return $return;
	}

	public function get_total_member()
	{
		$member_active   = $this->db->from('member')->where('is_active', 'yes')->get()->num_rows();
		$member_inactive = $this->db->from('member')->where('is_active', 'no')->get()->num_rows();
		$member_deleted  = $this->db->from('member')->where('deleted_at !=', null)->get()->num_rows();
		$total_member    = $member_active + $member_inactive + $member_deleted;

		$return = [
			'member_active'   => check_float($member_active),
			'member_inactive' => check_float($member_inactive),
			'member_deleted'  => check_float($member_deleted),
			'total_member'    => check_float($total_member),
		];

		return $return;
	}

	public function get_latest_member()
	{
		$arr = $this->db
			->select([
				'et_member.id',
				'et_member.profile_picture',
				'et_member.fullname',
				'et_member.email',
				'et_member.phone_number',
				'et_member.created_at',
				'tree.depth as generation',
				'upline.fullname as fullname_upline',
				'upline.email as email_upline',
				'upline.phone_number as phone_number_upline',
			])
			->from('et_member')
			->join('et_member as upline', 'upline.id = et_member.id_upline', 'left')
			->join('et_tree as tree', 'tree.id_member = et_member.id', 'left')
			->where('member.deleted_at', null)
			->order_by('et_member.created_at', 'desc')
			->limit(10)
			->get();

		if ($arr->num_rows() == 0) {
			$return = [];
		} else {
			$return = [];
			foreach ($arr->result() as $key) {
				$id                  = $key->id;
				$profile_picture     = base_url('public/img/pp/default_avatar.svg');
				$fullname            = $key->fullname;
				$email               = $key->email;
				$phone_number        = $key->phone_number;
				$created_at          = $key->created_at;
				$generation          = $key->generation;
				$fullname_upline     = $key->fullname_upline;
				$email_upline        = $key->email_upline;
				$phone_number_upline = $key->phone_number_upline;

				$arr_balance = $this->db
					->select('total_omset')
					->from('member_balance')
					->where('id_member', $id)
					->get();

				$total_asset = check_float($arr_balance->row()->total_omset);

				$nested = [
					'id'                  => $id,
					'profile_picture'     => $profile_picture,
					'fullname'            => $fullname,
					'email'               => $email,
					'phone_number'        => $phone_number,
					'created_at'          => $created_at,
					'generation'          => $generation,
					'fullname_upline'     => $fullname_upline,
					'email_upline'        => $email_upline,
					'phone_number_upline' => $phone_number_upline,
					'total_asset'         => $total_asset,
				];

				array_push($return, $nested);
			}
		}

		return $return;
	}

	public function get_total_profit_bonus_member()
	{
		$arr = $this->db
			->select([
				'SUM( balance.profit ) as sum_profit',
				'SUM( balance.bonus ) as sum_bonus',
			])
			->from('member as member')
			->join('member_balance as balance', 'balance.id_member = member.id', 'left')
			->where('member.deleted_at', null)
			->where('member.is_active', 'yes')
			->get();

		$sum_profit = check_float($arr->row()->sum_profit);
		$sum_bonus  = check_float($arr->row()->sum_bonus);

		$return = compact('sum_profit', 'sum_bonus');
		return $return;
	}
}
                        
/* End of file M_dashboard.php */
