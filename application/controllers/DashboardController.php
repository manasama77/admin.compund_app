<?php

defined('BASEPATH') or exit('No direct script access allowed');

class DashboardController extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->library('L_admin', null, 'template');
		$this->load->model('M_dashboard');
		$this->load->model('M_member');
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
			'is_active' => 'yes',
			'deleted_at' => null,
		];
		$count_total_member = $this->M_core->count('member', $where_member);
		// COUNT MEMBER ACTIVE END

		// GET LIST MEMBER START
		$arr_member = $this->M_member->get_list_member();
		// GET LIST MEMBER END

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
}
        
/* End of file DashboardController.php */
