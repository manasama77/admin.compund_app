<aside class="main-sidebar sidebar-dark-primary elevation-4">
	<a href="<?= site_url('dashboard'); ?>" class="brand-link">
		<img src="https://cryptoperty.id/public/img/logo.png" alt="LOGO" class="img-fluid brand-image" style="opacity: .8; max-width: 60px;">
		<span class="brand-text font-weight-bold text-white"><?= APP_NAME; ?></span>
	</a>

	<div class="sidebar">
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
				<li class="nav-item <?= ($this->uri->segment(1) == "trade_manager") ? "menu-is-opening menu-open" : ""; ?>">
					<a href="#" class="nav-link <?= ($this->uri->segment(1) == "trade_manager") ? "active" : ""; ?>">
						<i class="nav-icon fas fa-coins"></i>
						<p>
							Trade Manager
							<i class="fas fa-angle-left right"></i>
						</p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item">
							<a href="<?= site_url('trade_manager/index'); ?>" class="nav-link <?= ($this->uri->segment(1) == "trade_manager" && $this->uri->segment(2) == "index") ? "active" : ""; ?>">
								<i class="fas fa-list nav-icon"></i>
								<p>List</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?= site_url('trade_manager/profit'); ?>" class="nav-link <?= ($this->uri->segment(1) == "trade_manager" && $this->uri->segment(2) == "profit") ? "active" : ""; ?>">
								<i class="nav-icon fas fa-coins"></i>
								<p>
									Profit Trade Manager
								</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?= site_url('trade_manager/konfigurasi'); ?>" class="nav-link <?= ($this->uri->segment(1) == "trade_manager" && $this->uri->segment(2) == "konfigurasi") ? "active" : ""; ?>">
								<i class="nav-icon fas fa-cog"></i>
								<p>
									Konfigurasi Trade Manager
								</p>
							</a>
						</li>
					</ul>
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
					<a href="<?= site_url('convert/index'); ?>" class="nav-link <?= ($this->uri->segment(1) == "convert" && $this->uri->segment(2) == "index") ? "active" : ""; ?>">
						<i class="nav-icon fas fa-long-arrow-alt-right"></i>
						<p>
							Konversi
						</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="<?= site_url('transfer/index'); ?>" class="nav-link <?= ($this->uri->segment(1) == "transfer" && $this->uri->segment(2) == "index") ? "active" : ""; ?>">
						<i class="nav-icon fas fa-paper-plane"></i>
						<p>
							Transfer
						</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="<?= site_url('member_management'); ?>" class="nav-link">
						<i class="nav-icon fas fa-users"></i>
						<p>
							Member
						</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="<?= site_url('founder'); ?>" class="nav-link">
						<i class="nav-icon fas fa-user-tie"></i>
						<p>
							Founder
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
				<li class="nav-item">
					<a href="<?= site_url('konfigurasi_crypto_asset'); ?>" class="nav-link">
						<i class="nav-icon fas fa-cog"></i>
						<p>
							Konfigurasi Crypto Asset
						</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="<?= site_url('konfigurasi/aplikasi'); ?>" class="nav-link">
						<i class="nav-icon fas fa-cog"></i>
						<p>
							Konfigurasi Aplikasi
						</p>
					</a>
				</li>
			</ul>
		</nav>
	</div>
</aside>
