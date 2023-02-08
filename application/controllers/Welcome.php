<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

		public function __construct(){
			parent::__construct();
			session_start();
		}
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	public function index()
	{
		$this->load->view('loginUser');
	}

	public function connadmin(){
		$this->load->view('Admin');
	}

	public function suggest(){
		$this->load->view('Suggestion');
	}

	public function inscri()
	{
		$this->load->view('Inscription');
	}

	// public function actualite(){
	// 	$this->load->library('session');
	// 	//$this->load->model('FindDatabase');
	// 	//$this->FindDatabase->findmyobject($_SESSION['iduser']);
		
	// 	// echo $this->session->userdata('');
	// 	echo $_SESSION['iduser'];
	// 	//$this->load->view('ListeObject');
	// }
	public function formulaire(){
		$this->load->model('FindDatabase');

		$data['categ']=$this->FindDatabase->findallCateg();

		$this->load->view('Formulaire',$data);
	}

	public function addobject(){
		$config['upload_path'] = './assets/uploads/';
	    $config['allowed_types'] = 'jpg|jpeg|png|gif|PNG';
	    $config['max_size'] = 100000000;
	    $config['max_width'] = 99999;
	    $config['max_height'] = 99999;

	    $this->load->library('upload', $config);

	    if (!$this->upload->do_upload('userfile'))
	    {
	        $error = array('error' => $this->upload->display_errors());
	        echo "tay";
	    }
	    else
	    {
	        $data = array('upload_data' => $this->upload->data());
	        echo "mety";

	    }

	}
}