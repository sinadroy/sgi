<?php

class MDisciplinas_Semestres extends CI_Model {

    function mread() {
        $this->db->select('disciplinas_semestres.id,disciplinas_semestres.Disciplinas_id,disciplinas_semestres.Semestres_id');
        $this->db->from('disciplinas_semestres');
        $consulta = $this->db->get();
        return $consulta->result();
    }

    function mexiste($idd){
        $this->db->select('id');
        $this->db->from('disciplinas_semestres');
        $this->db->where('Disciplinas_id', $idd);
        if($this->db->count_all_results() > 0)
            return true;
        else
            return false;
    }

    /*
      function mupdate($id,$Disciplinas_id,$Semestres_id){
      $dados = array('Disciplinas_id' => $Disciplinas_id,'Semestres_id' => $Semestres_id);
      if($this->db->update('disciplinas_semestres', $dados, array('id' => $id))){
      return true;
      }else
      return false;
      }
     */

    function mupdate($Disciplinas_id, $Semestres_id) {
        $dados = array('Semestres_id' => $Semestres_id);
        if ($this->db->update('disciplinas_semestres', $dados, array('Disciplinas_id' => $Disciplinas_id))) {
            return true;
        } else
            return false;
    }

    function minsert($Disciplinas_id, $Semestres_id) {
        if ($this->db->insert('disciplinas_semestres', array('Disciplinas_id' => $Disciplinas_id, 'Semestres_id' => $Semestres_id))) {
            return true;
        } else {
            return false;
        }
    }

    function mdelete($id) {
        if ($this->db->delete('disciplinas_semestres', array('id' => $id)))
            return true;
        else
            return false;
    }

}

?>
