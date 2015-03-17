<?php if ( ! defined('BASEPATH')) exit ('No direct script access allowed');
class Socios_model extends CI_model {
	public function __construct() {
		$this->load->database();
	}
	public function get_socios() {
		$query = $this->db->get('lista_usuarios');

		return $query->result_array();
	}

	public function get_sociosxtipo($tipoId)	 {
		$this->db->select('*');
		$this->db->from('lista_usuarios');
		$this->db->where("tipoId = {$tipoId}");
		$query = $this->db->get();

		return $query->result_array();
	}
}