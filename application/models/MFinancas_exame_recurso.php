<?php
  class MFinancas_exame_recurso extends CI_Model{
      
      function mread(){
          $this->db->select('financas_exame_recurso.id,fc_data,fc_hora,fc_valor,fc_ref_pag,
            Financas_Forma_Pagamento_id, Financas_Forma_Pagamento.ffpNome,
            Financas_Contas_id, Financas_Contas.contNumero,
            anos_lectivos.alAno,
            Estudantes_id,
            candidatos.cnome,candidatos.cnomes,candidatos.capelido,candidatos.cbi_passaporte');
          $this->db->from('financas_exame_recurso');
          $this->db->join('Financas_Forma_Pagamento', 'financas_exame_recurso.Financas_Forma_Pagamento_id = Financas_Forma_Pagamento.id');
          $this->db->join('Financas_Contas', 'financas_exame_recurso.Financas_Contas_id = Financas_Contas.id');
          $this->db->join('anos_lectivos', 'financas_exame_recurso.anos_lectivos_id = anos_lectivos.id');
          $this->db->join('Estudantes', 'financas_exame_recurso.Estudantes_id = Estudantes.id');
          $this->db->join('Candidatos', 'Estudantes.Candidatos_id = Candidatos.id');
          $consulta = $this->db->get();
          $ord=1;
          $data = array();
            foreach ($consulta->result() as $row) {
                    $data[] = array(
                        "ord" => $ord,
                        "id" => $row->id,
                        "fc_data" => $row->fc_data,
                        "fc_hora" => $row->fc_hora,
                        "fc_ref_pag" => $row->fc_ref_pag,
                        "fc_valor" => $row->fc_valor,
                        "ffpNome" => $row->ffpNome,
                        "contNumero" => $row->contNumero,
                        "alAno" => $row->alAno,
                        "cnome" => $row->cnome,
                        "cnomes" => $row->cnomes,
                        "capelido" => $row->capelido,
                        "cbi_passaporte" => $row->cbi_passaporte,
                    );
                    $ord++;
            }
            return $data;
      }

      function mreadX_id($id){
        $this->db->select('financas_exame_recurso.id,fc_data,fc_hora,fc_valor,fc_ref_pag,
          Financas_Forma_Pagamento_id, Financas_Forma_Pagamento.ffpNome,
          Financas_Contas_id, Financas_Contas.contNumero,
          anos_lectivos.alAno,
          Estudantes_id,
          candidatos.cnome,candidatos.cnomes,candidatos.capelido,candidatos.cbi_passaporte');
        $this->db->from('financas_exame_recurso');
        $this->db->join('Financas_Forma_Pagamento', 'financas_exame_recurso.Financas_Forma_Pagamento_id = Financas_Forma_Pagamento.id');
        $this->db->join('Financas_Contas', 'financas_exame_recurso.Financas_Contas_id = Financas_Contas.id');
        $this->db->join('anos_lectivos', 'financas_exame_recurso.anos_lectivos_id = anos_lectivos.id');
        $this->db->join('Estudantes', 'financas_exame_recurso.Estudantes_id = Estudantes.id');
        $this->db->join('Candidatos', 'Estudantes.Candidatos_id = Candidatos.id');
        $this->db->where('Candidatos.id', $id);
        $consulta = $this->db->get();
        $ord=1;
        $data = array();
          foreach ($consulta->result() as $row) {
                  $data[] = array(
                      "ord" => $ord,
                      "id" => $row->id,
                      "fc_data" => $row->fc_data,
                      "fc_hora" => $row->fc_hora,
                      "fc_ref_pag" => $row->fc_ref_pag,
                      "fc_valor" => $row->fc_valor,
                      "ffpNome" => $row->ffpNome,
                      "contNumero" => $row->contNumero,
                      "alAno" => $row->alAno,
                      "cnome" => $row->cnome,
                      "cnomes" => $row->cnomes,
                      "capelido" => $row->capelido,
                      "cbi_passaporte" => $row->cbi_passaporte,
                  );
                  $ord++;
          }
          return $data;
    }

      function mupdate($id,$fc_data,$fc_hora,$fc_ref_pag,$fc_valor,$Financas_Forma_Pagamento_id,$Financas_Contas_id,$anos_lectivos_id,$Estudantes_id){
            $dados = array('fc_data'=>$fc_data, 'fc_hora'=>$fc_hora, 'fc_ref_pag'=>$fc_ref_pag, 'fc_valor'=>$fc_valor,
                'Financas_Forma_Pagamento_id'=>$Financas_Forma_Pagamento_id, 'Financas_Contas_id'=>$Financas_Contas_id,
                'anos_lectivos_id'=>$anos_lectivos_id, 'Estudantes_id'=>$Estudantes_id);
            if($this->db->update('financas_exame_recurso', $dados, array('id' => $id))){
                return true;
            }else
                return false;
      }
      
    function minsert($fc_data,$fc_hora,$fc_ref_pag,$fc_valor,$Financas_Forma_Pagamento_id,$Financas_Contas_id,$anos_lectivos_id,$Estudantes_id){
        $dados = array('fc_data'=>$fc_data, 'fc_hora'=>$fc_hora, 'fc_ref_pag'=>$fc_ref_pag, 'fc_valor'=>$fc_valor,
        'Financas_Forma_Pagamento_id'=>$Financas_Forma_Pagamento_id, 'Financas_Contas_id'=>$Financas_Contas_id,
        'anos_lectivos_id'=>$anos_lectivos_id, 'Estudantes_id'=>$Estudantes_id);
        if($this->db->insert('financas_exame_recurso', $dados))
        {
            return true;
        }else{
            return false;
        }
           
    }
    function mdelete($id) {
        if($this->db->delete('financas_exame_recurso', array('id' => $id)))  
            return true;
        else
            return false;
        
    }       
           
  }
