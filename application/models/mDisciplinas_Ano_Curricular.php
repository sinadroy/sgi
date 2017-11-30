<?php

class MDisciplinas_Ano_Curricular extends CI_Model {

    function mread() {
        $this->db->select('Disciplinas_Ano_Curricular.id,Disciplinas_Ano_Curricular.Disciplinas_id,Disciplinas_Ano_Curricular.Ano_Curricular_id');
        $this->db->from('Disciplinas_Ano_Curricular');
        $consulta = $this->db->get();
        return $consulta->result();
    }

    function mGetAnoC($idd) {
        $this->db->select('Ano_Curricular.acNome');
        $this->db->from('Disciplinas_Ano_Curricular');
        $this->db->join('Ano_Curricular', 'Disciplinas_Ano_Curricular.Ano_Curricular_id = Ano_Curricular.id');
        $this->db->where('Disciplinas_Ano_Curricular.disciplinas_id', $idd);
        $consulta = $this->db->get();
        foreach ($consulta->result() as $value) {
            return $value->acNome;
        }
    }
    function mGetAnoIdC($idd) {
        $this->db->select('Ano_Curricular.id');
        $this->db->from('Disciplinas_Ano_Curricular');
        $this->db->join('Ano_Curricular', 'Disciplinas_Ano_Curricular.Ano_Curricular_id = Ano_Curricular.id');
        $this->db->where('Disciplinas_Ano_Curricular.disciplinas_id', $idd);
        $consulta = $this->db->get();
        foreach ($consulta->result() as $value) {
            return $value->id;
        }
    }

    /* function mupdate($id,$Disciplinas_id,$Ano_Curricular_id){
      $dados = array('Disciplinas_id' => $Disciplinas_id,'Ano_Curricular_id' => $Ano_Curricular_id);
      if($this->db->update('Disciplinas_Ano_Curricular', $dados, array('id' => $id))){
      return true;
      }else
      return false;
      } */

    function mupdate($Disciplinas_id, $Ano_Curricular_id) {
        $dados = array('Ano_Curricular_id' => $Ano_Curricular_id);
        if ($this->db->update('Disciplinas_Ano_Curricular', $dados, array('disciplinas_id' => $Disciplinas_id))) {
            return true;
        } else
            return false;
    }

    function minsert($Disciplinas_id, $Ano_Curricular_id) {
        if ($this->db->insert('Disciplinas_Ano_Curricular', array('Disciplinas_id' => $Disciplinas_id, 'Ano_Curricular_id' => $Ano_Curricular_id))) {
            return true;
        } else {
            return false;
        }
    }

    function mdelete($id) {
        if ($this->db->delete('Disciplinas_Ano_Curricular', array('id' => $id)))
            return true;
        else
            return false;
    }

}

?>
