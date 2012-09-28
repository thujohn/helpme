<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Faq_model extends CI_Model{
	protected $table_faq = 'faq';

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
						->from($this->table_faq)
						->where($where)
						->get()
						->row(0);
	}

	function get_all($where = array(), $mode = ''){
		$query = $this->db->select('*')
						  ->from($this->table_faq)
						  ->where($where)
						  ->order_by('order')
						  ->get();
		if ($mode == 'array'){
			return $query;
		}else{
			return $query->result();
		}
	}

	function count($where = array()){
		return (int)$this->db->where($where)
							 ->count_all_results($this->table_faq);
	}

	function get_last($where = array()){
		$query = $this->db->select('*')
						  ->from($this->table_faq)
						  ->where($where)
						  ->order_by('order', 'DESC')
						  ->get()
						  ->row(0);
		if ($query){
			return $query->order;
		}else{
			return 0;
		}
	}

	function create($options){
		if (!$this->_required(
			array('question', 'answer'),
			$options)
		) return false;

		$last = $this->get_last();

		$this->db->set('order', ($last + 1));
		$this->db->set('question', $options['question']);
		$this->db->set('answer', $options['answer']);

		if ($this->db->insert($this->table_faq)){
			return $this->db->insert_id();
		}else{
			return false;
		}
	}

	function update($options){
		if (!$this->_required(
			array('id', 'question', 'answer'),
			$options)
		) return false;

		$this->db->set('question', $options['question']);
		$this->db->set('answer', $options['answer']);

		$this->db->where('id', $options['id']);

		if ($this->db->update($this->table_faq)){
			return true;
		}else{
			return false;
		}
	}

	function delete($options = array()){
		if (!$this->_required(
			array('id'),
			$options)
		) return false;

		if ($this->db->delete($this->table_faq, array('id' => $options['id']))){
			return true;
		}else{
			return false;
		}
	}

	function sort($data){
		$this->db->update_batch($this->table_faq, $data, 'id');
	}
}