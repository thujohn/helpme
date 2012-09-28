<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends MY_Controller {

	function __construct(){
		parent::__construct();
		$this->layout->set_theme('admin');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		// $this->output->enable_profiler(TRUE);
	}

	function index(){
		$this->layout->set_title('Configuration');

		$this->form_validation->set_rules('sitename','Nom du Site','trim|required|xss_clean');
		$this->form_validation->set_rules('noreply','E-mail de réponse','trim|required|xss_clean');
		$this->form_validation->set_rules('system_email','E-mail système','trim|required|xss_clean');
		if (!$this->form_validation->run()){
			$this->layout->views('admin/index', $this->data)->view();
		}else{
			$options['sitename'] = $this->input->post('sitename');
			$options['noreply'] = $this->input->post('noreply');
			$options['system_email'] = $this->input->post('system_email');

			$valid = $this->configManager->update($options);

			if ($valid){
				redirect('admin/config', 'refresh');
			}else{
				$this->layout->views('admin/error', $this->data)->view();
			}
		}
	}
}