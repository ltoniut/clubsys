<?php if ( ! defined('BASEPATH')) exit ('No direct script access allowed');
class Socios_model extends CI_model {
	public function __construct() {
		$this->load->database();
	}
	public function get_socios() {
		$socios = array(
			array(
				'#' => 1,
				'Tipo' => 'Instructor',
				'Apellidos y nombres' => 'Facal, Julio',
				'Dirección' => 'Perú 1819',
				'Fecha de nacimiento' => '1989-09-18',
				'Fecha de inscripción' => '2015-03-06 12:11:31'
				),
				array(
					'#' => 2,
					'Tipo' => 'Socio',
					'Apellidos y nombres' => 'Fulanito, Cosme',
					'Dirección' => 'Perú 1819',
					'Fecha de nacimiento' => '1989-09-18',
					'Fecha de inscripción' => '2015-03-06 12:11:31'
					),
				array(
					'#' => 3,
					'Tipo' => 'Socio',
					'Apellidos y nombres' => 'Josefo, Juanestrella',
					'Dirección' => 'Perú 1819',
					'Fecha de nacimiento' => '1989-09-18',
					'Fecha de inscripción' => '2015-03-06 12:11:31'
					),
				array(
					'#' => 4,
					'Tipo' => 'Instructor',
					'Apellidos y nombres' => 'Zeppeli, William',
					'Dirección' => 'Perú 1819',
					'Fecha de nacimiento' => '1989-09-18',
					'Fecha de inscripción' => '2015-03-06 12:11:31'
					),
				array(
					'#' => 5,
					'Tipo' => 'Socio',
					'Apellidos y nombres' => 'del Ocho, Chavo',
					'Dirección' => 'Perú 1819',
					'Fecha de nacimiento' => '1989-09-18',
					'Fecha de inscripción' => '2015-03-06 12:11:31'
					)
			);
		return $socios;
	}
}