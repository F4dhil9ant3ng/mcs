<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 * MyClinicSoft
 * 
 * A web based clinical system
 *
 * @package		MyClinicSoft
 * @author		Randy Rebucas
 * @copyright	Copyright (c) 2016 - 2018 MyClinicSoft, LLC
 * @license		http://www.myclinicsoft.com/license.txt
 * @link		http://www.myclinicsoft.com
 * 
 */

class Response_Model extends MY_Model {
	
	public function save($id = NULL, $db_array = NULL)
	{
		if ($id)
		{
			$this->session->set_flashdata('alert_success', lang('record_successfully_updated'));
			parent::save($id, $db_array);
		}
		else
		{
			$this->session->set_flashdata('alert_success', lang('record_successfully_created'));
			$id = parent::save(NULL, $db_array);
		}
		
		return $id;
	}
	
	public function delete($id)
	{
		parent::delete($id);
		
		$this->session->set_flashdata('alert_success', lang('record_successfully_deleted'));
	}
	
}
 /* End of file: Response_Model.php */
 /* Location: ./application/core/Response_Model.php */