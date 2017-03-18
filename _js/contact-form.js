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
function validate(event) {
	var alert_class = "alert-info";
	var alert_headline = "Loading...";
	var alert_text = "";
	event.preventDefault();
	if (!document.getElementById('forminput_name').value == "") {
		alert_text = "No name submitted.";
	}
	if (!document.getElementById('forminput_email').value == "") {
		alert_text = "No email submitted.";
	}
	if (!document.getElementById('forminput_message').value == "") {
		alert_text = "No message submitted.";
	}
	if (alert_text != "") {
		alert_class = "alert-warning";
		alert_headline = "Woops!";
		ContactUsAlert(alert_class, alert_headline, alert_text)
	}
	else {
		ContactUsAlert(alert_class, alert_headline, alert_text)
		grecaptcha.execute();
	}
}
function onload() {
	var element = document.getElementById('forminput_send');
	element.onclick = validate;
}
function ContactUs() {
	event.preventDefault();
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