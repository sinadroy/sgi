<?php
  class Mmeses_propina extends CI_Model{
      
      function mread(){
          $this->db->select('id,mesNome,mesEstado');
          $this->db->from('Meses_Propina');
          $consulta = $this->db->get();
          $data = array();
            foreach ($consulta->result() as $row) {
                    $data[] = array(
                        "id" => $row->id,
                        "mesNome" => $row->mesNome,
                        "value" => $row->mesNome,
                        "mesEstado" => $row->mesEstado
                    );
            }
            return $data;
      }

      function mreadXactivos(){
          $this->db->select('id,mesNome,mesEstado');
          $this->db->from('Meses_Propina');
          $this->db->where('Meses_Propina.mesEstado', "on");
          $consulta = $this->db->get();
          $data = array();
          /*  foreach ($consulta->result() as $row) {
                    $data[] = array(
                        "id" => $row->id,
                        "mesNome" => $row->mesNome,
                        "value" => $row->mesNome,
                        "mesEstado" => $row->mesEstado
                    );
            }
            return $data;
            */
            return $consulta->result();
      }

      function mGetID($Nome){
          $this->db->select('id');
          $this->db->from('Meses_Propina');
          $this->db->where('Meses_Propina.mesNome', $Nome);
          $consulta = $this->db->get();
          foreach($consulta->result() as $value) {
              return $value->id;
          }
      }
      
      function mupdate($id,$mesNome,$mesEstado){
            $dados = array('mesEstado'=>$mesEstado);
            if($this->db->update('Meses_Propina', $dados, array('id' => $id))){
                return true;
            }else
                return false;
      }      
           
  }
