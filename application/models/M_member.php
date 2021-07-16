<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_member extends CI_Model
{

	public function get_list_member()
	{
		$this->db->select([
			'et_member.id',
			'et_member.email',
			'et_member.id_card_number',
			'et_member.fullname',
			'et_member.phone_number',
			'et_member.id_upline',
			'(SELECT upline.fullname from et_member as upline where upline.id = et_member.id_upline) as upline_name',
			'(SELECT count(downline.id) from et_member as downline where downline.id_upline = et_member.id) as count_downline',
			'et_member.country_code',
			'et_member.profile_picture',
			'et_member.is_active',
			'et_member.ip_address',
			'et_member.user_agent',
			'et_member_balance.total_invest_trade_manager',
			'et_member_balance.total_invest_crypto_asset',
			'et_member.created_at',
		]);
		$this->db->from('member');
		$this->db->join('et_member_balance', 'et_member_balance.id_member = et_member.id', 'left');
		$this->db->where('member.deleted_at', null);
		$this->db->where('member.is_founder', 'no');
		$this->db->order_by('member.id', 'desc');
		return $this->db->get();
	}

	public function get_list_founder()
	{
		$this->db->select([
			'et_member.id',
			'et_member.email',
			'et_member.id_card_number',
			'et_member.fullname',
			'et_member.phone_number',
			'(SELECT count(downline.id) from et_member as downline where downline.id_upline = et_member.id) as count_downline',
			'et_member.country_code',
			'et_member.profile_picture',
			'et_member.is_active',
			'et_member.ip_address',
			'et_member.user_agent',
			'et_member_balance.total_invest_trade_manager',
			'et_member_balance.total_invest_crypto_asset',
		]);
		$this->db->from('member');
		$this->db->join('et_member_balance', 'et_member_balance.id_member = et_member.id', 'left');
		$this->db->where('member.deleted_at', null);
		$this->db->where('member.is_founder', 'yes');
		$this->db->order_by('member.id', 'desc');
		return $this->db->get();
	}

	public function get_data_member($id_member = null)
	{
		$this->db->select([
			'et_member.id',
			'et_member.email',
			'et_member.id_card_number',
			'et_member.fullname',
			'et_member.phone_number',
			'et_member.id_upline',
			'et_member.country_code',
			'et_member.profile_picture',
			'et_member.is_active',
			'et_member.ip_address',
			'et_member.user_agent',
			'et_member.created_at',
			'et_member_balance.total_invest_trade_manager',
			'et_member_balance.total_invest_crypto_asset',
		]);
		$this->db->from('member');
		$this->db->join('et_member_balance', 'et_member_balance.id_member = et_member.id', 'left');

		if ($id_member != null) {
			$this->db->where('member.id', $id_member);
		}

		$this->db->where('member.deleted_at', null);
		$this->db->order_by('member.id', 'desc');
		return $this->db->get();
	}
}
                        
/* End of file M_member.php */
