<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_accounting extends CI_Model
{


	public function __construct()
	{
		parent::__construct();
		$this->load->helper('floating_helper');
	}


	public function get_list_penjualan()
	{
		$total_omzet   = 0;
		$total_expired = 0;
		$sisa_piutang  = 0;
		$data_active   = [];
		$data_inactive = [];

		$sql_1 = "
		SELECT
			tm.created_at,
			member_tm.fullname,
			member_tm.user_id,
			'tm' AS jenis,
			tm.package_name,
			tm.amount_1 AS investasi 
		FROM
			et_member_trade_manager AS tm
			LEFT JOIN et_member AS member_tm ON member_tm.id = tm.id_member 
		WHERE
			tm.state = 'active' UNION
		SELECT
			ca.created_at,
			member_ca.fullname,
			member_ca.user_id,
			'ca' AS jenis,
			ca.package_name,
			ca.amount_1 AS investasi 
		FROM
			et_member_crypto_asset AS ca
			LEFT JOIN et_member AS member_ca ON member_ca.id = ca.id_member 
		WHERE
			ca.state = 'active' 
		ORDER BY
			created_at DESC
		";

		$query_1 = $this->db->query($sql_1);


		foreach ($query_1->result() as $key) {
			$created_at   = $key->created_at;
			$fullname     = $key->fullname;
			$user_id      = $key->user_id;
			$jenis        = $key->jenis;
			$package_name = $key->package_name;
			$investasi    = $key->investasi;

			$nested = [
				'created_at'   => $created_at,
				'fullname'     => $fullname,
				'user_id'      => $user_id,
				'jenis'        => $jenis,
				'package_name' => $package_name,
				'investasi'    => check_float($investasi),
			];

			array_push($data_active, $nested);

			$total_omzet += $key->investasi;
		}

		$sql_2 = "
		SELECT
			tm.created_at,
			member_tm.fullname,
			member_tm.user_id,
			'tm' AS jenis,
			tm.package_name,
			tm.amount_1 AS investasi 
		FROM
			et_member_trade_manager AS tm
			LEFT JOIN et_member AS member_tm ON member_tm.id = tm.id_member 
		WHERE
			tm.state = 'expired' UNION
		SELECT
			ca.created_at,
			member_ca.fullname,
			member_ca.user_id,
			'ca' AS jenis,
			ca.package_name,
			ca.amount_1 AS investasi 
		FROM
			et_member_crypto_asset AS ca
			LEFT JOIN et_member AS member_ca ON member_ca.id = ca.id_member 
		WHERE
			ca.state = 'expired' 
		ORDER BY
			created_at DESC
		";

		$query_2 = $this->db->query($sql_2);

		foreach ($query_2->result() as $key) {
			$created_at   = $key->created_at;
			$fullname     = $key->fullname;
			$user_id      = $key->user_id;
			$jenis        = $key->jenis;
			$package_name = $key->package_name;
			$investasi    = check_float($key->investasi);

			$nested = [
				'created_at'   => $created_at,
				'fullname'     => $fullname,
				'user_id'      => $user_id,
				'jenis'        => $jenis,
				'package_name' => $package_name,
				'investasi'    => $investasi,
			];

			array_push($data_inactive, $nested);

			$total_expired += $key->investasi;
		}

		$sisa_piutang = $total_omzet - $total_expired;

		$return = [
			'data_active'   => $data_active,
			'data_inactive' => $data_inactive,
			'total_omzet'   => check_float($total_omzet),
			'total_expired' => check_float($total_expired),
			'sisa_piutang'  => check_float($sisa_piutang),
		];

		return $return;
	}
}
                        
/* End of file M_accounting.php */
