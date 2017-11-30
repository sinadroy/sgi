<?php

class MNiveisAcesso extends CI_Model {

    //var $id = '';
    var $naNome = '';
    var $naDescricao = '';

    function _construct() {
        //parent::Model();
        //$this->load->database();
    }

    function mread() {
        $this->db->select('niveis_acessos.id,niveis_acessos.id as idna,niveis_acessos.naNome,niveis_acessos.naDescricao');
        $this->db->from('niveis_acessos');
        //$this->db->join('niveis_acessos', 'utilizadores.Niveis_Acessos_id = niveis_acessos.id');
        $consulta = $this->db->get();
        return $consulta->result();
    }

    function getID($nivei_acesso) {
        $this->db->select('niveis_acessos.id');
        $this->db->from('niveis_acessos');
        $this->db->where('niveis_acessos.naNome', $nivei_acesso);
        $consulta = $this->db->get();
        foreach ($consulta->result() as $row) {
            return $row->id;
        }
        //return $consulta->result();
    }

    function mupdate($id, $naNome, $naDescricao) {
        //$this->id   = $id;
        //if($passwd == $passwd2){
        $this->naNome = $naNome;
        $this->naDescricao = $naDescricao;

        if ($this->db->update('niveis_acessos', $this, array('id' => $id)))
            return true;
        else
            return false;
        //}else
        //return FALSE;
    }

    function minsert($naNome, $naDescricao) {
        //if($senha == $senha2){
        if ($this->db->insert('niveis_acessos', array('naNome' => $naNome, 'naDescricao' => $naDescricao))) {
            return true;
        } else {
            return false;
        }
    }
    function mdelete($id) {
        if($this->db->delete('niveis_acessos', array('id' => $id)))  
            return true;
        else
            return false;
        
      }

}

?>
