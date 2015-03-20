
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Actividades extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->library('table');
  		$template = array('table_open' => "<table class='table table-condensed table-striped'");
  		$this->table->set_template($template);

	}	

	public function index()
	{	

		$this->load->model('actividad');
		$datos['actividades']=$this->actividad->DevolverActividades();
		$datos['instructores']=$this->actividad->DevolverInstructores();
		$this->load->view('pages/actividades',$datos);
	}

	public function agregar(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('nombre','Nombre','required|is_unique[actividad.nombre]');
		$this->form_validation->set_rules('descripcion','Descripcion','required');
		$this->form_validation->set_rules('fecha','Fecha','required');
		#$this->form_validation->set_message('required','El campo %s es obligatorio');
		#$this->form_validation->set_message('is_unique','El campo %s debe ser unico');

		if($this->form_validation->run()!=false){

			$nombre=$_POST['nombre'];
			$descripcion=$_POST['descripcion'];
			$fecha=$_POST['fecha'];
			$instructor=$_POST['instructor'];

			$data=array ('0'=>$nombre,'1'=>$descripcion,'2'=>$instructor,'3'=>$fecha);

			$this->load->model('actividad');
			$this->actividad->AgregarActividad($data);
			$datos['actividades']=$this->actividad->DevolverActividades();
			$datos['mensaje']='Actividad Agregada';

			$this->load->view('pages/actividades',$datos);


		}
		else
		{
			$this->load->model('actividad');
			$datos['actividades']=$this->actividad->DevolverActividades();	
	
			$this->load->view('pages/actividades',$datos);
		}

	}
	public function mostrarActividades(){
		$this->load->model('actividad');
		$datos['actividades']=$this->actividad->DevolverActividades();
		$this->load->view('pages/actividades',$datos);

	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */