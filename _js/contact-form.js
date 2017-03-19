function ContactUsAlert(alert_class, alert_headline, alert_text) {
	$("#alert-response").removeClass("alert-info");
	$("#alert-response").removeClass("alert-warning");
	$("#alert-response").removeClass("alert-danger");
	$("#alert-response").addClass(alert_class);
	$("#alert-headline").text(alert_headline);
	$("#alert-text").text(alert_text);
	$("#alert-response").removeClass("hidden")
	$("#alert-response").addClass("show")
}
$("#forminput_send").click(function() {
	event.preventDefault();
	$("#contact-form").validate({
		ignore: ".ignore",
		rules: {
			forminput_name: {
				required: true,
				minlength: 2
			},
			forminput_email: {
				required: true,
				email: true
			},
			forminput_message: {
				required: true,
				minlength: 2
			}
		}
	});
	if($("#contact-form").valid() != 0)
		grecaptcha.execute;
});
function ContactUs() {
	var alert_class;
	var alert_headline;
	var alert_text;
	$("#forminput_name").prop('disabled', true);
	$("#forminput_email").prop('disabled', true);
	$("#forminput_message").prop('disabled', true);
	$("#forminput_send").prop('disabled', true);
	$.ajax({
		url: '_inc/ContactUs_Engine.php',
		method: 'POST',
		dataType: 'json',
		data: $("#contact-form :input"),
		success: function(data) {
				if(data['success'] == true)
				{
					alert_class = "alert-success";
					alert_headline = "Thank you!";
					alert_text = "You should be hearing from a member of our team shortly.";
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