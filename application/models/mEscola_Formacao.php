<?php
  class MEscola_Formacao extends CI_Model{
      
      function mread(){
          $ord=1;
          $this->db->select('Escola_Formacao.id,Escola_Formacao.efNome,Escola_Formacao.efCodigo,Escola_Formacao.efCodigoNome,
                Habilitacoes_Literarias_Candidatos.hlfNome');
          $this->db->from('Escola_Formacao');
          $this->db->join('Habilitacoes_Literarias_Candidatos','Escola_Formacao.Habilitacoes_Literarias_Candidatos_id = Habilitacoes_Literarias_Candidatos.id');
          $consulta = $this->db->get();
          foreach($consulta->result() as $row){
              $data[] = array(
                  "ord"=>$ord,
                  "id"=>$row->id,
                  "efNome"=>$row->efNome,
                  "value"=>$row->efNome,
                  "efCodigo"=>$row->efCodigo,
                  "hlfNome"=>$row->hlfNome,
                  "efCodigoNome"=>$row->efCodigoNome
              );
              $ord++;
          }
        return $data;
      }
      function mreadX($efNome){
          $ord=1;
          $this->db->select('Escola_Formacao.id');
          $this->db->from('Escola_Formacao');
          //$this->db->join('Escola_Formacao_Opcao','Escola_Formacao_Opcao.Opcao_id = Opcao.id');
          $this->db->where('Escola_Formacao.efNome',$efNome);
          $consulta = $this->db->get();
          foreach($consulta->result() as $row){
              return $row->id;
          }
      }
      //
      function mreadXtipo($tipo){
          $ord=1;
          $this->db->select('Escola_Formacao.id,Escola_Formacao.efNome,Escola_Formacao.efCodigo,Escola_Formacao.efCodigoNome,
                Habilitacoes_Literarias_Candidatos.hlfNome');
          $this->db->from('Escola_Formacao');
          $this->db->join('Habilitacoes_Literarias_Candidatos','Escola_Formacao.Habilitacoes_Literarias_Candidatos_id = Habilitacoes_Literarias_Candidatos.id');
          $this->db->where('Escola_Formacao.Habilitacoes_Literarias_Candidatos_id',$tipo);
          $consulta = $this->db->get();
          foreach($consulta->result() as $row){
              $data[] = array(
                  "ord"=>$ord,
                  "id"=>$row->id,
                  "efNome"=>$row->efNome,
                  "value"=>$row->efNome,
                  "efCodigo"=>$row->efCodigo,
                  "hlfNome"=>$row->hlfNome,
                  "efCodigoNome"=>$row->efCodigoNome
              );
              $ord++;
          }
        return $data;
      }

      

      function mupdate($id,$efNome,$efCodigo,$Habilitacoes_Literarias_Candidatos_id,$efCodigoNome){
            $this->load->model('MHabilitacoes_Literarias_Candidatos');
            $Habilitacoes_Literarias_Candidatos_id = $this->MHabilitacoes_Literarias_Candidatos->mGetID($Habilitacoes_Literarias_Candidatos_id);
            $dados = array('efNome'=>$efNome,'efCodigo'=>$efCodigo,
                            'Habilitacoes_Literarias_Candidatos_id'=>$Habilitacoes_Literarias_Candidatos_id,
                            'efCodigoNome'=>$efCodigoNome);
            if($this->db->update('Escola_Formacao', $dados, array('id' => $id))){
                return true;
            }else
                return false;
      }
      
    function minsert($efNome,$efCodigo,$Habilitacoes_Literarias_Candidatos_id,$efCodigoNome){
        if($this->db->insert('Escola_Formacao', array('efNome'=>$efNome,'efCodigo'=>$efCodigo,
            'Habilitacoes_Literarias_Candidatos_id'=>$Habilitacoes_Literarias_Candidatos_id,
            'efCodigoNome'=>$efCodigoNome)))
        {
            return true;
        }else{
            return false;
        }
           
    }
    function mdelete($id) {
        if($this->db->delete('Escola_Formacao', array('id' => $id)))  
            return true;
        else
            return false;
        
    }         
}
