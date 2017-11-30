<?php
  class MOutras_Formacoes extends CI_Model{
      
      function mread(){
          $this->db->select('Outras_Formacoes.id,Funcionarios.fNome,Funcionarios.fNomes,Funcionarios.fApelido,Funcionarios.fBI_Passaporte,
              Outras_Formacoes.Funcionarios_id,Outras_Formacoes.ofCurso,Outras_Formacoes.ofData_Inicio,Outras_Formacoes.ofData_Fim,
              Outras_Formacoes.ofTipo_Formacao,Outras_Formacoes.ofInstituicao,
              Outras_Formacoes.Pais_id,Pais.paNome');
          $this->db->from('Outras_Formacoes');
          $this->db->join('Funcionarios', 'Outras_Formacoes.Funcionarios_id = Funcionarios.id');
          $this->db->join('Pais', 'Outras_Formacoes.Pais_id = Pais.id');
          $consulta = $this->db->get();
          return $consulta->result();
      }
      //para curriculum
      function mreadXid($id){
          $this->db->select('Outras_Formacoes.id,Funcionarios.fNome,Funcionarios.fNomes,Funcionarios.fApelido,Funcionarios.fBI_Passaporte,
              Outras_Formacoes.Funcionarios_id,Outras_Formacoes.ofCurso,Outras_Formacoes.ofData_Inicio,Outras_Formacoes.ofData_Fim,
              Outras_Formacoes.ofTipo_Formacao,Outras_Formacoes.ofInstituicao,
              Outras_Formacoes.Pais_id,Pais.paNome');
          $this->db->from('Outras_Formacoes');
          $this->db->join('Funcionarios', 'Outras_Formacoes.Funcionarios_id = Funcionarios.id');
          $this->db->join('Pais', 'Outras_Formacoes.Pais_id = Pais.id');
          $this->db->where('Outras_Formacoes.Funcionarios_id', $id);
          $this->db->order_by('ofData_Inicio', 'DESC');
          $consulta = $this->db->get();
          return $consulta->result();
      }
      
      public function total(){
        $this->db->select('Outras_Formacoes.id');
          $this->db->from('Outras_Formacoes');
        return $this->db->count_all_results();
      }
       
    function mupdate($id,$Funcionarios_id,$ofCurso,$ofData_Inicio,
                $ofData_Fin,$ofInstituicao,$ofTipo_Formacao,$paNome){
            $dados = array('Funcionarios_id'=>$Funcionarios_id,
                'ofCurso'=>$ofCurso,'ofData_Inicio'=>$ofData_Inicio,'ofData_Fim'=>$ofData_Fin,
                'ofTipo_Formacao'=>$ofTipo_Formacao,'ofInstituicao'=>$ofInstituicao,'Pais_id'=>$paNome);
            if($this->db->update('Outras_Formacoes', $dados, array('id' => $id))){
                return true;
            }else
                return false;
    }
       
    function minsert($Funcionarios_id,$ofCurso,$ofData_Inicio,
                $ofData_Fin,$ofInstituicao,$ofTipo_Formacao,$paNome){
        if($this->db->insert('Outras_Formacoes', array('Funcionarios_id'=>$Funcionarios_id,
            'ofCurso'=>$ofCurso,'ofData_Inicio'=>$ofData_Inicio,
            'ofData_Fim'=>$ofData_Fin,'ofTipo_Formacao'=>$ofTipo_Formacao,
            'ofInstituicao'=>$ofInstituicao,'Pais_id'=>$paNome)))
        {
            return true;
        }else{
            return false;
        }
           
    }
    function mdelete($id) {
        if($this->db->delete('Outras_Formacoes', array('id' => $id)))  
            return true;
        else
            return false;
        
    }
       
          
  }
