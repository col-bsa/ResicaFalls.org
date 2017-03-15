<!DOCTYPE html>
<html lang="en">
	<head>
		<?php include '_inc/html_head.php'; ?>
		<title>Contact Us <?php include '_inc/var/site_name.php'; ?></title>
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
					<h5>Contact Form</h5>
					<form id="contact-form">
						<div class="form-group row">
							<label for="forminput_name" class="col-2 col-form-label" required>Name</label>
							<div class="col-10">
								<input class="form-control" type="text" id="forminput_name">
							</div>
						</div>
						<div class="form-group row">
							<label for="forminput_email" class="col-2 col-form-label" required>Email</label>
							<div class="col-10">
								<input class="form-control" type="email" id="forminput_email">
							</div>
						</div>
						<div class="form-group">
							<label for="forminput_message">Message</label>
							<textarea class="form-control" id="forminput_message" rows="4"></textarea>
						</div>
						<button type="submit" class="btn btn-primary" id="forminput_send">Send</button>
					</form>
					<div class="alert fade show" role="alert" id="alert-response">
						<strong id="alert-headline">Holy guacamole!</strong> <span id="alert-text"></span>
					</div>
				</div>
				<div class="col-12 col-md-4">
					<h5>Contact Info</h5>
					<address>
						<strong>Resica Falls Scout Reservation</strong><br>
						1200 Resica Falls Road<br>
						East Stroudsburg, PA 18302<br>
						<abbr title="Phone">P:</abbr> (570) 223-8312
					</address>
					<h5><a href="meet-the-team">Meet the Team!</a></h5>
					<address>
						<strong>Cradle of Liberty Council Office</strong><br>
						1485 Valley Forge Road<br>
						Wayne, PA 19087<br>
						<abbr title="Phone">P:</abbr> (610) 688-6900<br>
						<a href="http://colbsa.org" target="_blank">colbsa.org</a>
					</address>
				</div>
			</div>
		</div>
		<?php include '_inc/footer.php'; ?>	
		<?php include '_inc/html_foot.php'; ?>
		<script type="text/javascript">
			$( "#contact-form" ).submit(function( event ) {
				event.preventDefault();
				$("forminput_name").prop('disabled', true);
				$("forminput_email").prop('disabled', true);
				$("forminput_message").prop('disabled', true);
				$("forminput_send").prop('disabled', true);
				$.ajax({
					url: '_inc/engine_contact-us.php',
					type: 'post',
					dataType: 'json',
					data: $("form#contact-form").serialize(),
					success: function(data) {
						// ... do something with the data...
					}
					fail: function(data) {
						$("#alert-response").addClass("alert-danger");
						$("#alert-headline").text("Woops!");
						$("#alert-text").text("Sorry, but it looks like something has gone wrong. Please try again later.");
					}
				});
				$(".alert").alert();
			});
		</script>
	</body>
</html>