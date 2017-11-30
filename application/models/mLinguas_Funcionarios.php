<?php
  class MLinguas_Funcionarios extends CI_Model{
      
      function mread(){
          $this->db->select('Linguas_Funcionarios.id,Funcionarios.fNome,Funcionarios.fNomes,Funcionarios.fApelido,Funcionarios.fBI_Passaporte,
              Linguas_Funcionarios.Funcionarios_id,
              Linguas_Funcionarios.linguas_id,Linguas.linNome,
              Linguas_Funcionarios.linguas_nivel_id,Linguas_Nivel.lnNome
              ');
          $this->db->from('Linguas_Funcionarios');
          $this->db->join('Linguas', 'Linguas_Funcionarios.linguas_id = Linguas.id');
          $this->db->join('Funcionarios', 'Linguas_Funcionarios.Funcionarios_id = Funcionarios.id');
          $this->db->join('Linguas_Nivel', 'Linguas_Funcionarios.linguas_nivel_id = Linguas_Nivel.id');
          $consulta = $this->db->get();
          return $consulta->result();
      }
      
      function mreadXid($id){
          $this->db->select('Linguas_Funcionarios.id,Funcionarios.fNome,Funcionarios.fNomes,Funcionarios.fApelido,Funcionarios.fBI_Passaporte,
              Linguas_Funcionarios.Funcionarios_id,
              Linguas_Funcionarios.linguas_id,Linguas.linNome,
              Linguas_Funcionarios.linguas_nivel_id,Linguas_Nivel.lnNome
              ');
          $this->db->from('Linguas_Funcionarios');
          $this->db->join('Linguas', 'Linguas_Funcionarios.linguas_id = Linguas.id');
          $this->db->join('Funcionarios', 'Linguas_Funcionarios.Funcionarios_id = Funcionarios.id');
          $this->db->join('Linguas_Nivel', 'Linguas_Funcionarios.linguas_nivel_id = Linguas_Nivel.id');
          $this->db->where('Linguas_Funcionarios.Funcionarios_id', $id);
          $consulta = $this->db->get();
          return $consulta->result();
      }
      
      public function total(){
        $this->db->select('Linguas_Funcionarios.id');
          $this->db->from('Linguas_Funcionarios');
        return $this->db->count_all_results();
      }
       
    function mupdate($id,$Funcionarios_id,$linguas_id,$linguas_nivel_id){
            $dados = array('Funcionarios_id'=>$Funcionarios_id,'linguas_id'=>$linguas_id,'linguas_nivel_id'=>$linguas_nivel_id);
            if($this->db->update('Linguas_Funcionarios', $dados, array('id' => $id))){
                return true;
            }else
                return false;
    }
       
    function minsert($Funcionarios_id,$linguas_id,$linguas_nivel_id){
        if($this->db->insert('Linguas_Funcionarios', array('Funcionarios_id'=>$Funcionarios_id,'linguas_id'=>$linguas_id,'linguas_nivel_id'=>$linguas_nivel_id)))
        {
            return true;
        }else{
            return false;
        }
           
    }
    function mdelete($id) {
        if($this->db->delete('Linguas_Funcionarios', array('id' => $id)))  
            return true;
        else
            return false;
        
    }
       
          
  }
