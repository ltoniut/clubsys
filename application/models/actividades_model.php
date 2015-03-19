<?php if ( ! defined('BASEPATH')) exit ('No direct script access allowed');
	class Actividad extends CI_Model {

		public function set_actividad($data) {
			//Info = nombre, descripcion, fecha de inicio, id instructor, horarios(entrada, salida, dia)
			$nombre = $data->nombre;
			$descripcion = $data->descripcion;
			$instructor = $data->instructor;
			$fecha = $data->fecha;

			$queryAgregar = $this->db->query("call agregar_actividad({$instructor}, {$nombre},{$descripcion}, {$fecha})");
 

			if( FALSE === $queryAgregar ) {
			    echo( "Error al agregar actividad.");
			} else {
			    echo( "Inclusión exitosa." );
			}
		}

		public function set_historial_horario($actividad, $implementacion) {
			$this->db->query("call agregar_historial_horario({$actividad}, {$implementacion})");
		}

		public function set_horarios($data) {
			foreach ($data as $horario) {
				$actividad = $horario->actividad;
				$dia = $horario->dia;
				$entrada = $horario->entrada;
				$salida = $horario->salida;

				$this->db->query("call agregar_horario({$actividad}, {$dia}, {$entrada}, {$salida})");
			}
		}

		public function get_actividades() {
			$query = $this->db->get('lista_actividades');
			return $query->result_array();
		}

		public function delete_actividad($id) {
			$query = $this->db->delete('actividad', array('id' => $id));
			return $this->db->affected_rows();
		}
	}

?>