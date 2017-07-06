<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Reset Password | HRD Foundation</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>
<body>
<div>
   <div style="font-size: 26px;font-weight: 700;letter-spacing: -0.02em;line-height: 32px;color: #41637e;font-family: sans-serif;text-align: center" align="center" id="emb-email-header"></div>
<p style="Margin-top: 0;color: #565656;font-family: Georgia,serif;font-size: 16px;line-height: 25px;Margin-bottom: 25px">Hi <?=$user;?>,</p> 
<p style="margin-top: 0;color: #565656;font-family: Georgia,serif;font-size: 16px;line-height: 25px;Margin-bottom: 25px">
	We received a request to reset your password for your HRD account: <?=$emailID;?>. We are here to help!
	<br>
	<br>
	Simply click on the button to set a new password:<br><br>
	<a href="<?=base_url("login/resetPassword?token=$token");?>" style="display: inline-block; margin-bottom: 0;font-weight: 600;padding: 12px 28px;background-color: #E91E63; border-radius: 2px; box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.26); color: #fff; font-size: 13px; overflow: hidden; position: relative; text-transform: uppercase; transition: all .15s linear;text-decoration:none ">Reset Password</a>
	<br>
	<br>
	<small>Please do not try to redirect from the page.</small><br><br><br>
	<img src="<?=$logo;?>" height="70px;" width="auto"/><br>
	Regards,<br>
	HRD Team.<br>
	
</p>
</div>
</body>
</html>