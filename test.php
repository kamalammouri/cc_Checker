<?php

error_reporting(0);
set_time_limit(0);

function getSID(){
  $url = 'https://graasp.eu/donate';
  $post_items[] = "amount=1";
  $payload = implode ('&', $post_items);

  //create cURL connection
  $ch =  curl_init();
  //set options
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
  curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5000);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1 );
  curl_setopt($ch, CURLOPT_HEADER, TRUE);

  //perform our request
  $response = curl_exec($ch);
  //close the connection
  curl_close($ch);
  $pos = strpos($response, 'sessionId');
  $sessionId = substr($response, $pos+12, -2);
  return $sessionId;
}

echo getSID();