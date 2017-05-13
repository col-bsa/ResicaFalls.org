<!DOCTYPE html>
<html lang="en">
	<head>
		<?php include '_inc/html_head.php'; ?>
		<meta name="description" content="Schedule a trip plan with the team at Resica Falls Scout Reservation!" />
		<title>Contact Us <?php include '_inc/var/site_name.php'; ?></title>
		<script src='https://www.google.com/recaptcha/api.js'></script>
	</head>
	<body>
		<?php include '_inc/header.php'; ?>
		<?php include '_inc/nav.php'; ?>

		<div class="container content">
			<div class="row">
				<div class="col">
					<h1>Submit A Trip-Plan</h1>
				</div>
			</div>
			<div class="row">
				<div class="col-12 col-md-8">
					<form id="contact-form" onsubmit="">
						<div class="row">
							<div class="col-12 col-md-10 offset-md-2">
								<h2>Contact Info</h2>
							</div>
						</div>
						<div class="form-group row">
							<label for="forminput_name" class="col-12 col-md-2 col-form-label">Name</label>
							<div class="col-12 col-md-10">
								<input class="form-control" type="text" name="name" id="forminput_name">
							</div>
						</div>
						<div class="form-group row">
							<label for="forminput_phone" class="col-12 col-md-2 col-form-label">Phone</label>
							<div class="col-12 col-md-10">
								<input class="form-control" type="tel" name="phone" id="forminput_phone">
							</div>
						</div>
						<div class="form-group row">
							<label for="forminput_unit" class="col-12 col-md-2 col-form-label">Unit</label>
							<div class="col-12 col-md-10">
								<input class="form-control" type="number" name="unit" id="forminput_unit">
							</div>
						</div>
						<div class="form-group row">
							<label for="forminput_council" class="col-12 col-md-2 col-form-label">Council</label>
							<div class="col-12 col-md-10">
								<input class="form-control" type="text" name="council" id="forminput_council">
							</div>
						</div>
						<div class="row">
							<div class="col-12 col-md-10 offset-md-2">
								<h2>Trip Info</h2>
							</div>
						</div>
						<div class="form-group row">
							<label for="forminput_type" class="col-12 col-md-2 col-form-label">Council</label>
							<div class="col-12 col-md-10">
								<select class="form-control" name="type" id="forminput_type">
									<option>Hike</option>
									<option>Hike &amp; Swim</option>
									<option>Canoe</option>
								</select>
							</div>
						</div>
						<div class="form-group row">
							<label for="forminput_destination" class="col-12 col-md-2 col-form-label">Destination</label>
							<div class="col-12 col-md-10">
								<input class="form-control" type="text" name="destination" id="forminput_destination">
							</div>
						</div>
						<div class="form-group row">
							<label for="forminput_depdate" class="col-12 col-md-2 col-form-label">Departure Date</label>
							<div class="col-12 col-md-10">
								<input class="form-control" type="date" name="depdate" id="forminput_depdate">
							</div>
						</div>
						<div class="form-group row">
							<label for="forminput_deptime" class="col-12 col-md-2 col-form-label">Departure Time</label>
							<div class="col-12 col-md-10">
								<input class="form-control" type="time" name="depdate" id="forminput_deptime">
							</div>
						</div>
						<div class="form-group row">
							<label for="forminput_overnight" class="col-12 col-md-2 col-form-label">Overnight</label>
							<div class="col-12 col-md-10">
								<input class="form-control" type="checkbox" name="overnight" id="forminput_overnight">
							</div>
						</div>
						<div class="row">
							<div class="col-12 col-md-10 offset-md-2">
								<h2>Crew Details</h2>
							</div>
						</div>
						<div class="form-group row">
							<label for="forminput_youth" class="col-12 col-md-2 col-form-label">Number of Youth</label>
							<div class="col-12 col-md-10">
								<input class="form-control" type="number" name="youth" id="forminput_youth">
							</div>
						</div>
						<div class="form-group row">
							<label for="forminput_adults" class="col-12 col-md-2 col-form-label">Number of Adults</label>
							<div class="col-12 col-md-10">
								<input class="form-control" type="number" name="adults" id="forminput_adults">
							</div>
						</div>
						<div class="form-group row">
							<label for="forminput_lifeguards" class="col-12 col-md-2 col-form-label">Number of Lifeguards (If Applicable)</label>
							<div class="col-12 col-md-10">
								<input class="form-control" type="number" name="lifeguards" id="forminput_lifeguards">
							</div>
						</div>
						<div class="row">
							<div class="col-12 col-md-10 offset-md-2">
								<h2>Additional Details</h2>
							</div>
						</div>
						<div class="form-group row">
							<label for="forminput_other" class="col-12 col-md-2 col-form-label">Additional Details</label>
							<div class="col-12 col-md-10">
								<textarea class="form-control" name="other" id="forminput_other" rows="6"></textarea>
							</div>
						</div>
						<div class="g-recaptcha"
							data-sitekey="6LeqLRkUAAAAAH3FDqKPmDdl1ejBaKH0ouQeU_LE"
							data-callback=""
							data-size="invisible">
						</div>
						<div class="form-group row">
							<div class="col-12 col-md-8 offset-md-2">
								<button type="submit" class="btn btn-primary btn-block" id="forminput_send">Send</button>
							</div>
						</div>
						<div class="alert alert-info fade hidden" role="alert" id="alert-response">
							<strong id="alert-headline"></strong> <span id="alert-text"></span>
						</div>
					</form>
				</div>
				<div class="col-12 col-md-4">
					<h2>Requirements</h2>
					<ul>
						<li>All:</li>
						<ul>
							<li>Two-Deep Leadership</li>
							<li>Commissioner Approved Trip-Plan</li>
						</ul>
						<li>Aquatic:</li>
						<ul>
							<li>"Safe Swim Defense" Trained Adult</li>
							<li>Over 21 Year Old Look-Out</li>
							<li>Lifeguard for non-swimmers</li>
						</ul>
					</ul>
				</div>
			</div>
		</div>
		<?php include '_inc/footer.php'; ?>	
		<?php include '_inc/html_foot.php'; ?>
		<script src="_js/jquery-validation-1.16.0/dist/jquery.validate.min.js"></script>
		<script type="text/javascript" src="_js/contact-form.js"></script>
	</body>
</html>
