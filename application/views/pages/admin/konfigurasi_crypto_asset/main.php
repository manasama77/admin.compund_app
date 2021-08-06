<section class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1>Konfigurasi Crypto Asset</h1>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="#">Home</a></li>
					<li class="breadcrumb-item active">Konfigurasi Crypto Asset</li>
				</ol>
			</div>
		</div>
	</div>
</section>

<section class="content">
	<div class="container-fluid">
		<div class="row">

			<div class="col-12">
				<div class="card">
					<div class="card-header">
						<h3 class="card-title">List Konfigurasi Crypto Asset</h3>
						<div class="card-tools">
							<a href="<?= site_url('konfigurasi_crypto_asset/add'); ?>" class="btn btn-primary btn-sm">
								<i class="fas fa-plus"></i> Tambah Konfigurasi Crypto Asset
							</a>
						</div>

					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-bordered table-striped" id="table_data">
								<thead>
									<tr>
										<th style="min-width: 100px;">Kode</th>
										<th style="min-width: 100px;">Nama Paket</th>
										<th style="min-width: 100px;">Nilai Investasi</th>
										<th style="min-width: 100px;">Persentase Profit Per Bulan</th>
										<th style="min-width: 100px;">Profit Per Bulan</th>
										<th style="min-width: 100px;">Persentase Profit Per Hari</th>
										<th style="min-width: 100px;">Profit Per Hari</th>
										<th style="min-width: 100px;">Masa Aktif</th>
										<th style="min-width: 100px;">Persentase Profit Member</th>
										<th style="min-width: 100px;">Profit Member</th>
										<th style="min-width: 100px;">Persentase Profit Upline</th>
										<th style="min-width: 100px;">Profit Upline</th>
										<th style="min-width: 100px;">Persentase Profit Perusahaan</th>
										<th style="min-width: 100px;">Profit Perusahaan</th>
										<th style="min-width: 100px;">Status</th>
										<th style="min-width: 100px;">
											<i class="fas fa-cogs"></i>
										</th>
									</tr>
								</thead>
								<tbody>
									<?php
									if (count($arr) > 0) :
										foreach ($arr as $key) :
									?>
											<tr>
												<td><?= $key['code']; ?></td>
												<td><?= $key['name']; ?></td>
												<td><?= $key['amount']; ?></td>
												<td><?= $key['profit_per_month_percent']; ?></td>
												<td><?= $key['profit_per_month_value']; ?></td>
												<td><?= $key['profit_per_day_percentage']; ?></td>
												<td><?= $key['profit_per_day_value']; ?></td>
												<td><?= $key['contract_duration']; ?></td>
												<td><?= $key['share_self_percentage']; ?></td>
												<td><?= $key['share_self_value']; ?></td>
												<td><?= $key['share_upline_percentage']; ?></td>
												<td><?= $key['share_upline_value']; ?></td>
												<td><?= $key['share_company_percentage']; ?></td>
												<td><?= $key['share_company_value']; ?></td>
												<td><?= $key['is_active']; ?></td>
												<td>
													<?php $disabled = ($key['is_active'] == "yes") ? "disabled" : ""; ?>
													<a href="site_url('config_crypto_asset/edit/' . $key['id'])" class="btn btn-info btn-sm <?= $disabled; ?>">
														Edit
													</a>
												</td>
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
