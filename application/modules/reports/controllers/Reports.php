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
set_time_limit(120);
use Dompdf\Dompdf;
//use Dompdf\Css\Stylesheet;

class Reports extends Secure {

	function __construct() {
        parent::__construct();
       
    }

    function _remap($method, $params = array()) {
 
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
		$this->load->model('Report');
		
		$data['module'] = get_class();
		if ($this->input->is_ajax_request()) 
		{
			
			$this->load->view('manage', $data);
        } 
		else
		{
			$this->_init($data);
		}
	}
	
	function export($to, $type){
		$dompdf = new Dompdf();
		
		switch ($to) {
			case 'csv': //
				/*$this->load->dbutil();

				$query = $this->db->query("SELECT visit_date as Date, COUNT(status) as Visits FROM visits WHERE status = 0 AND license_key = $this->license_id");

				echo $this->dbutil->csv_from_result($query);
 */
                break;
            default: //pdf
				
				switch ($type) {
					case 'patients': //
						
						break;
					default: //visits
						$start_ts = date('Y-m-d', strtotime('-8 month', strtotime(date('Y-m-d'))));
						$end_ts = date('Y-m-d');
						$diff = abs(strtotime($end_ts) - strtotime($start_ts));
						$years = floor($diff / (365 * 60 * 60 * 24));
						$months = floor(($diff - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));

						$report = '';
						$report.='<table class="table" style="width:100%">';
							$report.='<thead>';
								$report.='<tr>';
									$report.='<th>Month</th>';
									$report.='<th>Visits</th>';
								$report.='</tr>';
							  $report.='</thead>';
						$report.='<tbody>';
						for($i = 0; $i < $months + 1; $i++){
							$report.="<tr>";
							$report.='<td>'. date('F', strtotime($start_ts . ' + ' . $i . 'month')).'</td>';
							$report.='<td>'. $this->Report->count_all(date('Y-m-d', strtotime($start_ts . ' + ' . $i . 'month')), $this->client_id).'</td>';
							$report.="</tr>";
							$i++; 
						} 
						$report.="</tbody></table>";
						$data['report'] = $report;
					break;
				}
				//
				$html = $this->load->view("ajax/reports/".$type, $data, true);
				
				
				$dompdf->loadHtml($html);

				// (Optional) Setup the paper size and orientation
				$dompdf->setPaper('A4', 'portrait');
				// Render the HTML as PDF
				$dompdf->render();

				// Output the generated PDF to Browser
				$dompdf->stream('report_'.$type);

				//$dompdf->output();*/
				
                break;
        }
	}
}
