<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cartelera extends CI_Controller {

	public function index()
	{	
		$noticias[]= array('titulo'=>'Hoy es viernes Joda Joda','im'=>'http://www.generadormemes.com/media/created/z7ltvf.jpg');
		$noticias[]=array ('titulo'=>'Messie Pasalaa','im'=>'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRrUgm66fzrHBwQlwYdmaDvG3_BVb2sPwAbAZaLugS21K24aaTzCQ');

		$data['getnoticias']=$noticias;

		$this->load->view('pages/noticias',$data);
	}
}

