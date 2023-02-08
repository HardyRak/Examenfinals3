<?php
	class InsertDatabase extends CI_Model
	{
		
		public function insertObject($data){
			$this->db->insert('Objets',$data);
		}

		public function insertuser($data){
			$this->db->insert('users',$data);
		}
		public function insertPropositions($data){
			$this->db->insert('Propositions',$data);
		}
		public function inserthistorique($data){
			$this->db->insert('historique',$data);
		}
	}
?>