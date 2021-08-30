<?php

defined('BASEPATH') or exit('No direct script access allowed');

class BonusRewardController extends CI_Controller
{
	protected $datetime;

	public function __construct()
	{
		parent::__construct();
		$this->load->library('L_admin', null, 'template');
		$this->load->model('M_bonus_reward');


		$this->datetime = date('Y-m-d H:i:s');
	}


	public function index()
	{
		$arr = $this->M_bonus_reward->get_list();

		$data = [
			'title'      => APP_NAME . ' | Bonus Recruitment',
			'content'    => 'bonus_reward/main',
			'vitamin_js' => 'bonus_reward/main_js',
			'arr'        => $arr,
		];
		$this->template->render($data);
	}
}
        
/* End of file  BonusRewardController.php */
