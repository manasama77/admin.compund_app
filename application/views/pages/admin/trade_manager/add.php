<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0">Add Trade Manager</h1>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="#">Trade Manager</a></li>
					<li class="breadcrumb-item active">Add Trade Manager</li>
				</ol>
			</div>
		</div>
	</div>
</div>

<section class="content">
	<div class="container-fluid">

		<div class="row">
			<div class="col-sm-12 col-md-6 offset-md-3">

				<form id="form_add">

					<div class="card">
						<div class="card-header">
							<h3 class="card-title">Form Add New Trade Package</h3>

							<div class="card-tools">
								<a href="<?= site_url('trade_manager'); ?>" class="btn btn-dark btn-sm">
									<i class="fas fa-chevron-left fa-fw"></i> Back to List
								</a>
							</div>
						</div>

						<div class="card-body">
							<div class="form-group">
								<label for="code">Code</label>
								<div class="input-group">
									<div class="input-group-prepend">
										<label class="input-group-text" for="code">ET-</label>
									</div>
									<input type="text" class="form-control" id="code" name="code" placeholder="Code" required>
								</div>
							</div>
							<div class="form-group">
								<label for="name">Name</label>
								<input type="text" class="form-control" id="name" name="name" placeholder="Name" required>
							</div>
							<div class="form-group">
								<label for="amount">Amount Investment</label>
								<div class="input-group">
									<input type="number" class="form-control" id="amount" name="amount" placeholder="Amount" required>
									<div class="input-group-append">
										<label class="input-group-text" for="amount">USD</label>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label for="profit_per_month_percent">Profit per Month (%)</label>
								<div class="input-group">
									<input type="number" class="form-control" id="profit_per_month_percent" name="profit_per_month_percent" placeholder="Profit per Month (%)" min="1" max="100" required>
									<div class="input-group-append">
										<label class="input-group-text" for="profit_per_month_percent">%</label>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label for="profit_per_month_value">Profit per Month (USD)</label>
								<div class="input-group">
									<input type="number" class="form-control" id="profit_per_month_value" name="profit_per_month_value" placeholder="Profit per Month (USD)" min="1" max="1000000000" required>
									<div class="input-group-append">
										<label class="input-group-text" for="profit_per_month_value">USD</label>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label for="profit_per_day_percentage">Profit per Day (%)</label>
								<div class="input-group">
									<input type="number" class="form-control" id="profit_per_day_percentage" name="profit_per_day_percentage" placeholder="Profit per Day (%)" min="1" max="100" required readonly>
									<div class="input-group-append">
										<label class="input-group-text" for="profit_per_day_percentage">%</label>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label for="profit_per_day_value">Profit per Day (USD)</label>
								<div class="input-group">
									<input type="number" class="form-control" id="profit_per_day_value" name="profit_per_day_value" placeholder="Profit per Day (USD)" min="1" max="1000000000" required readonly>
									<div class="input-group-append">
										<label class="input-group-text" for="profit_per_day_value">USD</label>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label for="contract_duration">Contract Duration</label>
								<div class="input-group">
									<input type="number" class="form-control" id="contract_duration" name="contract_duration" placeholder="Contract Duration" min="1" max="1825" required>
									<div class="input-group-append">
										<label class="input-group-text" for="contract_duration">Day</label>
									</div>
								</div>
							</div>
							<hr>
							<div class="form-group">
								<label for="share_self_percentage">Share Percentage Self (%)</label>
								<div class="input-group">
									<input type="number" class="form-control" id="share_self_percentage" name="share_self_percentage" placeholder="Share Percentage Self (%)" min="1" max="100" required>
									<div class="input-group-append">
										<label class="input-group-text" for="share_self_percentage">%</label>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label for="share_self_value">Share Percentage Self (USD)</label>
								<div class="input-group">
									<input type="number" class="form-control" id="share_self_value" name="share_self_value" placeholder="Share Percentage Self (USD)" min="1" max="1000000000" required>
									<div class="input-group-append">
										<label class="input-group-text" for="share_self_value">USD</label>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label for="share_upline_percentage">Share Percentage Upline (%)</label>
								<div class="input-group">
									<input type="number" class="form-control" id="share_upline_percentage" name="share_upline_percentage" placeholder="Share Percentage Upline (%)" min="1" max="100" required>
									<div class="input-group-append">
										<label class="input-group-text" for="share_upline_percentage">%</label>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label for="share_upline_value">Share Percentage Upline (USD)</label>
								<div class="input-group">
									<input type="number" class="form-control" id="share_upline_value" name="share_upline_value" placeholder="Share Percentage Upline (USD)" min="1" max="1000000000" required>
									<div class="input-group-append">
										<label class="input-group-text" for="share_upline_value">USD</label>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label for="share_company_percentage">Share Percentage Company (%)</label>
								<div class="input-group">
									<input type="number" class="form-control" id="share_company_percentage" name="share_company_percentage" placeholder="Share Percentage Company (%)" min="1" max="100" required>
									<div class="input-group-append">
										<label class="input-group-text" for="share_company_percentage">%</label>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label for="share_company_value">Share Percentage Company (USD)</label>
								<div class="input-group">
									<input type="number" class="form-control" id="share_company_value" name="share_company_value" placeholder="Share Percentage Company (USD)" min="1" max="1000000000" required>
									<div class="input-group-append">
										<label class="input-group-text" for="share_company_value">USD</label>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label for="sequence">Position</label>
								<select class="form-control" id="sequence" name="sequence" required>
									<option value="last">Last</option>
									<?php
									foreach ($arr->result() as $key) {
										echo '<option value="' . $sequence . '">Before ' . $key->name . '</option>';
									}
									?>
								</select>
							</div>
							<div class="form-group">
								<label for="Logo">Logo</label>
								<input type="file" class="form-control" id="Logo" name="Logo" required>
							</div>
						</div>

						<div class="card-footer text-center">
							<button type="submit" class="btn btn-primary btn-block btn-flat">Submit</button>
						</div>

					</div>

				</form>

			</div>
		</div>

	</div>
</section>
