<!-- content-header -->
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
			<div class="col-12 col-sm-6 col-md-3">
				<div class="info-box">
					<span class="info-box-icon bg-info elevation-1">
						<i class="fas fa-coins"></i>
					</span>

					<div class="info-box-content">
						<span class="info-box-text">Investments</span>
						<span class="info-box-number">
							<?= $total_investment; ?> <small>USDT</small>
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
						<span class="info-box-text">Members</span>
						<span class="info-box-number">
							<?= $count_total_member; ?>
						</span>
					</div>
				</div>
			</div>

			<!-- fix for small devices only -->
			<div class="clearfix hidden-md-up"></div>

			<div class="col-12 col-sm-6 col-md-3">
				<div class="info-box mb-3">
					<span class="info-box-icon bg-success elevation-1">
						<i class="fas fa-coins"></i>
					</span>

					<div class="info-box-content">
						<span class="info-box-text">Trade Managers</span>
						<span class="info-box-number">
							<?= $sum_total_invest_trade_manager; ?> <small>USDT</small>
						</span>
					</div>
				</div>
			</div>
			<div class="col-12 col-sm-6 col-md-3">
				<div class="info-box mb-3">
					<span class="info-box-icon bg-warning elevation-1">
						<i class="fas fa-coins"></i>
					</span>

					<div class="info-box-content">
						<span class="info-box-text">Crypto Assets</span>
						<span class="info-box-number">
							<?= $sum_total_invest_crypto_asset; ?> <small>USDT</small>
						</span>
					</div>
				</div>
			</div>
		</div>

		<div class="row">

			<div class="col-md-12">

				<div class="card">
					<div class="card-header">
						<h3 class="card-title">Latest Member </h3>

						<div class="card-tools">
							<button type="button" class="btn btn-tool" data-card-widget="collapse">
								<i class="fas fa-minus"></i>
							</button>
						</div>
					</div>
					<div class="card-body p-0">
						<?php echo '<pre>' . print_r($arr_member->result(), 1) . '</pre>'; ?>
						<div class="table-responsive">
							<table class="table">
								<thead>
									<tr>
										<th class="align-middle">Picture</th>
										<th class="align-middle">Fullname</th>
										<th class="align-middle">Email</th>
										<th class="align-middle">Phone Number</th>
										<th class="text-center align-middle">Upline</th>
										<th class="text-center align-middle">Total Asset</th>
										<th class="text-center align-middle">Total Downline</th>
										<th class="text-center align-middle">
											<i class="fas fa-cog"></i>
										</th>
									</tr>
								</thead>
								<tbody>

									<?php if ($arr_member->num_rows() > 0) : ?>
										<?php
										foreach ($arr_member->result() as $key) :
											if (is_file(FCPATH . $key->profile_picture)) {
												$pp = 'public/img/pp/' . $key->profile_picture;
											} else {
												$pp = "public/img/pp/default_avatar.svg";
											}

											$total_asset = $key->total_invest_trade_manager + $key->total_invest_crypto_asset;
										?>

											<tr>
												<td class="align-middle">
													<img src="<?= base_url($pp); ?>" alt="Profile Picture" class="img-size-50">
												</td>
												<td class="align-middle">
													<?= $key->fullname; ?>
												</td>
												<td class="align-middle">
													<?= $key->email; ?>
												</td>
												<td class="align-middle">
													<?= $key->phone_number; ?>
												</td>
												<td class="text-center align-middle">
													<?php if ($key->upline_name == null) { ?>
														<span class="badge badge-info">
															FOUNDER
														</span>
													<?php
													} else {
														echo $key->upline_name;
													}
													?>
												</td>
												<td class="text-center align-middle">
													<span class="badge badge-success">
														<i class="fas fa-coin"></i> <?= $total_asset; ?> USDT
													</span>
												</td>
												<td class="text-center align-middle">
													<span class="badge badge-warning">
														<i class="fas fa-users"></i> <?= $key->count_downline; ?> Member
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
											<td colspan="8" class="text-center text-danger">- You Don't Have Any Friend On Your Circle -</td>
										</tr>

									<?php endif; ?>

								</tbody>
							</table>
						</div>
					</div>
					<div class="card-footer text-center">
						<?php if ($arr_member->num_rows() > 10) : ?>
							<a href="javascript:void(0)" class="uppercase">View More...</a>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- /.Main Content -->
