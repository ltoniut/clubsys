<?php if ( ! defined('BASEPATH')) exit ('No direct script access allowed');
class Socios_model extends CI_model {
	public function __construct() {
		$this->load->database();
	}
	public function get_socios() {
		$query = $this->db->get('lista_usuarios');

		return $query->result_array();
	}

	public function get_sociosxtipo($tipoId) {
		$this->db->select('*');
		$this->db->from('lista_usuarios');
		$this->db->where("tipoId = {$tipoId}");
		$query = $this->db->get();

		return $query->result_array();
	}

	public function update_socio($data) {
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