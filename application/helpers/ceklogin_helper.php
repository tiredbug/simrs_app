<?php if(!defined("BASEPATH")) exit('No script direct allowed access.');


function cek_login($ket)
{
	$CI = & get_instance();
	switch ($ket) {
		case 'admin':
			# code...
		$stt=$CI->session->userdata('login_admin');
		if($stt)
		{
			return true;
		}
		else
		{
			return false;
		}
		break;
	}
}
function login_pendaftaran()
{
	$CI = & get_instance();
	$stt=$CI->session->userdata('login_pendaftaran');
	if($stt==true)
	{
		return true;
	}
	else
	{
		return false;
	}
}


function login_rajal()
{
	$CI= & get_instance();
	$stt=$CI->session->userdata('login_rajal');
	if($stt==true)
	{
		return true;
	}
	else
	{
		return false;
	}
}


function login_lab()
{
	$CI=& get_instance();
	$stt=$CI->session->userdata('login_lab');
	if($stt==true)
	{
		return true;
	}
	else
	{
		return false;
	}
}

function login_kasirrajal()
{
	$CI=& get_instance();
	$stt=$CI->session->userdata('login_kasirrajal');
	if($stt==true)
	{
		return true;
	}
	else
	{
		return false;
	}
}


function login_go()
{
	$CI=& get_instance();
	$stt=$CI->session->userdata('login_go');
	if($stt==true)
	{
		return true;
	}
	else
	{
		return false;
	}
}



// cek login depo farmasi 
function login_depo()
{
	$CI=& get_instance();
	$stt=$CI->session->userdata('login_depo');
	if($stt==true)
	{
		return true;
	}
	else
	{
		return false;
	}
}


// cek login igd 
function login_igd()
{
	$CI=& get_instance();
	$stt=$CI->session->userdata('login_igd');
	if($stt==true)
	{
		return true;
	}
	else
	{
		return false;
	}
}

// cek login co ranap
function login_coranap()
{
	$CI=& get_instance();
	$stt=$CI->session->userdata('login_coranap');
	if($stt==true)
	{
		return true;
	}
	else
	{
		return false;
	}
}

// cek login ranap
function login_ranap()
{
	$CI=& get_instance();
	$stt=$CI->session->userdata('login_ranap');
	if($stt==true)
	{
		return true;
	}
	else
	{
		return false;
	}
}
