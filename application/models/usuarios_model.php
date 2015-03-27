<?php if ( ! defined('BASEPATH')) exit ('No direct script access allowed');

class Usuarios_model extends CI_model {

	public function __construct() {
		$this->load->database();
	}

	public function set_usuario($data) {
		$tipo = $data['tipo'];
		$nombres = $data['nombres'];
		$apellido = $data['apellido'];
		$password = $data['password'];
		$direccion = $data['direccion'];
		$fechaNacimiento = $data['fechaNacimiento'];


		$sql = ("CALL agregar_usuario(?,?,?,?,?,?)");

		$this->db->query($sql, array($tipo, $nombres, $apellido, $password, $direccion, $fechaNacimiento));

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

	public function get_usuarios_nombre($string = FALSE) {
		$query_string = "SELECT * FROM `lista_usuarios`";

		if ($string) {
			$query_string .= " WHERE `Apellidos y nombres` LIKE '%{$string}%'";
		}

		$query = $this->db->query($query_string);

		return $query->result_array();
	}

	public function get_usuario_id($id) {
		$this->db->select('id, CONCAT(nombres, " ", apellido) AS nombre, tipo');
		$this->db->from('usuario');
		$this->db->where("id = '{$id}'");
		$query = $this->db->get();
		return $query->row_array();
	}

	public function get_usuario_nombre($string = FALSE) {
		$query_string = "SELECT * FROM `lista_usuarios`";

		if ($string) {
			$query_string .= " WHERE `Apellidos y nombres` LIKE '%{$string}%'";
		}

		$query = $this->db->query($query_string);

		return $query->result_array();
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