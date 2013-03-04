<?php 
	// http://instagram.com/developer/authentication/
	include('_config.php');
	
	if($_GET['code']) {
		$fields = array(
			'client_id'=>$config['client_id'], 
			'client_secret'=>$config['client_secret'], 
			'grant_type'=>$config['grant_type'], 
			'redirect_uri'=>$config['redirect_uri'],
			'code'=>$_GET['code']
		);
		//url-ify the data for the POST
		foreach($fields as $key=>$value) {
			$post_data .= $key.'='.$value.'&';
		}
		rtrim($post_data, '&');
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, 'https://api.instagram.com/oauth/access_token');
		curl_setopt($ch,CURLOPT_POST, count($fields));
		curl_setopt($ch,CURLOPT_POSTFIELDS, $post_data);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($ch);
		curl_close($ch);
		
		$response = json_decode($response);
		if($response->error_type){
			$flash['error'] = '<h3>'. $response->error_type . '</h3><p>' . $response->error_message . '</p>';
		}
		if($response->access_token){
			$user['access_token'] = $response->access_token;
			$user['username'] = $response->user->username;
			$user['id'] = $response->user->id;
			// you only need to get this once as it doesn't expire (for now, anyway)
			echo $user['access_token'];			
		}
	}
?>