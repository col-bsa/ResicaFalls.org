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
							<h2>Contact Form</h2>
						</div>
					</div>
					<form id="contact-form">
						<div class="form-group row">
							<label for="forminput_name" class="col-12 col-md-2 col-form-label">Name</label>
							<div class="col-12 col-md-10">
								<input class="form-control" type="text" id="forminput_name" required>
							</div>
						</div>
						<div class="form-group row">
							<label for="forminput_email" class="col-12 col-md-2 col-form-label">Email</label>
							<div class="col-12 col-md-10">
								<input class="form-control" type="email" id="forminput_email" required>
							</div>
						</div>
						<div class="form-group row">
							<label for="forminput_message" class="col-12 col-md-2 col-form-label">Message</label>
							<div class="col-12 col-md-10">
								<textarea class="form-control" id="forminput_message" rows="4" required></textarea>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-12 col-md-8 offset-md-2">
								<button type="submit" class="btn btn-primary btn-block" id="forminput_send">Send</button>
							</div>
						</div>
						<div class="g-recaptcha"
							data-sitekey="6LeqLRkUAAAAAH3FDqKPmDdl1ejBaKH0ouQeU_LE"
							data-callback="onSubmit"
							data-size="invisible">
						</div>
					</form>
					<div class="alert fade show" role="alert" id="alert-response">
						<strong id="alert-headline"></strong> <span id="alert-text"></span>
					</div>
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
						<a href="mailto:#">info@resicafalls.org</a>
					</address>
					<h5><a href="meet-the-team">Meet the Team!</a></h5>
				</div>
			</div>
		</div>
		<?php include '_inc/footer.php'; ?>	
		<?php include '_inc/html_foot.php'; ?>
		<script type="text/javascript">
			$( "#contact-form" ).submit(function(event) {
				event.preventDefault();
				$("#forminput_name").prop('disabled', true);
				$("#forminput_email").prop('disabled', true);
				$("#forminput_message").prop('disabled', true);
				$("#forminput_send").prop('disabled', true);
				$("#alert-response").addClass("alert-info");
				$("#alert-headline").text("Loading...");
				grecaptcha.execute();
				$.ajax({
					url: '_inc/engine_contact-us.php',
					type: 'post',
					dataType: 'json',
					data: $("form#contact-form").serialize(),
					success: function(data) {
						$("#alert-response").removeClass("alert-info");
						$("#alert-response").addClass("alert-success");
						$("#alert-headline").text("Sent!");
						$("#alert-text").text("Thank you! You should be hearing from a member of our team shortly.");
					},
					error: function(data) {
						$("#alert-response").removeClass("alert-info");
						$("#alert-response").addClass("alert-danger");
						$("#alert-headline").text("Woops!");
						$("#alert-text").text("Sorry, but it looks like something has gone wrong. Please try again later.");
					}
				});
			});
		</script>
	</body>
</html>

<?php
/*
Google Secret: 6LeqLRkUAAAAAPWWBtUnxxJO2j841Sw6FRvbP2-E
*/
?>