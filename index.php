<?php

	require_once "./zp_cti/lib/SuiteCRMClient.php";

	//echo "<h1>Nothing to find here</h1>";
	$arr = unserialize('a:4:{s:9:"eventType";s:11:"CallStarted";s:7:"version";s:2:"v1";s:4:"type";s:5:"Event";s:4:"data";a:8:{s:6:"status";i:1;s:4:"name";s:4:"test";s:9:"direction";s:3:"out";s:11:"destination";s:8:"29822031";s:6:"callid";i:1524664459097344;s:6:"caller";s:8:"27771153";s:9:"contactid";i:969;s:11:"callstarted";s:24:"2018-04-25T13:54:19+0000";}}');
	print_r($arr);

	echo "<br /><br /><br /><br /><br /><br /><br />";
	
	//print_r(json_encode($arr));

	$client = new SuiteCRMClient();
	$client->createEntry($arr);


?>
