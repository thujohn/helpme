<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contact extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('config/config_model', 'configManager');
		$this->load->model('user/user_model', 'userManager');
		if ($this->userManager->isLoggedIn()){
			redirect('tickets', 'refresh');
		}
		$this->load->model('contact_model', 'contactManager');
		$this->layout->set_theme('default');
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

	function index(){
		$this->layout->set_title('Contact');
		$this->layout->add_js('contact');

		$this->layout->views('index', $this->data)->view();
	}

	function send(){
		if (!empty($_POST)){
			$this->load->library('email');

			$_POST = array_map('trim', $_POST);
			$lastname = htmlspecialchars($_POST['lastname']);
			$firstname = htmlspecialchars($_POST['firstname']);
			$email = $_POST['email'];
			$subject = htmlspecialchars($_POST['subject']);
			$message = htmlspecialchars($_POST['message']);

			$error = array();

			if (empty($lastname)){
				$error[] = '- Saisissez votre nom';
			}

			if (empty($firstname)){
				$error[] = '- Saisissez votre prénom';
			}

			if (empty($email)){
				$error[] = '- Saisissez votre adresse e-mail';
			}else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){ 
				$error[] = '- L\'adresse e-mail est incorrecte';
			}

			if (empty($subject)){
				$error[] = '- Saisissez l\'objet de votre message';
			}

			if (empty($message)){
				$error[] = '- Saisissez votre message';
			}

			if (empty($error)){
				$options = array();
				$options['lastname'] = $lastname;
				$options['firstname'] = $firstname;
				$options['email'] = $email;
				$options['subject'] = $subject;
				$options['message'] = $message;
				$options['ip'] = $this->session->userdata('ip_address');
				$this->contactManager->create($options);

				$message = '<strong>Nom :</strong> '.$lastname.'<br /><strong>Prénom :</strong> '.$firstname.'<br /><strong>E-mail :</strong> '.$email.'<br /><br /><strong>Message :</strong><br />'.nl2br($message);

				$config['mailtype'] = 'html';
				$config['charset'] = 'UTF-8';
				$this->email->initialize($config);
				$this->email->from($this->data['config']->noreply);
				$this->email->to($this->data['config']->system_email);
				$this->email->reply_to($email, $lastname.' '.$firstname);
				$this->email->subject('[CONTACT] '.$subject);
				$this->email->message($message);

				if (@$this->email->send()){
					echo 'OK';
				}else{
					echo 'Échec de l\'envoi !';
				}
			}else{
				echo implode('<br />', $error);
			}
		}
	}
}