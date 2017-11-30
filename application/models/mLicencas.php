<?php
  class MLicencas extends CI_Model{
      
      //var $id = '';
      var $liceData_Inicio = '';
      var $liceData_Fin = '';
      var $liceMotivo = '';
      
      function mread(){
          $this->db->select('Licencas.id,Licencas.liceData_Inicio,Licencas.liceData_Fin,
              Licencas.Funcionarios_id,Funcionarios.fNome,Funcionarios.fNomes,Funcionarios.fApelido,Funcionarios.fBI_Passaporte,
              licencas.Licencas_Motivos_id, Licencas_Motivos.lmNome');
          $this->db->from('Licencas');
          $this->db->join('Funcionarios', 'Licencas.Funcionarios_id = Funcionarios.id');
          $this->db->join('Licencas_Motivos', 'Licencas.Licencas_Motivos_id = Licencas_Motivos.id');
          $consulta = $this->db->get();
          return $consulta->result();
      }

      function mGetID($Nome){
          $this->db->select('Licencas_Motivos.id');
          $this->db->from('Licencas_Motivos');
          $this->db->where('Licencas_Motivos.lmNome', $Nome);
          $consulta = $this->db->get();
          foreach($consulta->result() as $value) {
              return $value->id;
          }
      }
      
      public function totalLicencas(){
        $this->db->select('Licencas.id');
          $this->db->from('Licencas');
        return $this->db->count_all_results();
      }
      function dias_transcurridos($fecha_i,$fecha_f)
      {
        $dias = (strtotime($fecha_i)-strtotime($fecha_f))/86400;
        $dias = abs($dias); $dias = floor($dias);		
        return $dias;
      }
      function mCalcular_Total_Dias($id){
          $this->db->select('Licencas.liceData_Inicio,Licencas.liceData_Fin');
          $this->db->from('Licencas');
          $this->db->where('Licencas.Funcionarios_id', $id);
          $consulta = $this->db->get();
          foreach($consulta->result() as $value) {
              $data_inicio = $value->liceData_Inicio;
              $data_fin = $value->liceData_Fin;
          }
          return $this->dias_transcurridos($data_inicio,$data_fin);
      }

      function mGet_Data_Inicio($id){
          $this->db->select('Licencas.liceData_Inicio');
          $this->db->from('Licencas');
          $this->db->where('Licencas.Funcionarios_id', $id);
          $consulta = $this->db->get();
          foreach($consulta->result() as $value) {
              return $value->liceData_Inicio;
          }
      }

      function mGet_Data_Fin($id){
          $this->db->select('Licencas.liceData_Fin');
          $this->db->from('Licencas');
          $this->db->where('Licencas.Funcionarios_id', $id);
          $consulta = $this->db->get();
          foreach($consulta->result() as $value) {
              return $value->liceData_Fin;
          }
      }
       
      function mupdate($id,$Funcionarios_id,$liceData_Inicio,$liceData_Fin,$lmNome){
            $dados = array('Funcionarios_id'=>$Funcionarios_id,'liceData_Inicio'=>$liceData_Inicio,'liceData_Fin'=>$liceData_Fin,'Licencas_Motivos_id' => $lmNome);
            if($this->db->update('Licencas', $dados, array('id' => $id))){
                return true;
            }else
                return false;
      }
       
    function minsert($id,$liceData_Inicio,$liceData_Fin,$lmNome){
        if($this->db->insert('Licencas', array('Funcionarios_id'=>$id,'liceData_Inicio'=>$liceData_Inicio,'liceData_Fin'=>$liceData_Fin,'Licencas_Motivos_id' => $lmNome)))
        {
            return true;
        }else{
            return false;
        }
           
    }
    function mdelete($id) {
        if($this->db->delete('Licencas', array('id' => $id)))  
            return true;
        else
            return false;
        
    }
       
          
  }
