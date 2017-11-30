<?php
  class MComunicados extends CI_Model{
      
      function mread(){
          $this->db->select('id,comTitulo,comConteudo,comData,comHora');
          $this->db->from('Comunicados');
          $this->db->order_by('comData,comHora','DESC');
          $consulta = $this->db->get();
          $ord=1;
          $data = array();
            foreach ($consulta->result() as $row) {
                if($row->id != 1){
                    $data[] = array(
                        "ord" => $ord,
                        "id" => $row->id,
                        "comTitulo" => $row->comTitulo,
                        "value" => $row->comTitulo,
                        "comConteudo" => $row->comConteudo,
                        "comData" => $row->comData,
                        "comHora" => $row->comHora
                    );
                    $ord++;
                }
            }
            return $data;
      }

      function mGetID($Nome){
          $this->db->select('id');
          $this->db->from('Comunicados');
          $this->db->where('Comunicados.comTitulo', $Nome);
          $consulta = $this->db->get();
          foreach($consulta->result() as $value) {
              return $value->id;
          }
      }
      
      function mupdate($id,$comTitulo,$comConteudo,$comData,$comHora){
            $dados = array('comTitulo'=>$comTitulo,'comConteudo'=>$comConteudo,'comData'=>$comData,'comHora'=>$comHora);
            if($this->db->update('Comunicados', $dados, array('id' => $id))){
                return true;
            }else
                return false;
      }
      
    function minsert($comTitulo,$comConteudo,$comData,$comHora){
        if($this->db->insert('Comunicados', array('comTitulo'=>$comTitulo,'comConteudo'=>$comConteudo,'comData'=>$comData,'comHora'=>$comHora)))
        {
            return true;
        }else{
            return false;
        }
           
    }
    function mdelete($id) {
        if($this->db->delete('Comunicados', array('id' => $id)))  
            return true;
        else
            return false;
        
    }       
           
  }
