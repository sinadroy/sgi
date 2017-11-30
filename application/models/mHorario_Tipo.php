<?php
  class MHorario_Tipo extends CI_Model{
      
      function mread(){
          $this->db->select('Horario_Tipo.id,Horario_Tipo.htNome,Horario_Tipo.htCodigo,Horario_Tipo.htDescricao');
          $this->db->from('Horario_Tipo');
          
          $consulta = $this->db->get();
          $data = array();
          foreach($consulta->result() as $row){
              //$data[] = $row;
              $data[] = array(
                  "id"=>$row->id,
                  "htNome"=>$row->htNome,
                  "value"=>$row->htNome,
                  "htCodigo"=>$row->htCodigo,
                  "htDescricao"=>$row->htDescricao,
              );
          }
        return $data;
      }
      function mupdate($id,$Nome,$Codigo,$Descricao){
            $dados = array('htNome' => $Nome,'htCodigo' => $Codigo, 'htDescricao'=>$Descricao);
            if($this->db->update('Horario_Tipo', $dados, array('id' => $id))){
                return true;
            }else
                return false;
      }
      
    function minsert($Nome,$Codigo,$Descricao){
        if($this->db->insert('Horario_Tipo', array('htNome' => $Nome,'htCodigo' => $Codigo,'htDescricao'=>$Descricao)))
        {
            return true;
        }else{
            return false;
        }
           
    }
    function mdelete($id) {
        if($this->db->delete('Horario_Tipo', array('id' => $id)))  
            return true;
        else
            return false;
        
    }         
}
