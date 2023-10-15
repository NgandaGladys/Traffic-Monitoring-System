<?php

  function send_message($message, $phones){
  $curl = curl_init();
  curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://yoolasms.com/api/v1/send',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS =>'{
      "phone": "'.$phones.'",
      "message":"'.$message.'",
      "api_key": "7rz4BXu3zmT66Tx3o60JFqLDGC23n2YqN6OIe9X1779xJauc43wbfb6eUC9YAG27"
  }',
    CURLOPT_HTTPHEADER => array(
      'Content-Type: application/json'
    ),
  ));

  $response = curl_exec($curl);
  curl_close($curl);
  return $response;
  }
?>