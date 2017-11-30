<?php
  class MModulos extends CI_Model{
      
      //var $id = '';
      var $mNome = '';
      var $mDescricao = '';
      
      function _construct(){
          //parent::Model();
          //$this->load->database();
      }
      
      function mread(){
          $this->db->select('modulos.id,modulos.mNome,modulos.mDescricao');
          $this->db->from('modulos');
          //$this->db->join('niveis_acessos', 'utilizadores.Niveis_Acessos_id = niveis_acessos.id');
          $consulta = $this->db->get();
          return $consulta->result();
      }
      
      function mgetAccess($modulo,$usuario) {
          $this->db->select('utilizadores.id');
          $this->db->from('utilizadores');
          $this->db->join('niveis_acessos','utilizadores.Niveis_Acessos_id = niveis_acessos.id');
          $this->db->join('niveis_acessos_modulos','niveis_acessos_modulos.Niveis_Acessos_id = niveis_acessos.id');
          $this->db->join('modulos','niveis_acessos_modulos.Modulos_id = modulos.id');
          $this->db->where('modulos.mNome', $modulo);
          $this->db->where('utilizadores.uUsuario', $usuario);
          $consulta = $this->db->get();
          if($consulta->num_rows() > 0)
            return true;
          else
             return false;
      }
      /*
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
      
      function minsert($naNome,$naDescricao){
          //if($senha == $senha2){
        if($this->db->insert('niveis_acessos', array('naNome' => $naNome, 'naDescricao' => $naDescricao)))
        {    
            return true;
        }
        else{
            return false;
        }
      }
     * 
     */
           
  }
?>
