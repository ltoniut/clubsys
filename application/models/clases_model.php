<?php if ( ! defined('BASEPATH')) exit ('No direct script access allowed');
	class Actividad extends CI_Model {

		public function registrar_clase($id, $descripcion, $asistencias) {
			$data = array(
				'descripcion' => $descripcion
			);
			$this->db->where('id',$id);
			$this->db->update('usuario', $data);

			foreach ($asistencias as $entry) {
				$data = array(
					'actividad_id' => $id,
					'actividad_id' => $id
				);
				$this->db->insert
			}
		}

		public function consultar_asistencias($usuario, $actividad) {
			
		}
	}

?>