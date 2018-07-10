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

class Base_Controller extends MX_Controller {

    public $ajax_controller = false;

    public function __construct()
    {
        parent::__construct();

        $this->config->load('myclinicsoft');

        // Don't allow non-ajax requests to ajax controllers
        if ($this->ajax_controller and !$this->input->is_ajax_request())
        {
            exit;
        }

        $this->load->library('session');
        $this->load->helper('url');

        $this->load->database();
        $this->load->library('form_validation');
        $this->load->helper('number');
        $this->load->helper('pager');
        $this->load->helper('invoice');
        $this->load->helper('date');
        $this->load->helper('redirect');
        $this->load->helper('encode');

        // Load setting model and load settings
        $this->load->model('settings/Setting');
        $this->Setting->load_settings();

        $this->lang->load('mcs', $this->Setting->setting('default_language'));

        $this->load->helper('language');

        $this->load->module('layout');

        
    }

}
 /* End of file: Base_Controller.php */
 /* Location: ./application/core/Base_Controller.php */