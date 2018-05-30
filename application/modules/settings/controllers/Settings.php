<?php
require_once APPPATH. 'modules/secure/controllers/Secure.php';
/*
 * MyClinicSoft
 * 
 * A web based clinical system
 *
 * @package     MyClinicSoft
 * @author      Randy Rebucas
 * @copyright   Copyright (c) 2016 - 2018 MyClinicSoft, LLC
 * @license     http://www.myclinicsoft.com/license.txt
 * @link        http://www.myclinicsoft.com
 * 
 */
class Settings extends Secure 
{

	function __construct() 
	{
        parent::__construct();

        $this->load->library('location_lib');

        $this->load->language('setting', 'english');
        $this->load->language('common/common', 'english');
    }

    function _remap($method, $params = array()) 
    {
 
        if (method_exists($this, $method)) {
            return call_user_func_array(array($this, $method), $params);
        }

        $directory = getcwd();
        $class_name = get_class($this);
        $this->display_error_log($directory,$class_name,$method);
    }

    private function _init($data)
	{

		$this->layout
			->title(get_class($this)) 
			->set_partial('header', 'include/header') 
			->set_partial('sidebar', 'include/sidebar') 
			->set_partial('ribbon', 'include/ribbon', $data) 
			->set_partial('footer', 'include/footer') 
			->set_partial('shortcut', 'include/shortcut') 
			->set_metadata('author', 'Randy Rebucas')
			->set_layout('full-column') 
			->build('manage', $data); 
		
	}

	function index()
	{
		$this->load->model('templates/Template');

		$data['module'] = get_class($this); 
		
		if ($this->input->is_ajax_request()) 
		{
			$this->load->view('manage', $data);
        } 
		else
		{
			$this->_init($data);
		}
	}

	function general_update(){

		$batch_save_data=array(
			'business_name'=>$this->input->post('business_name'),
			'business_owner'=>$this->input->post('business_owner'),
			'business_address'=>$this->input->post('business_address'),
			'business_phone'=>$this->input->post('business_phone'),
			'business_email'=>$this->input->post('business_email'),
			'business_fax'=>$this->input->post('business_fax'),
			'language'=>$this->input->post('language'),
			'timezone'=>$this->input->post('timezone'),
			'default_country'		=>$this->input->post('default_country'),
			'default_state'		=>$this->input->post('default_state'),
			'default_city'		=>$this->input->post('default_city'),
			'prc'=>$this->input->post('prc'),
			'ptr'=>$this->input->post('ptr'),
			's2'=>$this->input->post('s2'),
			'morning_open_time'=>$this->input->post('morning_open_time'),
			'morning_close_time'=>$this->input->post('morning_close_time'),
			'afternoon_open_time'=>$this->input->post('afternoon_open_time'),
			'afternoon_close_time'=>$this->input->post('afternoon_close_time'),
			'week_end_open_time'=>$this->input->post('week_end_open_time'),
			'week_end_close_time'=>$this->input->post('week_end_close_time')
		);

		$config['upload_path'] = FCPATH . '/uploads/'.$this->client_id.'/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size'] = '9999';
		$config['max_width'] = '9999';
		$config['max_height'] = '9999';
		$config['encrypt_name'] = TRUE;
				
		$this->load->library('upload', $config);
		
		//check directory if exists
		if(!is_dir($config['upload_path']))
		{
			//create if not
			mkdir($config['upload_path'], 0755, TRUE);
		}

		if ($this->upload->do_upload('logo'))
		{
			
			$upload_data = $this->upload->data();
			
			if (!empty($upload_data['orig_name']))
			{
				
				$batch_save_data['company_logo'] = $upload_data['raw_name'] . $upload_data['file_ext'];
				
			}
		
		}
		
		if($this->Setting->batch_save($batch_save_data )){

			echo json_encode(array('success'=>true,'message'=>$this->lang->line('setting_saved_successfully')));

		}else{

			echo json_encode(array('success'=>false,'message'=>'error'));
		}

	}

	function my_profile($enc_id)
	{
		
		$id = url_base64_decode($enc_id);

		$data['module'] = $this->lang->line('common_my_profile');

		if ($this->input->is_ajax_request()) 
		{
			$this->load->model('user/User_model');
			
			$data['info'] = $this->User_model->get_profile_info($id);
			$this->load->view('user/profile', $data);
        } 
		else
		{
			$this->_init($data);
		}
	}
	
	function encryptID($user_id)
	{

		redirect('my-profile/'.url_base64_encode($user_id));

	}
}
