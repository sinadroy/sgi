<?php
  class MSubModulos extends CI_Model{
      
      //var $id = '';
      var $mNome = '';
      var $mDescricao = '';
      
      function _construct(){
          //parent::Model();
          //$this->load->database();
      }
      
      function mread($modulo_num){
          $this->db->select('sub_modulos.id,sub_modulos.smNome,sub_modulos.smCodigo');
          $this->db->from('sub_modulos');
          $this->db->join('modulos', 'sub_modulos.modulos_id = modulos.id');
          $this->db->where('modulos.mCodigo', $modulo_num);
          $this->db->order_by('smCodigo', 'ASC');
          $consulta = $this->db->get();
          return $consulta->result();
      }
      function mreadAll(){
          $this->db->select('sub_modulos.id,sub_modulos.smNome,sub_modulos.smCodigo');
          $this->db->from('sub_modulos');
          //$this->db->join('modulos', 'sub_modulos.modulos_id = modulos.id');
          //$this->db->where('modulos.mCodigo', $modulo_num);
          $consulta = $this->db->get();
          return $consulta->result();
      }
      function mreadXid($modulo_id){
          $this->db->select('sub_modulos.id,sub_modulos.smNome,sub_modulos.smCodigo');
          $this->db->from('sub_modulos');
          $this->db->join('modulos', 'sub_modulos.modulos_id = modulos.id');
          $this->db->where('modulos.id', $modulo_id);
          $this->db->order_by('smCodigo', 'ASC');
          $consulta = $this->db->get();
          return $consulta->result();
      }
      function mgetAccess($modulo,$usuario) {
          /*
            select sub_modulos.id,sub_modulos.smNome,sub_modulos.smCodigo 
            from sgi3.sub_modulos
            inner join sgi3.modulos on(modulos.id = sub_modulos.Modulos_id)
            inner join sgi3.niveis_acessos_modulos on (sub_modulos.id = niveis_acessos_modulos.sub_modulos_id)
            inner join sgi3.niveis_acessos on(niveis_acessos_modulos.Niveis_Acessos_id = niveis_acessos.id)
            inner join sgi3.utilizadores on(utilizadores.Niveis_Acessos_id = niveis_acessos.id)
            where modulos.mCodigo = '01'
            and sgi3.utilizadores.uUsuario = 'admin'
          */
          $this->db->select('sub_modulos.id,sub_modulos.smNome,sub_modulos.smCodigo ');
          $this->db->from('sub_modulos');
          $this->db->join('modulos','modulos.id = sub_modulos.Modulos_id');
          $this->db->join('niveis_acessos_modulos','sub_modulos.id = niveis_acessos_modulos.sub_modulos_id');
          $this->db->join('niveis_acessos','niveis_acessos_modulos.Niveis_Acessos_id = niveis_acessos.id');
          $this->db->join('utilizadores','utilizadores.Niveis_Acessos_id = niveis_acessos.id');
          $this->db->where('modulos.mCodigo', $modulo);
          $this->db->where('utilizadores.uUsuario', $usuario);
          $this->db->order_by('smCodigo', 'ASC');
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
