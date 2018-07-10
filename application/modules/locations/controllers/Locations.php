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
class Locations extends Secure
{

    function __construct() 
    {
        parent::__construct();
        $this->load->library('location_lib');
    }

    function _remap($method, $params = array()) 
    {
        if (method_exists($this, $method)) {
            return call_user_func_array(array($this, $method), $params);
        }
        $directory = getcwd();
        $class_name = get_class($this);
        $this->display_error_log($directory, $class_name, $method);
    }

    public function index() 
    {

    }

    function get_location_type() 
    {
        $id = $this->input->post('id', TRUE);
        $location_type = $this->input->post('type', TRUE);

        $location_types = $this->location_lib->get_types($location_type, $id);

        $output = null;

        foreach ($location_types->result() as $row) 
        {
            $output .= "<option value='" . $row->location_id . "'>" . $row->name . "</option>";
        }

        echo $output;
    }

    function get_locations($type) 
    {
        $id = $this->input->post('id', TRUE);
        $selected_id = $this->input->post('selected_id', TRUE);
        $location_type = $this->input->post('location_type', TRUE);
        $location_types = $this->location_lib->get_types($location_type, $id);
        echo json_encode($location_types->result());
    }
	
	
	
	function populate_state()
    {
		echo json_encode($this->location_lib->populate_states($this->input->post('id'))->result());
	}
	
	function populate_citie()
    {
		echo json_encode($this->location_lib->populate_cities($this->input->post('id'))->result());
	}
	
	
	
	
}
