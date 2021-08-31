<section class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1>Accounting Penjualan</h1>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="#">Home</a></li>
					<li class="breadcrumb-item active">Accounting Penjualan</li>
				</ol>
			</div>
		</div>
	</div>
</section>

<section class="content">
	<div class="container-fluid">
		<div class="row">

			<div class="col-sm-12 col-md-4">
				<div class="info-box">
					<span class="info-box-icon bg-success elevation-1">
						<i class="fas fa-coins"></i>
					</span>
					<div class="info-box-content">
						<span class="info-box-text">Total Omzet</span>
						<span class="info-box-number">
							<?= $arr['total_omzet']; ?> <small>USDT</small>
						</span>
					</div>
				</div>
			</div>

			<div class="col-sm-12 col-md-4">
				<div class="info-box">
					<span class="info-box-icon bg-warning elevation-1">
						<i class="fas fa-coins"></i>
					</span>
					<div class="info-box-content">
						<span class="info-box-text">Total Paket Habis</span>
						<span class="info-box-number">
							<?= $arr['total_expired']; ?> <small>USDT</small>
						</span>
					</div>
				</div>
			</div>

			<div class="col-sm-12 col-md-4">
				<div class="info-box">
					<span class="info-box-icon bg-dark elevation-1">
						<i class="fas fa-coins"></i>
					</span>
					<div class="info-box-content">
						<span class="info-box-text">Sisa Piutang</span>
						<span class="info-box-number">
							<?= $arr['sisa_piutang']; ?> <small>USDT</small>
						</span>
					</div>
				</div>
			</div>

			<div class="col-12">
				<div class="card">
					<div class="card-header bg-success">
						<h5 class="card-title">List Penjualan Aktif</h5>
						<div class="card-tools">
							<button type="button" class="btn btn-tool" data-card-widget="collapse">
								<i class="fas fa-minus text-white"></i>
							</button>
						</div>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-bordered table-striped" id="table_data_1" style="width: 100% !important; min-width: 100%;">
								<thead>
									<tr>
										<th style="min-width: 100px;">Tanggal</th>
										<th style="min-width: 100px;">Member</th>
										<th style="min-width: 100px;">Jenis Paket</th>
										<th style="min-width: 100px;">Nama Paket</th>
										<th class="text-right" style="min-width: 100px;">Investasi</th>
									</tr>
								</thead>
								<tbody>
									<?php
									if (count($arr['data_active']) > 0) :
										foreach ($arr['data_active'] as $key) :
									?>
											<tr>
												<td class="text-center"><?= $key['created_at']; ?></td>
												<td><?= $key['fullname']; ?> <small>(<?= $key['user_id']; ?>)</small></td>
												<td>
													<?php
													if ($key['jenis'] == "tm") {
														echo "Trade Manager";
													} else {
														echo "Crypto Asset";
													}
													?>
												</td>
												<td><?= $key['package_name']; ?></td>
												<td class="text-right"><?= $key['investasi']; ?></td>
											</tr>
									<?php
										endforeach;
									endif;
									?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>

			<div class="col-12">
				<div class="card">
					<div class="card-header bg-warning">
						<h5 class="card-title">List Penjualan Tidak Aktif</h5>
						<div class="card-tools">
							<button type="button" class="btn btn-tool" data-card-widget="collapse">
								<i class="fas fa-minus text-white"></i>
							</button>
						</div>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-bordered table-striped" id="table_data_2" style="width: 100% !important; min-width: 100%;">
								<thead>
									<tr>
										<th style="min-width: 100px;">Tanggal</th>
										<th style="min-width: 100px;">Member</th>
										<th style="min-width: 100px;">Jenis Paket</th>
										<th style="min-width: 100px;">Nama Paket</th>
										<th class="text-right" style="min-width: 100px;">Investasi</th>
									</tr>
								</thead>
								<tbody>
									<?php
									if (count($arr['data_inactive']) > 0) :
										foreach ($arr['data_inactive'] as $key) :
									?>
											<tr>
												<td class="text-center"><?= $key['created_at']; ?></td>
												<td><?= $key['fullname']; ?> <small>(<?= $key['user_id']; ?>)</small></td>
												<td>
													<?php
													if ($key['jenis'] == "tm") {
														echo "Trade Manager";
													} else {
														echo "Crypto Asset";
													}
													?>
												</td>
												<td><?= $key['package_name']; ?></td>
												<td class="text-right"><?= $key['investasi']; ?></td>
											</tr>
									<?php
										endforeach;
									endif;
									?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>
</section>

<form id="form_reset">
	<div class="modal fade" id="modal_reset" data-backdrop="static" data-keyboard="false" tabindex="-1">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="staticBackdropLabel">Reset Password</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label for="email_reset">Email</label>
						<input type="text" class="form-control" id="email_reset" name="email_reset" required readonly>
					</div>
					<div class="form-group">
						<label for="password_reset">New Password</label>
						<input type="password" class="form-control" id="password_reset" name="password_reset" required>
					</div>
				</div>
				<div class="modal-footer">
					<input type="hidden" id="id_reset" name="id_reset">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Submit</button>
				</div>
			</div>
		</div>
	</div>
</form>
