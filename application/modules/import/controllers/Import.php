<?php
require_once APPPATH. 'modules/secure/controllers/Secure.php';

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

class Import extends Secure {
	
	public function __construct()
	{
		parent::__construct();
        $this->load->model('import/Import_mdl');
        $this->load->model('auth/Users');
	}
	
	function _remap($method, $params = array()) {
 
        if (method_exists($this, $method)) 
        {
            return call_user_func_array(array($this, $method), $params);
        }

        $this->display_error_log(getcwd(), get_class($this), $method);
    }

	function index()
	{
		$this->layout->title('Import');
		$data['module'] = 'Import';

		if ($this->is_ajax) 
		{
			
			$this->load->view('manage', $data);
        } 
		else
		{
			$this->_set_layout($data);
			$this->layout->build('manage', $data);
			
		}
	}

	function load_ajax() {
	
		if ($this->is_ajax) 
		{	
			$this->load->library('datatables');
	       
	        $this->datatables->select("import_id as id, filename, created, success_count, failed_count, total_records as total", false);
	        
			$this->datatables->where('client_id', $this->client_id);
	        
	        $this->datatables->from('import');

	        echo $this->datatables->generate('json', 'UTF-8');
	        
    	}else{

	    	$this->session->set_flashdata('alert_error', 'Sorry! Page cannot open by new tab');
            redirect(strtolower(get_class()));
	    }
    }

	function view() {
        $data = array();

        $data['title'] = 'Patient';
        $data['notes'] = '<br /><b>Instructions for import the patients</b><br /> 
                                <b>Add new patient</b><br />
                                <ul><li>To add new patient keep column (Login E-mail) as blank and enter rest of information.</li>
                                </ul>
                                <i>
							After changing the fields save the file and import the file.</i>';
        $data['template_path'] = 'export-data/export-vendors';
        
        $data['upload_path'] = 'import_data/import_csv';
      
        $this->load->view('form', $data);
    }
	
	public function import_csv() {
		$this->load->model('patients/Patient');
		
        $msg = 'do_excel_import';

        $failCodes = array();
        $successCounts = array();
        $totalRecord = 0;
        $blankRow = 0;
        $import_data = array();
 
        $ext = explode("/", $_FILES['file_path']['type']);
        $type = strtolower(str_replace("\"", "", $ext[1]));
 
        if ($_FILES['file_path']['error'] != UPLOAD_ERR_OK) {
            
            $msg = 'Import file failed';

        } else {

            $config['upload_path'] = FCPATH . '/uploads/'.$this->client_id.'/imported-file/';
            $config['file_name'] = random_string('numeric', 5) . '_' . date('YmdHis', time()) . $_FILES['file_path']['name'];
            $config['allowed_types'] = 'csv|comma-separated-values|vnd.ms-excel';
            $this->load->library('upload', $config);
            
            //check directory if exists
			if(!is_dir($config['upload_path']))
			{
				//create if not
				mkdir($config['upload_path'], 0755, TRUE);
            }
            
            if ($this->upload->do_upload('file_path'))
			{
                $import_data['filename'] = $config['file_name'];
    
                if (($handle = fopen($_FILES['file_path']['tmp_name'], "r")) !== FALSE) {

                    $is_header_removed = FALSE;
                    $i = 0;
                    while (($data = fgetcsv($handle)) !== FALSE) {

                        if($i > 0) {

                            $import_data['module'] = "Patients";
                            if ($this->_checkBlankRow($data) == 0) {
                                $blankRow++;
                                continue;
                            }

                            $all_data = $this->_set_data($data);

                            $user_data = $all_data['user_data'];
                            $profile_data = $all_data['profile_data'];
                            $custom_data = $all_data['custom_data'];
                            
                            // don't duplicate people with same email
                            $id = -1;

                            // if ($this->Users->_get_user_by_email($data[1])->num_rows() > 0) {
                            //     $failCodes[] = $i;
                            //     $totalRecord++;
                                // $id = $this->Users->_get_user_by_email($data[1])->row('id');
    
                            //     continue;
                            // }
                    
                            if(!$this->Patient->save($user_data, $profile_data, $custom_data, $id)) {
                                $failCodes[] = $i;
                                $totalRecord++;
                            } else {
                                $successCounts[] = $i;
                                $totalRecord++;
                            }

                        }
                        $i++;
                    }
                    fclose($handle);
    
                    $import_data['created'] = date("Y-m-d H:i:s");
                    $import_data['client_id'] = $this->client_id;
                }
            }else{
                $success  = false;
                $msg = $this->upload->display_errors();
            }
        }
        
        $import_data['success_count'] = count($successCounts);
        $import_data['failed_count'] = count($failCodes);
        $import_data['total_records'] = $totalRecord;
 
        $success = true;

        if (count($failCodes) > 1) {
            $msg = "Most tasks imported. But some were not, here is list of their CODE (" . count($failCodes) . "): " . implode(", ", $failCodes);
            $success = false;
        } else {
        	
            $this->Import_mdl->insert($import_data);
            $msg = "Successfully tasks imported.";
        }
 
        echo json_encode(array('success' => $success, 'message' => $msg));
    }

    private function _checkBlankRow($data) {
        $str = implode(",", $data);
        $str = trim(str_replace(",", "", $str));
        return strlen($str);
    }

    private function _set_data($data) {
 
        return array(
            'user_data' => array(
                'username'      =>$data[0],        
				'email'         =>$data[1],
				'password'      =>$data[2],
				'client_id'		=>$this->client_id,
				'role_id'		=>$this->patient_role_id,
				'last_ip'       =>$this->input->ip_address(),
				'created'       =>$data[3],
				'token'			=>$data[4]
            ),
            'profile_data' => array(
                'firstname' 	=> $data[5],
                'mi' 			=> $data[6],
                'lastname' 		=> $data[7],
                'bMonth' 		=> $data[8],
                'bDay' 			=> $data[9],
                'bYear' 		=> $data[10],
                'gender' 		=> $data[11],
                'address' 		=> $data[12],
                'country' 		=> $data[13],
                'city' 			=> $data[14],
                'state' 		=> $data[15],
                'zip' 			=> $data[16],
                'mobile' 		=> $data[17]
            ),
            'custom_data' => array()
        );
    }

    function delete($id)
	{

    	if ($res = $this->Import_mdl->delete($id)) 
    	{
			echo json_encode(array('success' => true, 'message' => 'Import file successfully deleted!'));
		} 
		else 
		{
			echo json_encode(array('success' => false, 'message' => $res ));
		}

    }

}
/* End of file import.php */
/* Location: ./application/modules/import/controllers/import.php */