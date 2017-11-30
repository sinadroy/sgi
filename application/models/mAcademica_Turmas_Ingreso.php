<?php
  class MAcademica_Turmas_Ingreso extends CI_Model{
      
      function mread($al){
          $ord = 1;
          $this->db->select('Academica_Turmas_Ingreso.id,atcNome,atcCodigo,atcLocalizacao,atcCapacidade,anos_lectivos.alAno');
          $this->db->from('Academica_Turmas_Ingreso');
          $this->db->join('anos_lectivos','Academica_Turmas_Ingreso.anos_lectivos_id = anos_lectivos.id');
          if($al != '')
            $this->db->where('Academica_Turmas_Ingreso.anos_lectivos_id', $al);
          $consulta = $this->db->get();
          foreach($consulta->result() as $row){
              $data[] = array(
                  "ord" => $ord,
                  "id"=>$row->id,
                  "atcNome"=>$row->atcNome,
                  "value"=>$row->atcNome,
                  "atcCodigo"=>$row->atcCodigo,
                  "atcLocalizacao"=>$row->atcLocalizacao,
                  "atcCapacidade"=>$row->atcCapacidade,
                  "alAno"=>$row->alAno,
                  //"atcData"=>$row->atcData,
              );
              $ord++;
          }
        return $data;
      }

      function mreadCapacidadeTurma($turma){
          $this->db->select('Academica_Turmas_Ingreso.id,atcNome,atcCodigo,atcLocalizacao,atcCapacidade');
          $this->db->from('Academica_Turmas_Ingreso');
          $this->db->where('Academica_Turmas_Ingreso.id', $turma);
          $consulta = $this->db->get();
          foreach($consulta->result() as $value) {
              return $value->atcCapacidade;
          }
      }
      

      /*function mGetID($Nome){
          $this->db->select('Sessao_Trabalho_Administrativos.id');
          $this->db->from('Sessao_Trabalho_Administrativos');
          $this->db->where('Sessao_Trabalho_Administrativos.stNome', $Nome);
          $consulta = $this->db->get();
          foreach($consulta->result() as $value) {
              return $value->id;
          }
      }
      function mGetIDXCodigo($Codigo){
          $this->db->select('sessao.id');
          $this->db->from('sessao');
          $this->db->where('sessao.sesCodigo', $Codigo);
          $consulta = $this->db->get();
          foreach($consulta->result() as $value) {
              return $value->id;
          }
      }
      public function total(){
        $this->db->select('sessao.id');
          $this->db->from('sessao');
        return $this->db->count_all_results();
      }
      //Tiempos de aulas de una session
      public function taXses($idses){
        $this->db->select('temposaulas.id');
        $this->db->from('temposaulas');
        $this->db->where('temposaulas.sessao_id', $idses);
        //return $this->db->count_all_results();
        $consulta = $this->db->get();
        return $consulta->result();
      }*/
      function mupdate($id,$atcNome,$atcCodigo,$atcCapacidade,$atcLocalizacao,$al){
            $this->load->model('manos_lectivos');
            $al = $this->manos_lectivos->mGetID($al);
            $dados = array('atcNome'=>$atcNome,'atcCodigo'=>$atcCodigo,'atcCapacidade'=>$atcCapacidade,'atcLocalizacao'=>$atcLocalizacao,'anos_lectivos_id'=>$al);
            if($this->db->update('Academica_Turmas_Ingreso', $dados, array('id' => $id))){
                return true;
            }else
                return false;
      }
      
    function minsert($atcNome,$atcCodigo,$atcCapacidade,$atcLocalizacao,$al){
        if($this->db->insert('Academica_Turmas_Ingreso', array('atcNome'=>$atcNome,'atcCodigo'=>$atcCodigo,'atcCapacidade'=>$atcCapacidade,'atcLocalizacao'=>$atcLocalizacao,'anos_lectivos_id'=>$al)))
        {
            return true;
        }else{
            return false;
        }
           
    }
    function mdelete($id) {
        if($this->db->delete('Academica_Turmas_Ingreso', array('id' => $id)))  
            return true;
        else
            return false;
        
    }         
}
