<?php if(! defined("BASEPATH")) exit("No direct script access allowed.");

Class Logapp {


	private $CI;

	public function __construct()
	{
		$this->CI=& get_instance();
	}



	function log_user($user=null,$pesan=null)
	{
		$data=array('id'=>NULL,
                	'modul'=>$this->CI->uri->segment(1),
                	'klas'=>$this->CI->router->class,
                	'fungsi'=>$this->CI->router->method,
                	'user'=>$user,
                	'pesan'=>$pesan,
                	);
		$this->CI->db->insert('log_user',$data);
	}


	function log_pasien($norek=null,$user=null,$pesan=null)
	{
		$data=array(
			'id'=>NULL,
			'norek'=>$norek,
			'modul'=>$this->CI->uri->segment(1),
			'klas'=>$this->CI->router->class,
			'fungsi'=>$this->CI->router->method,
			'user'=>$user,
			'pesan'=>$pesan
			);
		$this->CI->db->insert('log_pasien',$data);
	}


	function log_kunjungan()
	{
		
	}
}