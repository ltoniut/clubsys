<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuarios extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('usuarios_model');
		$this->load->helper('form');
		$this->load->library('form_validation');
	}

	private function _is_admin() {
		if (!$this->session->userdata('is_admin'))
			show_error('Usuario sin autorización.', 403);
	}

	public function index() {
		if ($this->session->userdata('username'))
			redirect('home', 'refresh');
		else
			$this->login();
	}

	public function registro() {
		$config = array(
               array(
                     'field'   => 'nombre', 
                     'label'   => 'Nombre', 
                     'rules'   => 'required'
                  ),
               array(
                     'field'   => 'apellido', 
                     'label'   => 'Apellido', 
                     'rules'   => 'required'
                  ),
               array(
                     'field'   => 'password', 
                     'label'   => 'Contraseña', 
                     'rules'   => 'required|matches[passconf]'
                  ),
               array(
                     'field'   => 'passconf', 
                     'label'   => 'Confirmar contraseña', 
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

		if ($this->form_validation->run() === FALSE) {
			$this->load->view('usuarios/registro');
		}
		else {
			$detalles = array(
				'tipo' => 1,
				'nombres' => $this->input->post('nombre'),
				'apellido' => $this->input->post('apellido'),
				'password' => $this->input->post('password'),
				'direccion' => $this->input->post('direccion'),
				'fechaNacimiento' => $this->input->post('fechaNacimiento')
				);
			if ($this->usuarios_model->set_usuario($detalles)) {
				$this->_login(array('username' => $detalles['nombres'], 'is_admin' => 0));
				echo 'éxito';
			}
			else
				echo "falló";
		}
	}

	private function _login($data) {
		$this->session->set_userdata($data);
		redirect('home', 'refresh');
	}

	public function login() {
		$this->form_validation->set_rules('numeroSocio', 'Número de socio', 'required');
		$this->form_validation->set_rules('password', 'Contraseña', 'required');

		if ($this->form_validation->run() === FALSE) {
			$this->load->view('usuarios/login');
		}
		else {
			$nombre = $this->input->post('nombre');
			$password = $this->input->post('password');
			$usuario = $this->usuarios_model->get_usuario_id($id);

			if ($usuario) {
				if (password_verify($password, $hash)) {
					$this->_login(array('numeroSocio' => $usuario['nombre'], 1));
				}
				else {
					echo "constraseña incorrecta";
				}
			}
			else {
				echo 'no existe usuario';
			}
		}
	}

	public function logout() {
		$this->session->unset_userdata('numeroSocio');
		$this->session->sess_destroy();
		redirect('home', 'refresh');
	}

	public function update($id) {
		$this->_is_admin();
		$this->form_validation->set_rules('nombre', 'nombre', 'required|trim');

		if ($this->form_validation->run() === FALSE) {
			$usuario = $this->usuarios_model->get_usuario_id($id);
			if ($usuario) {
				$data['detalles'] = $usuario;
				$this->load->view('usuarios/update_delete', $data);
			}
			else
				show_404();
		}
		else {
			$detalles = array(
				'id' => $id,
				'nombre' => $this->input->post('nombre'),
				0
				);
			$this->productos_model->update_producto($detalles);
			$this->session->set_flashdata('msj_exito', 'Modificación exitosa.');
			redirect("productos/update/{$id}");
		}
	}

	#método para debugeo
	public function test() {
		$data = array(
			'id' => 6,
			'pass' => '1234'
			);
		$do = $this->usuarios_model->login_usuario($data);
		if ($do)
			echo json_encode($do);
		else
			echo "noooo";
	}

}