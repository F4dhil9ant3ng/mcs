<?php
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
class Queing extends CI_Model
{	
	private $table              = 'queing';              
    private $id                 = 'que_id';
	private $order_field        = 'que_id';
	private $order_position     = 'asc';
    
	function exists($id, $client_id)
	{
		$this->db->from($this->table);	
		$this->db->where('user_id',$id);
		$this->db->where('client_id', $client_id);
		$query = $this->db->get();
		
		return ($query->num_rows()==1);
	}
	
	function last_row($client_id)
	{
		return $this->db->select('que_id')->where('client_id', $client_id)->order_by('que_id',"desc")->limit(1)->get('queing')->row();
	}
	
	function get_all($client_id)
	{
		$this->db->from($this->table);	
		$this->db->where('client_id', $client_id);		
		$this->db->order_by($this->order_field, $this->order_position);
		return $this->db->get();
			
	}
	
	function count_all($client_id)
	{
		$this->db->from($this->table);
		$this->db->where('client_id', $client_id);
		return $this->db->count_all_results();
	}
	
	function get_info($id, $client_id)
	{
		$this->db->from($this->table);	
		$this->db->where('user_id',$id);
		$this->db->where('client_id', $client_id);
		$query = $this->db->get();
		
		if($query->num_rows()==1)
		{
			return $query->row();
		}
		else
		{
			$obj=new stdClass();

			$fields = $this->db->list_fields($this->table);

			foreach ($fields as $field)
			{
				$obj->$field='';
			}
			
			return $obj;
		}
	}
	
	function save($data, $id=false)
	{
		
		$success=false;
		
		$this->db->trans_start();

			if (!$id or !$this->exists($id))
			{
				
				$this->db->insert($this->table, $data);
			}
			else
			{
				$this->db->where($this->id, $id);
				$success = $this->db->update($this->table, $data);		
			}

		$this->db->trans_complete();		
		return $success;
	}

	function delete($id, $status, $client_id)
	{
		$this->db->where('user_id',$id);
		$this->db->where('client_id', $client_id);
		
		if($this->db->delete($this->table))
		{
			$data = array(
				'visit_type'	=> 'Consultation',
				'visit_date'	=> date('Y-m-d'),
				'user_id'	=> $id,
				'client_id'	=> $client_id,
				'status'	=> $status
			);
			return $this->db->insert('visits', $data);
			
		}
		

	}
	
	function delete_list($client_id)
	{
		$this->db->where('client_id', $client_id);
		return $this->db->delete($this->table);
 	}
	

}