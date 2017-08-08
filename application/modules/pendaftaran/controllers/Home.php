<?php if(! defined("BASEPATH")) exit('No script direct allowed access.');
class Home extends ci_controller{

	function __construct()
	{
		parent::__construct();
		if(! login_pendaftaran() )
		{
			redirect(base_url().'pendaftaran/login');
		}
	}

	function index()
	{
		$this->template->load('template','home');
	}

	function update_profile()
	{
		if(! $this->input->is_ajax_request())
		{
			exit("No direct script access allowed.");
		}
		else
		{
			$sukses=false;
			$pesan='';
			if($this->input->post('passl')!=$this->session->userdata('password'))
			{
				$pesan="Password lama salah.";
			}
			elseif($this->session->userdata('password')==$this->input->post('passb'))
			{
				$pesan="Password baru tidak boleh sama dengan password lama.";
			}
			elseif($this->input->post('passb')!=$this->input->post('passbr'))
			{
				$pesan="Ulangi password baru dengan benar.";
			}
			else
			{
				$this->db->where('id',$this->session->userdata('id'));
				if($this->db->update("pendaftaran_users",array(
					'password'			=>	$this->input->post('passb'),
					'passwordmd5'		=>	md5($this->input->post('passb')),
					'nama'				=>	$this->input->post('nama'),
					'last_updateakun'	=>	date("Y-m-d H:i:s")
					)))
				{
					$sukses=true;
					$this->session->set_userdata(array(
						'password'			=>	$this->input->post('passb'),
						'passwordmd5'		=>	md5($this->input->post('passb')),
						'nama'				=>	$this->input->post('nama'),
						'last_updateakun'	=>	date("Y-m-d H:i:s")
						));
				}
				else
				{
					$pesan_err='Gagal memperbaharui profile.';
				}
				
			}
			$respon['success']=$sukses;
			$respon['pesan_err']=$pesan;
			echo json_encode($respon);
		}
	}
}