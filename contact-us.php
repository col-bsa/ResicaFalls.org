<!DOCTYPE html>
<html lang="en">
	<head>
		<?php include '_inc/html_head.php'; ?>
		<title>Contact Us <?php include '_inc/var/site_name.php'; ?></title>
		<script src='https://www.google.com/recaptcha/api.js'></script>
	</head>
	<body>
		<?php include '_inc/header.php'; ?>
		<?php include '_inc/nav.php'; ?>

		<div class="container content">
			<div class="row">
				<div class="col">
					<h1>Contact Us</h1>
				</div>
			</div>
			<div class="row">
				<div class="col-12 col-md-8">
					<div class="row">
						<div class="col-12 col-md-10 offset-md-2">
							<h2>Send a Message</h2>
						</div>
					</div>
					<form id="contact-form">
						<div class="form-group row">
							<label for="forminput_name" class="col-12 col-md-2 col-form-label">Name</label>
							<div class="col-12 col-md-10">
								<input class="form-control" type="text" name="name" id="forminput_name">
							</div>
						</div>
						<div class="form-group row">
							<label for="forminput_email" class="col-12 col-md-2 col-form-label">Email</label>
							<div class="col-12 col-md-10">
								<input class="form-control" type="email" name="email" id="forminput_email">
							</div>
						</div>
						<div class="form-group row">
							<label for="forminput_message" class="col-12 col-md-2 col-form-label">Message</label>
							<div class="col-12 col-md-10">
								<textarea class="form-control" name="message" id="forminput_message" rows="6"></textarea>
							</div>
						</div>
						<div class="g-recaptcha"
							data-sitekey="6LeqLRkUAAAAAH3FDqKPmDdl1ejBaKH0ouQeU_LE"
							data-callback="ContactUs"
							data-size="invisible">
						</div>
						<div class="form-group row">
							<div class="col-12 col-md-8 offset-md-2">
								<button type="submit" class="btn btn-primary btn-block" id="forminput_send">Send</button>
							</div>
						</div>
						<div class="alert alert-info fade hidden" role="alert" id="alert-response">
							<strong id="alert-headline">Loading...</strong> <span id="alert-text"></span>
						</div>
					</form>
				</div>
				<div class="col-12 col-md-4">
					<h2>Contact Info</h2>
					<address>
						<strong>Resica Falls Scout Reservation</strong><br>
						1200 Resica Falls Road<br>
						East Stroudsburg, PA 18302<br>
						<abbr title="Phone">P:</abbr> (570) 223-8312<br>
						<abbr title="Fax">F:</abbr> (570) 223-7263<br>
						<a href="index" target="_blank">ResicaFalls.org</a><br>
						<a href="mailto:hello@resicafalls.org">hello@resicafalls.org</a>
					</address>
					<h5><a href="meet-the-team">Meet the Team!</a></h5>
				</div>
			</div>
		</div>
		<?php include '_inc/footer.php'; ?>	
		<?php include '_inc/html_foot.php'; ?>
		<script type="text/javascript" src="_js/contact-form.js"></script>
		<script>onload();</script>
	</body>
</html>