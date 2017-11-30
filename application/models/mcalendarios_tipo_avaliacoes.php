<?php
  class Mcalendarios_tipo_avaliacoes extends CI_Model{
      
      function mread(){
          $this->db->select('id,ava_nome');
          $this->db->from('avaliacoes');
          $consulta = $this->db->get();
          //return $consulta->result();
            $ord = 1;
            foreach($consulta->result() as $row){
                $al[] = array(
                    "ord"=>$ord,
                    "id"=>$row->id,
                    "value"=>$row->ava_nome,
                    "ava_nome"=>$row->ava_nome
                );
                $ord++;
            }
            $data = json_encode($al);
            return $data;
      }
      function mreadX($id){
          $this->db->select('ava_nome');
          $this->db->from('avaliacoes');
          $this->db->where('id', $id);
          $consulta = $this->db->get();
          foreach($consulta->result() as $value) {
              return $value->ava_nome;
          }
      }
      function mGetID($Nome){
          $this->db->select('id');
          $this->db->from('avaliacoes');
          $this->db->where('ava_nome', $Nome);
          $consulta = $this->db->get();
          foreach($consulta->result() as $value) {
              return $value->id;
          }
      }
      
      function mupdate($id,$ava_nome){
            $dados = array('ava_nome' => $ava_nome);
            if($this->db->update('avaliacoes', $dados, array('id' => $id))){
                return true;
            }else
                return false;
      }
      
    function minsert($ava_nome){
        if($this->db->insert('avaliacoes', array('ava_nome' => $ava_nome)))
        {
            return true;
        }else{
            return false;
        }
           
    }
    function mdelete($id) {
        if($this->db->delete('avaliacoes', array('id' => $id)))  
            return true;
        else
            return false;
        
    }
       
           
  }
?>
