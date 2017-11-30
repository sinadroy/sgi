<?php
  class MFuncionarios_Cargos extends CI_Model{
      
      function mread(){
          $ord=1;
          $this->db->select('Cargos.id,carNome,carCodigo');
          $this->db->from('Cargos');
          $consulta = $this->db->get();
          foreach($consulta->result() as $row){
              $data[] = array(
                  "ord"=>$ord,
                  "id"=>$row->id,
                  "carNome"=>$row->carNome,
                  "value"=>$row->carNome,
                  "carCodigo"=>$row->carCodigo,
              );
              $ord++;
          }
        return $data;
      }

      function mupdate($id,$carNome,$carCodigo){
            $dados = array('carNome'=>$carNome,'carCodigo'=>$carCodigo);
            if($this->db->update('Cargos', $dados, array('id' => $id))){
                return true;
            }else
                return false;
      }
      
    function minsert($carNome,$carCodigo){
        if($this->db->insert('Cargos', array('carNome'=>$carNome,'carCodigo'=>$carCodigo)))
        {
            return true;
        }else{
            return false;
        }
           
    }
    function mdelete($id) {
        if($this->db->delete('Cargos', array('id' => $id)))  
            return true;
        else
            return false;
        
    }         
}
