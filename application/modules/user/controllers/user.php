<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('config/config_model', 'configManager');
		$this->load->model('user/user_model', 'userManager');
		$this->layout->set_theme('default');
		$this->layout->add_css('login');
		if (!$this->userManager->isLoggedIn() && $this->uri->segment(2) !== 'login' && $this->uri->segment(2) !== 'forgot'){
			redirect('user/login','refresh');
		}
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		// $this->output->enable_profiler(TRUE);
		$this->data = array();
		$conf = $this->configManager->get_config();
		$config = new stdClass();
		foreach ($conf as $kC => $vC){
			$f = strtolower(trim($vC->field));
			$config->$f = $vC->value;
		}
		$this->data['config'] = $config;
	}

	function login(){
		$this->layout->set_title('Connexion');
		if ($this->userManager->isLoggedIn()){
			redirect('/','refresh');
		}else{
			$this->form_validation->set_rules('username','Utilisateur','trim|required|xss_clean');
			$this->form_validation->set_rules('password','Mot de passe','trim|required|sha1');
			if (!$this->form_validation->run()){
				$this->layout->views('login', $this->data)->view();
			}else{
				$options['username'] = $this->input->post('username');
				$options['password'] = $this->input->post('password');
				$valid = $this->userManager->login($options);

				if ($valid){
					if ($this->userManager->isAdmin()){
						redirect('admin','refresh');
					}else{
						redirect('/','refresh');
					}
				}else{
					$this->layout->views('error-login', $this->data)->view();
				}
			}
		}
	}

	function forgot(){
		$this->layout->set_title('Mot de passe oublié');
		if ($this->userManager->isLoggedIn()){
			redirect('/','refresh');
		}else{
			$this->form_validation->set_rules('email','Adresse e-mail','trim|required|xss_clean|valid_email');
			if (!$this->form_validation->run()){
				$this->layout->views('forgot', $this->data)->view();
			}else{
				$options['email'] = $this->input->post('email');
				$password = $this->userManager->new_password($options);

				if ($password){
					$message = 'Votre nouveau mot de passe : '.$password;

					$config['mailtype'] = 'html';
					$config['charset'] = 'UTF-8';
					$this->load->library('email');
					$this->email->initialize($config);
					$this->email->from($this->data['config']->noreply);
					$this->email->to($options['email']);
					$this->email->subject('Modification du compte');
					$this->email->message($message);
					@$this->email->send();

					redirect('user/login','refresh');
				}else{
					$this->layout->views('error-forgot', $this->data)->view();
				}
			}
		}
	}

	function logout(){
		$this->session->sess_destroy();
		redirect('user/login','refresh');
	}
}