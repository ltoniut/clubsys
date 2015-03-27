<?php if ( ! defined('BASEPATH')) exit ('No direct script access allowed');

	class Actividad extends CI_Model {

		public function set_actividad($data) {
			//Info = nombre, descripcion, fecha de inicio, id instructor, horarios(entrada, salida, dia)
		$nombre = $data['nombre'];
		$descripcion = $data['descripcion'];
		$instructor = $data['instructor'];
		$fecha = $data['fecha'];

			$sql = "call agregar_actividad(?, ?, ?, ?)";
 
   			$queryAgregar = $this->db->query($sql, array($instructor, $nombre, $descripcion, $fecha));
 

			if( FALSE === $queryAgregar ) {
			    echo( "Error al agregar actividad.");
			} else {
			    echo( "Inclusión exitosa." );
			}
		}

		public function update_actividad($data) {
			$id = $data->id;
			$nombre = $data->nombre;
			$descripcion = $data->descripcion;
			$instructor = $data->instructor;

			$sql = "update `actividad` SET `instructor_id`= ?,`nombre`= ?,`descripcion`= ? WHERE `id` = $id";

			$this->db->query($sql, array($instructor, $nombre, $descripcion));
		}

		public function set_historial_horario($actividad, $implementacion) {
			$sql = "call agregar_historial_horario(?, ?)";
			$this->db->query($sql, array($actividad, $implementacion));
		}

		public function set_horarios($data) {
			foreach ($data as $horario) {
				$actividad = $horario['actividad'];
				$dia = $horario['dia'];
				$entrada = $horario['entrada'];
				$salida = $horario['salida'];

				$sql = ("call agregar_horario(?, ?, ?, ?)");


				$this->db->query($sql, array($actividad, $dia, $entrada, $salida));
			}
		}

		public function get_actividades() {
			$query = $this->db->get('lista_actividades');
			//chequear fecha de finalizacion

			return $query->result_array();
		}

		public function delete_actividad($id) {
			$this->db->delete('actividad', array('id' => $id));

			if ($this->db->affected_rows() > 0)
				return true;
			else
				return false;
		}

		public function get_usuarios_actividad($id) {
			$query = $this->db->get_where('lista_participantes',array('id_actividad' => $id));
			//chequear fecha de finalizacion

			return $query->result_array();
		}

		public function get_actividades_usuario($id) {
			$query = $this->db->get_where('lista_participantes',array('id_usuario' => $id));
			//chequear fecha de finalizacion

			return $query->result_array();
		}

		public function inscribir_actividad($usuario, $actividad) {
			$sql = ("call inscribir_a_actividad(?, ?)");
			$this->db->query($sql, array($usuario, $actividad));
		}

		public function desinscribir_actividad($usuario, $actividad) {
			$sql = ("call desinscribir_a_actividad(?, ?)");
			$this->db->query($sql, array($actividad, $usuario));
		}

		Actividad por usuario
		Usuario por Actividad
		inscribir a actividades
		desinscribir a actividades
	}

?>