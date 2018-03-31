<?php
	$clientID = ""; // Required
	
	
	$embedType = "stream";
	if(!isset($_GET["channel"])) {
		if(isset($_GET["video"])) {
			$embedType = "video";
		}
		else if(isset($_GET["clip"])) {
			$embedType = "clip";
		}
		else {
			$embedType = "";
		}
	}
	
	$baseURL = "https://api.twitch.tv/helix";

	function helix($url) {
		global $clientID, $baseURL;
		$ch = curl_init("{$baseURL}/{$url}");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, [ "Client-ID: {$clientID}" ]);
		$json = curl_exec($ch);
		$error = curl_error($ch);
		curl_close($ch);
		if($error) {
			print_r($error);
		}
		$data = json_decode($json);
		return $data;
	}
	
	function getUserByName($login) {
		return helix("users?login={$login}")->data;
	}
	
	function getUserByID($id) {
		return helix("users?id={$id}")->data;
	}
	
	function getStreamByName($user_login) {
		return helix("streams?user_login={$user_login}")->data;
	}
	
	function getVideoByID($id) {
		return helix("videos?id={$id}")->data;
	}
	
	function getClipByID($id) {
		return helix("clips?id={$id}")->data;
	}
	
	function getGameNameByID($id) {
		$data = helix("games?id={$id}")->data;
		if(count($data)) {
			return $data[0]->name;
		}
		return "";
	}
	
	$userData = null;
	$streamData = null;
	$videoData = null;
	$clipData = null;
	$gameName = null;
	
	$cardTitle = "Twitch.tv";
	$embedURL = "https://twitch.tv/";
	$cardDescription = "Twitch.tv";
	$cardImage = "https://static-cdn.jtvnw.net/ttv-static/404_preview-640x360.jpg";
	
	if($embedType === "stream") {
		$userData = getUserByName($_GET["channel"]);
		if(count($userData)) {
			$userData = $userData[0];
			$embedURL = "http://player.twitch.tv/?channel={$userData->login}";
			$streamData = getStreamByName($userData->login);
			if(count($streamData)) {
				$streamData = $streamData[0];
				$cardDescription = $streamData->title;
				$cardImage = str_replace("{width}x{height}", "640x360", $streamData->thumbnail_url);
				$gameName = getGameNameByID($streamData->game_id);
				if($gameName) {
					$cardTitle = "{$userData->display_name} playing {$gameName} on Twitch!";
				}
				else {
					$cardTitle = "{$userData->display_name} streaming on Twitch!";
				}
			}
			else {
				$cardTitle = "{$userData->display_name} on Twitch!";
				$embedURL = "https://twitch.tv/{$userData->login}";
				$cardDescription = "Visit {$userData->display_name} on Twitch!";
				if($userData->offline_image_url) {
					$cardImage = str_replace("1920x1080", "640x360", $userData->offline_image_url);
				}
			}
		}
		else {
			echo "Couldn't find channel named \"{$_GET["channel"]}\"";
			exit(404);
		}
	}
	else if($embedType === "video") {
		$videoData = getVideoByID($_GET["video"]);
		if(count($videoData)) {
			$videoData = $videoData[0];
			$embedURL = "http://player.twitch.tv/?video={$videoData->id}";
			$cardDescription = $videoData->title;
			$cardImage = str_replace("%{width}x%{height}", "640x360", $videoData->thumbnail_url);
			$userData = getUserByID($videoData->user_id)[0];
			$cardTitle = "Video by {$userData->display_name} on Twitch!";
		}
		else {
			echo "Couldn't find video by ID \"{$_GET["video"]}\"";
			exit(404);
		}
	}
	else if($embedType === "clip") {
		$clipData = getClipByID($_GET["clip"]);
		if(count($clipData)) {
			$clipData = $clipData[0];
			$embedURL = "https://clips.twitch.tv/embed?clip={$clipData->id}";
			$cardDescription = $clipData->title;
			$cardImage = $clipData->thumbnail_url;
			$userData = getUserByID($clipData->broadcaster_id)[0];
			$gameName = getGameNameByID($clipData->game_id);
			if($gameName) {
				$cardTitle = "Clip of {$userData->display_name} playing {$gameName} on Twitch!";
			}
			else {
				$cardTitle = "Clip of {$userData->display_name} on Twitch!";
			}
		}
		else {
			echo "Couldn't find clip by ID \"{$_GET["clip"]}\"";
			exit(404);
		}
	}
	else {
		echo "No \"channel\", \"video\", or \"clip\" set.";
		exit(400);
	}
	
	// print_r([
	// 	type => $embedType,
	// 
	// 	user => $userData,
	// 	stream => $streamData,
	// 	video => $videoData,
	// 	clip => $clipData,
	// 	game => $gameName,
	// 
	// 	cardTitle => $cardTitle,
	// 	embedURL => $embedURL,
	// 	cardDescription => $cardDescription,
	// 	cardImage => $cardImage
	// ]);
	
	// exit(200);
?>

<!doctype html>
<html>
<head>
	<meta property="twitter:title" content="<?=$cardTitle?>">
	<meta property="twitter:description" content="<?=$cardDescription?>">
	<meta name="twitter:card" content="player">
	<meta name="twitter:site" content="@twitch">
	<meta name="twitter:image" content="<?=$cardImage?>">
	<meta name="twitter:player" content="<?=$embedURL?>">
	<meta name="twitter:player:width" content="640">
	<meta name="twitter:player:height" content="360">
	<meta name="twitter:image:partner_badge:src" content="https://clips-media-assets.twitch.tv/img/twitch-white-rgb.png"/>
	<!-- <meta http-equiv="refresh" content="0; url="https://twitch.tv/<?=$userData->login?>" /> -->
</head>
<body></body>
</html>
