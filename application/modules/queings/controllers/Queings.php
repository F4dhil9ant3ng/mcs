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
use Dompdf\Dompdf;
use Dompdf\Options;

class Queings extends Secure 
{
	
    function __construct() 
    {
        parent::__construct();

        $this->load->model('Queing');
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
	
	function index()
	{
		$this->output->set_template('minimal');	
		
		$this->output->set_common_meta(get_class(), 'description', 'keyword');
		$this->output->set_meta('author','Randy Rebucas');
		$data['module'] = get_class();
		$this->load->view('list', $data);
        
	}
	
	function move_in($id)
	{

		$this->load->model('patients/Patient');

		$info = $this->Patient->get_profile_info($id);
	
		$data = array(
			'que_id'  		=> $this->Queing->last_row($this->client_id)->que_id + 1, //unique id
			'que_date'		=> date('Y-m-d'),
			'que_license' 	=> $this->client_id,
			'que_patient_id'    	=> $info->id, //id of patient
			'que_name'    	=> $info->firstname.', '.$info->lastname //name of patient
		);

		if($this->Queing->save($data))
		{
			echo json_encode(array('success' => true, 'message' => 'Patient successfully move to wating list!'));
		} 
		else 
		{
			echo json_encode(array('success' => false, 'message' => 'Patient cannot be move to wating list!'));
		}
		
	}
	
	function move_out($rowid, $status) 
	{ 

        if($this->Queing->delete($rowid, $status, $this->client_id))
        {
			echo json_encode(array('success' => true, 'message' => 'Patient successfully remove in wating list!'));
		} 
		else 
		{
			echo json_encode(array('success' => false, 'message' => 'Patient cannot be remove in wating list!'));
		}
	}
	
	function clear_all()
	{
		
		if($this->Queing->delete_list($this->client_id))
		{
			echo json_encode(array('success' => true, 'message' => 'Cleaning wating list done!'));
		} 
		else 
		{
			echo json_encode(array('success' => false, 'message' => 'Encounter error in cleaning!'));
		}
	}
	
	function preview($id, $mainteinable = false)
	{
		
		$this->load->library('location_lib');

		$this->load->model('patients/Patient');
		$this->load->model('records/Record');
		$this->load->model('records/Custom');
		$this->load->model('templates/Template');

		$info = $this->Patient->get_profile_info($id);
		
		$next_visit = $this->Custom->get_record('next_visit_'.$this->client_id, $info->id, false, date('Y-m-d'));

		$age = (date("md", date("U", mktime(0, 0, 0, $info->bMonth, $info->bDay, $info->bYear))) > date("md")
				? ((date("Y") - $info->bYear) - 1)
				: (date("Y") - $info->bYear));				
	    
		if($info->gender == 1){
			$gender = 'Male';
		}elseif($info->gender == 2){
			$gender = 'Female';
		}else{
			$gender = 'Undefine';
		}

		$i = 1;
		$prescriptions = '';
	    $prescriptions.='<table id="rx-contents" width="100%"><tbody>';
		foreach ($this->Custom->get_record('prescription', $id, false, date('Y-m-d')) as $row) {
			$prescriptions.="<tr>";
			$prescriptions.='<td style="font-size: 20px; vertical-align: top; width:10%; padding-bottom: 5px;"><strong>'. $i .'</strong></td>';
			$prescriptions.='<td style="font-size: 20px; vertical-align: top; width:75%; padding-bottom: 5px;"><strong>' .  $row['medicine'].' '.$row['preparation']. '</strong><br> ';
			$prescriptions.='<span style="font-weight: normal;font-size: 18px;font-style: italic;padding-left: 30px; padding-bottom: 5px;">Sig: '.$row['sig'].'</span></td>';
			$prescriptions.='<td style="font-size: 20px; vertical-align: top; width:15%; text-align: right; padding-bottom: 5px;"><strong># ' . $row['qty'] . '</strong></td>';
			$prescriptions.="</tr>";
		$i++; 
		} 
		$prescriptions.="</tbody></table>";

		//get default rxpad template
		//rx_template
		
		$tx_template = ($this->config->item('rx_template') != '') ? $this->Template->get_info($this->config->item('rx_template'))->temp_content : $this->Template->get_info(1)->temp_content;

		//Replace variables from the Templates
        $html_ = str_replace(
			array(
				//patient details
				"{{patient_id}}",
				"{{patient_name}}", 
				"{{patient_gender}}", 
				"{{patient_birthday}}",
				"{{patient_age}}", 
				"{{patient_address}}", 
				"{{patient_country}}",
				"{{patient_city}}",
				"{{patient_state}}",
				"{{patient_zip}}",
				"{{patient_mobile}}",
				//preserve details				
				"{{consultation_date}}", 
				"{{next_visit}}",
				"{{prescriptions}}",
				//configuration details
				"{{business_name}}", 
				"{{business_owner}}", 
				"{{business_address}}", 
				"{{business_phone}}", 
				"{{business_email}}", 
				"{{business_fax}}", 
				"{{prc}}", 
				"{{ptr}}", 
				"{{s2}}",
				"{{business_morning_open_time}}", 
				"{{business_morning_close_time}}", 
				"{{business_afternoon_open_time}}", 
				"{{business_afternoon_close_time}}", 
				"{{business_weekend_open_time}}", 
				"{{business_weekend_close_time}}"
			), 
			array(
				//patient details
				$info->id,
				$info->lastname.' '.$info->firstname, 
				$gender, 
				$info->bYear. '-' .$info->bMonth. '-' .$info->bDay,
				$age, 
				($info->address) ? $info->address : '--',
				($info->country) ? $this->location_lib->info('countries', $info->country)->name : '--',	// $this->location_lib->get_info($info->country)->name : '--',				
				($info->city) ? $this->location_lib->info('cities', $info->city)->name : '--',	// $this->location_lib->get_info($info->city)->name : '--', 
				($info->state) ? $this->location_lib->info('states', $info->state)->name : '--',	// $this->location_lib->get_info($info->state)->name : '--', 
				($info->zip) ? $info->zip : '--',
				($info->mobile) ? $info->mobile : '--',
				//preserve details
				date('m/d/Y'),
				(count($next_visit) > 0) ? date('m/d/Y', strtotime($next_visit[0]['next_visit'])) : '--',
				$prescriptions,
				//configuration details
				($this->config->item('business_name')) ? $this->config->item('business_name') : '--',
				($this->config->item('business_owner')) ? $this->config->item('business_owner') : '--', 
				($this->config->item('business_address')) ? $this->config->item('business_address') : '--',
				($this->config->item('business_phone')) ? $this->config->item('business_phone') : '--',
				($this->config->item('business_email')) ? $this->config->item('business_email') : '--',
				($this->config->item('business_fax')) ? $this->config->item('business_fax') : '--',
				($this->config->item('prc')) ? $this->config->item('prc') : '--', 
				($this->config->item('ptr')) ? $this->config->item('ptr') : '--', 
				($this->config->item('s2')) ? $this->config->item('s2') : '--',
				($this->config->item('morning_open_time')) ? $this->config->item('morning_open_time') : '--',
				($this->config->item('morning_close_time')) ? $this->config->item('morning_close_time') : '--',
				($this->config->item('afternoon_open_time')) ? $this->config->item('afternoon_open_time') : '--',
				($this->config->item('afternoon_close_time')) ? $this->config->item('afternoon_close_time') : '--',
				($this->config->item('week_end_open_time')) ? $this->config->item('week_end_open_time') : '--',
				($this->config->item('week_end_close_time')) ? $this->config->item('week_end_close_time') : '--'
			), $tx_template
        );
        //End 

        $data['pdf_html'] = html_entity_decode(html_entity_decode($html_));
		$this->load->view("ajax/rxpad", $data);

    }
	
	function get_in()
	{
		
		$this->load->view('manage');

	}
	
	function get_list()
	{
		
		$this->load->view('list');

	}
	
	function get_counts()
	{
		$counts = 0;
		$counts = $this->Queing->count_all($this->client_id);
		echo json_encode(array('counts' => $counts));
	}
}