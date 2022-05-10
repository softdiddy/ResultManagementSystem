<?php


	$dnd = 2;
	$from = "Keypoint";
	$to = '07080037635';
	$body = 'Your-Payment-has-recieved';
	$token = "AAGpGeeFPidD5rtncl67dUpD9mEdHcY6dCnIraBFgNrO0qb0tUmQHy2afexs";
	$url = "https://www.bulksmsnigeria.com/api/v1/sms/create?api_token=".$token."&from=".$from."&to=".$to."&body=".$body;
	//// NB:: YOU CAN SIMPLY POST TO THE URL
	
	///// API Call function
	
function api_call($url)
{
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_HTTPGET, 1);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	$result = curl_exec($curl);
	curl_close($curl);
	return $result;
}	
 api_call($url);

?>