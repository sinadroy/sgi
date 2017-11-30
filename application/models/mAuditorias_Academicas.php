<?php
  class MAuditorias_Academicas extends CI_Model{
      
      function mread(){
          $this->db->select('id,audOperacao,audData,audHora,audDescricao,audUsuario, audModulo, audSubModulo');
          $this->db->from('Auditorias');
          //$this->db->join('modulos', 'Auditorias.modulos_id = modulos.id');
          //$this->db->join('sub_modulos', 'Auditorias.sub_modulos_id = sub_modulos.id');
          //$this->db->join('utilizadores', 'Auditorias.utilizadores_id = utilizadores.id');
          $this->db->where('audModulo',"Academica");
          $this->db->order_by('audData,audHora','DESC');
          $consulta = $this->db->get();
          $ord=1;
          $data = array();
            foreach ($consulta->result() as $row) {
                if($row->id != 1){
                    $data[] = array(
                        "ord" => $ord,
                        "id" => $row->id,
                        "audOperacao" => $row->audOperacao,
                        "audModulo" => $row->audModulo,
                        "audSubModulo" => $row->audSubModulo,
                        "audUsuario" => $row->audUsuario,
                        "audData" => $row->audData,
                        "audHora" => $row->audHora,
                        "audDescricao" => $row->audDescricao,
                    );
                    $ord++;
                }
            }
            return $data;
      }
/*
      function mupdate($id,$audOperacao,$mNome,$smNome,$uUsuario,$audData,$audHora){
            $dados = array('audOperacao'=>$audOperacao,'mNome'=>$mNome,'smNome'=>$smNome,'uUsuario'=>$uUsuario,'audData'=>$audData,'audHora'=>$audHora);
            if($this->db->update('Auditorias', $dados, array('id' => $id))){
                return true;
            }else
                return false;
      }
  */    
    function minsert($audOperacao,$mNome,$smNome,$uUsuario,$audDescricao){
        $audData = date("Y/m/d");
        $audHora = date('H:i:s', time());
        if($this->db->insert('Auditorias', array('audOperacao'=>$audOperacao,'audModulo'=>$mNome,'audSubModulo'=>$smNome,'audUsuario'=>$uUsuario,'audData'=>$audData,'audHora'=>$audHora,'audDescricao'=>$audDescricao)))
        {
            return true;
        }else{
            return false;
        }
           
    }
    function mdelete($id) {
        if($this->db->delete('Auditorias', array('id' => $id)))  
            return true;
        else
            return false;
        
    }       
           
  }
