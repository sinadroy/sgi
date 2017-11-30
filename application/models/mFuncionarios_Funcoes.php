<?php
  class MFuncionarios_Funcoes extends CI_Model{
      
      function mread(){
          $ord=1;
          $this->db->select('Funcoes.id,funcNome,funcCodigo');
          $this->db->from('Funcoes');
          $consulta = $this->db->get();
          foreach($consulta->result() as $row){
             if($row->funcCodigo != '0' || $row->funcCodigo != '00' || $row->funcCodigo != '000')
             {
                $data[] = array(
                    "ord"=>$ord,
                    "id"=>$row->id,
                    "funcNome"=>$row->funcNome,
                    "value"=>$row->funcNome,
                    "funcCodigo"=>$row->funcCodigo,
                );
                $ord++;
             }
          }
        return $data;
      }
      function mread_combos(){
          $ord=1;
          $this->db->select('Funcoes.id,funcNome,funcCodigo');
          $this->db->from('Funcoes');
          $consulta = $this->db->get();
          foreach($consulta->result() as $row){
              $data[] = array(
                  "ord"=>$ord,
                  "id"=>$row->id,
                  "funcNome"=>$row->funcNome,
                  "value"=>$row->funcNome,
                  "funcCodigo"=>$row->funcCodigo,
              );
              $ord++;
          }
        return $data;
      }
      function mGetID($Nome){
          $this->db->select('Funcoes.id');
          $this->db->from('Funcoes');
          $this->db->where('Funcoes.funcNome', $Nome);
          $consulta = $this->db->get();
          foreach($consulta->result() as $value) {
              return $value->id;
          }
      }
      function mupdate($id,$funcNome,$funcCodigo){
            $dados = array('funcNome'=>$funcNome,'funcCodigo'=>$funcCodigo);
            if($this->db->update('Funcoes', $dados, array('id' => $id))){
                return true;
            }else
                return false;
      }
      
    function minsert($funcNome,$funcCodigo){
        if($this->db->insert('Funcoes', array('funcNome'=>$funcNome,'funcCodigo'=>$funcCodigo)))
        {
            return true;
        }else{
            return false;
        }
           
    }
    function mdelete($id) {
        if($this->db->delete('Funcoes', array('id' => $id)))  
            return true;
        else
            return false;
        
    }         
}
