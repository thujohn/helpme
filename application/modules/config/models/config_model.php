<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Config_model extends CI_Model{
	protected $table = 'config';

	function _required($required, $data){
		foreach ($required as $field){
			if (!isset($data[$field])){
				return false;
			}
		}
		return true;
	}

	function get_config(){
		return $this->db->select('*')
						->from($this->table)
						->get()
						->result();
	}

	function update_config($options){
		if (!$this->_required(
			array('sitename', 'noreply', 'system_email', 'address', 'phone', 'limit_articles_acc'),
			$options)
		) return false;

		foreach ($options as $kO => $vO){
			$this->db->set('value', $vO);
			$this->db->where('field', $kO);
			$this->db->update($this->table);
		}

		return true;
	}
}