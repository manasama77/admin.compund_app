<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_dashboard extends CI_Model
{

	public function get_total_investment()
	{
		return $this->db
			->select([
				'SUM( et_member_balance.total_invest_trade_manager ) AS sum_total_invest_trade_manager',
				'SUM( et_member_balance.total_invest_crypto_asset ) AS sum_total_invest_crypto_asset',
			])
			->from('et_member')
			->join('et_member_balance', 'et_member_balance.id_member = et_member.id', 'left')
			->where('et_member.is_active', 'yes')
			->where('et_member.deleted_at', null)
			->where('et_member_balance.deleted_at', null)
			->get();
	}
}
                        
/* End of file M_dashboard.php */
