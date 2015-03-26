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
		$this->db->select('id, CONCAT(nombres, " ", apellido) AS nombre, tipo', false);
		$this->db->from('usuario');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function delete_usuario($id) {
		$this->db->where('id', $id);
		$this->db->delete('usuario'); 
	}

	public function get_usuarios_tipo($tipo) {
		$this->db->select('id, CONCAT(nombres, " ", apellido) AS nombre, tipo', false);
		$this->db->from('usuario');
		$this->db->where("tipo = '{$tipo}'")
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_usuario_id($id) {
		$this->db->select('id, CONCAT(nombres, " ", apellido) AS nombre, tipo');
		$this->db->from('usuario');
		$this->db->where("id = '{$id}'");
		$query = $this->db->get();
		return $query->row_array();
	}

	public function login_usuario($data) {
		$id = $data['id'];
		$pass = $data['pass'];
		$this->db->select('id, CONCAT(nombres, " ", apellido) AS nombre, tipo', false);
		$this->db->from('usuario');
		$this->db->where("id = '{$id}' AND hash = PASSWORD('{$pass}')");
		$query = $this->db->get();
		return $query->row_array();
	}

	public function update_usuario($data) {
		$info = array(
           'tipo_id' => $data->tipo,
           'nombres' => $data->$name,
           'apellido' => $data->$apellido,
           'direccion' => $data->$direccion,
           'fecha_nacimiento' => $data->$nacimiento
        );

        $this->db->where('id', $data->id);
		$this->db->update('usuario', $data); 
	}
}