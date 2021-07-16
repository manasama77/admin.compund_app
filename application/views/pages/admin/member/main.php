<section class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1>Member Management</h1>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="#">Home</a></li>
					<li class="breadcrumb-item active">Member Management</li>
				</ol>
			</div>
		</div>
	</div>
</section>

<section class="content">
	<div class="container-fluid">
		<?php echo '<pre>' . print_r($arr_member, 1) . '</pre>'; ?>
		<div class="row">

			<div class="col-12">
				<div class="card">
					<div class="card-header">
						List Member
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-bordered table-striped" id="table_data">
								<thead>
									<tr>
										<th>Picture</th>
										<th>Fullname</th>
										<th>Email</th>
										<th>Phone</th>
										<th>Total Asset</th>
										<th>Total Downline</th>
										<th class="text-center">Status</th>
									</tr>
								</thead>
								<tbody>
									<?php
									foreach ($arr_member as $key) :
										if ($key['is_active'] == "yes") {
											$badge_color = 'badge-success';
											$badge_text = 'Active';
										} else {
											$badge_color = 'badge-dark';
											$badge_text = 'Inactive';
										}
									?>
										<tr>
											<td>
												<img src="<?= base_url($key['profile_picture']); ?>" alt="Profile Picture" class="img-size-50">
											</td>
											<td>
												<?= $key['fullname']; ?>
											</td>
											<td>
												<?= $key['email']; ?>
											</td>
											<td>
												<?= $key['phone_number']; ?>
											</td>
											<td>
												<span class="badge badge-success">
													<i class="fas fa-coin"></i> <?= $key['total_asset']; ?> USDT
												</span>
											</td>
											<td>
												<span class="badge badge-warning">
													<i class="fas fa-users"></i> <?= $key['count_downline']; ?> Member
												</span>
											</td>
											<td class="text-center">
												<span class="badge <?= $badge_color; ?>" style="cursor: pointer;" onclick="changeStatus('<?= $key['id']; ?>', '<?= $key['email']; ?>', '<?= $key['is_active']; ?>')"><?= $badge_text; ?></span>
											</td>
										</tr>
									<?php endforeach; ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>
</section>
