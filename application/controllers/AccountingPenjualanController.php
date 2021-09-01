<?php

defined('BASEPATH') or exit('No direct script access allowed');

class AccountingPenjualanController extends CI_Controller
{
	protected $datetime;

	public function __construct()
	{
		parent::__construct();
		$this->load->library('L_admin', null, 'template');
		$this->load->model('M_accounting');

		$this->datetime = date('Y-m-d H:i:s');
	}


	public function penjualan()
	{
		$arr = $this->M_accounting->get_list_penjualan();
		$data = [
			'title'      => APP_NAME . ' | Accounting Penjualan',
			'content'    => 'accounting/penjualan/main',
			'vitamin_js' => 'accounting/penjualan/main_js',
			'arr'        => $arr,
		];
		$this->template->render($data);
	}

	public function profit()
	{
		$arr = $this->M_accounting->get_list_profit();
		$data = [
			'title'      => APP_NAME . ' | Accounting Bonus',
			'content'    => 'accounting/profit/main',
			'vitamin_js' => 'accounting/profit/main_js',
			'arr'        => $arr,
		];
		$this->template->render($data);
	}

	public function bonus()
	{
		$arr = $this->M_accounting->get_list_bonus();
		$data = [
			'title'      => APP_NAME . ' | Accounting Bonus',
			'content'    => 'accounting/bonus/main',
			'vitamin_js' => 'accounting/bonus/main_js',
			'arr'        => $arr,
		];
		$this->template->render($data);
	}

	public function reward()
	{
		$arr = $this->M_accounting->get_list_reward();
		$data = [
			'title'      => APP_NAME . ' | Accounting Bonus',
			'content'    => 'accounting/reward/main',
			'vitamin_js' => 'accounting/reward/main_js',
			'arr'        => $arr,
		];
		$this->template->render($data);
	}

	public function rekap()
	{
		$arr_penjualan = $this->M_accounting->get_list_penjualan();
		$arr_profit    = $this->M_accounting->get_list_profit();
		$arr_bonus     = $this->M_accounting->get_list_bonus();
		$arr_reward    = $this->M_accounting->get_list_reward();

		$data['total_omzet_penjualan']   = $arr_penjualan['total_omzet'];
		$data['total_expired_penjualan'] = $arr_penjualan['total_expired'];
		$data['sisa_piutang_penjualan']  = $arr_penjualan['sisa_piutang'];

		$data['sum_profit']          = $arr_profit['sum_profit'];
		$data['sum_wd_profit']       = $arr_profit['sum_wd'];
		$data['sisa_piutang_profit'] = $arr_profit['sisa_piutang'];

		$data['sum_bonus']          = $arr_bonus['sum_bonus'];
		$data['sum_wd_bonus']       = $arr_bonus['sum_wd'];
		$data['sisa_piutang_bonus'] = $arr_bonus['sisa_piutang'];

		$data['sum_reward']             = $arr_reward['sum_reward'];
		$data['sum_terbayarkan_reward'] = $arr_reward['sum_terbayarkan'];
		$data['sisa_piutang_reward']    = $arr_reward['sisa_piutang'];

		$data = [
			'title'      => APP_NAME . ' | Accounting Rekap',
			'content'    => 'accounting/rekap/main',
			'vitamin_js' => 'accounting/rekap/main_js',
			'data'       => $data,
		];
		$this->template->render($data);
	}
}
        
/* End of file  AccountingPenjualanController.php */
