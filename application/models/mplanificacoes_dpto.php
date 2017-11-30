<?php
  class Mplanificacoes_dpto extends CI_Model{
      
    function mread_x_idd($idd){
          $ord = 1;
          $this->db->select('temas.id, temnome, temhoras');
          $this->db->from('temas');
          $this->db->where('temas.disciplinas_id', $idd);
          $consulta = $this->db->get();
          $data = array();
            foreach ($consulta->result() as $row) {
                    $data[] = array(
                        "ord" => $ord,
                        "id" => $row->id,
                        "temnome" => $row->temnome,
                        "temhoras" => $row->temhoras
                    );
                    $ord++;
            }
            return $data;
    }

    function mupdate($id,$temnome,$temhoras,$disciplinas_id){
            $dados = array('temnome'=>$temnome,
                            'temhoras'=>$temhoras,
                            'disciplinas_id'=>$disciplinas_id);
            if($this->db->update('temas', $dados, array('id' => $id))){
                return true;
            }else
                return false;
    }  
      
    function minsert($temnome,$temhoras,$disciplinas_id){
        if($this->db->insert('temas', array('temnome'=>$temnome,
                                            'temhoras'=>$temhoras,
                                            'disciplinas_id'=>$disciplinas_id)))
            {
                return true;
            }else{
                return false;
            }
           
    }

    function mdelete($id) {
        if($this->db->delete('temas', array('id' => $id)))  
            return true;
        else
            return false;
        
    }
           
  }
