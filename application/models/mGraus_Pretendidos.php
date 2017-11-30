<?php
  class MGraus_Pretendidos extends CI_Model{
      
      
      function mread(){
          $this->db->select('Graus_Pretendidos.id,Graus_Pretendidos.gpNome,Graus_Pretendidos.gpCodigo');
          $this->db->from('Graus_Pretendidos');
          //$this->db->join('Funcionarios', 'Ferias.Funcionarios_id = Funcionarios.id');
          $consulta = $this->db->get();
          return $consulta->result();
      }
      
      function mGetID($Nome){
          $this->db->select('Graus_Pretendidos.id');
          $this->db->from('Graus_Pretendidos');
          $this->db->where('Graus_Pretendidos.gpNome', $Nome);
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
      function mupdate($id,$gpNome,$gpCodigo){
            $dados = array('gpNome' => $gpNome,'gpCodigo' => $gpCodigo);
            if($this->db->update('Graus_Pretendidos', $dados, array('id' => $id))){
                return true;
            }else
                return false;
      }
       
    function minsert($id,$gpNome,$gpCodigo){
        if($this->db->insert('Graus_Pretendidos', array('gpNome' => $gpNome,'gpCodigo' => $gpCodigo)))
        {
            return true;
        }else{
            return false;
        }
           
    }
    function mdelete($id) {
        if($this->db->delete('Graus_Pretendidos', array('id' => $id)))  
            return true;
        else
            return false;
        
    }
       
          
  }
