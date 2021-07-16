<?php

defined('BASEPATH') or exit('No direct script access allowed');

class TradeManager extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->library('L_admin', null, 'template');
	}


	public function index()
	{
		$data = [
			'title'   => 'Edit Trade | Dashboard',
			'content' => 'dashboard/main',
		];
		$this->template->render($data);
	}

	public function add()
	{
		$data = [
			'title'      => 'Edit Trade | Add Trade Manager',
			'content'    => 'trade_manager/add',
			'vitamin_js' => 'trade_manager/add_js',
		];

		$where = [
			'is_active' => 'yes',
			'deleted_at' => null,
		];
		$arr = $this->M_core->get('et_package', '*', $where);

		$data['arr'] = $arr;
		$this->template->render($data);
	}
}
        
    /* End of file  TradeManager.php */
