<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends MY_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('contact/contact_model', 'contactManager');
		if (!$this->userManager->isAdmin()){
			redirect('/', 'refresh');
		}
		$this->layout->set_theme('admin');
		$this->layout->add_css('default');
		// $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
	}

	function index(){
		$this->layout->set_title('Tableau de bord');

		$this->data['last_tickets_open'] = $this->ticketManager->get_all_tickets(array('state' => 'open'), '', 'T.id DESC', 5);
		$this->data['last_tickets_closed'] = $this->ticketManager->get_all_tickets(array('state' => 'close'), '', 'T.id DESC', 5);
		$this->data['last_contacts'] = $this->contactManager->get_all(array(), '', 'id DESC', 5);

		$this->layout->views('admin/dashboard', $this->data)->view();
	}
}