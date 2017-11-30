<?php
  class MUniversidades extends CI_Model{
      
      
      function mread(){
          $this->db->select('Universidades.id,Universidades.univNome,Universidades.univCodigo,Pais.paNome');
          $this->db->from('Universidades');
          $this->db->join('Pais', 'Universidades.Pais_id = Pais.id');
          $consulta = $this->db->get();
          return $consulta->result();
      }

      function mread_x_pais($pid){
        $this->db->select('Universidades.id,Universidades.univNome');
        $this->db->from('Universidades');
        //$this->db->join('Pais', 'Universidades.Pais_id = Pais.id');
        $this->db->where('Universidades.Pais_id',$pid);
        $consulta = $this->db->get();
        return $consulta->result();
    }
      
      function mGetID($Nome){
          $this->db->select('Universidades.id');
          $this->db->from('Universidades');
          $this->db->where('Universidades.univNome', $Nome);
          $consulta = $this->db->get();
          foreach($consulta->result() as $value) {
              return $value->id;
          }
      }
      /*
      public function total(){
        $this->db->select('Ferias.id');
          $this->db->from('Ferias');
        return $this->db->count_all_results();
      }
       */
      function mupdate($id,$univNome,$univCodigo,$Pais_id){
            $dados = array('univNome' => $univNome,'univCodigo' => $univCodigo,'Pais_id' => $Pais_id);
            if($this->db->update('Universidades', $dados, array('id' => $id))){
                return true;
            }else
                return false;
      }
       
    function minsert($univNome,$univCodigo,$Pais_id){
        if($this->db->insert('Universidades', array('univNome' => $univNome,'univCodigo' => $univCodigo,'Pais_id' => $Pais_id)))
        {
            return true;
        }else{
            return false;
        }
           
    }
    function mdelete($id) {
        if($this->db->delete('Universidades', array('id' => $id)))  
            return true;
        else
            return false;
        
    }
       
          
  }
