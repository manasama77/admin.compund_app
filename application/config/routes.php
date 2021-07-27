<?php
defined('BASEPATH') or exit('No direct script access allowed');

$route['default_controller']   = 'LoginController';
$route['404_override']         = '';
$route['translate_uri_dashes'] = FALSE;

$route['login']      					= 'LoginController/index';
$route['auth']       					= 'LoginController/auth';
$route['otp']        					= 'LoginController/otp';
$route['otp_auth']   					= 'LoginController/otp_auth';
$route['otp_resend'] 					= 'LoginController/otp_resend';
$route['logout']     					= 'LoginController/logout';
$route['forgot_password']				= 'LoginController/forgot_password';
$route['send_forgot_password']			= 'LoginController/send_forgot_password';
$route['reset_password/(:any)/(:any)'] 	= 'LoginController/reset_password/$1/$2';

$route['dashboard'] = 'DashboardController/index';

$route['profile']                = 'ProfileController/index';
$route['setting_update']         = 'ProfileController/setting_update';
$route['check_current_password'] = 'ProfileController/check_current_password';
$route['update_password']        = 'ProfileController/update_password';
$route['reset_password']         = 'ProfileController/reset_password';

$route['trade_manager'] = 'TradeManagerController/index';

$route['crypto_asset'] = 'CryptoAssetController/index';

$route['withdraw'] = 'WithdrawController/index';

$route['profit_trade_manager'] = 'ProfitTradeManagerController/index';

$route['profit_crypto_asset'] = 'ProfitCryptoAssetController/index';

$route['admin_management'] = 'AdminManagementController/index';
$route['change_role']      = 'AdminManagementController/change_role';
$route['change_status']    = 'AdminManagementController/change_status';
$route['add_admin']        = 'AdminManagementController/add_admin';
$route['delete_admin']     = 'AdminManagementController/delete_admin';

$route['founder']               = 'FounderController/index';
$route['founder/store']         = 'FounderController/store';
$route['founder/change_status'] = 'FounderController/change_status';

$route['member_management']       = 'MemberController/index';
$route['member_management/store'] = 'MemberController/store';
$route['member_management/change_status'] = 'MemberController/change_status';

$route['log/recruitment'] = 'LogRecruitmentController/index';

$route['init']                               = 'Init/init';
$route['base64']                             = 'Init/base64';
$route['send_email']                         = 'SendEmail';
$route['coinpayment/get_basic_info']         = 'CoinPayment/get_basic_info';
$route['coinpayment/rates']                  = 'CoinPayment/rates';
$route['coinpayment/create_transaction']     = 'CoinPayment/create_transaction';
$route['coinpayment/callback_address']       = 'CoinPayment/callback_address';
$route['coinpayment/get_tx_info']            = 'CoinPayment/get_tx_info';
$route['coinpayment/get_tx_ids']             = 'CoinPayment/get_tx_ids';
$route['coinpayment/balances']               = 'CoinPayment/balances';
$route['coinpayment/create_transfer']        = 'CoinPayment/create_transfer';
$route['coinpayment/create_withdrawal']      = 'CoinPayment/create_withdrawal';
$route['coinpayment/cancel_withdrawal']      = 'CoinPayment/cancel_withdrawal';
$route['coinpayment/convert']                = 'CoinPayment/convert';
$route['coinpayment/convert_limits']         = 'CoinPayment/convert_limits';
$route['coinpayment/get_withdrawal_history'] = 'CoinPayment/get_withdrawal_history';
$route['coinpayment/get_withdrawal_info']    = 'CoinPayment/get_withdrawal_info';

$route['coinpayment/ipn'] = 'CoinPayment/ipn';
$route['coinpayment/success'] = 'CoinPayment/success';
$route['coinpayment/cancel'] = 'CoinPayment/cancel';

$route['test/founder/add'] = 'TestController/insert_founder';
$route['test/downline/add'] = 'TestController/insert_downline';
$route['test/member/count_downline'] = 'TestController/count_downline';
$route['test/member/show_tree'] = 'TestController/show_tree';
$route['test/member/show_tree_attr'] = 'TestController/show_tree_attr';
