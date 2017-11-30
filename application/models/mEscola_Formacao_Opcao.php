<?php
  class MEscola_Formacao_Opcao extends CI_Model{
      
      function mread(){
          $ord=1;
          $this->db->select('Escola_Formacao_Opcao.id,Escola_Formacao.efNome,Escola_Formacao.id as efid,Opcao.opcNome,Opcao.id as opcid');
          $this->db->from('Escola_Formacao');
          $this->db->join('Escola_Formacao_Opcao','Escola_Formacao_Opcao.Escola_Formacao_id = Escola_Formacao.id');
          $this->db->join('Opcao','Escola_Formacao_Opcao.Opcao_id = Opcao.id');
          $consulta = $this->db->get();
          foreach($consulta->result() as $row){
              $data[] = array(
                  "ord"=>$ord,
                  "id"=>$row->id,
                  "efNome"=>$row->efNome,
                  "efid"=>$row->efid,
                  
                  "opcNome"=>$row->opcNome,
                  "opcid"=>$row->opcid,
              );
              $ord++;
          }
        return $data;
      }
      
      function mupdate($id,$efNome,$opcNome){
            $dados = array('Escola_Formacao_id'=>$efNome,'Opcao_id'=>$opcNome);
            if($this->db->update('Escola_Formacao_Opcao', $dados, array('id' => $id))){
                return true;
            }else
                return false;
      }
      
    function minsert($efNome,$opcNome){
        if($this->db->insert('Escola_Formacao_Opcao', array('Escola_Formacao_id'=>$efNome,'Opcao_id'=>$opcNome)))
        {
            return true;
        }else{
            return false;
        }
           
    }
    function mdelete($id) {
        if($this->db->delete('Escola_Formacao_Opcao', array('id' => $id)))  
            return true;
        else
            return false;
        
    }         
}
