<?php
  class MFormacao_Funcionarios extends CI_Model{
      
      function mread(){
          $this->db->select('Formacao_Funcionarios.id,Funcionarios.fNome,Funcionarios.fNomes,Funcionarios.fApelido,Funcionarios.fBI_Passaporte,
              Formacao_Funcionarios.Funcionarios_id,
              Formacao_Funcionarios.fofuCurso,Formacao_Funcionarios.fofuNota,
              Formacao_Funcionarios.fofuAno_Inicio,Formacao_Funcionarios.fofuAno_Fin,Formacao_Funcionarios.fofuTema_Tese,
              Formacao_Funcionarios.Graus_Pretendidos_id,Graus_Pretendidos.gpNome,
              Formacao_Funcionarios.Universidades_id,Universidades.univNome,
              Formacao_Funcionarios.Modalidades_Formacao_id,Modalidades_Formacao.mfNome,
              Formacao_Funcionarios.Pais_id,Pais.paNome');
          $this->db->from('Formacao_Funcionarios');
          //$this->db->join('Bolsa_Funcionarios', 'Em_Formacao_Funcionarios.Bolsa_Funcionarios_id = Bolsa_Funcionarios.id');
          $this->db->join('Funcionarios', 'Formacao_Funcionarios.Funcionarios_id = Funcionarios.id');
          $this->db->join('Graus_Pretendidos', 'Formacao_Funcionarios.Graus_Pretendidos_id = Graus_Pretendidos.id');
          $this->db->join('Universidades', 'Formacao_Funcionarios.Universidades_id = Universidades.id');
          //$this->db->join('Orgao_Provendor_Bolsas', 'Em_Formacao_Funcionarios.Orgao_Provendor_Bolsas_id = Orgao_Provendor_Bolsas.id');
          $this->db->join('Modalidades_Formacao', 'Formacao_Funcionarios.Modalidades_Formacao_id = Modalidades_Formacao.id');
          $this->db->join('Pais', 'Formacao_Funcionarios.Pais_id = Pais.id');
          //$this->db->join('Provincias', 'Em_Formacao_Funcionarios.Provincias_id = Provincias.id');
          $consulta = $this->db->get();
          return $consulta->result();
      }
      //para curriculum
      function mreadXid($id){
          $this->db->select('Formacao_Funcionarios.id,Funcionarios.fNome,Funcionarios.fNomes,Funcionarios.fApelido,Funcionarios.fBI_Passaporte,
              Formacao_Funcionarios.Funcionarios_id,
              Formacao_Funcionarios.fofuCurso,Formacao_Funcionarios.fofuNota,
              Formacao_Funcionarios.fofuAno_Inicio,Formacao_Funcionarios.fofuAno_Fin,Formacao_Funcionarios.fofuTema_Tese,
              Formacao_Funcionarios.Graus_Pretendidos_id,Graus_Pretendidos.gpNome,
              Formacao_Funcionarios.Universidades_id,Universidades.univNome,
              Formacao_Funcionarios.Modalidades_Formacao_id,Modalidades_Formacao.mfNome,
              Formacao_Funcionarios.Pais_id,Pais.paNome');
          $this->db->from('Formacao_Funcionarios');
          //$this->db->join('Bolsa_Funcionarios', 'Em_Formacao_Funcionarios.Bolsa_Funcionarios_id = Bolsa_Funcionarios.id');
          $this->db->join('Funcionarios', 'Formacao_Funcionarios.Funcionarios_id = Funcionarios.id');
          $this->db->join('Graus_Pretendidos', 'Formacao_Funcionarios.Graus_Pretendidos_id = Graus_Pretendidos.id');
          $this->db->join('Universidades', 'Formacao_Funcionarios.Universidades_id = Universidades.id');
          //$this->db->join('Orgao_Provendor_Bolsas', 'Em_Formacao_Funcionarios.Orgao_Provendor_Bolsas_id = Orgao_Provendor_Bolsas.id');
          $this->db->join('Modalidades_Formacao', 'Formacao_Funcionarios.Modalidades_Formacao_id = Modalidades_Formacao.id');
          $this->db->join('Pais', 'Formacao_Funcionarios.Pais_id = Pais.id');
          $this->db->where('Formacao_Funcionarios.Funcionarios_id', $id);
          $this->db->order_by('fofuAno_Inicio', 'DESC');
          $consulta = $this->db->get();
          return $consulta->result();
      }
      
      public function total(){
        $this->db->select('Formacao_Funcionarios.id');
          $this->db->from('Formacao_Funcionarios');
        return $this->db->count_all_results();
      }
       
    function mupdate($id,$Funcionarios_id,$Universidades_id,$fofuCurso,
                $fofuAno_Inicio,$fofuAno_Fin,$fofuTema_Tese,$gpNome,$mfNome,$paNome,$fofuNota){
            $dados = array('Funcionarios_id'=>$Funcionarios_id,'Universidades_id'=>$Universidades_id,
                'fofuCurso'=>$fofuCurso,'fofuAno_Inicio'=>$fofuAno_Inicio,'fofuAno_Fin'=>$fofuAno_Fin,
                'fofuTema_Tese'=>$fofuTema_Tese,'Graus_Pretendidos_id'=>$gpNome,
                'Modalidades_Formacao_id'=>$mfNome,'Pais_id'=>$paNome,'fofuNota'=>$fofuNota);
            if($this->db->update('Formacao_Funcionarios', $dados, array('id' => $id))){
                return true;
            }else
                return false;
    }
       
    function minsert($Funcionarios_id,$Universidades_id,$fofuCurso,
                $fofuAno_Inicio,$fofuAno_Fin,$fofuTema_Tese,$gpNome,$mfNome,$paNome,$fofuNota){
        if($this->db->insert('Formacao_Funcionarios', array('Funcionarios_id'=>$Funcionarios_id,
            'Universidades_id'=>$Universidades_id,'fofuCurso'=>$fofuCurso,'fofuAno_Inicio'=>$fofuAno_Inicio,
            'fofuAno_Fin'=>$fofuAno_Fin,'fofuTema_Tese'=>$fofuTema_Tese,'Graus_Pretendidos_id'=>$gpNome,
            'Modalidades_Formacao_id'=>$mfNome,'Pais_id'=>$paNome,'fofuNota'=>$fofuNota)))
        {
            return true;
        }else{
            return false;
        }
           
    }
    function mdelete($id) {
        if($this->db->delete('Formacao_Funcionarios', array('id' => $id)))  
            return true;
        else
            return false;
        
    }
       
          
  }
