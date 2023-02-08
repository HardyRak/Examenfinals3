<?php
defined('BASEPATH') OR exit('No direct script access allowed');
	class Login extends CI_Controller
	{
		public function __construct(){
			parent::__construct();
			session_start();
		}

		public function loginuser(){
			$mail=$this->input->post('mail');
			$mdp=$this->input->post('mdp');
			
			$this->load->model('FindDatabase');

			$data=$this->FindDatabase->getloging($mail,$mdp);
			$this->load->helper('url_helper');
			if (count($data)==0) {
				redirect('welcome/index?err=Ce compte n exist pas');
			}else{
				$id=$data[0]->idUser;
				//$this->load->library('session');
				// $this->session->set_userdata('iduser',$id);
				$_SESSION['iduser']=$id;
				$session=$_SESSION['iduser'];
				$perso= array();
				$perso['user']=$this->FindDatabase->findUser($session);
				$perso['objet']=$this->FindDatabase->findmyobject($session);
				$perso['nav']=1;
				$this->load->view('ListeObject',$perso);
			}
		}
		public function profadmin(){
			$this->load->view('AdminPage');
		}

		public function loginadmin(){
			$mail=$this->input->post('mail');
			$mdp=$this->input->post('mdp');

			$this->load->model('FindDatabase');
			$data=$this->FindDatabase->findadmin($mail,$mdp);
			
			if (count($data)==0) {

			}else{
				$id=$data[0]->idAdmin;
				//$this->load->library('session');
				//$this->session->set_userdata('iduser',$id);
				$_SESSION['iduser']=$id;
				$this->load->view('AdminPage');
			}
		}

		public function listtoutobj(){
			$this->load->model('FindDatabase');
			$perso['user']=$this->FindDatabase->findUser($_SESSION['iduser']);
			$perso['objet']=$this->FindDatabase->listeobject($_SESSION['iduser']);
			$perso['nav']=0;
			$this->load->view('ListeObject',$perso);
		}

		public function profil(){
			$this->load->model('FindDatabase');
			$perso['user']=$this->FindDatabase->findUser($_SESSION['iduser']);
			$perso['objet']=$this->FindDatabase->findmyobject($_SESSION['iduser']);
			$perso['nav']=1;
			$this->load->view('ListeObject',$perso);
		}

		public function suggerer(){
			$idobj=$this->input->get('idobj');
			$this->load->model('FindDatabase');
			$obj['object']=$this->FindDatabase->findmyobjectcat($_SESSION['iduser']);

			$_SESSION['myobject']=$idobj;

			$this->load->view('Suggestion',$obj);
		}
		public function messuggestion(){
			$idproko=$this->input->get('myobject');
			$idpro=$this->input->get('idobject');
			$idUseroul=$this->input->get('idname');
			$idUserza=$_SESSION['iduser'];

			$data = array('idObjetako' => $idproko,'idObjetcontre' => $idpro,'idUserza' => $idUserza,'idUseroul' => $idUseroul,'idprop'=>null);

			$this->load->model('InsertDatabase');
			$this->InsertDatabase->insertPropositions($data);
			
			$this->load->model('FindDatabase');
			$data1['user']=$this->FindDatabase->findUser($_SESSION['iduser']);
			$data1['liste']=$this->FindDatabase->getmyproposition($_SESSION['iduser']);
			$data1['nav']=2;

			$this->load->view('ListeObject',$data1);
			$this->load->helper('url_helper');
			redirect('Login/messuggestionnav');
		}
		public function messuggestionnav(){
			$this->load->model('FindDatabase');
			$data1['user']=$this->FindDatabase->findUser($_SESSION['iduser']);
			$data1['liste']=$this->FindDatabase->getmyproposition($_SESSION['iduser']);
			$data1['nav']=2;
			$this->load->view('ListeObject',$data1);	
		}
		public function listsuggerersurmonprod($idobj){
			$this->load->model('FindDatabase');
			$data['liste']=$this->FindDatabase->getProposition();
		}
		public function gestionAdmin($idcate){
			$this->load->model('FindDatabase');
			$tab=$this->FindDatabase->gestionCategorie($idcate);
		}

		public function recherche(){
			$idcat=$this->input->post('idCategorie');
			$titre=$this->input->post('titre');
			$this->load->model('FindDatabase');
			$liste['rech']=$this->FindDatabase->search($idcat,$titre);
			$liste['user']=$this->FindDatabase->findUser($_SESSION['iduser']);
			$liste['objet']=$this->FindDatabase->search($idcat,$titre);
			$liste['nav']=3;
			$this->load->view('ListeObject',$liste);
		}

		public function inscription()
		{
			$nom=$this->input->post('name');
			$mail=$this->input->post('mail');
			$mdp=$this->input->post('mdp');
			$tab = array('idUser' => null ,'nom'=>$nom,'email'=>$mail,'psswd'=>$mdp);
			if (count($tab)==0) {
				redirect('welcome/inscri?err=Verifiez votre inscription');
			}else{
			$this->load->model('InsertDatabase');
			$this->InsertDatabase->insertuser($tab);
			$this->load->helper('url_helper');
			$this->load->view('loginUser');
			}
		}

		public function tehanakalo(){
			$idpro=$this->input->post('idprod');
			$this->load->model('FindDatabase');
			$data['mpangataka']=$this->FindDatabase->getmisymiproposer($idpro);

			$this->load->view('MonSuggestion',$data);
		}

		public function annulationproposition(){
			$idprod=$this->input->get('idprod');
			$this->load->model('Delete');
			$this->Delete->deletepropo($idprod);

			$this->load->model('FindDatabase');
			$data1['user']=$this->FindDatabase->findUser($_SESSION['iduser']);
			$data1['liste']=$this->FindDatabase->getmyproposition($_SESSION['iduser']);
			$data1['nav']=2;
		
			$this->load->view('ListeObject',$data1);
		}
		public function annulationproposition2(){
			$idprod=$this->input->get('idprod');
			$this->load->model('Delete');
			$this->Delete->deletepropo($idprod);

			$this->load->model('FindDatabase');
			$data1['user']=$this->FindDatabase->findUser($_SESSION['iduser']);
			$data1['liste']=$this->FindDatabase->getmyproposition($_SESSION['iduser']);
			$data1['nav']=2;
		
			$this->load->helper('url_helper');
			redirect('Login/profil');
		}

		public function accepter(){
			$idprop=$this->input->get('idprod');
			$this->load->model('FindDatabase');
			$obj=$this->FindDatabase->getpropo($idprop);
			$this->load->model('Delete');
			$id1=$obj[0]->idObjetako;
			$id2=$obj[0]->idObjetcontre;
			$data1= array('idUser'=>$obj[0]->idUserza);
			$data2 = array('idUser'=>$obj[0]->idUseroul);
			;
			$this->Delete->update($id1,$id2,$data2,$data1);

			$this->load->model('InsertDatabase');

			$datetime=new DateTime();
			$datest=$datetime->format('Y-m-d H:i:s');

			$datah = array('idObjet' => $id1,'idObjetnatakalo'=> $id2,'idUser'=> $obj[0]->idUserza,'idUser1'=> $obj[0]->idUseroul,'dates'=>$datest);
			
			$this->InsertDatabase->inserthistorique($datah);
			$this->Delete->deletepropo($idprop);
			$this->load->helper('url_helper');
			redirect('Login/profil');
		}
		public function logout(){
			session_destroy();
			$this->load->helper('url_helper');
			redirect(base_url().'Welcome');
		}
		public function statistic(){
			$this->load->model('FindDatabase');
			$users=$this->FindDatabase->countuser();
			$echanges=$this->FindDatabase->countechange();
			$data['user']=$users;
			$data['echange']=$echanges;
			$this->load->view('Statistic',$data);
		}
	}
?>