<?php if ( ! defined('BASEPATH')) exit ('No direct script access allowed');

class Usuarios_model extends CI_model {

	public function __construct() {
		$this->load->database();
	}

	public function set_usuario($data) {
		$this->db->query("CALL agregar_usuario('".$data['tipo']."','".$data['nombres']."','".$data['apellido']."','".$data['password']."','".$data['direccion']."','".$data['fechaNacimiento']."')");

		if ($this->db->affected_rows() > 0) 
			return TRUE;
		else
		 	return FALSE;
	}

	public function get_usuarios() {
		$this->db->select('id, CONCAT(nombres, " ", apellido) AS nombre, tipo');
		$this->db->from('usuario');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_usuario_id($id) {
		$this->db->select('id, nombres, tipo');
		$this->db->from('usuario');
		$this->db->where("id = '{$id}'");
		$query = $this->db->get();
		return $query->row_array();
	}

	public function update_usuario($data) {

	}
}