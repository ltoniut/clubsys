<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cartelera extends CI_Controller {

	public function index()
	{	
		$noticias[]= array('titulo'=>'Boca vs Colon','im'=>'http://www.ole.com.ar/boca-juniors/futbol/inicial-Vasco-Arruabarrena-Santa-Fe_OLEIMA20150309_0062_14.jpg','cont'=>'El Cata Díaz en el fondo y Gago en el medio, calificados con 7 por Olé, fueron de lo mejorcito del Xeneize en el Cementerio de los Elefantes. ¿Cómo viste la reacción de Orion en el empate Sabalero? ¿Y tu figura quién fue?');
		$noticias[]=array ('titulo'=>'Messie Pasalaa','im'=>'http://www.ole.com.ar/river-plate/futbol/Caras-dicen-comodo-doloroso_OLEIMA20150309_0063_14.jpg','cont'=>'Ponzio y Mayada se llevaron un 7 para Olé, dentro de un Millo que fue de mayor a menor y que, analizando el boletín, acumuló varios cuatro. ¿Coincidís?');

		$data['getnoticias']=$noticias;

		$this->load->view('pages/noticias',$data);
	}
}

