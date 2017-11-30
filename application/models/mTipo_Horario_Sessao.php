<?php
  class MTipo_Horario_Sessao extends CI_Model{
      
      function mread(){
          $this->db->select('Tipo_Horario_Sessao.id, Tipo_Horario_Sessao.Entrada,Tipo_Horario_Sessao.Saida,
            Tipo_Horario_Sessao.Horario_Tipo_id, Horario_Tipo.htNome,
            Tipo_Horario_Sessao.Sessao_Trabalho_Administrativos_id, Sessao_Trabalho_Administrativos.stNome');
          $this->db->from('Tipo_Horario_Sessao');
          $this->db->join('Horario_Tipo', 'Tipo_Horario_Sessao.Horario_Tipo_id = Horario_Tipo.id');
          $this->db->join('Sessao_Trabalho_Administrativos', 'Tipo_Horario_Sessao.Sessao_Trabalho_Administrativos_id = Sessao_Trabalho_Administrativos.id');
          $consulta = $this->db->get();
          $data = array();
          foreach($consulta->result_array() as $row){
              $data[] = $row;
          }
        return $data;
      }
      function mupdate($id,$htNome,$stNome,$Entrada,$Saida){
            $dados = array('Sessao_Trabalho_Administrativos_id' => $stNome,'Horario_Tipo_id' => $htNome, 'Entrada'=>$Entrada,'Saida'=>$Saida);
            if($this->db->update('Tipo_Horario_Sessao', $dados, array('id' => $id))){
                return true;
            }else
                return false;
      }
      
      function minsert($htNome,$stNome,$Entrada,$Saida){
            if($this->db->insert('Tipo_Horario_Sessao', array('Sessao_Trabalho_Administrativos_id' => $stNome,'Horario_Tipo_id' => $htNome, 'Entrada'=>$Entrada,'Saida'=>$Saida)))
            {
                return true;
            }else{
                return false;
            }
            
      }
      function mdelete($id) {
        if($this->db->delete('Tipo_Horario_Sessao', array('id' => $id)))  
            return true;
        else
            return false;
        
      }         
}
