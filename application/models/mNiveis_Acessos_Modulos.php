<?php
  class MNiveis_Acessos_Modulos extends CI_Model{
      
      //var $id = '';
      var $Niveis_Acessos_id = '';
      var $Modulos_id = '';
      var $sub_modulos_id = '';
      
      function _construct(){
          //parent::Model();
          //$this->load->database();
      }
      
      function mread(){
          $this->db->select('niveis_acessos_modulos.id,niveis_acessos.id as idna,niveis_acessos.naNome,
                  modulos.id as idm,modulos.mNome,sub_modulos.id as idsm,sub_modulos.smNome');
          $this->db->from('niveis_acessos_modulos');
          $this->db->join('niveis_acessos', 'niveis_acessos_modulos.Niveis_Acessos_id = niveis_acessos.id');
          $this->db->join('modulos', 'niveis_acessos_modulos.Modulos_id = modulos.id');
          $this->db->join('sub_modulos', 'niveis_acessos_modulos.sub_modulos_id = sub_modulos.id');
          $consulta = $this->db->get();
          return $consulta->result();
      }
    /*
      function getID($nivei_acesso) {
          $this->db->select('niveis_acessos.id');
          $this->db->from('niveis_acessos');
          $this->db->where('niveis_acessos.naNome', $nivei_acesso);
          $consulta = $this->db->get();
          foreach($consulta->result() as $row){
              return $row->id;
          }
          //return $consulta->result();
      }
      
      function mupdate($id,$naNome,$naDescricao){
          //$this->id   = $id;
          //if($passwd == $passwd2){
            $this->naNome = $naNome;
            $this->naDescricao = $naDescricao;
            
            if($this->db->update('niveis_acessos', $this, array('id' => $id)))
                  return true;
            else
                  return false;
          //}else
                  //return FALSE;
      }
      * 
     */ 
    function minsert($na,$m,$sm){
        if($this->db->insert('niveis_acessos_modulos', array('Niveis_Acessos_id' => $na, 
            'Modulos_id' => $m, 'sub_modulos_id'=>$sm)))
        {    
            return true;
        }
        else{
            return false;
        }
    }
    function mdelete($id) {
        if($this->db->delete('niveis_acessos_modulos', array('id' => $id)))  
            return true;
        else
            return false;
        
    }
           
  }
?>
