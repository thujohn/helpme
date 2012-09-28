<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tickets_model extends CI_Model{
	protected $table_tickets = 'tickets';
	protected $table_responses = 'responses';
	protected $table_attachments = 'attachments';
	protected $table_users = 'users';

	function _required($required, $data){
		foreach ($required as $field){
			if (!isset($data[$field])){
				return false;
			}
		}
		return true;
	}

	function get_ticket($where = array()){
		return $this->db->select('T.*, A.file_name, A.raw_name, U.email')
						->from($this->table_tickets.' AS T')
						->join($this->table_attachments.' AS A', 'A.id = T.attachment_id', 'left')
						->join($this->table_users.' AS U', 'U.id = T.user_id', 'left')
						->where($where)
						->get()
						->row(0);
	}

	function get_all_tickets($where = array(), $mode = '', $order_column = 'T.id', $limit = 10, $from = 0){
		$query = $this->db->select('T.*, A.file_name, A.raw_name')
						  ->from($this->table_tickets.' AS T')
						  ->join($this->table_attachments.' AS A', 'A.id = T.attachment_id', 'left')
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

	function search_tickets($search){
		$query = $this->db->select('*')
						  ->from($this->table_tickets)
						  ->where('MATCH (`title`, `text`) AGAINST ("'. $search .'" IN BOOLEAN MODE)', NULL, FALSE)
						  ->get();
		return $query;
	}

	function count_tickets($where = array()){
		return (int)$this->db->where($where)
							 ->count_all_results($this->table_tickets);
	}

	function create_ticket($options){
		if (!$this->_required(
			array('title', 'text', 'ip', 'user_id'),
			$options)
		) return false;

		$this->db->set('date_add', 'NOW()', false);
		$this->db->set('title', $options['title']);
		$this->db->set('text', $options['text']);
		$this->db->set('ip', $options['ip']);
		$this->db->set('user_id', $options['user_id']);

		if ($this->db->insert($this->table_tickets)){
			return $this->db->insert_id();
		}else{
			return false;
		}
	}

	function update_ticket($options){
		if (!$this->_required(
			array('id'),
			$options)
		) return false;

		$this->db->set('date_maj', 'NOW()', false);
		if (isset($options['state'])){
			$this->db->set('state', $options['state']);
		}
		$this->db->where('id', $options['id']);
		$this->db->update($this->table_tickets);
	}

	function get_response($where = array()){
		return $this->db->select('R.*, U.lastname, U.firstname, A.file_name, A.raw_name')
						->from($this->table_responses.' AS R')
						->join($this->table_users.' AS U', 'U.id = R.user_id', 'left')
						->join($this->table_attachments.' AS A', 'A.id = R.attachment_id', 'left')
						->where($where)
						->get()
						->row(0);
	}

	function get_all_responses($where = array(), $mode = '', $order_column = 'R.id', $limit = 10, $from = 0){
		$query = $this->db->select('R.*, U.lastname, U.firstname, A.file_name, A.raw_name')
						  ->from($this->table_responses.' AS R')
						  ->join($this->table_users.' AS U', 'U.id = R.user_id', 'left')
						  ->join($this->table_attachments.' AS A', 'A.id = R.attachment_id', 'left')
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

	function search_responses($search){
		$query = $this->db->select('T.*')
						  ->from($this->table_responses.' AS R')
						  ->join($this->table_tickets.' AS T', 'T.id = R.ticket_id', 'left')
						  ->where('MATCH (R.`text`) AGAINST ("'. $search .'" IN BOOLEAN MODE)', NULL, FALSE)
						  ->get();
		return $query;
	}

	function count_responses($where = array()){
		return (int)$this->db->where($where)
							 ->count_all_results($this->table_responses);
	}

	function create_response($options){
		if (!$this->_required(
			array('text', 'ip', 'ticket_id', 'user_id'),
			$options)
		) return false;

		$this->db->set('date_add', 'NOW()', false);
		$this->db->set('text', $options['text']);
		$this->db->set('ip', $options['ip']);
		$this->db->set('ticket_id', $options['ticket_id']);
		$this->db->set('user_id', $options['user_id']);

		if ($this->db->insert($this->table_responses)){
			return $this->db->insert_id();
		}else{
			return false;
		}
	}

	function get_attachment($where = array()){
		return $this->db->select('*')
						->from($this->table_attachments)
						->where($where)
						->get()
						->row(0);
	}

	function get_all_attachments($where = array(), $mode = '', $order_column = 'id', $limit = 10, $from = 0){
		$query = $this->db->select('*')
						  ->from($this->table_attachments)
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

	function count_attachments($where = array()){
		return (int)$this->db->where($where)
							 ->count_all_results($this->table_attachments);
	}

	function save_attachment($options){
		if (!$this->_required(
			array('file_name', 'file_type', 'raw_name', 'file_ext', 'file_size', 'is_image', 'image_width', 'image_height', 'image_type'),
			$options)
		) return false;

		$this->db->set('date_add', 'NOW()', false);
		$this->db->set('file_name', $options['file_name']);
		$this->db->set('file_type', $options['file_type']);
		$this->db->set('raw_name', $options['raw_name']);
		$this->db->set('file_ext', $options['file_ext']);
		$this->db->set('file_size', $options['file_size']);
		$this->db->set('is_image', $options['is_image']);
		$this->db->set('image_width', $options['image_width']);
		$this->db->set('image_height', $options['image_height']);
		$this->db->set('image_type', $options['image_type']);

		if ($this->db->insert($this->table_attachments)){
			$insert_id = $this->db->insert_id();
			$this->db->set('attachment_id', $insert_id);
			if (isset($options['ticket_id']) && $options['ticket_id'] != null){
				$this->db->where('id', $options['ticket_id']);
				$this->db->update($this->table_tickets);
			}
			if (isset($options['response_id']) && $options['response_id'] != null){
				$this->db->where('id', $options['response_id']);
				$this->db->update($this->table_responses);
			}
			return $insert_id;
		}else{
			return false;
		}
	}
}