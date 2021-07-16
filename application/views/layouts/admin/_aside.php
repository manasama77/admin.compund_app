<aside class="main-sidebar sidebar-dark-primary elevation-4">
	<!-- Brand Logo -->
	<a href="<?= site_url('dashboard'); ?>" class="brand-link">
		<img src="<?= base_url('public/img/logo.png'); ?>" alt="EDI TRADE LOGO" class="img-fluid brand-image" style="opacity: .8; max-width: 60px;">
		<span class="brand-text font-weight-bold text-white">EDITRADE</span>
	</a>

	<!-- Sidebar -->
	<div class="sidebar">
		<!-- Sidebar user panel (optional) -->
		<div class="user-panel mt-3 pb-3 mb-3 d-flex">
			<div class="image">
				<img src="<?= base_url('public/plugin/adminlte/dist/img/avatar5.png'); ?>" class="img-circle elevation-2" alt="Admin Image">
			</div>
			<div class="info">
				<span class="d-block text-white"><small><?= $this->session->userdata(SESI . 'name'); ?></small></span>
				<div class="btn-group">
					<a href="<?= site_url('profile'); ?>" class="btn btn-info btn-sm btn-flat text-white">
						<i class="fas fa-user"></i> Profile
					</a>
					<a href="<?= site_url('logout'); ?>" class="btn btn-danger btn-sm btn-flat text-white">
						<i class="fas fa-sign-out-alt"></i> Sign Out
					</a>
				</div>
			</div>
		</div>

		<!-- Sidebar Menu -->
		<nav class="mt-2">
			<ul class="nav nav-pills nav-sidebar flex-column nav-flat nav-compact nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">
				<li class="nav-item">
					<a href="<?= site_url('dashboard'); ?>" class="nav-link">
						<i class="nav-icon fas fa-tachometer-alt"></i>
						<p>
							Dashboard
						</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="#" class="nav-link">
						<i class="nav-icon fas fa-coins"></i>
						<p>
							Trade Manager
							<i class="fas fa-angle-left right"></i>
							<span class="badge badge-success right">1</span>
						</p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item">
							<a href="<?= site_url('trade_manager'); ?>" class="nav-link">
								<i class="fas fa-robot nav-icon"></i>
								<p>List Trade Manager</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?= site_url('trade_manager/add'); ?>" class="nav-link">
								<i class="fas fa-plus nav-icon"></i>
								<p>Add Trade Manager</p>
							</a>
						</li>
					</ul>
				</li>
				<li class="nav-item">
					<a href="#" class="nav-link">
						<i class="nav-icon fas fa-house-user"></i>
						<p>
							Crypto Asset
							<i class="right fas fa-angle-left"></i>
							<span class="badge badge-success right">1</span>
						</p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item">
							<a href="<?= site_url('login'); ?> list_crypto_asset.html" class="nav-link">
								<i class="fas fa-list nav-icon"></i>
								<p>List Crypto Asset</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?= site_url('login'); ?> add_crypto_asset.html" class="nav-link">
								<i class="fas fa-plus nav-icon"></i>
								<p>Add Crypto Asset</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?= site_url('login'); ?> claim_reward.html" class="nav-link">
								<i class="fas fa-gift nav-icon"></i>
								<p>Claim Reward</p>
							</a>
						</li>
					</ul>
				</li>
				<li class="nav-item">
					<a href="<?= site_url('user/withdraw'); ?>" class="nav-link">
						<i class="nav-icon fas fa-wallet"></i>
						<p>
							Withdraw
						</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="#" class="nav-link">
						<i class="nav-icon fas fa-scroll"></i>
						<p>
							Logs
							<i class="fas fa-angle-left right"></i>
						</p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item">
							<a href="<?= site_url('login'); ?> log_trade_profit.html" class="nav-link">
								<i class="fas fa-hand-holding-usd nav-icon"></i>
								<p>Trade Profit</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?= site_url('login'); ?> log_crypto_asset.html" class="nav-link">
								<i class="fas fa-house-user nav-icon"></i>
								<p>Crypto Asset</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?= site_url('login'); ?> log_quest.html" class="nav-link">
								<i class="fas fa-tasks nav-icon"></i>
								<p>Rewards</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?= site_url('log/recruitment'); ?>" class="nav-link">
								<i class="fas fa-sun nav-icon"></i>
								<p>Recruitment</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?= site_url('login'); ?> log_withdraw.html" class="nav-link">
								<i class="fas fa-wallet nav-icon"></i>
								<p>Withdraw</p>
							</a>
						</li>
					</ul>
				</li>
				<li class="nav-item">
					<a href="<?= site_url('member_management'); ?>" class="nav-link">
						<i class="nav-icon fas fa-users"></i>
						<p>
							Member Management
						</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="<?= site_url('founder'); ?>" class="nav-link">
						<i class="nav-icon fas fa-user-tie"></i>
						<p>
							Founder Management
						</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="<?= site_url('admin_management'); ?>" class="nav-link">
						<i class="nav-icon fas fa-user-secret"></i>
						<p>
							Admin Management
						</p>
					</a>
				</li>
			</ul>
		</nav>
		<!-- /.sidebar-menu -->
	</div>
	<!-- /.sidebar -->
</aside>
