<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Faq extends MY_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('faq_model', 'faqManager');
		$this->layout->set_theme('default');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		// $this->output->enable_profiler(TRUE);
	}

	function index() {
		$this->layout->set_title('FAQ');

		$this->data['questions'] = $this->faqManager->get_all();

		$this->layout->views('index', $this->data)->view();
	}
}