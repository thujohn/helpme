<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model{
	protected $table_users = 'users';
	protected $table_roles = 'roles';

	function _required($required, $data){
		foreach ($required as $field){
			if (!isset($data[$field])){
				return false;
			}
		}
		return true;
	}

	function enum_select($field){
		$row = $this->db->query("SHOW COLUMNS FROM ".$this->table_users." WHERE Field LIKE '$field';")->row()->Type;
		$regex = "/'(.*?)'/";
		preg_match_all($regex , $row, $enum_array);
		$enum_fields = $enum_array[1];
		foreach ($enum_fields as $key=>$value){
			$enums[$value] = $value; 
		}
		return $enums;
	}

	function isLoggedIn(){
		if ($this->session->userdata('logged_in') && $this->session->userdata('id')){
			return true;
		}else{
			return false;
		}
	}

	function isAdmin(){
		if ($this->isLoggedIn() && $this->session->userdata('role') < 3){
			return true;
		}else{
			return false;
		}
	}

	function check_free($field, $val){
		return $this->db->select('*')
						->from($this->table_users)
						->where($field, $val)
						->get()
						->num_rows();
	}

	function login($options = array()){
		if (!$this->_required(
			array('username', 'password'),
			$options)
		) return false;

		$user = $this->get(array('username' => $options['username'], 'password' => $options['password']));
		if (!$user) return false;
		if ($user->status == 'inactive') return false;

		$this->db->set('last_visit', 'NOW()', false)
				 ->set('ip', $this->input->ip_address())
				 ->where('id', $user->id)
				 ->update($this->table_users);
		$this->session->set_userdata('logged_in', true);
		$this->session->set_userdata('id', $user->id);
		$this->session->set_userdata('username', $user->username);
		$this->session->set_userdata('lastname', $user->lastname);
		$this->session->set_userdata('firstname', $user->firstname);
		$this->session->set_userdata('email', $user->email);
		$this->session->set_userdata('role', $user->role);
		$this->session->set_userdata('sitename', $user->sitename);

		return true;
	}

	function create($options){
		if (!$this->_required(
			array('status', 'role', 'lastname', 'firstname', 'email', 'username', 'password', 'sitename'),
			$options)
		) return false;

		$this->db->set('date_add', 'NOW()', false);
		$this->db->set('status', $options['status']);
		$this->db->set('role', $options['role']);
		$this->db->set('lastname', $options['lastname']);
		$this->db->set('firstname', $options['firstname']);
		$this->db->set('email', $options['email']);
		$this->db->set('username', $options['username']);
		$this->db->set('password', $options['password']);
		$this->db->set('sitename', $options['sitename']);

		if ($this->db->insert($this->table_users)){
			return $this->db->insert_id();
		}else{
			return false;
		}
	}

	function update($options){
		if (!$this->_required(
			array('id', 'status', 'role', 'lastname', 'firstname', 'email', 'username', 'sitename'),
			$options)
		) return false;

		$this->db->set('status', $options['status']);
		$this->db->set('role', $options['role']);
		$this->db->set('lastname', $options['lastname']);
		$this->db->set('firstname', $options['firstname']);
		$this->db->set('email', $options['email']);
		$this->db->set('username', $options['username']);
		if ($options['password'] != null){
			$this->db->set('password', $options['password']);
		}
		$this->db->set('sitename', $options['sitename']);

		if ($this->db->where('id', $options['id'])->update($this->table_users)){
			return true;
		}else{
			return false;
		}
	}

    function is_unique($value, $field){
        $this->validation->set_message('users_model->is_unique', "The %s {$value} is not available. Try a different username");
        return (bool)(!$this->findBy("{$field} = '{$value}'"));
    }

	function keygen($long = 8){
		$key = '';
		$chars = "0123456789abcdefghjkmnpqrstuvwxyzABCDEFGHJKMNPQRSTUVWXYZ";
		$i = 0;
		while ($i < $long){
			$char = substr($chars, mt_rand(0, strlen($chars)-1), 1);
			if (!strstr($key, $char)) { 
				$key .= $char;
				$i++;
			}
		}
		return $key;
	}

	function new_password($options = array()){
		if (!$this->_required(
			array('email'),
			$options)
		) return false;

		$password = $this->keygen(8);

		$user = $this->get(array('email' => $options['email']));
		if (!$user) return false;
		if ($user->status == 'inactive') return false;

		$this->db->set('password', sha1($password));

		if ($this->db->where('id', $user->id)->update($this->table_users)){
			return $password;
		}else{
			return false;
		}
	}

	function change_password($options = array()){
		if (!$this->_required(
			array('id', 'password'),
			$options)
		) return false;

		$this->db->set('password', $options['password']);

		if ($this->db->where('id', $options['id'])->update($this->table_users)){
			return true;
		}else{
			return false;
		}
	}

	function get($where = array()){
		return $this->db->select('*')
						->from($this->table_users)
						->where($where)
						->get()
						->row(0);
	}

	function get_all($where = array(), $mode = ''){
		$query = $this->db->select('*', false)
						  ->from($this->table_users)
						  ->where($where)
						  ->order_by('id')
						  ->get();
		if ($mode == 'array'){
			return $query;
		}else{
			return $query->result();
		}
	}

	function get_part($nb, $debut = 0, $where = array(), $order = array()){
		if (!is_integer($nb) || $nb < 1 || !is_integer($debut) || $debut < 0){
			return false;
		}

		if (isset($order['sortBy'])){
			$sortBy = $order['sortBy'];
		}else{
			$sortBy = 'id';
		}

		if (isset($order['sortDirection'])){
			$sortDirection = $order['sortDirection'];
		}else{
			$sortDirection = 'ASC';
		}

		return $this->db->select('*', false)
						->from($this->table_users)
						->where($where)
						->order_by($sortBy, $sortDirection)
						->order_by('id')
						->limit($nb, $debut)
						->get()
						->result();
	}

	function count($where = array()){
		return (int)$this->db->where($where)
							 ->count_all_results($this->table_users);
	}

	function get_all_roles($where = array(), $mode = ''){
		$query = $this->db->select('*')
						  ->from($this->table_roles)
						  ->where($where)
						  ->order_by('id')
						  ->get();
		if ($mode == 'array'){
			return $query;
		}else{
			return $query->result();
		}
	}

	function toggle_status($options = array()){
		if (!$this->_required(
			array('id', 'status'),
			$options)
		) return false;

		$this->db->set('status', $options['status']);
		$this->db->where('id', $options['id']);

		if ($this->db->update($this->table_users)){
			return true;
		}else{
			return false;
		}
	}
}