<aside class="main-sidebar sidebar-dark-warning elevation-1">
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
					<a href="<?= site_url('dashboard'); ?>" class="nav-link <?= ($this->uri->segment(1) == "dashboard") ? "active" : ""; ?>">
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

				<li class="nav-item <?= ($this->uri->segment(1) == "crypto_asset") ? "menu-is-opening menu-open" : ""; ?>">
					<a href="#" class="nav-link <?= ($this->uri->segment(1) == "crypto_asset") ? "active" : ""; ?>">
						<i class="nav-icon fas fa-coins"></i>
						<p>
							Crypto Asset
							<i class="fas fa-angle-left right"></i>
						</p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item">
							<a href="<?= site_url('crypto_asset/index'); ?>" class="nav-link <?= ($this->uri->segment(1) == "crypto_asset" && $this->uri->segment(2) == "index") ? "active" : ""; ?>">
								<i class="fas fa-list nav-icon"></i>
								<p>List</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?= site_url('crypto_asset/profit'); ?>" class="nav-link <?= ($this->uri->segment(1) == "crypto_asset" && $this->uri->segment(2) == "profit") ? "active" : ""; ?>">
								<i class="nav-icon fas fa-coins"></i>
								<p>
									Profit Crypto Asset
								</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?= site_url('crypto_asset/konfigurasi'); ?>" class="nav-link <?= ($this->uri->segment(1) == "crypto_asset" && $this->uri->segment(2) == "konfigurasi") ? "active" : ""; ?>">
								<i class="nav-icon fas fa-cog"></i>
								<p>
									Konfigurasi Crypto Asset
								</p>
							</a>
						</li>
					</ul>
				</li>

				<li class="nav-item <?= ($this->uri->segment(1) == "bonus") ? "menu-is-opening menu-open" : ""; ?>">
					<a href="#" class="nav-link <?= ($this->uri->segment(1) == "bonus") ? "active" : ""; ?>">
						<i class="nav-icon fas fa-coins"></i>
						<p>
							Bonus
							<i class="fas fa-angle-left right"></i>
						</p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item">
							<a href="<?= site_url('bonus/recruitment'); ?>" class="nav-link <?= ($this->uri->segment(1) == "bonus" && $this->uri->segment(2) == "recruitment") ? "active" : ""; ?>">
								<i class="fas fa-users nav-icon"></i>
								<p>Recruitment</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?= site_url('bonus/qualification_leader'); ?>" class="nav-link <?= ($this->uri->segment(1) == "bonus" && $this->uri->segment(2) == "qualification_leader") ? "active" : ""; ?>">
								<i class="nav-icon fas fa-users"></i>
								<p>
									Qualification Leader
								</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?= site_url('bonus/royalty'); ?>" class="nav-link <?= ($this->uri->segment(1) == "bonus" && $this->uri->segment(2) == "royalty") ? "active" : ""; ?>">
								<i class="nav-icon fas fa-users"></i>
								<p>
									Royalty
								</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?= site_url('bonus/reward'); ?>" class="nav-link <?= ($this->uri->segment(1) == "bonus" && $this->uri->segment(2) == "reward") ? "active" : ""; ?>">
								<i class="nav-icon fas fa-users"></i>
								<p>
									Reward
								</p>
							</a>
						</li>
					</ul>
				</li>

				<li class="nav-item">
					<a href="<?= site_url('withdraw'); ?>" class="nav-link <?= ($this->uri->segment(1) == "withdraw") ? "active" : ""; ?>">
						<i class="nav-icon fas fa-wallet"></i>
						<p>
							Withdraw
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
					<a href="<?= site_url('member_management'); ?>" class="nav-link <?= ($this->uri->segment(1) == "member_management") ? "active" : ""; ?>">
						<i class="nav-icon fas fa-users"></i>
						<p>
							Member
						</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="<?= site_url('founder'); ?>" class="nav-link <?= ($this->uri->segment(1) == "founder") ? "active" : ""; ?>">
						<i class="nav-icon fas fa-user-tie"></i>
						<p>
							Founder
						</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="<?= site_url('admin_management'); ?>" class="nav-link <?= ($this->uri->segment(1) == "admin_management") ? "active" : ""; ?>">
						<i class="nav-icon fas fa-user-secret"></i>
						<p>
							Admin Management
						</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="<?= site_url('konfigurasi/aplikasi'); ?>" class="nav-link <?= ($this->uri->segment(1) == "konfigurasi") ? "active" : ""; ?>">
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
