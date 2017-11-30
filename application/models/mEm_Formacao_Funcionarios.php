<?php
  class MEm_Formacao_Funcionarios extends CI_Model{
      
      function mread(){
          $this->db->select('Em_Formacao_Funcionarios.id,Funcionarios.fNome,Funcionarios.fNomes,Funcionarios.fApelido,Funcionarios.fBI_Passaporte,
              Em_Formacao_Funcionarios.Funcionarios_id,
              Em_Formacao_Funcionarios.id,Em_Formacao_Funcionarios.ffCurso,Em_Formacao_Funcionarios.ffOpcao,
              Em_Formacao_Funcionarios.ffWeb_Site_Univ,Em_Formacao_Funcionarios.ffEmail_Secretaria,Em_Formacao_Funcionarios.ffAno_Inicio,
              Em_Formacao_Funcionarios.ffAno_Fin,Em_Formacao_Funcionarios.ffTema_Tese,
              Em_Formacao_Funcionarios.Graus_Pretendidos_id,Graus_Pretendidos.gpNome,
              Em_Formacao_Funcionarios.Universidades_id,Universidades.univNome,
              Em_Formacao_Funcionarios.Orgao_Provendor_Bolsas_id,Orgao_Provendor_Bolsas.opbNome,
              Em_Formacao_Funcionarios.Modalidades_Formacao_id,Modalidades_Formacao.mfNome,
              Em_Formacao_Funcionarios.Pais_id,Pais.paNome,
              Em_Formacao_Funcionarios.ffCidade,
              Em_Formacao_Funcionarios.Bolsa_Funcionarios_id,Bolsa_Funcionarios.bolNome');
          $this->db->from('Em_Formacao_Funcionarios');
          $this->db->join('Bolsa_Funcionarios', 'Em_Formacao_Funcionarios.Bolsa_Funcionarios_id = Bolsa_Funcionarios.id');
          $this->db->join('Funcionarios', 'Em_Formacao_Funcionarios.Funcionarios_id = Funcionarios.id');
          $this->db->join('Graus_Pretendidos', 'Em_Formacao_Funcionarios.Graus_Pretendidos_id = Graus_Pretendidos.id');
          $this->db->join('Universidades', 'Em_Formacao_Funcionarios.Universidades_id = Universidades.id');
          $this->db->join('Orgao_Provendor_Bolsas', 'Em_Formacao_Funcionarios.Orgao_Provendor_Bolsas_id = Orgao_Provendor_Bolsas.id');
          $this->db->join('Modalidades_Formacao', 'Em_Formacao_Funcionarios.Modalidades_Formacao_id = Modalidades_Formacao.id');
          $this->db->join('Pais', 'Em_Formacao_Funcionarios.Pais_id = Pais.id');
          //$this->db->join('Provincias', 'Em_Formacao_Funcionarios.Provincias_id = Provincias.id');
          $consulta = $this->db->get();
          return $consulta->result();
      }
      
      public function total(){
        $this->db->select('Em_Formacao_Funcionarios.id');
          $this->db->from('Em_Formacao_Funcionarios');
        return $this->db->count_all_results();
      }
       
    function mupdateEF($id,$Funcionarios_id,$Universidades_id,$ffCurso,
                $ffOpcao,$ffWeb_Site_Univ,$ffEmail_Secretaria,$ffAno_Inicio,$ffAno_Fin,$bolNome,$ffTema_Tese,
                $gpNome,$opbNome,$mfNome,$paNome,$ffCidade){
            $dados = array('Funcionarios_id'=>$Funcionarios_id,'Universidades_id'=>$Universidades_id,'ffCurso'=>$ffCurso,'ffOpcao'=>$ffOpcao,'ffWeb_Site_Univ'=>$ffWeb_Site_Univ,
                'ffEmail_Secretaria'=>$ffEmail_Secretaria,'ffAno_Inicio'=>$ffAno_Inicio,'ffAno_Fin'=>$ffAno_Fin,
                'Bolsa_Funcionarios_id'=>$bolNome,'ffTema_Tese'=>$ffTema_Tese,'Graus_Pretendidos_id'=>$gpNome,
                'Orgao_Provendor_Bolsas_id'=>$opbNome,'Modalidades_Formacao_id'=>$mfNome,'Pais_id'=>$paNome,'ffCidade'=>$ffCidade);
            if($this->db->update('Em_Formacao_Funcionarios', $dados, array('id' => $id))){
                return true;
            }else
                return false;
    }
       
    function minsert($Funcionarios_id,$univNome,$ffCurso,$ffOpcao,$ffWeb_Site_Univ,$ffEmail_Secretaria,$ffAno_Inicio,
            $ffAno_Fin,$bolNome,$ffTema_Tese,$gpNome,$opbNome,$mfNome,$paNome,$ffCidade){
        if($this->db->insert('Em_Formacao_Funcionarios', array('Funcionarios_id'=>$Funcionarios_id,'Universidades_id'=>$univNome,'ffCurso'=>$ffCurso,
            'ffOpcao'=>$ffOpcao,'ffWeb_Site_Univ' => $ffWeb_Site_Univ,'ffEmail_Secretaria'=>$ffEmail_Secretaria,
            'ffAno_Inicio'=>$ffAno_Inicio,'ffAno_Fin'=>$ffAno_Fin,'Bolsa_Funcionarios_id'=>$bolNome,'ffTema_Tese'=>$ffTema_Tese,
            'Graus_Pretendidos_id'=>$gpNome,'Orgao_Provendor_Bolsas_id'=>$opbNome,'Modalidades_Formacao_id'=>$mfNome,'Pais_id'=>$paNome,'ffCidade'=>$ffCidade)))
        {
            return true;
        }else{
            return false;
        }
           
    }
    function mdelete($id) {
        if($this->db->delete('Em_Formacao_Funcionarios', array('id' => $id)))  
            return true;
        else
            return false;
        
    }
       
          
  }
