<?php 
	class Delete extends CI_Model
	{
		
		public function deletepropo($idprop){
			$this->db->where('idprop',$idprop);
			$this->db->delete('Propositions');
		} 

		public function update($id1,$id2,$data1,$data2){
			$this->db->where('idObjet',$id1);
			$this->db->update('objets',$data1);

			$this->db->where('idObjet',$id2);
			$this->db->update('objets',$data2);
			
		}
	}

?>