<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends MY_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('faq_model', 'faqManager');
		$this->layout->set_theme('admin');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		// $this->output->enable_profiler(TRUE);
	}

	function index() {
		$this->layout->set_title('FAQ');
		$this->layout->add_js('jquery-ui-1.9.1.custom.min');
		$this->layout->add_js('sort');

		$this->data['questions'] = $this->faqManager->get_all();

		$this->layout->views('admin/index', $this->data)->view();
	}

	function create(){
		$this->layout->set_title('Ajouter une question');
		$this->layout->add_css('redactor');
		$this->layout->add_js('redactor/fr');
		$this->layout->add_js('redactor/redactor.min');
		$this->layout->add_js('default');

		$this->form_validation->set_rules('question','Question','trim|required|xss_clean');
		$this->form_validation->set_rules('answer','Réponse','trim|required|xss_clean');
		if (!$this->form_validation->run()){
			$this->layout->views('admin/create', $this->data)->view();
		}else{
			$options['question'] = $this->input->post('question');
			$options['answer'] = $this->input->post('answer');
			$valid = $this->faqManager->create($options);

			if ($valid){
				redirect('admin/faq', 'refresh');
			}else{
				$this->layout->views('admin/create-error', $this->data)->view();
			}
		}
	}

	function update($id){
		$question = $this->faqManager->get(array('id' => (int) $id));

		if (!$question){
			redirect('admin/faq', 'refresh');
		}

		$this->data['question'] = $question;

		$this->layout->set_title('Modifier une question');
		$this->layout->add_css('redactor');
		$this->layout->add_js('redactor/fr');
		$this->layout->add_js('redactor/redactor.min');
		$this->layout->add_js('default');

		$this->form_validation->set_rules('question','Question','trim|required|xss_clean');
		$this->form_validation->set_rules('answer','Réponse','trim|required|xss_clean');
		if (!$this->form_validation->run()){
			$this->layout->views('admin/update', $this->data)->view();
		}else{
			$options['id'] = $question->id;
			$options['question'] = $this->input->post('question');
			$options['answer'] = $this->input->post('answer');
			$valid = $this->faqManager->update($options);

			if ($valid){
				redirect('admin/faq', 'refresh');
			}else{
				$this->layout->views('admin/update-error', $this->data)->view();
			}
		}
	}

	function delete($id){
		$question = $this->faqManager->get(array('id' => (int) $id));

		if ($question){
			$options['id'] = $question->id;
			$this->faqManager->delete($options);
		}

		redirect('admin/faq', 'refresh');
	}

	function sort(){
		$records = array();
		parse_str($_POST['recordsArray'], $records);
		$updateRecordsArray = $records['recordsArray'];

		$cpt = 1;
		$data = array();
		foreach ($updateRecordsArray as $recordIDValue) {
			$data[] = array('id' => $recordIDValue, 'order' => $cpt);
			$cpt++;
		}

		$this->faqManager->sort($data);
	}
}