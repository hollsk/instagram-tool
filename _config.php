<?php 
	$config['target_user'] = 'hollsk'; // a target user (somebody whose pics you want to see)
	$config['client_id'] = ''; // get this from instagram when you register a new app
	$config['client_secret'] = ''; // get this from instagram when you register a new app
	$config['grant_type'] = 'authorization_code'; // this is the only value Instagram supports right now
	$config['access_token'] = ''; // get this from auth.php (one-time)
	$config['redirect_uri'] = 'http://root.instagram-tool.lh/'; // your root url, you'll only use this for auth.php
	$config['authorisation_url'] = 'https://api.instagram.com/oauth/authorize/?client_id='. $config['client_id'] .'&redirect_uri='. $config['redirect_uri'] .'&response_type=code';
	
	$flash['error'] = '';
?>