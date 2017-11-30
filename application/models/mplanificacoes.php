<?php
  class Mplanificacoes extends CI_Model{
      
      function mread(){
          $this->db->select('planificacoes.id,pactividade,pdescricao,psupervisor,
            pdatainicio,pdatafim,presposta,pestado,
            funcionarios.fnome,funcionarios.fnomes,funcionarios.fapelido,
            alAno,anos_lectivos_id,
            chefes_departamentos_utilizadores_id');
          $this->db->from('planificacoes');
          $this->db->join('chefes_departamentos_utilizadores', 'planificacoes.chefes_departamentos_utilizadores_id = chefes_departamentos_utilizadores.id');
          $this->db->join('funcionarios', 'chefes_departamentos_utilizadores.funcionarios_id = funcionarios.id');
          $this->db->join('anos_lectivos', 'planificacoes.anos_lectivos_id = anos_lectivos.id');
          //$this->db->where('tanome', 'Administrativa');
          $consulta = $this->db->get();
          $data = array();
          $ord = 1;
            foreach ($consulta->result() as $row) {
                $data[] = array(
                    "id" => $row->id,
                    "ord" => $ord,
                    "pactividade" => $row->pactividade,
                    "pdescricao" => $row->pdescricao,
                    "psupervisor" => $row->psupervisor,
                    "pdatainicio" => $row->pdatainicio,
                    "pdatafim" => $row->pdatafim,
                    "presposta" => $row->presposta,
                    "pestado" => $row->pestado,
                    "fnome" => $row->fnome,
                    "fnomes" => $row->fnomes,
                    "fapelido" => $row->fapelido,
                    "anos_lectivos_id" => $row->anos_lectivos_id,
                    "alAno" => $row->alAno,
                    "cduid" => $row->chefes_departamentos_utilizadores_id
                );
                $ord++;
            }
            return $data;
      }

      function mread_x_chefe($chefe){
        $this->db->select('planificacoes.id,pactividade,pdescricao,psupervisor,
          pdatainicio,pdatafim,presposta,pestado,
          funcionarios.fnome,funcionarios.fnomes,funcionarios.fapelido,
          alAno,anos_lectivos_id,
          chefes_departamentos_utilizadores_id');
        $this->db->from('planificacoes');
        $this->db->join('chefes_departamentos_utilizadores', 'planificacoes.chefes_departamentos_utilizadores_id = chefes_departamentos_utilizadores.id');
        $this->db->join('utilizadores', 'chefes_departamentos_utilizadores.utilizadores_id = utilizadores.id');
        $this->db->join('funcionarios', 'chefes_departamentos_utilizadores.funcionarios_id = funcionarios.id');
        $this->db->join('anos_lectivos', 'planificacoes.anos_lectivos_id = anos_lectivos.id');
        $this->db->where('utilizadores.uUsuario', $chefe);
        $consulta = $this->db->get();
        $data = array();
        $ord = 1;
          foreach ($consulta->result() as $row) {
              $data[] = array(
                  "id" => $row->id,
                  "ord" => $ord,
                  "pactividade" => $row->pactividade,
                  "pdescricao" => $row->pdescricao,
                  "psupervisor" => $row->psupervisor,
                  "pdatainicio" => $row->pdatainicio,
                  "pdatafim" => $row->pdatafim,
                  "presposta" => $row->presposta,
                  "pestado" => $row->pestado,
                  "fnome" => $row->fnome,
                  "fnomes" => $row->fnomes,
                  "fapelido" => $row->fapelido,
                  "anos_lectivos_id" => $row->anos_lectivos_id,
                  "alAno" => $row->alAno,
                  "cduid" => $row->chefes_departamentos_utilizadores_id
              );
              $ord++;
          }
          return $data;
    }

      function msearch($search){
          $ord = 1;
        $this->db->select('planificacoes.id,pactividade,pdescricao,psupervisor,
        pdatainicio,pdatafim,presposta,pestado,
        funcionarios.fnome,funcionarios.fnomes,funcionarios.fapelido,
        alAno,anos_lectivos_id,
        chefes_departamentos_utilizadores_id');
        $this->db->from('planificacoes');
        $this->db->join('chefes_departamentos_utilizadores', 'planificacoes.chefes_departamentos_utilizadores_id = chefes_departamentos_utilizadores.id');
        $this->db->join('funcionarios', 'chefes_departamentos_utilizadores.funcionarios_id = funcionarios.id');
        $this->db->join('anos_lectivos', 'planificacoes.anos_lectivos_id = anos_lectivos.id');
        $this->db->like('pactividade',$search);
        $this->db->or_like('pdescricao',$search);
        $this->db->or_like('psupervisor',$search);
        $this->db->or_like('pdatainicio',$search);
        $this->db->or_like('pdatafim',$search);
        $this->db->or_like('presposta',$search);
        $this->db->or_like('pestado',$search);
        $this->db->or_like('fnome',$search);
        $this->db->or_like('alAno',$search);
        //$this->db->or_like('fnomes',$search);
        $this->db->or_like('fapelido',$search);
        $consulta = $this->db->get();
        $data = array();
          foreach ($consulta->result() as $row) {
                  $data[] = array(
                    "id" => $row->id,
                    "ord" => $ord,
                    "pactividade" => $row->pactividade,
                    "pdescricao" => $row->pdescricao,
                    "psupervisor" => $row->psupervisor,
                    "pdatainicio" => $row->pdatainicio,
                    "pdatafim" => $row->pdatafim,
                    "presposta" => $row->presposta,
                    "pestado" => $row->pestado,
                    "fnome" => $row->fnome,
                    "fnomes" => $row->fnomes,
                    "fapelido" => $row->fapelido,
                    "anos_lectivos_id" => $row->anos_lectivos_id,
                    "alAno" => $row->alAno,
                    "cduid" => $row->chefes_departamentos_utilizadores_id
                  );
                  $ord++;
          }
          return $data;
    }
      
    function mupdate($id,$pactividade,$pdescricao,$psupervisor,$pdatainicio,$pdatafim,$presposta,$pestado,$cduid,$alid){
            $dados = array('pactividade'=>$pactividade,
                            'pdescricao'=>$pdescricao,
                            'psupervisor'=>$psupervisor,
                            'pdatainicio'=>$pdatainicio,
                            'pdatafim'=>$pdatafim,
                            'presposta'=>$presposta,
                            'pestado'=>$pestado,
                            'chefes_departamentos_utilizadores_id'=>$cduid,
                            'anos_lectivos_id'=>$alid);
            if($this->db->update('planificacoes', $dados, array('id' => $id))){
                return $this->mread();
            }else
                return false;
    }

    function mupdate_crud($id,$presposta){
        $dados = array('presposta'=>$presposta);
        if($this->db->update('planificacoes', $dados, array('id' => $id))){
            return true;
        }else
            return false;
    } 
      
    function minsert($pactividade,$pdescricao,$psupervisor,$pdatainicio,$pdatafim,$presposta,$pestado,$cduid,$alid){
        //obt id de chefes_departamentos_utilizadores_id
        //$this->load->model('Mchefes_departamentos_utilizadores');
        //$id = $this->Mchefes_departamentos_utilizadores->mget_id($fnome,$fapelido);
        if($this->db->insert('planificacoes', array('pactividade' => $pactividade,
                                                    'pdescricao' => $pdescricao,
                                                    'psupervisor' => $psupervisor,
                                                    'pdatainicio' => $pdatainicio,
                                                    'pdatafim' => $pdatafim,
                                                    'presposta' => $presposta,
                                                    'pestado' => $pestado,
                                                    'chefes_departamentos_utilizadores_id' => $cduid,
                                                    "anos_lectivos_id" => $alid,
                                                    )))
            {
                return $this->mread();
            }else{
                return false;
            }
           
    }

    function mdelete($id) {
        if($this->db->delete('planificacoes', array('id' => $id)))  
            return $this->mread();
        else
            return false;
        
    }
           
  }
