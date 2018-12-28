<?php
  class MPrecarios extends CI_Model{
      
    function mread(){
        $ord = 1;
        $this->db->select('id,precnome,preccodigo,precdescricao');
        $this->db->from('precario');
        //$this->db->join('Provincias', 'Municipios.Provincias_id = Provincias.id');
        $consulta = $this->db->get();
        foreach($consulta->result() as $row){
            $al[] = array(
                "ord"=>$ord,
                "id"=>$row->id,
                "value"=>$row->precnome,
                "precnome"=>$row->precnome,
                "preccodigo"=>$row->preccodigo,
                "precdescricao"=>$row->precdescricao
            );
            $ord++;
        }
        return $al;
    }
      
      function mGetID($Nome){
          $this->db->select('id');
          $this->db->from('precario');
          $this->db->where('precnome', $Nome);
          $consulta = $this->db->get();
          foreach($consulta->result() as $value) {
              return $value->id;
          }
      }
      function mGetIDXCodigo($Codigo){
          $this->db->select('id');
          $this->db->from('precario');
          $this->db->where('preccodigo', $Codigo);
          $consulta = $this->db->get();
          foreach($consulta->result() as $value) {
              return $value->id;
          }
      }
      public function total(){
        $this->db->select('id');
          $this->db->from('precario');
        return $this->db->count_all_results();
      }
      function mupdate($id,$precnome,$preccodigo,$precdescricao){
            $d = array('precnome' => $precnome,'preccodigo' => $preccodigo,'precdescricao' => $precdescricao);
            if($this->db->update('precario', $d, array('id' => $id))){
                return true;
            }else
                return false;
      }
      
    function minsert($precnome,$preccodigo,$precdescricao){
        $d = array('precnome' => $precnome,'preccodigo' => $preccodigo,'precdescricao' => $precdescricao);
        if($this->db->insert('precario', $d))
        {
            return true;
        }else{
            return false;
        }
           
    }
    function mdelete($id) {
        if($this->db->delete('precario', array('id' => $id)))  
            return true;
        else
            return false;
        
    }
       
           
  }
?>
