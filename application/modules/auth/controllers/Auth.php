<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends MX_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('auth/users');
		// modules::run('login/is_logged_in');
		$this->load->language('auth/tank_auth');
		$this->load->library('auth/tank_auth');
	}

	function index()
	{
		if ($message = $this->session->flashdata('message')) {
			$this->load->view('auth/general_message', array('message' => $message));
		} else {
			redirect('/auth/login/');
			// modules::run('auth/login');
		}
	}

	/**
	* Login user on the site
	*
	* @return void
	*/
	function login()
	{
		if ($this->tank_auth->is_logged_in()) {									// logged in
			redirect('dashboard');

		} elseif ($this->tank_auth->is_logged_in(FALSE)) {						// logged in, not activated
			redirect('/auth/send_again/');

		} else {
			$data = [];
			$this->layout
			->title('Login') //$article->title
			->prepend_metadata('<script src="/js/jquery.js"></script>')
			->append_metadata('<script src="/js/jquery.flot.js"></script>')
			// application/views/some_folder/header
			//->set_partial('header', 'includes/widgets') //third param optional $data
			// application/views/some_folder/header
			//->inject_partial('header', '<h1>Hello World!</h1>')  //third param optional $data
			->set_layout('empty') // application/views/layouts/two_col.php
			->build('login_form', $data); // views/welcome_message
		}
	}
	
	function doLogin(){
		$this->load->library('auth/tank_auth');
		
							// validation ok
		if ($this->tank_auth->login(
				$this->input->post('login'),
				$this->input->post('password'),
				$this->input->post('remember') ? 1 : 0)) {								// success
			echo json_encode(array('success' => true, 'message' => 'Loged In Successfully! Redirecting .....'));
			///exit();
		} else {
			$data['error'] = array();  
			$errors = $this->tank_auth->get_error_message();
			                                                   // fail
			foreach ($errors as $k => $v) {
				$data['error'][$k] = $this->lang->line($v);
			}
		
			echo json_encode(array('success' => false, 'message' => $data['error']));
			//exit();
		}
	}
	
	
	/**
	 * Logout user
	 *
	 * @return void
	 */
	function logout()
	{
		$this->users->update_visibility($this->tank_auth->get_user_id(), 0);
		
		$this->tank_auth->logout();

		$this->_show_message($this->lang->line('auth_message_logged_out'));
	}

	/**
	 * Register user on the site
	 *
	 * @return void
	 */
	function register()
	{
	
		if ($this->tank_auth->is_logged_in()) {									// logged in
			redirect('dashboard');

		} elseif ($this->tank_auth->is_logged_in(FALSE)) {						// logged in, not activated
			redirect('/auth/send_again/');

		} else {
			
			$data[] = '';


			$this->layout
			->title('Register') //$article->title
			// application/views/some_folder/header
			//->set_partial('header', 'includes/widgets') //third param optional $data
			// application/views/some_folder/header
			//->inject_partial('header', '<h1>Hello World!</h1>')  //third param optional $data
			->set_layout('empty') // application/views/layouts/two_col.php
			->build('register_form', $data); // views/welcome_message
		}
	}
	
	function doRegister() {

		$data['errors'] = array();

		$email_activation = $this->config->item('email_activation', 'tank_auth');
				
		if (!is_null($data = $this->tank_auth->create_user(
				$this->input->post('client_business_name'),
				$this->input->post('client_fullname'),
				$this->input->post('client_address'),
				$this->input->post('username'),
				$this->input->post('email'),
				$this->input->post('password'),
				$email_activation))) {									// success

			$data['site_name'] = $this->config->item('website_name', 'tank_auth');

			if ($email_activation) {									// send "activate" email
				$data['activation_period'] = $this->config->item('email_activation_expire', 'tank_auth') / 3600;

				$this->_send_email('activate', $data['email'], $data);

				unset($data['password']); // Clear password (just for any case)

				echo json_encode(array('success' => true, 'message' => $this->lang->line('auth_message_registration_completed_1')));
				exit();
			} else {
				if ($this->config->item('email_account_details', 'tank_auth')) {	// send "welcome" email

					$this->_send_email('welcome', $data['email'], $data);
					//notification to admin
					
				}
				unset($data['password']); // Clear password (just for any case)

				echo json_encode(array('success' => true, 'message' => $this->lang->line('auth_message_registration_completed_2')));
				exit();
			}

			$this->_send_email('mcs_registration', $this->config->item('dev_email'), $data);
		} else {
			
			$errors = $this->tank_auth->get_error_message();
			foreach ($errors as $k => $v)	$data['errors'][$k] = $this->lang->line($v);
			
			echo json_encode(array('success' => false, 'message' => $data['errors']));
			exit();
		}
		

	}

	/**
	 * Delete user from the site (only when user is logged in)
	 *
	 * @return void
	 */
	function delete()
	{
		if (!$this->tank_auth->is_logged_in()) 
		{								// not logged in or not activated
			redirect('/auth/login/');

		} 
		else 
		{

			$confirm_password = $this->input->post('confirm_pass');				//get confirmation password
			$recent_password = $this->input->post('recent_pass');				//get recent password

			if ($this->tank_auth->check_password($confirm_password, $recent_password)) //check if password is coorect
			{
				if ($this->tank_auth->delete_user($confirm_password)) {			// success
					echo json_encode(array('success' => true, 'message' => $this->lang->line('auth_message_unregistered')));
					exit();
				} 
				else 
				{														// fail
					echo json_encode(array('success' => false, 'message' => 'Sorry!We cannot delete your account.'));
					exit();
				}
			} 
			else 
			{
				echo json_encode(array('success' => false, 'message' => 'Password is incorrect'));
				exit();
			}

		}
	}

	function checkexistemail() {

        $email = $this->input->post('email');

		if (!$this->tank_auth->is_email_available($email))
		{
            echo(json_encode(false));
            exit();
        } else {
            echo(json_encode(true));
            exit();
        }
        
    }

    function checkexistusername() {

        $username = $this->input->post('username');

		if (!$this->tank_auth->is_username_available($username))
		{
            echo(json_encode(false));
            exit();
        } else {
            echo(json_encode(true));
            exit();
        }
        
    }

    function checkexistbusiness() {

        $business = $this->input->post('client_business_name');

		if (!$this->tank_auth->is_business_available($business))
		{
            echo(json_encode(false));
            exit();
        } else {
            echo(json_encode(true));
            exit();
        }
        
    }
	/**
	 * Send activation email again, to the same or new email address
	 *
	 * @return void
	 */
	function send_again()
	{
		if (!$this->tank_auth->is_logged_in(FALSE)) {							// not logged in or activated
			redirect('/auth/login/');

		} else {
			$this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean|valid_email');

			$data['errors'] = array();

			if ($this->form_validation->run()) {								// validation ok
				if (!is_null($data = $this->tank_auth->change_email(
						$this->form_validation->set_value('email')))) {			// success

					$data['site_name']	= $this->config->item('website_name', 'tank_auth');
					$data['activation_period'] = $this->config->item('email_activation_expire', 'tank_auth') / 3600;

					$this->_send_email('activate', $data['email'], $data);

					//$this->_show_message(sprintf($this->lang->line('auth_message_activation_email_sent'), $data['email']));
					echo json_encode(array('success' => true, 'message' => $this->lang->line('auth_message_activation_email_sent')));
					exit();
				} else {
					$errors = $this->tank_auth->get_error_message();
					foreach ($errors as $k => $v)	$data['errors'][$k] = $this->lang->line($v);
					echo json_encode(array('success' => false, 'message' => $data['errors'][$k]));
					exit();
				}
			}

			$this->layout
			->title('Login') //$article->title
			->prepend_metadata('<script src="/js/jquery.js"></script>')
			->append_metadata('<script src="/js/jquery.flot.js"></script>')
			// application/views/some_folder/header
			//->set_partial('header', 'includes/widgets') //third param optional $data
			// application/views/some_folder/header
			//->inject_partial('header', '<h1>Hello World!</h1>')  //third param optional $data
			->set_layout('empty') // application/views/layouts/two_col.php
			->build('send_again_form', $data); // views/welcome_message
		}
	}

	/**
	 * Activate user account.
	 * User is verified by user_id and authentication code in the URL.
	 * Can be called by clicking on link in mail.
	 *
	 * @return void
	 */
	function activate()
	{
		$user_id		= $this->uri->segment(3);
		$new_email_key	= $this->uri->segment(4);

		// Activate user
		if ($this->tank_auth->activate_user($user_id, $new_email_key)) {		// success
			$this->tank_auth->logout();
			$this->_show_message($this->lang->line('auth_message_activation_completed').' '.anchor('/auth/login/', 'Login'));

		} else {																// fail
			$this->_show_message($this->lang->line('auth_message_activation_failed'));
		}
	}

	/**
	 * Generate reset code (to change password) and send it to user
	 *
	 * @return void
	 */
	function forgot_password()
	{
		if ($this->tank_auth->is_logged_in()) {									// logged in
			redirect('');

		} elseif ($this->tank_auth->is_logged_in(FALSE)) {						// logged in, not activated
			redirect('/auth/send_again/');

		} else {

			$data['option'] = 'register';
			$this->output->set_template('auth');
			$this->output->set_common_meta('Forgot Password', 'description', 'keyword');
			$this->load->section('auth', 'include/auth', $data);
			$this->load->view('auth/forgot_password_form', $data);
		}
	}

	function doForgot(){
										// validation ok
		if (!is_null($data = $this->tank_auth->forgot_password(
				$this->input->post('email')))) {

			$data['site_name'] = $this->config->item('website_name', 'tank_auth');

			// Send email with password activation link
			$this->_send_email('forgot_password', $data['email'], $data);

			//$this->_show_message($this->lang->line('auth_message_new_password_sent'));
			echo json_encode(array('success' => true, 'message' => $this->lang->line('auth_message_new_password_sent')));
			exit();
		} else {
			$errors = $this->tank_auth->get_error_message();
			foreach ($errors as $k => $v)	$data['errors'][$k] = $this->lang->line($v);
			echo json_encode(array('success' => false, 'message' => $data['errors']));
			exit();
		}
		
	}
	/**
	 * Replace user password (forgotten) with a new one (set by user).
	 * User is verified by user_id and authentication code in the URL.
	 * Can be called by clicking on link in mail.
	 *
	 * @return void
	 */
	function reset_password()
	{
		$user_id		= $this->uri->segment(3);
		$new_pass_key	= $this->uri->segment(4);

		$this->form_validation->set_rules('new_password', 'New Password', 'trim|required|xss_clean|min_length['.$this->config->item('password_min_length', 'tank_auth').']|max_length['.$this->config->item('password_max_length', 'tank_auth').']|alpha_dash');
		$this->form_validation->set_rules('confirm_new_password', 'Confirm new Password', 'trim|required|xss_clean|matches[new_password]');

		$data['errors'] = array();

		if ($this->form_validation->run()) {								// validation ok
			if (!is_null($data = $this->tank_auth->reset_password(
					$user_id, $new_pass_key,
					$this->form_validation->set_value('new_password')))) {	// success

				$data['site_name'] = $this->config->item('website_name', 'tank_auth');

				// Send email with new password
				$this->_send_email('reset_password', $data['email'], $data);

				$this->_show_message($this->lang->line('auth_message_new_password_activated').' '.anchor('/auth/login/', 'Login'));

			} else {														// fail
				$this->_show_message($this->lang->line('auth_message_new_password_failed'));
			}
		} else {
			// Try to activate user by password key (if not activated yet)
			if ($this->config->item('email_activation', 'tank_auth')) {
				$this->tank_auth->activate_user($user_id, $new_pass_key, FALSE);
			}

			if (!$this->tank_auth->can_reset_password($user_id, $new_pass_key)) {
				$this->_show_message($this->lang->line('auth_message_new_password_failed'));
			}
		}
		$this->load->view('auth/reset_password_form', $data);
	}

	/**
	 * Change user password
	 *
	 * @return void
	 */
	function change_password()
	{
		if (!$this->tank_auth->is_logged_in()) {								// not logged in or not activated
			redirect('/auth/login/');

		} else {
			$this->form_validation->set_rules('old_password', 'Old Password', 'trim|required|xss_clean');
			$this->form_validation->set_rules('new_password', 'New Password', 'trim|required|xss_clean|min_length['.$this->config->item('password_min_length', 'tank_auth').']|max_length['.$this->config->item('password_max_length', 'tank_auth').']|alpha_dash');
			$this->form_validation->set_rules('confirm_new_password', 'Confirm new Password', 'trim|required|xss_clean|matches[new_password]');

			$data['errors'] = array();

			if ($this->form_validation->run()) {								// validation ok
				if ($this->tank_auth->change_password(
						$this->form_validation->set_value('old_password'),
						$this->form_validation->set_value('new_password'))) {	// success
					
					echo json_encode(array('success' => true, 'message' => $this->lang->line('auth_message_password_changed')));
					exit();
				} else {														// fail
					$errors = $this->tank_auth->get_error_message();
					foreach ($errors as $k => $v)	$data['errors'][$k] = $this->lang->line($v);
					echo json_encode(array('success' => false, 'message' => 'Sorry!We cannot change your password.'));
					exit();
				}
				
			}
			$this->load->view('auth/change_password_form', $data);
			
		}
	}

	/**
	 * Change user email
	 *
	 * @return void
	 */
	function change_email()
	{
		if (!$this->tank_auth->is_logged_in()) {								// not logged in or not activated
			redirect('/auth/login/');

		} else {
			$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
			$this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean|valid_email');

			$data['errors'] = array();

			if ($this->form_validation->run()) {								// validation ok
				if (!is_null($data = $this->tank_auth->set_new_email(
						$this->form_validation->set_value('email'),
						$this->form_validation->set_value('password')))) {			// success

					$data['site_name'] = $this->config->item('website_name', 'tank_auth');

					// Send email with new email address and its activation link
					$this->_send_email('change_email', $data['new_email'], $data);

					$this->_show_message(sprintf($this->lang->line('auth_message_new_email_sent'), $data['new_email']));

				} else {
					$errors = $this->tank_auth->get_error_message();
					foreach ($errors as $k => $v)	$data['errors'][$k] = $this->lang->line($v);
				}
			}
			$this->load->view('auth/change_email_form', $data);
		}
	}

	/**
	 * Replace user email with a new one.
	 * User is verified by user_id and authentication code in the URL.
	 * Can be called by clicking on link in mail.
	 *
	 * @return void
	 */
	function reset_email()
	{
		$user_id		= $this->uri->segment(3);
		$new_email_key	= $this->uri->segment(4);

		// Reset email
		if ($this->tank_auth->activate_new_email($user_id, $new_email_key)) {	// success
			$this->tank_auth->logout();
			$this->_show_message($this->lang->line('auth_message_new_email_activated').' '.anchor('/auth/login/', 'Login'));

		} else {																// fail
			$this->_show_message($this->lang->line('auth_message_new_email_failed'));
		}
	}

	/**
	 * Delete user from the site (only when user is logged in)
	 *
	 * @return void
	 */
	function unregister()
	{
		if (!$this->tank_auth->is_logged_in()) {								// not logged in or not activated
			redirect('/auth/login/');

		} else {
			$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');

			$data['errors'] = array();

			if ($this->form_validation->run()) {								// validation ok
				if ($this->tank_auth->delete_user(
						$this->form_validation->set_value('password'))) {		// success
					$this->_show_message($this->lang->line('auth_message_unregistered'));

				} else {														// fail
					$errors = $this->tank_auth->get_error_message();
					foreach ($errors as $k => $v)	$data['errors'][$k] = $this->lang->line($v);
				}
			}
			$this->load->view('auth/unregister_form', $data);
		}
	}

	/**
	 * Show info message
	 *
	 * @param	string
	 * @return	void
	 */
	function _show_message($message)
	{
		$this->session->set_flashdata('message', $message);
		redirect('/auth/');
	}
	
	function send_queries(){

		$quries = array(
			'fullname'	=>$this->input->post('name'),
			'email'		=>$this->input->post('email'),
			'subject'	=>$this->input->post('subject'),
			'message'	=>$this->input->post('message'),
			'subscribed'=> 1
		);

		if($this->tank_auth->save_queries($quries))
		{
			
			$data['site_name'] = $this->config->item('website_name', 'tank_auth');
			$this->_send_email('send_queries', $quries['email'], $data);
			
			echo json_encode(array('success' => true, 'message' => 'Thanks for sending your query!'));
			exit();
		} else {														// fail
			echo json_encode(array('success' => false, 'message' => 'Sorry! We encounter error while sending your queries.'));
			exit();
		}
				
	}
	/**
	 * Send email message of given type (activate, forgot_password, etc.)
	 *
	 * @param	string
	 * @param	string
	 * @param	array
	 * @return	void
	 */
	function _send_email($type, $email, &$data)
	{

      	$this->load->library('email');
		$this->email->from($this->config->item('webmaster_email', 'tank_auth'), $this->config->item('website_name', 'tank_auth'));
		$this->email->reply_to($this->config->item('webmaster_email', 'tank_auth'), $this->config->item('website_name', 'tank_auth'));
		$this->email->to($email);
		$this->email->subject(sprintf($this->lang->line('auth_subject_'.$type), $this->config->item('website_name', 'tank_auth')));
		$this->email->message($this->load->view('email/'.$type.'-html', $data, TRUE));
		$this->email->set_alt_message($this->load->view('email/'.$type.'-txt', $data, TRUE));
		$this->email->send();
	}

	/**
	 * Create CAPTCHA image to verify user as a human
	 *
	 * @return	string
	 */
	function _create_captcha()
	{
		$this->load->helper('captcha');

		$cap = create_captcha(array(
			'img_path'		=> './'.$this->config->item('captcha_path', 'tank_auth'),
			'img_url'		=> base_url().$this->config->item('captcha_path', 'tank_auth'),
			'font_path'		=> './'.$this->config->item('captcha_fonts_path', 'tank_auth'),
			'font_size'		=> $this->config->item('captcha_font_size', 'tank_auth'),
			'img_width'		=> $this->config->item('captcha_width', 'tank_auth'),
			'img_height'	=> $this->config->item('captcha_height', 'tank_auth'),
			'show_grid'		=> $this->config->item('captcha_grid', 'tank_auth'),
			'expiration'	=> $this->config->item('captcha_expire', 'tank_auth'),
		));

		// Save captcha params in session
		$this->session->set_flashdata(array(
				'captcha_word' => $cap['word'],
				'captcha_time' => $cap['time'],
		));

		return $cap['image'];
	}

	/**
	 * Callback function. Check if CAPTCHA test is passed.
	 *
	 * @param	string
	 * @return	bool
	 */
	function _check_captcha($code)
	{
		$time = $this->session->flashdata('captcha_time');
		$word = $this->session->flashdata('captcha_word');

		list($usec, $sec) = explode(" ", microtime());
		$now = ((float)$usec + (float)$sec);

		if ($now - $time > $this->config->item('captcha_expire', 'tank_auth')) {
			$this->form_validation->set_message('_check_captcha', $this->lang->line('auth_captcha_expired'));
			return FALSE;

		} elseif (($this->config->item('captcha_case_sensitive', 'tank_auth') AND
				$code != $word) OR
				strtolower($code) != strtolower($word)) {
			$this->form_validation->set_message('_check_captcha', $this->lang->line('auth_incorrect_captcha'));
			return FALSE;
		}
		return TRUE;
	}

	/**
	 * Create reCAPTCHA JS and non-JS HTML to verify user as a human
	 *
	 * @return	string
	 */
	function _create_recaptcha()
	{
		$this->load->helper('recaptcha');

		// Add custom theme so we can get only image
		$options = "<script>var RecaptchaOptions = {theme: 'custom', custom_theme_widget: 'recaptcha_widget'};</script>\n";

		// Get reCAPTCHA JS and non-JS HTML
		$html = recaptcha_get_html($this->config->item('recaptcha_public_key', 'tank_auth'));

		return $options.$html;
	}

	/**
	 * Callback function. Check if reCAPTCHA test is passed.
	 *
	 * @return	bool
	 */
	function _check_recaptcha()
	{
		$this->load->helper('recaptcha');

		$resp = recaptcha_check_answer($this->config->item('recaptcha_private_key', 'tank_auth'),
				$_SERVER['REMOTE_ADDR'],
				$_POST['recaptcha_challenge_field'],
				$_POST['recaptcha_response_field']);

		if (!$resp->is_valid) {
			$this->form_validation->set_message('_check_recaptcha', $this->lang->line('auth_incorrect_captcha'));
			return FALSE;
		}
		return TRUE;
	}
	
	function update_type(){

		$type = $this->input->post('profile_visibility');
		if(!$this->tank_auth->update_types($this->tank_auth->get_user_id(), $type)){
			echo json_encode(array('success' => true, 'message' => 'Profile updated!'));
				exit();
		}else{
			echo json_encode(array('success' => false, 'message' => 'Error in updating your profile.'));
				exit();	
		}
	}
	
	function notification_update(){

		$notification_data = $this->input->post('notifications') != NULL ? $this->input->post('notifications') : array();

		if($this->tank_auth->update_notifications($this->tank_auth->get_user_id(), $notification_data)){
			echo json_encode(array('success' => true, 'message' => 'Notifications updated!'));
				exit();
		}else{
			echo json_encode(array('success' => false, 'message' => 'Error in updating your notifications.'));
				exit();	
		}

	}
	
	
	
	function upload_picture($id){
		if ($this->input->is_ajax_request()) 
		{
	        $this->load->view("ajax/profile_upload");
	    }else{
	    	$this->session->set_flashdata('alert_error', 'Sorry! Page cannot open by new tab');
            redirect('');
	    }
	}
	
	function upload_profile($id){
		
		$pic = '';
		
		$config['upload_path'] = getcwd() . '/uploads/'.$this->tank_auth->get_license_key().'/profile-picture/';
		$config['allowed_types'] = 'gif|jpg|png';
		//$config['max_size'] = '1024';
		//$config['max_width'] = '800';
		//$config['max_height'] = '680';
		$config['encrypt_name'] = TRUE;
		
		$this->load->library('upload', $config);

		if(!is_dir($config['upload_path']))
		{
			mkdir($config['upload_path'], 0755, TRUE);
		}

		if (!$this->upload->do_upload('profile_picture'))
		{
			echo json_encode(array('success'=>false,'message'=>$this->upload->display_errors()));

		}else{
			
			$upload_data = $this->upload->data();
					
			if (!empty($upload_data['orig_name']))
			{
				
				$pic = $upload_data['raw_name'] . $upload_data['file_ext'];
				
			}
			
			$this->Person->save_picture($pic, $id);

			echo json_encode(array('success'=>true,'message'=>$this->lang->line('config_saved_successfully')));
		}

	}
	
	function get_switch_advance(){
		
        if (!$this->session->userdata('option'))
            $this->set_seach(1);

        return $this->session->userdata('option');
        
	}
	
	function switch_advance($option) {
		if($this->session->set_userdata('option', $option)){
			echo json_encode(array('success'=>true));
		}
    }
	
	function update_templates(){
			
		$batch_save_data=array(
			'rx_template'=> $this->input->post('rx_template')
		);
		$this->Appconfig->batch_save($this->tank_auth->get_license_key(), $batch_save_data );

		echo json_encode(array('success'=>true));
	}
}

/* End of file auth.php */
/* Location: ./application/controllers/auth.php */