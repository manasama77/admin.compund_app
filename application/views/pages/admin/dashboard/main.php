<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0">Dashboard</h1>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="#">Home</a></li>
					<li class="breadcrumb-item active">Dashboard</li>
				</ol>
			</div>
		</div>
	</div>
</div>

<section class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12 col-md-4">
				<div class="info-box">
					<span class="info-box-icon bg-primary elevation-1">
						<i class="fas fa-coins"></i>
					</span>
					<div class="info-box-content">
						<span class="info-box-text">Total Investasi</span>
						<span class="info-box-number">
							<?= $card['arr_investment'][0]['total_investment']; ?> <small>USDT</small>
						</span>
					</div>
				</div>
			</div>
			<div class="col-sm-12 col-md-4">
				<div class="info-box">
					<span class="info-box-icon bg-primary elevation-1">
						<i class="fas fa-coins"></i>
					</span>
					<div class="info-box-content">
						<span class="info-box-text">Total Profit Member</span>
						<span class="info-box-number">
							<?= $card['arr_profit_bonus']['sum_profit']; ?> <small>USDT</small>
						</span>
					</div>
				</div>
			</div>
			<div class="col-sm-12 col-md-4">
				<div class="info-box">
					<span class="info-box-icon bg-primary elevation-1">
						<i class="fas fa-coins"></i>
					</span>
					<div class="info-box-content">
						<span class="info-box-text">Total Bonus Member</span>
						<span class="info-box-number">
							<?= $card['arr_profit_bonus']['sum_bonus']; ?> <small>USDT</small>
						</span>
					</div>
				</div>
			</div>

			<div class="clearfix hidden-md-up"></div>

			<div class="col-sm-12 col-md-6">
				<div class="info-box">
					<span class="info-box-icon bg-info elevation-1">
						<i class="fas fa-coins"></i>
					</span>

					<div class="info-box-content">
						<span class="info-box-text">Trade Manager Hari Ini</span>
						<span class="info-box-number">
							<?= $card['arr_investment'][1]['trade_manager']; ?> <small>USDT</small>
						</span>
					</div>
				</div>
			</div>
			<div class="col-sm-12 col-md-6">
				<div class="info-box">
					<span class="info-box-icon bg-info elevation-1">
						<i class="fas fa-coins"></i>
					</span>

					<div class="info-box-content">
						<span class="info-box-text">Jumlah Trade Manager Hari Ini</span>
						<span class="info-box-number">
							<?= $card['arr_investment'][1]['count_trade_manager']; ?>
						</span>
					</div>
				</div>
			</div>
			<div class="col-sm-12 col-md-6">
				<div class="info-box">
					<span class="info-box-icon bg-warning elevation-1">
						<i class="fas fa-coins"></i>
					</span>

					<div class="info-box-content">
						<span class="info-box-text">Crypto Asset Hari Ini</span>
						<span class="info-box-number">
							<?= $card['arr_investment'][1]['crypto_asset']; ?> <small>USDT</small>
						</span>
					</div>
				</div>
			</div>
			<div class="col-sm-12 col-md-6">
				<div class="info-box">
					<span class="info-box-icon bg-warning elevation-1">
						<i class="fas fa-coins"></i>
					</span>

					<div class="info-box-content">
						<span class="info-box-text">Jumlah Crypto Asset Hari Ini</span>
						<span class="info-box-number">
							<?= $card['arr_investment'][1]['count_crypto_asset']; ?>
						</span>
					</div>
				</div>
			</div>

			<div class="clearfix hidden-md-up"></div>

			<div class="col-sm-12 col-md-3">
				<div class="info-box mb-3">
					<span class="info-box-icon bg-info elevation-1">
						<i class="fas fa-coins"></i>
					</span>

					<div class="info-box-content">
						<span class="info-box-text">Total Trade Managers</span>
						<span class="info-box-number">
							<?= $card['arr_investment'][0]['sum_total_invest_trade_manager']; ?> <small>USDT</small>
						</span>
					</div>
				</div>
			</div>
			<div class="col-sm-12 col-md-3">
				<div class="info-box mb-3">
					<span class="info-box-icon bg-info elevation-1">
						<i class="fas fa-coins"></i>
					</span>

					<div class="info-box-content">
						<span class="info-box-text">Jumlah Trade Managers</span>
						<span class="info-box-number">
							<?= $card['arr_investment'][0]['sum_count_trade_manager']; ?>
						</span>
					</div>
				</div>
			</div>
			<div class="col-sm-12 col-md-3">
				<div class="info-box mb-3">
					<span class="info-box-icon bg-warning elevation-1">
						<i class="fas fa-coins"></i>
					</span>

					<div class="info-box-content">
						<span class="info-box-text">Total Crypto Assets</span>
						<span class="info-box-number">
							<?= $card['arr_investment'][0]['sum_total_invest_crypto_asset']; ?> <small>USDT</small>
						</span>
					</div>
				</div>
			</div>
			<div class="col-sm-12 col-md-3">
				<div class="info-box mb-3">
					<span class="info-box-icon bg-warning elevation-1">
						<i class="fas fa-coins"></i>
					</span>

					<div class="info-box-content">
						<span class="info-box-text">Jumlah Crypto Assets</span>
						<span class="info-box-number">
							<?= $card['arr_investment'][0]['sum_count_crypto_asset']; ?>
						</span>
					</div>
				</div>
			</div>

			<div class="clearfix hidden-md-up"></div>

			<div class="col-12 col-sm-6 col-md-3">
				<div class="info-box mb-3">
					<span class="info-box-icon bg-success elevation-1">
						<i class="fas fa-users"></i>
					</span>

					<div class="info-box-content">
						<span class="info-box-text">Member Aktif</span>
						<span class="info-box-number">
							<?= $card['arr_member']['member_active']; ?>
						</span>
					</div>
				</div>
			</div>
			<div class="col-12 col-sm-6 col-md-3">
				<div class="info-box mb-3">
					<span class="info-box-icon bg-secondary elevation-1">
						<i class="fas fa-users"></i>
					</span>

					<div class="info-box-content">
						<span class="info-box-text">Member Tidak Aktif</span>
						<span class="info-box-number">
							<?= $card['arr_member']['member_inactive']; ?>
						</span>
					</div>
				</div>
			</div>
			<div class="col-12 col-sm-6 col-md-3">
				<div class="info-box mb-3">
					<span class="info-box-icon bg-danger elevation-1">
						<i class="fas fa-users"></i>
					</span>

					<div class="info-box-content">
						<span class="info-box-text">Member Dihapus</span>
						<span class="info-box-number">
							<?= $card['arr_member']['member_deleted']; ?>
						</span>
					</div>
				</div>
			</div>
			<div class="col-12 col-sm-6 col-md-3">
				<div class="info-box mb-3">
					<span class="info-box-icon bg-primary elevation-1">
						<i class="fas fa-users"></i>
					</span>

					<div class="info-box-content">
						<span class="info-box-text">Total Member</span>
						<span class="info-box-number">
							<?= $card['arr_member']['total_member']; ?>
						</span>
					</div>
				</div>
			</div>

			<div class="clearfix hidden-md-up"></div>

			<div class="col-12 col-sm-6 col-md-3">
				<div class="info-box mb-3">
					<span class="info-box-icon bg-white">
						<img src="https://icons.iconarchive.com/icons/cjdowner/cryptocurrency-flat/1024/Tether-USDT-icon.png" alt="USDT">
					</span>

					<div class="info-box-content">
						<span class="info-box-text">Total Penarikan Profit <small>USDT</small></span>
						<span class="info-box-number">
							<?= $card['arr_withdraw']['sum_wd_profit_usdt']; ?> <small>USDT</small>
						</span>
					</div>
				</div>
			</div>
			<div class="col-12 col-sm-6 col-md-3">
				<div class="info-box mb-3">
					<span class="info-box-icon bg-white">
						<img src="https://icons.iconarchive.com/icons/cjdowner/cryptocurrency-flat/1024/Binance-Coin-BNB-icon.png" alt="BNB">
					</span>

					<div class="info-box-content">
						<span class="info-box-text">Total Penarikan Profit <small>BNB</small></span>
						<span class="info-box-number">
							<?= $card['arr_withdraw']['sum_wd_profit_bnb']; ?> <small>BNB</small>
						</span>
					</div>
				</div>
			</div>
			<div class="col-12 col-sm-6 col-md-3">
				<div class="info-box mb-3">
					<span class="info-box-icon bg-white">
						<img src="https://icons.iconarchive.com/icons/cjdowner/cryptocurrency-flat/1024/TRON-TRX-icon.png" alt="TRX">
					</span>

					<div class="info-box-content">
						<span class="info-box-text">Total Penarikan Profit <small>TRX</small></span>
						<span class="info-box-number">
							<?= $card['arr_withdraw']['sum_wd_profit_trx']; ?> <small>TRX</small>
						</span>
					</div>
				</div>
			</div>
			<div class="col-12 col-sm-6 col-md-3">
				<div class="info-box mb-3">
					<span class="info-box-icon bg-white">
						<img src="https://cdn.coinranking.com/BUvPxmc9o/ltcnew.svg?size=48x48" alt="LTCT">
					</span>

					<div class="info-box-content">
						<span class="info-box-text">Total Penarikan Profit <small>LTCT</small></span>
						<span class="info-box-number">
							<?= $card['arr_withdraw']['sum_wd_profit_ltct']; ?> <small>LTCT</small>
						</span>
					</div>
				</div>
			</div>

			<div class="clearfix hidden-md-up"></div>

			<div class="col-12 col-sm-6 col-md-3">
				<div class="info-box mb-3">
					<span class="info-box-icon bg-white">
						<img src="https://icons.iconarchive.com/icons/cjdowner/cryptocurrency-flat/1024/Tether-USDT-icon.png" alt="USDT">
					</span>

					<div class="info-box-content">
						<span class="info-box-text">Total Penarikan Bonus <small>USDT</small></span>
						<span class="info-box-number">
							<?= $card['arr_withdraw']['sum_wd_bonus_usdt']; ?> <small>USDT</small>
						</span>
					</div>
				</div>
			</div>
			<div class="col-12 col-sm-6 col-md-3">
				<div class="info-box mb-3">
					<span class="info-box-icon bg-white">
						<img src="https://icons.iconarchive.com/icons/cjdowner/cryptocurrency-flat/1024/Binance-Coin-BNB-icon.png" alt="BNB">
					</span>

					<div class="info-box-content">
						<span class="info-box-text">Total Penarikan Bonus <small>BNB</small></span>
						<span class="info-box-number">
							<?= $card['arr_withdraw']['sum_wd_bonus_bnb']; ?> <small>BNB</small>
						</span>
					</div>
				</div>
			</div>
			<div class="col-12 col-sm-6 col-md-3">
				<div class="info-box mb-3">
					<span class="info-box-icon bg-white">
						<img src="https://icons.iconarchive.com/icons/cjdowner/cryptocurrency-flat/1024/TRON-TRX-icon.png" alt="TRX">
					</span>

					<div class="info-box-content">
						<span class="info-box-text">Total Penarikan Bonus <small>TRX</small></span>
						<span class="info-box-number">
							<?= $card['arr_withdraw']['sum_wd_bonus_trx']; ?> <small>TRX</small>
						</span>
					</div>
				</div>
			</div>
			<div class="col-12 col-sm-6 col-md-3">
				<div class="info-box mb-3">
					<span class="info-box-icon bg-white">
						<img src="https://cdn.coinranking.com/BUvPxmc9o/ltcnew.svg?size=48x48" alt="LTCT">
					</span>

					<div class="info-box-content">
						<span class="info-box-text">Total Penarikan Bonus <small>LTCT</small></span>
						<span class="info-box-number">
							<?= $card['arr_withdraw']['sum_wd_bonus_ltct']; ?> <small>LTCT</small>
						</span>
					</div>
				</div>
			</div>

			<div class="clearfix hidden-md-up"></div>

			<div class="col-12 col-sm-6 col-md-3">
				<div class="info-box mb-3">
					<span class="info-box-icon bg-white">
						<img src="https://icons.iconarchive.com/icons/cjdowner/cryptocurrency-flat/1024/Tether-USDT-icon.png" alt="USDT">
					</span>

					<div class="info-box-content">
						<span class="info-box-text">CoinPayments <small>USDT</small></span>
						<span class="info-box-number">
							<?= $card['arr_coin_balance']['usdt']; ?> <small>USDT</small>
						</span>
					</div>
				</div>
			</div>
			<div class="col-12 col-sm-6 col-md-3">
				<div class="info-box mb-3">
					<span class="info-box-icon bg-white">
						<img src="https://icons.iconarchive.com/icons/cjdowner/cryptocurrency-flat/1024/Binance-Coin-BNB-icon.png" alt="BNB">
					</span>

					<div class="info-box-content">
						<span class="info-box-text">CoinPayments <small>BNB</small></span>
						<span class="info-box-number">
							<?= $card['arr_coin_balance']['bnb']; ?> <small>BNB</small>
						</span>
					</div>
				</div>
			</div>
			<div class="col-12 col-sm-6 col-md-3">
				<div class="info-box mb-3">
					<span class="info-box-icon bg-white">
						<img src="https://icons.iconarchive.com/icons/cjdowner/cryptocurrency-flat/1024/TRON-TRX-icon.png" alt="TRX">
					</span>

					<div class="info-box-content">
						<span class="info-box-text">CoinPayments <small>TRX</small></span>
						<span class="info-box-number">
							<?= $card['arr_coin_balance']['trx']; ?> <small>TRX</small>
						</span>
					</div>
				</div>
			</div>
			<div class="col-12 col-sm-6 col-md-3">
				<div class="info-box mb-3">
					<span class="info-box-icon bg-white">
						<img src="https://cdn.coinranking.com/BUvPxmc9o/ltcnew.svg?size=48x48" alt="LTCT">
					</span>

					<div class="info-box-content">
						<span class="info-box-text">CoinPayments <small>LTCT</small></span>
						<span class="info-box-number">
							<?= $card['arr_coin_balance']['ltct']; ?> <small>LTCT</small>
						</span>
					</div>
				</div>
			</div>

		</div>

		<div class="row">

			<div class="col-md-12">

				<div class="card">
					<div class="card-header">
						<h3 class="card-title">Member Terbaru</h3>

						<div class="card-tools">
							<button type="button" class="btn btn-tool" data-card-widget="collapse">
								<i class="fas fa-minus"></i>
							</button>
						</div>
					</div>
					<div class="card-body p-0">
						<div class="table-responsive">
							<table class="table">
								<thead>
									<tr>
										<th class="text-center align-middle">PP</th>
										<th class="align-middle">Nama Lengkap</th>
										<th class="align-middle">Email</th>
										<th class="align-middle">No Telepon</th>
										<th class="text-center align-middle">Upline</th>
										<th class="text-center align-middle">Total Asset</th>
										<th class="text-center align-middle">Total Downline</th>
										<th class="text-center align-middle">
											<i class="fas fa-cog"></i>
										</th>
									</tr>
								</thead>
								<tbody>

									<?php if (count($arr_latest_member) > 0) : ?>
										<?php
										foreach ($arr_latest_member as $key) :
										?>

											<tr>
												<td class="align-top">
													<img src="<?= $key['profile_picture']; ?>" alt="Profile Picture" class="img-size-50">
												</td>
												<td class="align-top">
													<?= $key['fullname']; ?>
												</td>
												<td class="align-top">
													<?= $key['email']; ?>
												</td>
												<td class="align-top">
													<?= $key['phone_number']; ?>
												</td>
												<td class="align-top">
													<?php if ($key['fullname_upline'] == null) { ?>
														<span class="badge badge-info">
															FOUNDER
														</span>
													<?php
													} else {
														echo $key['fullname_upline'] . " (" . $key['email_upline'] . ")";
													}
													?>
												</td>
												<td class="text-center align-middle">
													<span class="badge badge-success">
														<i class="fas fa-coin"></i> <?= $key['total_asset']; ?> USDT
													</span>
												</td>
												<td class="text-center align-middle">
													<span class="badge badge-warning">
														<i class="fas fa-users"></i> 0 Member
													</span>
												</td>
												<td class="text-center align-middle">
													<button type="button" class="btn btn-info btn-xs" onclick="showModalDownline()">
														<i class="fas fa-eye fa-fw"></i> Detail
													</button>
												</td>
											</tr>

										<?php endforeach; ?>
									<?php else : ?>

										<tr>
											<td colspan="8" class="text-center text-danger">- Data Member Tidak Ditemukan -</td>
										</tr>

									<?php endif; ?>

								</tbody>
							</table>
						</div>
					</div>
					<div class="card-footer text-center">
						<?php if ($card['arr_member']['member_active'] > 10) : ?>
							<a href="<?= site_url('member'); ?>" class="uppercase">Selengkapnya...</a>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
