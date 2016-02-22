<?php
	define('API_ACCESS_KEY', 'AIzaSyDx-6SzxjtHmGx9nrlR5pokxHvjo_fH8AM');

	$msg = array(
		'message' 		=> 'here is a message. message',
		'title'			=> 'This is a title. title',
		'subtitle'		=> 'This is a subtitle. subtitle',
		'tickerText'	=> 'Ticker text here...Ticker text here...Ticker text here',
		'vibrate'		=> 1,
		'sound'			=> 1
	);
	
	$fields = array(
		'data'	=> $msg
	);
 
	$headers = array(
		'Authorization: key=' . API_ACCESS_KEY,
		'Content-Type: application/json'
	);
	 
	$ch = curl_init();
	curl_setopt( $ch,CURLOPT_URL, 'https://android.googleapis.com/gcm/send' );
	curl_setopt( $ch,CURLOPT_POST, true );
	curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
	curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
	curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
	curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
	$result = curl_exec($ch );
	curl_close( $ch );

	echo $result;
?>