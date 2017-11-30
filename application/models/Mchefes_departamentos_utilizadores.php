<?php
  class Mchefes_departamentos_utilizadores extends CI_Model{
      
      function mread(){
          $this->db->select('chefes_departamentos_utilizadores.id,chefes_departamentos_utilizadores.funcionarios_id,
          chefes_departamentos_utilizadores.utilizadores_id, chefes_departamentos_utilizadores.departamentos_id,
            funcionarios.fnome,funcionarios.fnomes,funcionarios.fapelido,funcionarios.fbi_passaporte,
            utilizadores.uusuario,
            departamentos.depnome');
          $this->db->from('chefes_departamentos_utilizadores');
          $this->db->join('funcionarios', 'chefes_departamentos_utilizadores.funcionarios_id = funcionarios.id');
          $this->db->join('utilizadores', 'chefes_departamentos_utilizadores.utilizadores_id = utilizadores.id');
          $this->db->join('departamentos', 'chefes_departamentos_utilizadores.departamentos_id = departamentos.id');
          $consulta = $this->db->get();
          $ord=1;
          $data = array();
            foreach ($consulta->result() as $row) {
                if($row->id != 1){
                    $data[] = array(
                        "ord" => $ord,
                        "id" => $row->id,
                        "funcionarios_id" => $row->funcionarios_id,
                        "fnome" => $row->fnome,
                        "fnomes" => $row->fnomes,
                        "fapelido" => $row->fapelido,
                        "fbi_passaporte" => $row->fbi_passaporte,
                        "utilizadores_id" => $row->utilizadores_id,
                        "uusuario" => $row->uusuario,
                        "departamentos_id" => $row->departamentos_id,
                        "depnome" => $row->depnome,
                    );
                    $ord++;
                }
            }
            return $data;
      }
    //para combobox planificacoes
    function mread_fid(){
        $this->db->select('chefes_departamentos_utilizadores.id,
                          funcionarios.fnome,funcionarios.fnomes,funcionarios.fapelido');
        $this->db->from('chefes_departamentos_utilizadores');
        $this->db->join('funcionarios', 'chefes_departamentos_utilizadores.funcionarios_id = funcionarios.id');
        $this->db->join('utilizadores', 'chefes_departamentos_utilizadores.utilizadores_id = utilizadores.id');
        $this->db->join('departamentos', 'chefes_departamentos_utilizadores.departamentos_id = departamentos.id');
        //$this->db->where('funcionarios_id', $funcionarios_id);
        $consulta = $this->db->get();
        $data = array();
          foreach ($consulta->result() as $row) {
              if($row->id != 1){
                  $data[] = array(
                      "id" => $row->id,
                      "fnome" => $row->fnome.' '.$row->fnomes.' '.$row->fapelido,
                      "value" => $row->fnome.' '.$row->fnomes.' '.$row->fapelido,
                  );
              }
          }
          return $data;
    }

    //obtener dpto id apartir del user id
    function mread_dpto_id($idu){
        $this->db->select('Departamentos_id');
        $this->db->from('chefes_departamentos_utilizadores');
        $this->db->where('utilizadores_id', $idu);
        $consulta = $this->db->get();
        $data = array();
        foreach ($consulta->result() as $row) {
            return $row->Departamentos_id;
        }
    } 

      function mexiste($funcionarios_id){
          $this->db->select('id');
          $this->db->from('chefes_departamentos_utilizadores');
          $this->db->where('funcionarios_id', $funcionarios_id);
          if($this->db->count_all_results() > 0)
            return true;
          else
            return false;
      }
      //ver si existe un chefe por el bi
      function mexiste_x_bi($bi){
          $this->db->select('id');
          $this->db->from('funcionarios');
          $this->db->where('fBI_Passaporte', $bi);
          if($this->db->count_all_results() > 0)
            return true;
          else
            return false;
      }
      //saber departamento del curso de un estudante por su bi
      function mdpto_x_bi($n,$c,$bi){
          $this->db->select('departamentos.depnome');
          $this->db->from('departamentos');
          $this->db->join('niveis_cursos', 'niveis_cursos.departamentos_id = departamentos.id');
          $this->db->join('niveis', 'niveis_cursos.niveis_id = niveis.id');
          $this->db->join('cursos', 'niveis_cursos.cursos_id = cursos.id');
          $this->db->join('Estudantes', 'Estudantes.niveis_cursos_id = niveis_cursos.id');
          $this->db->join('Candidatos', 'Estudantes.Candidatos_id = Candidatos.id');
          $this->db->where('niveis.nnome', $n);
          $this->db->where('cursos.cnome', $c);
          $this->db->where('Candidatos.cBI_Passaporte', $bi);
          $consulta = $this->db->get();
          foreach ($consulta->result() as $row) {
                 return $row->depnome;
          }
      }
      //retornar departamento por usuario
      function mcomprobar_departamento_usuario(/*$dpto_est,*/$user, $n,$c,$bi){
          //ver deparatamento por bi
          $dpto = $this->mdpto_x_bi($n,$c,$bi);

          $this->db->select('departamentos.depnome, utilizadores.uusuario');
          $this->db->from('chefes_departamentos_utilizadores');
          $this->db->join('funcionarios', 'chefes_departamentos_utilizadores.funcionarios_id = funcionarios.id');
          $this->db->join('utilizadores', 'chefes_departamentos_utilizadores.utilizadores_id = utilizadores.id');
          $this->db->join('departamentos', 'chefes_departamentos_utilizadores.departamentos_id = departamentos.id');
          $this->db->where('utilizadores.uusuario', $user);
          $this->db->where('departamentos.depnome', $dpto);
          if($this->db->count_all_results() > 0)
            return true;
          else
            return false;
      }

      function mget_id($fnome,$fapelido){
            $this->db->select('chefes_departamentos_utilizadores.id');
            $this->db->from('chefes_departamentos_utilizadores');
            $this->db->join('funcionarios', 'chefes_departamentos_utilizadores.funcionarios_id = funcionarios.id');
            $this->db->where('funcionarios.fnome', $fnome);
            $this->db->where('funcionarios.fapelido', $fapelido);
            $consulta = $this->db->get();
            foreach ($consulta->result() as $row) {
                $data[] = array(
                    "id" => $row->id,
                );
            }
            return $data;
      }

      //saber si el usuario es jefe de dpto
      function mdt_se_chefe_departamento($user){
        $this->db->select('departamentos.depnome');
        $this->db->from('chefes_departamentos_utilizadores');
        $this->db->join('utilizadores', 'chefes_departamentos_utilizadores.utilizadores_id = utilizadores.id');
        $this->db->join('departamentos', 'chefes_departamentos_utilizadores.departamentos_id = departamentos.id');
        $this->db->where('utilizadores.uusuario', $user);
        if($this->db->count_all_results() > 0)
          return true;
        else
          return false;
    }

      function mupdate($id,$funcionarios_id,$utilizadores_id,$departamentos_id){
            $dados = array('otNome'=>$otNome,'otCodigo'=>$otCodigo);
            if($this->db->update('chefes_departamentos_utilizadores', $dados, array('id' => $id))){
                return true;
            }else
                return false;
      }
      
    function minsert($funcionarios_id,$utilizadores_id,$departamentos_id){
        if($this->db->insert('chefes_departamentos_utilizadores', array('funcionarios_id'=>$funcionarios_id,'utilizadores_id'=>$utilizadores_id,'departamentos_id'=>$departamentos_id)))
        {
            return true;
        }else{
            return false;
        }
           
    }
    function mdelete($id) {
        if($this->db->delete('chefes_departamentos_utilizadores', array('id' => $id)))  
            return true;
        else
            return false;
        
    }       
           
  }
