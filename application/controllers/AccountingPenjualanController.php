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


	public function index()
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
}
        
/* End of file  AccountingPenjualanController.php */
