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

class Form_Validation_Model extends MY_Model {
    
    public function __construct()
    {
       parent::__construct();

        $this->load->library('form_validation');
        // $this->form_validation->CI =& $this;
    }
    
}
 /* End of file: Form_Validation_Model.php */
 /* Location: ./application/core/Form_Validation_Model.php */