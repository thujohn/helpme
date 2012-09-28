<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Layout {
	private $CI;
	private $var = array();
	private $theme = 'default';

	public function __construct(){
		$this->CI =& get_instance();

		$this->var['output'] = '';

		$this->var['title'] = ucfirst($this->CI->router->fetch_method()) . ' - ' . ucfirst($this->CI->router->fetch_class());
		
		//	Nous initialisons la variable $charset avec la même valeur que
		//	la clé de configuration initialisée dans le fichier config.php
		$this->var['charset'] = $this->CI->config->item('charset');
		
		$this->var['css'] = array();
		$this->var['js'] = array();
	}

	public function view($name = '', $data = array()){
		if (empty($name)){
			$name = $this->theme;
		}
		$obj =& get_instance();
		$this->CI->load->view('../themes/'.$name, $this->var);
	}

	public function views($name, $data = array()){
		$this->var['output'] .= $this->CI->load->view($name, $data, true);
		return $this;
	}

	public function set_title($title){
		if(is_string($title) AND !empty($title)){
			$this->var['title'] = $title;
			return true;
		}
		return false;
	}

	public function set_h1($h1){
		if(is_string($h1) AND !empty($h1)){
			$this->var['h1'] = $h1;
			return true;
		}
		return false;
	}

	public function add_css($name){
		if(is_string($name) && !empty($name)){
			$this->var['css'][] = css_asset($name);
			return true;
		}
		return false;
	}

	public function add_js($name){
		if(is_string($name) && !empty($name)){
			$this->var['js'][] = js_asset($name);
			return true;
		}
		return false;
	}

	public function set_theme($theme){
		$obj =& get_instance();
		if(is_string($theme) AND !empty($theme) AND file_exists('./application/'.$this->CI->config->item('base_folder').'/themes/' . $theme . '.php')){
			$this->theme = $theme;
			return true;
		}
		return false;
	}
}