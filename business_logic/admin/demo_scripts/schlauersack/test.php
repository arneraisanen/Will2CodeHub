<?php
$from = 'SchlauerSack Contact Form';
$to = 'wfsmyth@googlemail.com';
$subject = 'Contact Form Enquiry for SchlauerSack';
$body = 'test email from me';

	if (mail ($to, $subject, $body, $from)) {
		$result='<div class="alert alert-success">Thank You! SchlauerSack will be in touch</div>';
		$firstname = '';
		$surname = '';
		$email = '';
		$phone = '';
		$message = '';
	} else {
		$result='<div class="alert alert-danger">Sorry there was an error sending your message. Please try again later.</div>';
	}
	
echo $result;

