<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pasien_api extends CI_Controller{
    
    public function __construct()
    {
        parent::__construct();
        if(! login_igd())
        {
            redirect(base_url().'igd/login');
        }
        $this->load->model('pasien/m_master');
        $this->load->model('pasien/m_function');
        // $this->load->model('register/m_core');
    }

    function get_infopasien()
    {
        if(! $this->input->is_ajax_request())
        {
            exit("No direct script access allowed.");
        }
        else
        {
            $data=$this->m_function->get_infopasien();
            echo json_encode($data->row_array());
        }
    }


    function get_databasepasien()
    {

        if(! $this->input->is_ajax_request())
        {
            exit("No direct script access allowed.");
        }
        else
        {
            $data=array();
            foreach ($this->m_function->get_databasepasien()->result() as $p)
            {
                $row=array();
                $row[]= $p->norec;
                $row[]= $p->nik;
                $row[]= $p->asuransi;
                $row[]= $p->nama;
                $row[]= $p->prov;
                $row[]= $p->kab;
                $row[]= $p->kec;
                $row[]= $p->desa;
                $row[]= '';
                
                $data[]=$row;
            }
            $respon=array(
                "draw"=>  $this->input->post('draw'),
                "recordsTotal"=>  $this->m_function->count_all_db_pasien(),
                "recordsFiltered"=>  $this->m_function->count_db_pasien_filtered(),
                "data"=>$data
            );
            echo json_encode($respon);
        }
       
    }

    function get_kab()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }
        else
        {
            $id_prov=  $this->input->post('id_provinsi');
            $data_kab=  $this->m_master->get_kab($id_prov);
            echo"<option value=''>-- Pilih --</option>";
            foreach ($data_kab->result() as $kab)
            {
                echo"<option value='".$kab->id_kota."'>".$kab->nama_kota."</option>";
            }
        }
    }

    function get_kec()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }
        else
        {
            $id_kab=  $this->input->post('id_kab');
            $data_kec=  $this->m_master->get_kec($id_kab);
            echo"<option value=''>-- Pilih --</option>";
            foreach ($data_kec->result() as $kec)
            {
                echo"<option value='".$kec->id_kecamatan."'>".$kec->nama_kecamatan."</option>";
            }
        }
    }
    
    //    fungsi ini dipanggil ketika pada halaman register dipilih kecamatan, fungsi ini memberikan
    //    respon berupa data html untuk ditampilkan pada combobox desa berdasarkan data kecamatan yang dipilih.
    //    === method POST
    //    === parameter dikirim id_kec;
    //    === respon dikirim berupa HTML
    function get_desa()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }
        else
        {
            $id_kec=  $this->input->post('id_kec');
            $data_desa=  $this->m_master->get_desa($id_kec);
            echo"<option value=''>-- Pilih --</option>";
            foreach ($data_desa->result() as $desa)
            {
                echo"<option value='".$desa->id_kelurahan."'>".$desa->nama_kelurahan."</option>";
            }
        }
    }


    //    proses data registrasi
    function void_register()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }
        else
        {
            $norek='';
            $data=array('success'=>false,'message'=>array(),'pesan_err'=>'');
            switch ($this->input->post('norek'))
            {
                case "":
                    $norek=  $this->create_norek();
                    break;

                case !"":
                    $norek=  $this->input->post('norek');
                    break;
            }
            // variabel data pasien 
            $data_pasien=array(
                'nomor_rekammedis'      =>$norek,
                'nomor_nik'             =>$this->input->post('nik'),
                'nomor_asuransi'        =>$this->input->post('noasuransi'),
                'nama_lengkap'          =>$this->input->post('nama'),
                'jenis_kelamin'         =>$this->input->post('jk'),
                'agama'                 =>$this->input->post('agama'),
                'tp_lahir'              =>$this->input->post('tp_lahir'),
                'tgl_lahir'             =>date("Y-m-d",strtotime($this->input->post('tgl_lahir'))),
                'alamat_ktp'            =>$this->input->post('alamatktp'),
                'kode_desa'             =>$this->input->post('desa_ktp'),
                'kode_kecamatan'        =>$this->input->post('kec_ktp'),
                'kode_kabupaten'        =>$this->input->post('kab_ktp'),
                'kode_provinsi'         =>$this->input->post('prov_ktp'),
                'kode_pendidikan'       =>$this->input->post('pdd'),
                'kode_pekerjaan'        =>$this->input->post('pkj'),
                'status_pasien'         =>$this->input->post('stt'),
                'email'                 =>$this->input->post('email'),
                'hp_pasien'             =>$this->input->post('nohp'),
                'keluarga'              =>$this->input->post('nama_k'),
                'hp_keluarga'           =>$this->input->post('nohp_k'),
                );

            // fungsi ini untuk mengload fungsli form validation
            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters("<p class='text-danger'>",'</p>');
            $this->form_validation->set_rules('norek','Nomor rekam medis','is_natural|callback_cek_norek_pasien',array(
                'is_natural'=>'%s harus angka.'
                ));
            $this->form_validation->set_rules('nik','Nomor nik ','trim|is_natural|callback_cek_ukuran_nik',array(
                'is_natural'=>'%s harus angka.'
                ));
            $this->form_validation->set_rules("noasuransi","Nomor asuransi",'trim|is_natural|callback_cek_asuransi',array('is_natural'=>'%s harus angka.'));
            $this->form_validation->set_rules('nama',"Nama lengkap",'required',array(
                'required'=>'%s harus diisi'
                ));
            $this->form_validation->set_rules('jk','Jenis kelamin','required',array('required'=>'%s harus dipilih.'));
            $this->form_validation->set_rules('agama','Agama','required',array('required'=>'%s harus dipilih.'));
            $this->form_validation->set_rules('tp_lahir','Tempat lahir','required',array('required'=>'%s input sesuai identitas.'));
            $this->form_validation->set_rules('tgl_lahir','Tgl lahir','required',array('required'=>'%s input sesuai identitas.'));
            $this->form_validation->set_rules('pdd','Pendidikan terakhir','required',array('required'=>'%s harus dipilih.'));
            $this->form_validation->set_rules('pkj','Pekerjaan','required',array('required'=>'%s harus dipilih'));
            $this->form_validation->set_rules('stt','Status perkawinan','required',array('required'=>'%s harus dipilih'));
            $this->form_validation->set_rules('alamatktp','Alamat','required',array('required'=>'%s wajib diisi sesuai identitas.'));
            $this->form_validation->set_rules('prov_ktp','Provinsi','required',array('required'=>'%s wajib pilih.'));
            $this->form_validation->set_rules('kab_ktp','Kabupaten','required',array('required'=>'%s wajib pilih.'));
            $this->form_validation->set_rules('kec_ktp','Kecamatan','required',array('required'=>'%s wajib pilih.'));
            $this->form_validation->set_rules('desa_ktp','Desa','required',array('required'=>'%s wajib pilih.'));

            if($this->form_validation->run())
            {
                if($this->m_function->submit_data($data_pasien))
                {
                    $data['success']=true;
                }
                else
                {
                    $err=  $this->db->error();
                    //gagal registrasi pasien
                    $data['pesan_err']="Data pasien gagal disimpan, mohon periksa kembali inputan anda. Pastikan semua data wajib sudah diisi.";
                }
            }
            else
            {
                foreach ($_POST as $key => $value) {
                    # code...
                    $data['message'][$key]=form_error($key);
                }
                $data['pesan_err']='periksa kembali data inputan anda, data yang dibutuhkan rekam medis belum lengkap';
            }
        }
        
       
        echo json_encode($data);
    }



    function create_norek()
    {
        $max=  $this->m_function->max_norek();
        return sprintf("%06d",$max['nomor_rekammedis']+1);

    }

    // cek validasi norek
    function cek_norek_pasien($norek)
    {
        if($norek!='')
        {
            if($this->m_function->cek_norek($norek)>0)
            {
                $this->form_validation->set_message('cek_norek_pasien','No. Medrec <b>'.$norek.'</b> sudah ada.');
                return false;
            }
            elseif(strlen($norek)<6 || strlen($norek)>6)
            {
                $this->form_validation->set_message('cek_norek_pasien','Panjang nomor rekam medis 6 digit.');
                return false;
            }
            else
            {
                return true;
            }
        }
        else
        {
            return true;
        }
    }
    // end

    function cek_asuransi($as)
    {
        if($as!='')
        {
            
            if($this->m_function->cek_asuransi($as)>0)
            {
                $this->form_validation->set_message("cek_asuransi","Nomor asuransi <b>".$as."</b> sudah ada.");
                return false;
            }
            else{
                return true;
            }
        }
        else
        {
            return true;
        }
    }

    function cek_ukuran_nik($nik)
    {
        if(strlen($nik)<16 && $nik!='')
        {
            $this->form_validation->set_message("cek_ukuran_nik","Nomor nik kurang dari 16 digit");
            return false;
        }
        elseif(strlen($nik) > 16 && $nik!='')
        {
            $this->form_validation->set_message("cek_ukuran_nik","Nomor nik lebih dari 16 digit");
            return false;
        }
        elseif($nik=='')
        {
            $this->form_validation->set_message("cek_ukuran_nik","Nomor nik wajib diisi.");
            return false;
        }
        elseif($this->m_function->cek_nik($this->input->post('nik'))>0)
        {
            $this->form_validation->set_message("cek_ukuran_nik","Nomor nik <b>".$nik."</b> sudah ada.");
            return false;
        }
        else
        {
            return true;
        }
    }


    //  proses update data pasien
    function void_update()
    {

        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }
        else
        {
            $norek='';
            $data=array('success'=>false,'message'=>array(),'pesan_err'=>'');
            switch ($this->input->post('norek'))
            {
                case "":
                    $norek=  $this->create_norek();
                    break;

                case !"":
                    $norek=  $this->input->post('norek');
                    break;
            }
            // variabel data pasien 
            $norek=  $this->input->post('id');
            $data_pasien=array(
                'nomor_rekammedis'      =>$norek,
                'nomor_nik'             =>$this->input->post('nik'),
                'nomor_asuransi'        =>$this->input->post('noasuransi'),
                'nama_lengkap'          =>$this->input->post('nama'),
                'jenis_kelamin'         =>$this->input->post('jk'),
                'agama'                 =>$this->input->post('agama'),
                'tp_lahir'              =>$this->input->post('tp_lahir'),
                'tgl_lahir'             =>date("Y-m-d",strtotime($this->input->post('tgl_lahir'))),
                'alamat_ktp'            =>$this->input->post('alamatktp'),
                'kode_desa'             =>$this->input->post('desa_ktp'),
                'kode_kecamatan'        =>$this->input->post('kec_ktp'),
                'kode_kabupaten'        =>$this->input->post('kab_ktp'),
                'kode_provinsi'         =>$this->input->post('prov_ktp'),
                'kode_pendidikan'       =>$this->input->post('pdd'),
                'kode_pekerjaan'        =>$this->input->post('pkj'),
                'status_pasien'         =>$this->input->post('stt'),
                'email'                 =>$this->input->post('email'),
                'hp_pasien'             =>$this->input->post('nohp'),
                'keluarga'              =>$this->input->post('nama_k'),
                'hp_keluarga'           =>$this->input->post('nohp_k'),
                );

            // fungsi ini untuk mengload fungsli form validation
            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters("<p class='text-danger'>",'</p>');
            
            $this->form_validation->set_rules('nik','Nomor nik ','trim|is_natural|callback_cek_ukuran_nik_f_update',array(
                'is_natural'=>'%s harus angka.'
                ));
            $this->form_validation->set_rules("noasuransi","Nomor asuransi",'trim|is_natural|callback_cek_asuransi_f_update',array('is_natural'=>'%s harus angka.'));
            $this->form_validation->set_rules('nama',"Nama lengkap",'required',array(
                'required'=>'%s harus diisi'
                ));
            $this->form_validation->set_rules('jk','Jenis kelamin','required',array('required'=>'%s harus dipilih.'));
            $this->form_validation->set_rules('agama','Agama','required',array('required'=>'%s harus dipilih.'));
            $this->form_validation->set_rules('tp_lahir','Tempat lahir','required',array('required'=>'%s input sesuai identitas.'));
            $this->form_validation->set_rules('tgl_lahir','Tgl lahir','required',array('required'=>'%s input sesuai identitas.'));
            $this->form_validation->set_rules('pdd','Pendidikan terakhir','required',array('required'=>'%s harus dipilih.'));
            $this->form_validation->set_rules('pkj','Pekerjaan','required',array('required'=>'%s harus dipilih'));
            $this->form_validation->set_rules('stt','Status perkawinan','required',array('required'=>'%s harus dipilih'));
            $this->form_validation->set_rules('alamatktp','Alamat','required',array('required'=>'%s wajib diisi sesuai identitas.'));
            $this->form_validation->set_rules('prov_ktp','Provinsi','required',array('required'=>'%s wajib pilih.'));
            $this->form_validation->set_rules('kab_ktp','Kabupaten','required',array('required'=>'%s wajib pilih.'));
            $this->form_validation->set_rules('kec_ktp','Kecamatan','required',array('required'=>'%s wajib pilih.'));
            $this->form_validation->set_rules('desa_ktp','Desa','required',array('required'=>'%s wajib pilih.'));

            if($this->form_validation->run())
            {
                if($this->m_function->submit_update_data($data_pasien,$this->input->post('id')))
                {
                    $data['success']=true;
                }
                else
                {
                    $err=  $this->db->error();
                    //gagal registrasi pasien
                    $data['pesan_err']="Data pasien gagal disimpan, mohon periksa kembali inputan anda. Pastikan semua data wajib sudah diisi.";
                }
            }
            else
            {
                foreach ($_POST as $key => $value) {
                    # code...
                    $data['message'][$key]=form_error($key);
                }
                $data['pesan_err']='periksa kembali data inputan anda, data yang dibutuhkan rekam medis belum lengkap';
            }
            echo json_encode($data);
        }
        
    
    }



    function cek_ukuran_nik_f_update($nik,$norek)
    {
        if(strlen($nik)<16 && $nik!='')
        {
            $this->form_validation->set_message("cek_ukuran_nik_f_update","Nomor nik kurang dari 16 digit");
            return false;
        }
        elseif(strlen($nik) > 16 && $nik!='')
        {
            $this->form_validation->set_message("cek_ukuran_nik_f_update","Nomor nik lebih dari 16 digit");
            return false;
        }
        elseif($nik=='')
        {
            $this->form_validation->set_message("cek_ukuran_nik_f_update","Nomor nik wajib diisi.");
            return false;
        }
        elseif($this->m_function->cek_nik_update($_POST['id'],  $this->input->post('nik'))->num_rows() > 0)
        {
            $this->form_validation->set_message("cek_ukuran_nik_f_update","Nomor nik <b>".$nik."</b> sudah ada.");
            return false;
        }
        else
        {
            return true;
        }
    }

    function cek_asuransi_f_update($as)
    {
        if($as!='')
        {
            
            if($this->m_function->cek_noasuransi_update($_POST['id'],$this->input->post('noasuransi'))->num_rows() > 0)
            {
                $this->form_validation->set_message("cek_asuransi_f_update","Nomor asuransi <b>".$as."</b> sudah ada.");
                return false;
            }
            else{
                return true;
            }
        }
        else
        {
            return true;
        }
    }

}