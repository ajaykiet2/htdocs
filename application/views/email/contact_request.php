<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Contact Request | HRD Foundation</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>
<body>
<div>
   <div style="font-size: 26px;font-weight: 700;letter-spacing: -0.02em;line-height: 32px;color: #41637e;font-family: sans-serif;text-align: center" align="center" id="emb-email-header"></div>
<p style="Margin-top: 0;color: #565656;font-family: Georgia,serif;font-size: 16px;line-height: 25px;Margin-bottom: 25px">Hey <?=$user;?>,</p> 
<p style="margin-top: 0;color: #565656;font-family: Georgia,serif;font-size: 16px;line-height: 25px;Margin-bottom: 25px">
	There is an enquiry for you, Below are the details:
	<br>
	<br>
	<b>Name:</b> <?=$contact_name;?><br>
	<b>Mobile:</b> <?=$contact_mobile;?><br>
	<b>Email:</b> <?=$contact_email;?><br>
	<b>Message:</b> <?=$contact_message;?><br><br>
	<small>Please take a look and respond accordingly.</small><br><br><br>
	Regards,<br>
	HRD ADMIN.
	
</p>
</div>
</body>
</html>