<?php
  class MPeriodos extends CI_Model{
      
      function mread(){
          $this->db->select('Periodos.id,Periodos.pNome,Periodos.pCodigo');
          $this->db->from('Periodos');
          $consulta = $this->db->get();
          return $consulta->result();
      }
      function mGetID($Nome){
          $this->db->select('periodos.id');
          $this->db->from('periodos');
          $this->db->where('periodos.pNome', $Nome);
          $consulta = $this->db->get();
          foreach($consulta->result() as $value) {
              return $value->id;
          }
      }
      function mGetNome($id){
        $this->db->select('periodos.pNome');
        $this->db->from('periodos');
        $this->db->where('periodos.id', $id);
        $consulta = $this->db->get();
        foreach($consulta->result() as $value) {
            return $value->pNome;
        }
    }
      function mGet_total_X_periodoID($id,$al){
          $this->db->select('count(candidatos.id) as total');
          $this->db->from('candidatos');
          $this->db->join('cursos_pretendidos', 'cursos_pretendidos.Candidatos_id = candidatos.id');
          $this->db->join('niveis_cursos', 'cursos_pretendidos.niveis_cursos_id = niveis_cursos.id');
          $this->db->join('periodos', 'niveis_cursos.periodos_id = periodos.id');
          $this->db->join('anos_lectivos', 'candidatos.anos_lectivos_id = anos_lectivos.id');
          $this->db->where('anos_lectivos.alAno', $al);
          $this->db->where('periodos.id', $id);
          $consulta = $this->db->get();
          $data = array();
          foreach($consulta->result() as $row) {
              return $row->total;
          }
      }
      function mGet_total_X_periodo_estadistica($al){
          $al = ($al != "")?$al:date('Y');
          $this->db->select('periodos.id,periodos.pNome');
          $this->db->from('periodos');
          //$this->db->where('cursos.id', $Nome);
          $consulta = $this->db->get();
          $data = array();
          foreach($consulta->result() as $row) {
              $data[] = array(
                "id" => $row->id,
                "periodo"=> $row->pNome,
                "quantidade" => $this->mGet_total_X_periodoID($row->id,$al),
                "color" => ($row->pNome == "regular")?"#36abee":"#ee9e36",
            );
          }
          return $data;
      }
      function mGetIDXCodigo($Codigo){
          $this->db->select('Periodos.id');
          $this->db->from('Periodos');
          $this->db->where('Periodos.pCodigo', $Codigo);
          $consulta = $this->db->get();
          foreach($consulta->result() as $value) {
              return $value->id;
          }
      }
      public function total(){
        $this->db->select('Periodos.id');
          $this->db->from('Periodos');
        return $this->db->count_all_results();
      }
      function mupdate($id,$Nome,$Codigo){
            $dados = array('pNome' => $Nome,'pCodigo' => $Codigo);
            if($this->db->update('Periodos', $dados, array('id' => $id))){
                return true;
            }else
                return false;
      }
      
    function minsert($Nome,$Codigo){
        if($this->db->insert('Periodos', array('pNome' => $Nome,'pCodigo' => $Codigo)))
        {
            return true;
        }else{
            return false;
        }
           
    }
    function mdelete($id) {
        if($this->db->delete('Periodos', array('id' => $id)))  
            return true;
        else
            return false;
        
    }
       
           
  }
?>
