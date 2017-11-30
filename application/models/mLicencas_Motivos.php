<?php
  class MLicencas_Motivos extends CI_Model{
      
      function mread(){
          $ord=1;
          $this->db->select('Licencas_Motivos.id,lmNome,lmCodigo');
          $this->db->from('Licencas_Motivos');
          $consulta = $this->db->get();
          foreach($consulta->result() as $row){
              $data[] = array(
                  "ord"=>$ord,
                  "id"=>$row->id,
                  "lmNome"=>$row->lmNome,
                  "value"=>$row->lmNome,
                  "lmCodigo"=>$row->lmCodigo,
              );
              $ord++;
          }
        return $data;
      }

      function mupdate($id,$lmNome,$lmCodigo){
            $dados = array('lmNome'=>$lmNome,'lmCodigo'=>$lmCodigo);
            if($this->db->update('Licencas_Motivos', $dados, array('id' => $id))){
                return true;
            }else
                return false;
      }
      
    function minsert($lmNome,$lmCodigo){
        if($this->db->insert('Licencas_Motivos', array('lmNome'=>$lmNome,'lmCodigo'=>$lmCodigo)))
        {
            return true;
        }else{
            return false;
        }
           
    }
    function mdelete($id) {
        if($this->db->delete('Licencas_Motivos', array('id' => $id)))  
            return true;
        else
            return false;
        
    }         
}
