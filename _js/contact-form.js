function ContactUsAlert(alert_class, alert_headline, alert_text) {
	$("#alert-response").removeClass("alert-info");
	$("#alert-response").addClass(alert_class);
	$("#alert-headline").text(alert_headline);
	$("#alert-text").text(alert_text);
}
function ContactUs() {
	event.preventDefault();
	$("#forminput_name").prop('disabled', true);
	$("#forminput_email").prop('disabled', true);
	$("#forminput_message").prop('disabled', true);
	$("#forminput_send").prop('disabled', true);
	$("#alert-response").removeClass("hidden")
	$("#alert-response").addClass("show")
	$.ajax({
		url: '_inc/ContactUs_Engine.php',
		type: 'POST',
		dataType: 'json',
		data: $("form#contact-form").serialize(),
		success: function(data) {
				if(data['success'] == true)
				{
					alert_class = "alert-success";
					alert_headline = "Sent!";
					alert_text = "Thank you! You should be hearing from a member of our team shortly.";
				}
				else
				{
					alert_class = "alert-danger";
					alert_headline = "Uh-Oh!";
					alert_text = data['error'];
				}
				ContactUsAlert(alert_class, alert_headline, alert_text)
		},
		error: function(data) {
			ContactUsAlert("alert-danger", "Woops!", "Sorry, but it looks like something has gone wrong. Please try again later.")
		}
	});
};