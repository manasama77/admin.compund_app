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
}
        
/* End of file  AccountingPenjualanController.php */
