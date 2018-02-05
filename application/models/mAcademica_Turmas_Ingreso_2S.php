<?php
  class MAcademica_Turmas_Ingreso_2S extends CI_Model{
      
      function mread($al){
          $this->db->select('Academica_Turmas_Ingreso_2S.id,
            atcNome,
            atcCodigo,
            atcLocalizacao,
            atcCapacidade,
            anos_lectivos.alAno');
          $this->db->from('Academica_Turmas_Ingreso_2S');
          $this->db->join('anos_lectivos','Academica_Turmas_Ingreso_2S.anos_lectivos_id = anos_lectivos.id');
          if($al != '')
            $this->db->where('Academica_Turmas_Ingreso_2S.anos_lectivos_id', $al);
          $consulta = $this->db->get();
          foreach($consulta->result() as $row){
              $data[] = array(
                  "id"=>$row->id,
                  "atcNome"=>$row->atcNome,
                  "value"=>$row->atcNome,
                  "atcCodigo"=>$row->atcCodigo,
                  "atcLocalizacao"=>$row->atcLocalizacao,
                  "atcCapacidade"=>$row->atcCapacidade,
                  "alAno"=>$row->alAno
                  //"atcData"=>$row->atcData,
              );
          }
        return $data;
      }

      function mreadCapacidadeTurma($turma){
          $this->db->select('Academica_Turmas_Ingreso_2S.id,atcNome,atcCodigo,atcLocalizacao,atcCapacidade');
          $this->db->from('Academica_Turmas_Ingreso_2S');
          $this->db->where('Academica_Turmas_Ingreso_2S.id', $turma);
          $consulta = $this->db->get();
          foreach($consulta->result() as $value) {
              return $value->atcCapacidade;
          }
      }
     
      function mupdate($id,$atcNome,$atcCodigo,$atcCapacidade,$atcLocalizacao,$al){
        $this->load->model('manos_lectivos');
        $al = $this->manos_lectivos->mGetID($al);    
        $dados = array('atcNome'=>$atcNome,'atcCodigo'=>$atcCodigo,'atcCapacidade'=>$atcCapacidade,'atcLocalizacao'=>$atcLocalizacao,'anos_lectivos_id'=>$al);
            if($this->db->update('Academica_Turmas_Ingreso_2S', $dados, array('id' => $id))){
                return true;
            }else
                return false;
      }
      
    function minsert($atcNome,$atcCodigo,$atcCapacidade,$atcLocalizacao,$al){
        if($this->db->insert('Academica_Turmas_Ingreso_2S', array('atcNome'=>$atcNome,'atcCodigo'=>$atcCodigo,'atcCapacidade'=>$atcCapacidade,'atcLocalizacao'=>$atcLocalizacao,'anos_lectivos_id'=>$al)))
        {
            return true;
        }else{
            return false;
        }
           
    }
    function mdelete($id) {
        if($this->db->delete('Academica_Turmas_Ingreso_2S', array('id' => $id)))  
            return true;
        else
            return false;
        
    }         
}
