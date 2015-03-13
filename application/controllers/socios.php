<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Socios extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('socios_model');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('table');
		$template = array('table_open' => "<table class='table table-condensed table-striped'");
		$this->table->set_template($template);
	}

	public function index() {
		$data['socios'] = $this->socios_model->get_socios();
		$this->load->view('pages/socios', $data);
	}

}