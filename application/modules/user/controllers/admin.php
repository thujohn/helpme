<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends MY_Controller {

	function __construct(){
		parent::__construct();
		$this->layout->set_theme('admin');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		// $this->output->enable_profiler(TRUE);
	}

	function index(){
		$this->layout->set_title('Les Utilisateurs');

		$this->data['users'] = $this->userManager->get_part(99999, 0, array('role >=' => $this->session->userdata('role')), array('sortBy' => 'role', 'sortDirection' => 'ASC'));

		$this->layout->views('admin/index', $this->data)->view();
	}

	function create(){
		$this->layout->set_title('Ajouter un utilisateur');

		$this->data['status'] = $this->userManager->enum_select('status');

		$query = $this->userManager->get_all_roles(array('id >=' => $this->session->userdata('role')), 'array');
		$this->data['roles'] = array();
		foreach ($query->result_array() as $role){
			$this->data['roles'][$role['id']] = $role['name'];
		}

		$this->form_validation->set_rules('status','Statut','trim|required|xss_clean');
		$this->form_validation->set_rules('role','Rôle','trim|required|xss_clean|valid_drop');
		$this->form_validation->set_rules('lastname','Nom','trim|required|xss_clean');
		$this->form_validation->set_rules('firstname','Prénom','trim|required|xss_clean');
		$this->form_validation->set_rules('email','Adresse e-mail','trim|required|xss_clean');
		$this->form_validation->set_rules('username','Nom d\'utilisateur','trim|required|xss_clean');
		$this->form_validation->set_rules('password','Mot de passe','trim|required|xss_clean|sha1');
		$this->form_validation->set_rules('sitename','Nom du site','trim|required|xss_clean');
		if (!$this->form_validation->run()){
			$this->layout->views('admin/create', $this->data)->view();
		}else{
			$valid = false;
			$options['status'] = $this->input->post('status');
			$options['role'] = $this->input->post('role');
			$options['lastname'] = $this->input->post('lastname');
			$options['firstname'] = $this->input->post('firstname');
			$options['email'] = $this->input->post('email');
			$options['username'] = $this->input->post('username');
			$options['password'] = $this->input->post('password');
			$options['sitename'] = $this->input->post('sitename');
			$check_email = $this->userManager->check_free('email', $options['email']);
			if ($check_email == 0){
				$valid = $this->userManager->create($options);
			}

			if ($valid){
				redirect('admin/user', 'refresh');
			}else{
				$this->layout->views('admin/create-error', $this->data)->view();
			}
		}
	}

	function update($id){
		$user = $this->userManager->get(array('id' => (int) $id));

		if (!$user){
			redirect('admin/user', 'refresh');
		}

		$this->data['user'] = $user;

		$this->layout->set_title('Modifier un utilisateur');

		$this->data['status'] = $this->userManager->enum_select('status');

		$query = $this->userManager->get_all_roles(array('id >=' => $this->session->userdata('role')), 'array');
		$this->data['roles'] = array();
		foreach ($query->result_array() as $role){
			$this->data['roles'][$role['id']] = $role['name'];
		}

		$this->form_validation->set_rules('status','Statut','trim|required|xss_clean');
		$this->form_validation->set_rules('role','Rôle','trim|required|xss_clean|valid_drop');
		$this->form_validation->set_rules('lastname','Nom','trim|required|xss_clean');
		$this->form_validation->set_rules('firstname','Prénom','trim|required|xss_clean');
		$this->form_validation->set_rules('email','Adresse e-mail','trim|required|xss_clean');
		$this->form_validation->set_rules('username','Nom d\'utilisateur','trim|required|xss_clean');
		$this->form_validation->set_rules('password','Mot de passe','trim|xss_clean|sha1');
		$this->form_validation->set_rules('sitename','Nom du site','trim|required|xss_clean');
		if (!$this->form_validation->run()){
			$this->layout->views('admin/update', $this->data)->view();
		}else{
			$valid = false;
			$options['id'] = $user->id;
			$options['status'] = $this->input->post('status');
			$options['role'] = $this->input->post('role');
			$options['lastname'] = $this->input->post('lastname');
			$options['firstname'] = $this->input->post('firstname');
			$options['email'] = $this->input->post('email');
			$options['username'] = $this->input->post('username');
			if (!$this->input->post('password')){
				$options['password'] = '';
			}else{
				$options['password'] = $this->input->post('password');
			}
			$options['sitename'] = $this->input->post('sitename');
			$valid = $this->userManager->update($options);

			if ($valid){
				redirect('admin/user', 'refresh');
			}else{
				$this->layout->views('admin/update-error', $this->data)->view();
			}
		}
	}

	function status($id){
		$user = $this->userManager->get(array('id' => (int) $id));

		if ($user && $user->id != $this->session->userdata('id')){
			$options['id'] = $user->id;
			if ($user->status == "active"){
				$options['status'] = "inactive";
			}else{
				$options['status'] = "active";
			}
			$this->userManager->toggle_status($options);
		}

		redirect('admin/user', 'refresh');
	}
}