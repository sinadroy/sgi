<?php
  class Mdocumentos extends CI_Model{
      
      function mread(){
          $this->db->select('tipo_documentos.id,tipo_documentos.tdnome,tipo_documentos.tdvalor');
          $this->db->from('tipo_documentos');
          
          $consulta = $this->db->get();
          $ord=1;
          $data = array();
            foreach ($consulta->result() as $row) {
                    $data[] = array(
                        "ord" => $ord,
                        "id" => $row->id,
                        "tdnome" => $row->tdnome,
                        "value" => $row->tdnome,
                        "tdvalor" => $row->tdvalor
                    );
                    $ord++;
            }
            return $data;
      }

      function mupdate($id,$tdnome,$tdvalor){
            $dados = array('tdnome'=>$tdnome,'tdvalor'=>$tdvalor);
            if($this->db->update('tipo_documentos', $dados, array('id' => $id))){
                return true;
            }else
                return false;
      }
      
    function minsert($tdnome,$tdvalor){
        if($this->db->insert('tipo_documentos', array('tdnome'=>$tdnome,'tdvalor'=>$tdvalor)))
        {
            return true;
        }else{
            return false;
        }
           
    }
    function mdelete($id) {
        if($this->db->delete('tipo_documentos', array('id' => $id)))  
            return true;
        else
            return false;
        
    }       
           
  }
