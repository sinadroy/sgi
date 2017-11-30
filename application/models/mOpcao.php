<?php
  class MOpcao extends CI_Model{
      
      function mread(){
          $ord=1;
          $this->db->select('id,opcNome,opcCodigo');
          $this->db->from('Opcao');
          $consulta = $this->db->get();
          foreach($consulta->result() as $row){
              $data[] = array(
                  "ord"=>$ord,
                  "id"=>$row->id,
                  "opcNome"=>$row->opcNome,
                  "value"=>$row->opcNome,
                  "opcCodigo"=>$row->opcCodigo,
              );
              $ord++;
          }
        return $data;
      }
      function mreadXtipo($escola){
          $ord=1;
          $this->db->select('Opcao.id,Opcao.opcNome,Opcao.opcCodigo');
          $this->db->from('Opcao');
          $this->db->join('Escola_Formacao_Opcao','Escola_Formacao_Opcao.Opcao_id = Opcao.id');
          $this->db->where('Escola_Formacao_Opcao.Escola_Formacao_id',$escola);
          $consulta = $this->db->get();
          foreach($consulta->result() as $row){
              $data[] = array(
                  "ord"=>$ord,
                  "id"=>$row->id,
                  "opcNome"=>$row->opcNome,
                  "value"=>$row->opcNome,
                  "opcCodigo"=>$row->opcCodigo,
              );
              $ord++;
          }
        return $data;
      }
      function mreadX($opcNome){
          $ord=1;
          $this->db->select('Opcao.id');
          $this->db->from('Opcao');
          //$this->db->join('Escola_Formacao_Opcao','Escola_Formacao_Opcao.Opcao_id = Opcao.id');
          $this->db->where('Opcao.opcNome',$opcNome);
          $consulta = $this->db->get();
          foreach($consulta->result() as $row){
              return $row->id;
          }
      }
      function mupdate($id,$opcNome,$opcCodigo){
            $dados = array('opcNome'=>$opcNome,'opcCodigo'=>$opcCodigo);
            if($this->db->update('Opcao', $dados, array('id' => $id))){
                return true;
            }else
                return false;
      }
      
    function minsert($opcNome,$opcCodigo){
        if($this->db->insert('Opcao', array('opcNome'=>$opcNome,'opcCodigo'=>$opcCodigo)))
        {
            return true;
        }else{
            return false;
        }
           
    }
    function mdelete($id) {
        if($this->db->delete('Opcao', array('id' => $id)))  
            return true;
        else
            return false;
        
    }         
}
