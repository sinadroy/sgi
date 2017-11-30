<?php
  class MEventos extends CI_Model{
      
      function mread(){
          $this->db->select('Funcionarios.fNome,Funcionarios.fNomes,Funcionarios.fApelido,Funcionarios.fBI_Passaporte,
              Eventos.id,Eventos.Funcionarios_id,Eventos.evTitulo,Eventos.evInstituicao,Eventos.evAno,
              Eventos.Pais_id,Pais.paNome,Eventos.Tipo_Evento_id,Tipo_Evento.teNome');
          $this->db->from('Eventos');
          $this->db->join('Tipo_Evento', 'Eventos.Tipo_Evento_id = Tipo_Evento.id');
          $this->db->join('Funcionarios', 'Eventos.Funcionarios_id = Funcionarios.id');
          $this->db->join('Pais', 'Eventos.Pais_id = Pais.id');
          $consulta = $this->db->get();
          return $consulta->result();
      }
      //para curriculum
      function mreadXid($id){
          $this->db->select('Funcionarios.fNome,Funcionarios.fNomes,Funcionarios.fApelido,Funcionarios.fBI_Passaporte,
              Eventos.id,Eventos.Funcionarios_id,Eventos.evTitulo,Eventos.evInstituicao,Eventos.evAno,
              Eventos.Pais_id,Pais.paNome,Eventos.Tipo_Evento_id,Tipo_Evento.teNome');
          $this->db->from('Eventos');
          $this->db->join('Tipo_Evento', 'Eventos.Tipo_Evento_id = Tipo_Evento.id');
          $this->db->join('Funcionarios', 'Eventos.Funcionarios_id = Funcionarios.id');
          $this->db->join('Pais', 'Eventos.Pais_id = Pais.id');
          $this->db->where('Eventos.Funcionarios_id', $id);
          $this->db->order_by('evAno', 'DESC');
          //$this->db->order_by('name', 'ASC');
          $consulta = $this->db->get();
          return $consulta->result();
      }
      
      public function total(){
        $this->db->select('Eventos.id');
          $this->db->from('Eventos');
        return $this->db->count_all_results();
      }
       
    function mupdate($id,$Funcionarios_id,$evTitulo,$evInstituicao,$evAno,$Pais_id,$Tipo_Evento_id){
            $dados = array('Funcionarios_id'=>$Funcionarios_id,'evTitulo'=>$evTitulo,'evInstituicao'=>$evInstituicao,
                'evAno'=>$evAno,'Pais_id'=>$Pais_id,'Tipo_Evento_id'=>$Tipo_Evento_id);
            if($this->db->update('Eventos', $dados, array('id' => $id))){
                return true;
            }else
                return false;
    }  
    function minsert($Funcionarios_id,$evTitulo,$evInstituicao,$evAno,$Pais_id,$Tipo_Evento_id){
        if($this->db->insert('Eventos', array('Funcionarios_id'=>$Funcionarios_id,'evTitulo'=>$evTitulo,'evInstituicao'=>$evInstituicao,
                'evAno'=>$evAno,'Pais_id'=>$Pais_id,'Tipo_Evento_id'=>$Tipo_Evento_id)))
        {
            return true;
        }else{
            return false;
        }
           
    }
    function mdelete($id) {
        if($this->db->delete('Eventos', array('id' => $id)))  
            return true;
        else
            return false;
        
    }
       
          
  }
