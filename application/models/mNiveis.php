<?php
  class MNiveis extends CI_Model{
      
      //var $id = '';
      var $nNome = '';
      var $nCodigo = '';
      var $nDescricao = '';
      
      function _construct(){
          //parent::Model();
          //$this->load->database();
      }
      
      function mread(){
          $this->db->select('niveis.id,niveis.nNome,niveis.nCodigo,niveis.nDescricao');
          $this->db->from('niveis');
          //$this->db->join('niveis_acessos', 'utilizadores.Niveis_Acessos_id = niveis_acessos.id');
          $consulta = $this->db->get();
          return $consulta->result();
      }
      function mread_dpto($dpto) {
        $this->db->select('niveis.id,niveis.nNome,niveis.nCodigo,niveis.nDescricao');
        $this->db->from('niveis');
        $this->db->join('niveis_cursos', 'niveis_cursos.niveis_id = niveis.id');
        $this->db->where('niveis_cursos.departamentos_id', $dpto);
        $consulta = $this->db->get();
        foreach($consulta->result() as $row){
            $al[] = array(
                "id"=>$row->id,
                "value"=>$row->nNome,
                "nNome"=>$row->nNome,
                "nCodigo"=>$row->nCodigo,
                "nDescricao"=>$row->nDescricao,
            );
        }
        return $al;
    }
      public function totalNiveis(){
        $this->db->select('niveis.id,niveis.nNome,niveis.nCodigo,niveis.nDescricao');
        $this->db->from('niveis');
        return $this->db->count_all_results();
      }
      function getID($nNome) {
          $this->db->select('id');
          $this->db->from('niveis');
          $this->db->where('niveis.nNome', $nNome);
          $consulta = $this->db->get();
          foreach($consulta->result() as $row){
              return $row->id;
          }
          //return $consulta->result();
      }
      function getNome($n) {
        $this->db->select('nNome');
        $this->db->from('niveis');
        $this->db->where('niveis.id', $n);
        $consulta = $this->db->get();
        foreach($consulta->result() as $row){
            return $row->nNome;
        }
        //return $consulta->result();
    }
      function mupdate($id,$nNome,$nCodigo,$nDescricao){
            $this->nNome = $nNome;
            $this->nCodigo = $nCodigo;
            $this->nDescricao = $nDescricao;
            
            if($this->db->update('niveis', $this, array('id' => $id)))
                  return true;
            else
                  return false;
          //}else
                  //return FALSE;
      }
      
      function minsert($nNome,$nCodigo,$nDescricao){
          //if($senha == $senha2){
        if($this->db->insert('niveis', array('nNome' => $nNome,'nCodigo' => $nCodigo, 'nDescricao' => $nDescricao)))
        {    
            return true;
        }
        else{
            return false;
        }
      }
    function mdelete($id) {
        if($this->db->delete('niveis', array('id' => $id)))  
            return true;
        else
            return false;
        
    }
       
           
  }
?>
