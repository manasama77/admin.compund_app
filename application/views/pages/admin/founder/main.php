<section class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1>Founder Management</h1>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="#">Home</a></li>
					<li class="breadcrumb-item active">Founder Management</li>
				</ol>
			</div>
		</div>
	</div>
</section>

<section class="content">
	<div class="container-fluid">
		<?php echo '<pre>' . print_r($arr_founder, 1) . '</pre>'; ?>
		<div class="row">

			<div class="col-sm-12 col-md-8">
				<div class="card">
					<div class="card-header">
						List Founder
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
									foreach ($arr_founder as $key) :
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

			<div class="col-sm-12 col-md-4">
				<div class="card">
					<div class="card-header">
						Add Founder
					</div>
					<div class="card-body">
						<form id="form_add">
							<div class="form-group">
								<label for="id_card_number">ID Card Number</label>
								<input type="text" class="form-control" id="id_card_number" name="id_card_number" minlength="4" required>
							</div>
							<div class="form-group">
								<label for="email">Email</label>
								<input type="email" class="form-control" id="email" name="email" autocomplete="email" required>
							</div>
							<div class="form-group">
								<label for="password">Password</label>
								<input type="password" class="form-control" id="password" name="password" autocomplete="new-password" minlength="4" required>
							</div>
							<div class="form-group">
								<label for="verify_password">Verify Password</label>
								<input type="password" class="form-control" id="verify_password" name="verify_password" autocomplete="new-password" minlength="4" required>
							</div>
							<hr>
							<div class="form-group">
								<label for="fullname">Name</label>
								<input type="text" class="form-control" id="fullname" name="fullname" autocomplete="name" minlength="3" required>
							</div>
							<div class="form-group">
								<label for="phone_number">Phone Number</label>
								<input type="tel" class="form-control" id="phone_number" name="phone_number" autocomplete="tel" minlength="4" required>
							</div>
							<button type="submit" class="btn btn-primary btn-block">Submit</button>
						</form>
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
