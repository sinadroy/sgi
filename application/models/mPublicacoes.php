<?php
  class MPublicacoes extends CI_Model{
      
      function mread(){
          $this->db->select('Funcionarios.fNome,Funcionarios.fNomes,Funcionarios.fApelido,Funcionarios.fBI_Passaporte,
              Publicacoes.id,Publicacoes.Funcionarios_id,Publicacoes.pubTitulo,Publicacoes.pubAno,
              Publicacoes.pubEditora_Revista,Publicacoes.pubISBN_ISSN,Publicacoes.Pais_id,Pais.paNome,
              Publicacoes.Tipo_Publicacoes_id,Tipo_Publicacoes.tpubNome');
          $this->db->from('Publicacoes');
          $this->db->join('Tipo_Publicacoes', 'Publicacoes.Tipo_Publicacoes_id = Tipo_Publicacoes.id');
          $this->db->join('Funcionarios', 'Publicacoes.Funcionarios_id = Funcionarios.id');
          $this->db->join('Pais', 'Publicacoes.Pais_id = Pais.id');
          $consulta = $this->db->get();
          return $consulta->result();
      }
      //para curriculum
      function mreadXid($id){
          $this->db->select('Funcionarios.fNome,Funcionarios.fNomes,Funcionarios.fApelido,Funcionarios.fBI_Passaporte,
              Publicacoes.id,Publicacoes.Funcionarios_id,Publicacoes.pubTitulo,Publicacoes.pubAno,
              Publicacoes.pubEditora_Revista,Publicacoes.pubISBN_ISSN,Publicacoes.Pais_id,Pais.paNome,
              Publicacoes.Tipo_Publicacoes_id,Tipo_Publicacoes.tpubNome');
          $this->db->from('Publicacoes');
          $this->db->join('Tipo_Publicacoes', 'Publicacoes.Tipo_Publicacoes_id = Tipo_Publicacoes.id');
          $this->db->join('Funcionarios', 'Publicacoes.Funcionarios_id = Funcionarios.id');
          $this->db->join('Pais', 'Publicacoes.Pais_id = Pais.id');
          $this->db->where('Publicacoes.Funcionarios_id', $id);
          $this->db->order_by('pubAno', 'DESC');
          $consulta = $this->db->get();
          return $consulta->result();
      }
      
      public function total(){
        $this->db->select('Publicacoes.id');
          $this->db->from('Publicacoes');
        return $this->db->count_all_results();
      }
       
    function mupdate($id,$Funcionarios_id,$pubTitulo,$pubAno,$pubEditora_Revista,$pubISBN_ISSN,$Pais_id,$Tipo_Publicacoes_id){
            $dados = array('Funcionarios_id'=>$Funcionarios_id,'pubTitulo'=>$pubTitulo,
                'pubAno'=>$pubAno,'pubEditora_Revista'=>$pubEditora_Revista,'pubISBN_ISSN'=>$pubISBN_ISSN,
                'Pais_id'=>$Pais_id,'Tipo_Publicacoes_id'=>$Tipo_Publicacoes_id);
            if($this->db->update('Publicacoes', $dados, array('id' => $id))){
                return true;
            }else
                return false;
    }
    /*
    Funcionarios_id:6
    pubTitulo:asd
    pubAno:2014
    pubEditora_Revista:asd
    pubISBN_ISSN:1234
    tpubNome:2
    paNome:2
     */   
    function minsert($Funcionarios_id,$pubTitulo,$pubAno,$pubEditora_Revista,$pubISBN_ISSN,$Pais_id,$Tipo_Publicacoes_id){
        if($this->db->insert('Publicacoes', array('Funcionarios_id'=>$Funcionarios_id,'pubTitulo'=>$pubTitulo,
                'pubAno'=>$pubAno,'pubEditora_Revista'=>$pubEditora_Revista,'pubISBN_ISSN'=>$pubISBN_ISSN,
                'Pais_id'=>$Pais_id,'Tipo_Publicacoes_id'=>$Tipo_Publicacoes_id)))
        {
            return true;
        }else{
            return false;
        }
           
    }
    function mdelete($id) {
        if($this->db->delete('Publicacoes', array('id' => $id)))  
            return true;
        else
            return false;
        
    }
       
          
  }
