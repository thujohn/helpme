<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contact_model extends CI_Model{
	protected $table_contact = 'contact';

	function _required($required, $data){
		foreach ($required as $field){
			if (!isset($data[$field])){
				return false;
			}
		}
		return true;
	}

	function get($where = array()){
		return $this->db->select('*')
						->from($this->table_contact)
						->where($where)
						->get()
						->row(0);
	}

	function get_all($where = array(), $mode = '', $order_column = 'id', $limit = 10, $from = 0){
		$query = $this->db->select('*')
						  ->from($this->table_contact)
						  ->where($where)
						  ->order_by($order_column)
						  ->limit($limit, $from)
						  ->get();
		if ($mode == 'array'){
			return $query;
		}else{
			return $query->result();
		}
	}

	function count($where = array()){
		return (int)$this->db->where($where)
							 ->count_all_results($this->table_contact);
	}

	function create($options){
		if (!$this->_required(
			array('lastname', 'firstname', 'email', 'subject', 'message', 'ip'),
			$options)
		) return false;

		$this->db->set('date_sent', 'NOW()', false);
		$this->db->set('lastname', $options['lastname']);
		$this->db->set('firstname', $options['firstname']);
		$this->db->set('email', $options['email']);
		$this->db->set('subject', $options['subject']);
		$this->db->set('message', $options['message']);
		$this->db->set('ip', $options['ip']);

		if ($this->db->insert($this->table_contact)){
			return $this->db->insert_id();
		}else{
			return false;
		}
	}
}