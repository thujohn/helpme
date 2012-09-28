<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends MY_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('contact_model', 'contactManager');
		$this->layout->set_theme('admin');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		// $this->output->enable_profiler(TRUE);
	}

	function index() {
		$this->layout->set_title('Contact');

		$this->data['contacts'] = $this->contactManager->get_all(array(), '', 'id DESC');

		$this->layout->views('admin/index', $this->data)->view();
	}

	function read($id){
		$contact = $this->contactManager->get(array('id' => (int) $id));

		if (!$contact){
			redirect('contact', 'refresh');
		}

		$this->layout->set_title('Contact');

		$this->data['contact'] = $contact;

		$this->layout->views('admin/read', $this->data)->view();
	}
}