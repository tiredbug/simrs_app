<?php
/**
* 
*/
class Bpjs 
{
	private $url_ws='http://dvlp.bpjs-kesehatan.go.id:8081/devwslokalrest/';
	private $x_cons_id='22709';
	private $secretKey='5jL71DDFBE';

	private $x_timestamp='';
	private $x_signature='';

	function buat_auth_validasi()
	{
		date_default_timezone_set('Asia/Jakarta');
		$d=date("H")-7;
        $tStamp = strval(strtotime(date("Y-m-d ".$d.":i:s"))-strtotime('1970-01-01 00:00:00'));
        // Computes the signature by hashing the salt with the secret key as the key
        $signature = hash_hmac('sha256', $this->x_cons_id."&".$tStamp, $this->secretKey, true);
 
	    // base64 encode…
	    $encodedSignature = base64_encode($signature);
	 
	    // urlencode…
	    // $encodedSignature = urlencode($encodedSignature);
 		
 		$this->x_timestamp=$tStamp;
 		$this->x_signature=$encodedSignature;
	}



	function id()
	{
		return $this->x_cons_id;
	}

	function time_stamp()
	{
		return $this->x_timestamp;
	}

	function signature()
	{
		return $this->x_signature;
	}


	function peserta($by,$id)
	{
		$this->buat_auth_validasi();
		$curl = curl_init();

		curl_setopt_array($curl, array(
			CURLOPT_URL => $by=='bpjs'?$this->url_ws.'Peserta/Peserta/'.$id:$this->url_ws.'/Peserta/Peserta/nik/'.$id,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "GET",
			CURLOPT_HTTPHEADER => array(
			    'X-cons-id:'.$this->id(),
				'X-timestamp:'.$this->time_stamp(),
				'X-signature:'.$this->signature(),
			),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
		  return "cURL Error #:" . $err;
		} else {
		  return $response;
		}


	}

	function sep_insert($param=array())
	{
		$this->buat_auth_validasi();
		$curl = curl_init();
		$param=array(
			'request'=>array(
				't_sep'=>array(
					'noKartu'=>$param['noKartu'],
					'tglSep'=>$param['tglSep'],
					'tglRujukan'=>$param['tglRujukan'],
					'noRujukan'=>$param['noRujukan'],
					'ppkRujukan'=>$param['ppkRujukan'],
					'ppkPelayanan'=>$param['ppkPelayanan'],
					'jnsPelayanan'=>$param['jnsPelayanan'],
					'catatan'=>$param['catatan'],
					'diagAwal'=>$param['diagAwal'],
					'poliTujuan'=>$param['poliTujuan'],
					'klsRawat'=>$param['klsRawat'],
					'lakaLantas'=>$param['lakaLantas'],
					'lokasiLaka'=>$param['lokasiLaka'],
					'user'=>$this->id(),
					'noMr'=>$param['noMr'],
				)
			)
		);
		
		curl_setopt_array($curl, array(
		  	CURLOPT_URL => $this->url_ws.'SEP/insert',
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "POST",
			CURLOPT_POSTFIELDS=>json_encode($param),
			CURLOPT_HTTPHEADER => array(
			    'X-cons-id:'.$this->id(),
				'X-timestamp:'.$this->time_stamp(),
				'X-signature:'.$this->signature(),
			),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
		  return "cURL Error #:" . $err;
		} else {
		  return $response;
		}
	}

	function rujukan($by,$from,$value)
	{
		$url='';
		switch ($by) {
			case 'kartu':
				# code...
			    $url=$from=='pcare'?$this->url_ws.'Rujukan/Peserta/'.$value:$this->url_ws.'Rujukan/RS/Peserta/'.$value;
				break;
			case 'rujukan':
				# code...
			    $url=$from=='pcare'?$this->url_ws.'Rujukan/'.$value:$this->url_ws.'Rujukan/RS/'.$value;
				break;
			
			
		}
		$this->buat_auth_validasi();
		$curl = curl_init();

		curl_setopt_array($curl, array(
			CURLOPT_URL => $url,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "GET",
			CURLOPT_HTTPHEADER => array(
			    'X-cons-id:'.$this->id(),
				'X-timestamp:'.$this->time_stamp(),
				'X-signature:'.$this->signature(),
			),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
		  return "cURL Error #:" . $err;
		} else {
		  return $response;
		}
	}


	function sep_updatetglpulang($param=array())
	{
		$this->buat_auth_validasi();
		$curl = curl_init();
		$param=array(
			'request'=>array(
				't_sep'=>array(
					'noSep'=>$param['noSep'],
					'tglPlg'=>$param['tglPlg'],
					'ppkPelayanan'=>$param['ppkPelayanan'],
				)
			)
		);
		
		curl_setopt_array($curl, array(
		  	CURLOPT_URL => $this->url_ws.'Sep/updtglplg',
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "PUT",
			CURLOPT_POSTFIELDS=>json_encode($param),
			CURLOPT_HTTPHEADER => array(
			    'X-cons-id:'.$this->id(),
				'X-timestamp:'.$this->time_stamp(),
				'X-signature:'.$this->signature(),
			),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
		  return "cURL Error #:" . $err;
		} else {
		  return $response;
		}
	}


	function sep_updatesep($param=array())
	{
		$this->buat_auth_validasi();
		$curl = curl_init();
		$param=array(
			'request'=>array(
				't_sep'=>array(
					'noSep'=>$param['noSep'],
					'noKartu'=>$param['noKartu'],
					'tglSep'=>$param['tglSep'],
					'tglRujukan'=>$param['tglRujukan'],
					'noRujukan'=>$param['noRujukan'],
					'ppkRujukan'=>$param['ppkRujukan'],
					'ppkPelayanan'=>$param['ppkPelayanan'],
					'jnsPelayanan'=>$param['jnsPelayanan'],
					'catatan'=>$param['catatan'],
					'diagAwal'=>$param['diagAwal'],
					'poliTujuan'=>$param['poliTujuan'],
					'klsRawat'=>$param['klsRawat'],
					'lakaLantas'=>$param['lakaLantas'],
					'lokasiLaka'=>$param['lokasiLaka'],
					'user'=>$param['user'],
					'noMr'=>$param['noMr'],
				)
			)
		);
		
		curl_setopt_array($curl, array(
		  	CURLOPT_URL => $this->url_ws.'Sep/Update',
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "PUT",
			CURLOPT_POSTFIELDS=>json_encode($param),
			CURLOPT_HTTPHEADER => array(
			    'X-cons-id:'.$this->id(),
				'X-timestamp:'.$this->time_stamp(),
				'X-signature:'.$this->signature(),
			),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
		  return "cURL Error #:" . $err;
		} else {
		  return $response;
		}
	}


	function sep_delete($param=array())
	{
		$this->buat_auth_validasi();
		$curl = curl_init();
		$param=array(
			'request'=>array(
				't_sep'=>array(
					'noSep'=>$param['noSep'],
					'ppkPelayanan'=>$param['ppkPelayanan'],
				)
			)
		);
		
		curl_setopt_array($curl, array(
		  	CURLOPT_URL => $this->url_ws.'SEP/Delete',
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "DELETE",
			CURLOPT_POSTFIELDS=>json_encode($param),
			CURLOPT_HTTPHEADER => array(
			    'X-cons-id:'.$this->id(),
				'X-timestamp:'.$this->time_stamp(),
				'X-signature:'.$this->signature(),
			),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
		  return "cURL Error #:" . $err;
		} else {
		  return $response;
		}
	}


	function sep_mapping($param=array())
	{
		$this->buat_auth_validasi();
		$curl = curl_init();
		$param=array(
			'request'=>array(
				't_sep'=>array(
					'noSep'=>$param['noSep'],
					'ppkPelayanan'=>$param['ppkPelayanan'],
				)
			)
		);
		
		curl_setopt_array($curl, array(
		  	CURLOPT_URL => $this->url_ws.'SEP/map/trans',
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "POST",
			CURLOPT_POSTFIELDS=>json_encode($param),
			CURLOPT_HTTPHEADER => array(
			    'X-cons-id:'.$this->id(),
				'X-timestamp:'.$this->time_stamp(),
				'X-signature:'.$this->signature(),
			),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
		  return "cURL Error #:" . $err;
		} else {
		  return $response;
		}
	}


	function sep_detail($val)
	{
		$this->buat_auth_validasi();
		$curl = curl_init();
				
		curl_setopt_array($curl, array(
			CURLOPT_URL => $this->url_ws.'SEP/'.$val,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "GET",
			CURLOPT_HTTPHEADER => array(
			    'X-cons-id:'.$this->id(),
				'X-timestamp:'.$this->time_stamp(),
				'X-signature:'.$this->signature(),
			),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
		  return "cURL Error #:" . $err;
		} else {
		  return $response;
		}
	}

}