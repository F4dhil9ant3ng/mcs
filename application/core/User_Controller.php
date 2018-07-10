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

class User_Controller extends Base_Controller {

	public function __construct($required_key, $required_val)
	{
		parent::__construct();

		if ($this->session->userdata($required_key) <> $required_val)
		{
			redirect('sessions/login');
		}
	}

}
 /* End of file: User_Controller.php */
 /* Location: ./application/core/User_Controller.php */
