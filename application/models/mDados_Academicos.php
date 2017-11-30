<?php
  class MDados_Academicos extends CI_Model{
      
    /*  function mread(){
          $this->db->select('Trabalhador.id,Trabalhador.trabNome');
          $this->db->from('Trabalhador');
          $consulta = $this->db->get();
          $data = array();
        foreach ($consulta->result() as $row) {
            $data[] = array(
                "id" => $row->id,
                "trabNome" => $row->trabNome,
                "value" => $row->trabNome
            );
        }
        return $data;
      }

      function mGetID($Nome){
          $this->db->select('id');
          $this->db->from('Trabalhador');
          $this->db->where('Trabalhador.trabNome', $Nome);
          $consulta = $this->db->get();
          foreach($consulta->result() as $value) {
              return $value->id;
          }
      }
      */
      function mGet_pfXCandidato_id($id){
          $this->db->select('Formacao_Pais_id');
          $this->db->from('Dados_Academicos_Candidatos');
          $this->db->where('Candidatos_id', $id);
          $consulta = $this->db->get();
          foreach($consulta->result() as $value) {
              return $value->Formacao_Pais_id;
          }
      }

      function mGet_provfXCandidato_id($id){
          $this->db->select('Formacao_Provincias_id');
          $this->db->from('Dados_Academicos_Candidatos');
          $this->db->where('Candidatos_id', $id);
          $consulta = $this->db->get();
          foreach($consulta->result() as $value) {
              return $value->Formacao_Provincias_id;
          }
      }
      function mGet_hlXCandidato_id($id){
          $this->db->select('Habilitacoes_Literarias_Candidatos_id');
          $this->db->from('Dados_Academicos_Candidatos');
          $this->db->where('Candidatos_id', $id);
          $consulta = $this->db->get();
          foreach($consulta->result() as $value) {
              return $value->Habilitacoes_Literarias_Candidatos_id;
          }
      }  
      function mGet_efXCandidato_id($id){
          $this->db->select('Escola_Formacao_id');
          $this->db->from('Dados_Academicos_Candidatos');
          $this->db->where('Candidatos_id', $id);
          $consulta = $this->db->get();
          foreach($consulta->result() as $value) {
              return $value->Escola_Formacao_id;
          }
      }
      function mGet_opcXCandidato_id($id){
          $this->db->select('Opcao_id');
          $this->db->from('Dados_Academicos_Candidatos');
          $this->db->where('Candidatos_id', $id);
          $consulta = $this->db->get();
          foreach($consulta->result() as $value) {
              return $value->Opcao_id;
          }
      }
      function mGet_anoXCandidato_id($id){
          $this->db->select('Ano');
          $this->db->from('Dados_Academicos_Candidatos');
          $this->db->where('Candidatos_id', $id);
          $consulta = $this->db->get();
          foreach($consulta->result() as $value) {
              return $value->Ano;
          }
      }
      function mGet_mediaXCandidato_id($id){
          $this->db->select('Media');
          $this->db->from('Dados_Academicos_Candidatos');
          $this->db->where('Candidatos_id', $id);
          $consulta = $this->db->get();
          foreach($consulta->result() as $value) {
              return $value->Media;
          }
      }
      function mreadProvinciaXcandidato($candidato_id){
          $this->db->select('Provincias.id,Provincias.provNome');
          $this->db->from('Provincias');
          $this->db->join('Dados_Academicos_Candidatos','Dados_Academicos_Candidatos.Formacao_Provincias_id = Provincias.id');
          $this->db->where('Dados_Academicos_Candidatos.Candidatos_id',$candidato_id);
          $consulta = $this->db->get();
          foreach($consulta->result() as $row){
              return $row->provNome;
          }
      }
  }
