<?php
  class Mplanificacoes_prof extends CI_Model{
      
      function mread(){
          $this->db->select('temas.id, temnome, temhoras, disciplinas_id,
            stnome, stobservacao, temas_id, tipo_aulas_id,
            tanome');
          $this->db->from('sub_temas');
          $this->db->join('temas', 'sub_temas.temas_id = temas.id');
          $this->db->join('tipo_aulas', 'sub_temas.tipo_aulas_id = tipo_aulas.id');
          $consulta = $this->db->get();
          $data = array();
            foreach ($consulta->result() as $row) {
                    $data[] = array(
                        "id" => $row->id,
                        "temnome" => $row->temnome,
                        "temhoras" => $row->temhoras,
                        "disciplinas_id" => $row->disciplinas_id,
                        "stnome" => $row->stnome,
                        "stobservacao" => $row->stobservacao,
                        "temas_id" => $row->temas_id,
                        "tipo_aulas_id" => $row->tipo_aulas_id,
                        "tanome" => $row->tanome
                    );
            }
            return $data;
      }

      function mread_x($idd,$tema_id){
          $ord = 1;
        $this->db->select('sub_temas.id, temnome, temhoras, disciplinas_id,
          stnome, stobservacao, temas_id, tipo_aulas_id,
          tanome');
        $this->db->from('sub_temas');
        $this->db->join('temas', 'sub_temas.temas_id = temas.id');
        $this->db->join('tipo_aulas', 'sub_temas.tipo_aulas_id = tipo_aulas.id');
        $this->db->where('disciplinas_id',$idd);
        if($tema_id != "")
            $this->db->where('temas_id',$tema_id);
        $consulta = $this->db->get();
        $data = array();
          foreach ($consulta->result() as $row) {
                  $data[] = array(
                      "id" => $row->id,
                      "ord" => $ord,
                      "temnome" => $row->temnome,
                      "temhoras" => $row->temhoras,
                      "disciplinas_id" => $row->disciplinas_id,
                      "stnome" => $row->stnome,
                      "stobservacao" => $row->stobservacao,
                      "temas_id" => $row->temas_id,
                      "tipo_aulas_id" => $row->tipo_aulas_id,
                      "tanome" => $row->tanome
                  );
                  $ord++;
          }
          return $data;
    }

    function mread_temas($idd){
        $this->db->select('temas.id, temnome, temhoras, disciplinas_id');
        $this->db->from('temas');
        //$this->db->join('sub_temas', 'sub_temas.temas_id = temas.id');
        //$this->db->join('tipo_aulas', 'sub_temas.tipo_aulas_id = tipo_aulas.id');
        if($idd != "")
            $this->db->where('disciplinas_id',$idd);
        $consulta = $this->db->get();
        $data = array();
          foreach ($consulta->result() as $row) {
                  $data[] = array(
                      "id" => $row->id,
                      "temnome" => $row->temnome,
                      "value" => $row->temnome,
                      "temhoras" => $row->temhoras
                  );
          }
          return $data;
    }

    function mread_tipo_aulas(){
        $this->db->select('id, tanome');
        $this->db->from('tipo_aulas');
        $consulta = $this->db->get();
        $data = array();
          foreach ($consulta->result() as $row) {
                  $data[] = array(
                      "id" => $row->id,
                      "tanome" => $row->tanome,
                      "value" => $row->tanome
                  );
          }
          return $data;
    }
     
    




    function mupdate_subtema($id,$stnome,$stobservacao,$temas_id,$tipo_aulas_id){
            $dados = array('stnome'=>$stnome,
                            'stobservacao'=>$stobservacao,
                            'temas_id'=>$temas_id,
                            'tipo_aulas_id'=>$tipo_aulas_id);
            if($this->db->update('sub_temas', $dados, array('id' => $id))){
                return true;
            }else
                return false;
    }  
      
    function minsert_subtema($stnome,$stobservacao,$temas_id,$tipo_aulas_id){
        if($this->db->insert('sub_temas', array('stnome'=>$stnome,
                                                    'stobservacao'=>$stobservacao,
                                                    'temas_id'=>$temas_id,
                                                    'tipo_aulas_id'=>$tipo_aulas_id)))
            {
                return true;
            }else{
                return false;
            }
           
    }

    function mdelete_subtema($id) {
        if($this->db->delete('sub_temas', array('id' => $id)))  
            return true;
        else
            return false;
        
    }
           
  }
