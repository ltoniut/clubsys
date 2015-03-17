<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Socios extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('socios_model');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger" role="alert">', '</div>');
		$this->load->library('table');
		$template = array('table_open' => "<table class='table table-condensed table-striped'");
			$this->table->set_template($template);
		}
		public function index() {
			$data['socios'] = $this->socios_model->get_socios();
			$this->load->view('pages/socios', $data);
		}

		public function agregar() {
			$config = array(
	               array(
	                     'field'   => 'nombres', 
	                     'label'   => 'Nombres', 
	                     'rules'   => 'required'
	                  ),
	               array(
	                     'field'   => 'apellidos', 
	                     'label'   => 'Apellidos', 
	                     'rules'   => 'required'
	                  ),
	               array(
	                     'field'   => 'direccion', 
	                     'label'   => 'Dirección', 
	                     'rules'   => 'required'
	                  ),
	               array(
	                     'field'   => 'fechaNacimiento', 
	                     'label'   => 'Fecha de nacimiento', 
	                     'rules'   => 'required'
	                )
	            );
	        $this->form_validation->set_rules($config);

	        if ($this->form_validation->run()) {
	        	$detalles = array(
					'nombres' => $this->input->post('nombres'),
					'apellidos' => $this->input->post('apellidos'),
					'tipo' => $this->input->post('tipo'),
					'direccion' => $this->input->post('direccion'),
					'fechaNacimiento' => $this->input->post('fechaNacimiento')
					);
				echo json_encode($detalles);
			}
			else {
				$this->session->set_flashdata('error', validation_errors());
				redirect('socios/index');
			}
		}

		public function test($idTipo) {

			$array = $this->socios_model->get_sociosxtipo($idTipo);
			echo json_encode($array);
		}
	}