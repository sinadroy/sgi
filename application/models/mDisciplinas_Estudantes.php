<?php
class MDisciplinas_Estudantes extends CI_Model {
	
	function mread() {
		$this->db->select('Disciplinas_Estudantes.id,
            Candidatos.id as cid,Candidatos.cNome,Candidatos.cNomes,Candidatos.cApelido,Candidatos.cBI_Passaporte,
            Disciplinas.id as did,Disciplinas.dNome');
		$this->db->from('Disciplinas_Estudantes');
        $this->db->join('Estudantes', 'Disciplinas_Estudantes.Estudantes_id = Estudantes.id');
        $this->db->join('Candidatos', 'Estudantes.Candidatos_id = Candidatos.id');
		$this->db->join('Disciplinas', 'Disciplinas_Estudantes.Disciplinas_id = Disciplinas.id');
        $this->db->order_by('cNome,cApelido','ASC');
		$consulta = $this->db->get();
		$ord=1;
		$data = array();
		foreach ($consulta->result() as $row) {
			$data[] = array(
                "id" => $row->id,
                "ord" => $ord,
                "cid" => $row->cid,
                "cNome" => $row->cNome,
                "cNomes" => $row->cNomes,
                "cApelido" => $row->cApelido,
                "cBI_Passaporte" => $row->cBI_Passaporte,
                "did" => $row->did,
                "dNome" => $row->dNome
			);
			$ord++;	
		}
		return $data;
	}
	
	function mdt_acesso_dados_estudante($bi){
        $this->db->select('id');
        $this->db->from('pautas');
        $this->db->join('Estudantes','pautas.Estudantes_id = Estudantes.id');
        $this->db->join('Candidatos','Estudantes.Candidatos_id = Candidatos.id');
        $this->db->join('Disciplinas','pautas.Disciplinas_id = Disciplinas.id');
        $this->db->where('Candidatos.cBI_Passaporte', $bi);
        $this->db->where('pautas.Disciplinas_id', $idd);
        if($this->db->count_all_results() > 0)
            return true;
        else
            return false;
	}

	/*    
    *Insertar en la tabla estudiantes los datos:    
    *Candidatos_id    
    *niveis_cursos_id    
    *Data_Matricula    
    */
	function minsert($Estudantes_id,$Disciplinas_id){
        $dados = array('Estudantes_id'=>$Estudantes_id, 'Disciplinas_id'=>$Disciplinas_id);
        if ($this->db->insert('Disciplinas_Estudantes', $dados))
            return true;
        else
            return false;
	}
	
	function mupdate($id,$Estudantes_id,$Disciplinas_id) {
		$dados = array('Estudantes_id'=>$Estudantes_id, 'Disciplinas_id'=>$Disciplinas_id);
		if ($this->db->update('Disciplinas_Estudantes', $dados, array('id' => $id))) {
			return true;
		}else
		    return false;
	}
	
	function mdelete($id) {
		if($this->db->delete('Disciplinas_Estudantes', array('id' => $id)))
			return true;
		else
			return false;
	}
}