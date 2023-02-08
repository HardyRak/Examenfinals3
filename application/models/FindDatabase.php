<?php 
	class FindDatabase extends CI_Model{
		public function __construct(){
			parent::__construct();
			$this->load->database();
		}

		public function findadmin($email,$mdp){
			$query=$this->db->get_where('Admnistrateur',array('email'=>$email,'psswd'=>$mdp));
			return $query->result();
		}

		public function findalluser(){
			$query=$this->db->get('Users');
			return $query->result();	
		}

		public function findUser($id){
			$query=$this->db->get_where('Users',array('iduser'=>$id));
			return $query->result();
		}

		public function getloging($mail,$mdp){
			$query=$this->db->get_where('users',array('email'=>$mail,'psswd'=>$mdp));
			
			return $query->result();
		}

		public function findallobject(){
			$query=$this->db->get('Objets');
			return $query->result();	
		}
		public function findobject($id){
			$this->db->select('*');
			$this->db->from('Objets');
			$this->db->join('Categorie','Objets.idCategorie=Categorie.idCategorie');
			$this->db->where('Objets.idUser !=',$id);
			$query=$this->db->get();
			return $query->result();
		}
		public function findmyobject($idperso){
			$query=$this->db->get_where('Objets',array('iduser'=>$idperso));
			return $query->result();
		}
		 public function findobjectOB($idob){
			$query=$this->db->get_where('Objets',array('idObjet'=>$idob));
			return $query->result();
		}

		public function findmyobjectcat($idperso){
			$this->db->select('*');
			$this->db->from('Objets');
			$this->db->join('Categorie','Objets.idCategorie=Categorie.idCategorie');
			$this->db->where('Objets.idUser =',$idperso);
			$query=$this->db->get();
			return $query->result();
		}
		public function findallCateg(){
			$query=$this->db->get('Categorie');
			return $query->result();	
		}

		public function findcateg($idcat){
			$query=$this->db->get_where('Categorie',array('idCategorie'=>$idcat));
			return $query->result();	
		}

		public function findallhisto(){
			$query=$this->db->get('historique');
			return $query->result();
		}

		public function findMyhistorique($id){
			$query=$this->db->get_where('historique',array('idObjet'=>$id));
			return $query->result();
		}

		public function search($idcat,$titre){
			$this->db->select('*');
			$this->db->from('Objets');
			$this->db->join('Users','Objets.idUser=Users.idUser');
			$this->db->where('idCategorie',$idcat);
			$this->db->where('Titre',$titre);
			$query=$this->db->get();
			return $query->result();
		}
		public function listeobject($iduser){
			$this->db->select('*');
			$this->db->from('Objets');
			$this->db->join('Users','Objets.idUser=Users.idUser');

			$this->db->where('Objets.idUser !=',$iduser);
			$query=$this->db->get();
			return $query->result();
		}

		public function getProposition($idobj){
			$query=$this->db->get_where('Propositions',array('idObjetako' => $idobj));
			return $query->result();
		}

		public function gestionCategorie($idcate){
			$this->db->select('*');
			$this->db->from('Objets');
			$this->db->where('idCategorie =',$idcate);
			$query=$this->db->get();
			return $query->result();
		}

		//select*from propositions join objets on propositions.idObjetako=Objets.idObjet;

		public function getmyproposition($idpers){
			$query=$this->db->get_where('Propositions',array('idUserza' => $idpers));
			return $query->result();
			return $query->result();
		}

		public function getmisymiproposer($idObjetcontre){
			$query=$this->db->get_where('Propositions',array('idObjetcontre' => $idObjetcontre));
			return $query->result();
			return $query->result();
		}

		public function getpropo($idprop){
			$query=$this->db->get_where('Propositions',array('idprop' => $idprop));
			return $query->result();
			return $query->result();
		}
		public function countuser(){
			$this->db->select('count(idUser) as ur');
			$this->db->from('Users');
			$query=$this->db->get();
			return $query->result();
		}
		public function countechange(){
			$this->db->select('count(dates) as ec');
			$this->db->from('historique');
			$query=$this->db->get();
			return $query->result();
		}
	}		
?>