<?php
	header('Content-Type: application/json'); 
	include('_config.php');	
	
	$apiUrlBase = 'https://api.instagram.com/v1/';
	
	if($_GET['what']) {
		
		switch ($_GET['what']) {
			case "getRecentMediaForUser":
				$apiUrl = 'users/search?q='.$_GET['who'].'&count=1';
				// get the ID of the user you searched for
				$getTargetId = json_decode(file_get_contents($apiUrlBase. $apiUrl .'&access_token='.$config['access_token']));
				// grab their pics
				$results = file_get_contents($apiUrlBase. 'users/'.$getTargetId->data[0]->id.'/media/recent/?count='.$_GET['count'].'&max_timestamp='.$_GET['max_timestamp'].'&access_token='.$config['access_token']);				
				break;
			case "getPopularMedia":
				$results = file_get_contents($apiUrlBase.'media/popular?client_id='. $config['client_id']);
				break;
			case "getInfoForUser":
				$apiUrl = 'users/search?q='.$_GET['who'].'&count=1';
				// get the info of the user you searched for
				$results = file_get_contents($apiUrlBase. $apiUrl .'&access_token='.$config['access_token']);	
				break;
			case "searchForMedia":
				if(!$_GET['lat'] || !$_GET['lng']) {
					echo 'Missing lat or lng parameter';
				} else {
					$results = file_get_contents($apiUrlBase. 'media/search?lat='.$_GET['lat'].'&lng='.$_GET['lng'].'&min_timestamp='.$_GET['min_timestamp'].'&max_timestamp='.$_GET['max_timestamp'].'&distance='.$_GET['distance'].'&access_token='.$config['access_token']);
				}
				break;
			case "searchForTags":
				$results = file_get_contents($apiUrlBase. 'tags/search?q='.$_GET['query'].'&access_token='.$config['access_token']);
				break;
			case "recentlyTagged":
				$results = file_get_contents($apiUrlBase. 'tags/'.$_GET['query'].'/media/recent?access_token='.$config['access_token']);
				break;
		}
	}
	
	echo 'instagram(' . $results . ');';
?>