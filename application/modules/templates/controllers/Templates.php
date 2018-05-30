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
class Templates extends Secure 
{

	function __construct() 
	{
        parent::__construct();
        $this->load->model('Template');
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
		$data['module'] = 'Templates';
		if ($this->is_ajax) 
		{
			
			$this->load->view('manage', $data);
        } 
		else
		{
			$this->_init($data);
			
		}
	}
	
	function load_ajax() 
	{
	
		if ($this->is_ajax) 
		{	
			$this->load->library('datatables');
	       
	        $this->datatables->select("temp_id as id, temp_name as name, temp_type as type, temp_status as status, temp_created as created, client_id", false);
	        
			$this->datatables->where('client_id', $this->client_id);
	        
	        $this->datatables->from('templates');

	        echo $this->datatables->generate('json', 'UTF-8');
    	}
    	else
    	{
	    	$this->session->set_flashdata('alert_error', 'Sorry! Page cannot open by new tab');
            redirect('');
	    }
    }
	
	function view($id = -1)
	{

        if ($this->is_ajax) 
		{
			
			$data['info'] = $this->Template->get_info($id);
			
			$templates = array('' => 'Select');
			
			foreach ($this->Template->get_all($this->client_id)->result_array() as $row) 
			{
				$templates[$row['temp_id']] = $row['temp_name'];
			}

			$data['templates'] = $templates;
			
	        $this->load->view("form", $data);
	    }
	    else
	    {
	    	$this->session->set_flashdata('alert_error', 'Sorry! Page cannot open by new tab');
            redirect('');
	    }
    }
	
	function preset($id = 0)
	{
		if ($id) 
		{

            $preset = $this->Template->load($id);

            echo html_entity_decode(html_entity_decode($preset->temp_content));
        } 
        else 
        {
            echo '';
        }
	}
	function doSave($id = -1)
	{
		
		$template_data = array(
			'temp_name'			=>$this->input->post('name'),
			'temp_content'		=>$this->input->post('content'),
			'temp_type'			=>$this->input->post('types'),
			'temp_status'		=>1,//$this->input->post('status') ? 1 : 0,
			'client_id'			=>$this->client_id
		);
		
		if($this->Template->save($template_data, $id))
		{
			if($id==-1)
			{
				echo json_encode(array('success'=>true,'message'=>$template_data['temp_name']));
			}
			else 
			{
				echo json_encode(array('success'=>true,'message'=>$template_data['temp_name']));
			}
		}
		else//failure
		{	
			echo json_encode(array('success'=>false,'message'=>$template_data['temp_name']));
		}
			
	}
	
	function details($id = -1)
	{
    	if ($this->is_ajax) 
		{
	    	$data['info'] = $this->Template->get_info($id);
	        $this->load->view("detail", $data);
	    }
	    else
	    {
	    	$this->session->set_flashdata('alert_error', 'Sorry! Page cannot open by new tab');
            redirect('');
	    }
    }
	
    function delete($id)
    {

    	if ($res = $this->Template->delete($id)) {
			echo json_encode(array('success' => true, 'message' => 'Template successfully deletd!'));
		} 
		else 
		{
			echo json_encode(array('success' => false, 'message' => $res ));
		}

    }

}