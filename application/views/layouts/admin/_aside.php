<aside class="main-sidebar sidebar-dark-primary elevation-4">
	<a href="<?= site_url('dashboard'); ?>" class="brand-link">
		<img src="https://cryptoperty.id/public/img/logo.png" alt="LOGO" class="img-fluid brand-image" style="opacity: .8; max-width: 60px;">
		<span class="brand-text font-weight-bold text-white"><?= APP_NAME; ?></span>
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
					<a href="<?= site_url('trade_manager'); ?>" class="nav-link">
						<i class="nav-icon fas fa-coins"></i>
						<p>
							Trade Manager
						</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="<?= site_url('crypto_asset'); ?>" class="nav-link">
						<i class="nav-icon fas fa-coins"></i>
						<p>
							Crypto Asset
						</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="<?= site_url('withdraw'); ?>" class="nav-link">
						<i class="nav-icon fas fa-wallet"></i>
						<p>
							Withdraw
						</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="<?= site_url('profit_trade_manager'); ?>" class="nav-link">
						<i class="nav-icon fas fa-coins"></i>
						<p>
							Profit Trade Manager
						</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="<?= site_url('profit_crypto_asset'); ?>" class="nav-link">
						<i class="nav-icon fas fa-coins"></i>
						<p>
							Profit Crypto Asset
						</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="<?= site_url('bonus_recruitment'); ?>" class="nav-link">
						<i class="nav-icon fas fa-coins"></i>
						<p>
							Bonus Recruitment
						</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="<?= site_url('bonus_qualification_leader'); ?>" class="nav-link">
						<i class="nav-icon fas fa-coins"></i>
						<p>
							Bonus Qualification Leader
						</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="<?= site_url('bonus_royalty'); ?>" class="nav-link">
						<i class="nav-icon fas fa-coins"></i>
						<p>
							Bonus Royalty
						</p>
					</a>
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
