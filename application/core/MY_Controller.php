<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model('config/config_model', 'configManager');
		$this->load->model('user/user_model', 'userManager');
		$this->load->model('tickets/tickets_model', 'ticketManager');

		$this->data = array();

		if (!$this->userManager->isLoggedIn() && $this->uri->segment(1) != 'user' && $this->uri->segment(2) != 'logout'){
			redirect('user/logout', 'refresh');
		}

		if (!$this->userManager->isAdmin() && $this->uri->segment(1) == 'admin'){
			redirect('/', 'refresh');
		}else if ($this->userManager->isAdmin() && $this->uri->segment(1) != 'admin'){
			redirect('admin', 'refresh');
		}

		$conf = $this->configManager->get_config();
		$config = new stdClass();
		foreach ($conf as $kC => $vC){
			$f = strtolower(trim($vC->field));
			$config->$f = $vC->value;
		}
		$this->data['config'] = $config;

		if ($this->userManager->isAdmin()){
			$this->data['nb_open'] = $this->ticketManager->count_tickets(array('state' => 'open'));
			$this->data['nb_close'] = $this->ticketManager->count_tickets(array('state' => 'close'));
			$this->data['nb_all'] = $this->ticketManager->count_tickets();
		}else{
			$this->data['nb_open'] = $this->ticketManager->count_tickets(array('state' => 'open', 'user_id' => $this->session->userdata('id')));
			$this->data['nb_close'] = $this->ticketManager->count_tickets(array('state' => 'close', 'user_id' => $this->session->userdata('id')));
			$this->data['nb_all'] = $this->ticketManager->count_tickets(array('user_id' => $this->session->userdata('id')));
		}
	}
}