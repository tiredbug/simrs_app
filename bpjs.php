<?php 

echo time();
echo "<br/>";
echo strval(time());
   // $data = "22709";
   // $secretKey = "5jL71DDFBE";
   //       // Computes the timestamp
   //        date_default_timezone_set('UTC');
   //        $tStamp = strval(time()-strtotime('1970-01-01 00:00:00'));
   //         // Computes the signature by hashing the salt with the secret key as the key
   // $signature = hash_hmac('sha256', $data."&".$tStamp, $secretKey, true);
 
   // // base64 encode…
   // $encodedSignature = base64_encode($signature);
 
   // // urlencode…
   // // $encodedSignature = urlencode($encodedSignature);
 
   // echo "X-cons-id: " .$data ." ";
   // echo "X-timestamp:" .$tStamp ." ";
   // echo "X-signature: " .$encodedSignature;