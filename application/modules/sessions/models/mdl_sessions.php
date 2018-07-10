<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 * FusionInvoice
 * 
 * A free and open source web based invoicing system
 *
 * @package		FusionInvoice
 * @author		Jesse Terry
 * @copyright	Copyright (c) 2012 - 2013 FusionInvoice, LLC
 * @license		http://www.fusioninvoice.com/license.txt
 * @link		http://www.fusioninvoice.com
 * 
 */

class Mdl_Sessions extends CI_Model {

    public function auth($email, $password)
    {
        $this->db->where('email', $email);

        $query = $this->db->get('users');

        if ($query->num_rows())
        {
            $user = $query->row();

            $this->load->library('crypt');

            /**
             * Password hashing changed after 1.2.0
             * Check to see if user has logged in since the password change
             */
            if (!$user->user_psalt)
            {
                /**
                 * The user has not logged in, so we're going to attempt to
                 * update their record with the updated hash
                 */
                if (md5($password) == $user->user_password)
                {
                    /**
                     * The md5 login validated - let's update this user 
                     * to the new hash
                     */
                    $salt = $this->crypt->salt();
                    $hash = $this->crypt->generate_password($password, $salt);

                    $db_array = array(
                        'user_psalt'    => $salt,
                        'user_password' => $hash
                    );
                    
                    $this->db->where('id', $user->user_id);
                    $this->db->update('users', $db_array);
                    
                    $this->db->where('email', $email);
                    $user = $this->db->get('users')->row();
                    
                }
                else
                {
                    /**
                     * The password didn't verify against original md5
                     */
                    return FALSE;
                }
            }

            if ($this->crypt->check_password($user->password, $password))
            {
                $session_data = array(
                    // 'user_type' => $user->user_type,
                    'role_id' => $user->role_id,
                    'user_id'   => $user->id,
                    'username' => $user->username
                );

                $this->session->set_userdata($session_data);

                return TRUE;
            }
        }

        return FALSE;
    }

    /**
	 * Get user_id
	 *
	 * @return	string
	 */
	function get_user_id()
	{
		return $this->session->userdata('user_id');
	}

	/**
	 * Get username
	 *
	 * @return	string
	 */
	function get_username()
	{
		return $this->session->userdata('username');
	}

	/**
	 * Get role id
	 *
	 * @return	string
	 */
	function get_role_id()
	{
		return $this->session->userdata('role_id');
	}

}

?>