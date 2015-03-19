<?php if ( ! defined('BASEPATH')) exit ('No direct script access allowed');
	class Actividad extends CI_Model {

		public function registrar_clase($clase, $descripcion, $asistencias) {
			$this->db->select('lista_actividades');
		}

		public function consultar_asistencias($usuario, $actividad) {
			
		}
	}

?>