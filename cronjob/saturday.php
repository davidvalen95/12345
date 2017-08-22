
<?php
// create a new cURL resource
$ch = curl_init();

// set URL and other appropriate options
curl_setopt($ch, CURLOPT_URL, "http://gbzworshipper.com/cronjob/add/schedule");
curl_setopt($ch, CURLOPT_HEADER, 0);

// grab URL and pass it to the browser
curl_exec($ch);

// close cURL resource, and free up system resources
curl_close($ch);

 // echo date_default_timezone_set('Asia/Jakarta');
 // $date = date('m/d/Y h:i:s a', strtotime("+11 day", time()));
 //
 // echo $date;
?>
