<?php
  class Mchefes_sectores_utilizadores extends CI_Model{
      
      function mread(){
          $this->db->select('chefes_sectores_utilizadores.id,chefes_sectores_utilizadores.funcionarios_id,
          chefes_sectores_utilizadores.utilizadores_id, chefes_sectores_utilizadores.sectores_id,
            funcionarios.fnome,funcionarios.fnomes,funcionarios.fapelido,funcionarios.fbi_passaporte,
            utilizadores.uusuario,
            sectores.secnome');
          $this->db->from('chefes_sectores_utilizadores');
          $this->db->join('funcionarios', 'chefes_sectores_utilizadores.Funcionarios_id = funcionarios.id');
          $this->db->join('utilizadores', 'chefes_sectores_utilizadores.utilizadores_id = utilizadores.id');
          $this->db->join('sectores', 'chefes_sectores_utilizadores.sectores_id = sectores.id');
          $consulta = $this->db->get();
          $ord=1;
          $data = array();
            foreach ($consulta->result() as $row) {
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
                        "sectores_id" => $row->sectores_id,
                        "secnome" => $row->secnome,
                    );
                    $ord++;
            }
            return $data;
      }
    //para combobox planificacoes
    function mread_fid(){
        $this->db->select('chefes_sectores_utilizadores.id,
                          funcionarios.fnome,funcionarios.fnomes,funcionarios.fapelido');
        $this->db->from('chefes_sectores_utilizadores');
        $this->db->join('funcionarios', 'chefes_sectores_utilizadores.funcionarios_id = funcionarios.id');
        $this->db->join('utilizadores', 'chefes_sectores_utilizadores.utilizadores_id = utilizadores.id');
        $this->db->join('sectores', 'chefes_sectores_utilizadores.sectores_id = sectores.id');
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
        $this->db->select('sectores_id');
        $this->db->from('chefes_sectores_id_utilizadores');
        $this->db->where('utilizadores_id', $idu);
        $consulta = $this->db->get();
        $data = array();
        foreach ($consulta->result() as $row) {
            return $row->sectores_id_id;
        }
    } 

      function mexiste($funcionarios_id){
          $this->db->select('id');
          $this->db->from('chefes_sectores_utilizadores');
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
          $this->db->select('sectores.depnome');
          $this->db->from('sectores');
          $this->db->join('niveis_cursos', 'niveis_cursos.sectores_id = sectores.id');
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
      function mcomprobar_sector_usuario(/*$dpto_est,*/$user, $n,$c,$bi){
          //ver deparatamento por bi
          $dpto = $this->mdpto_x_bi($n,$c,$bi);

          $this->db->select('sectores.depnome, utilizadores.uusuario');
          $this->db->from('chefes_sectores_utilizadores');
          $this->db->join('funcionarios', 'chefes_sectores_utilizadores.funcionarios_id = funcionarios.id');
          $this->db->join('utilizadores', 'chefes_sectores_utilizadores.utilizadores_id = utilizadores.id');
          $this->db->join('sectores', 'chefes_sectores_utilizadores.sectores_id = sectores.id');
          $this->db->where('utilizadores.uusuario', $user);
          $this->db->where('sectores.depnome', $dpto);
          if($this->db->count_all_results() > 0)
            return true;
          else
            return false;
      }

      function mget_id($fnome,$fapelido){
            $this->db->select('chefes_sectores_utilizadores.id');
            $this->db->from('chefes_sectores_utilizadores');
            $this->db->join('funcionarios', 'chefes_sectores_utilizadores.funcionarios_id = funcionarios.id');
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
        $this->db->select('sectores.depnome');
        $this->db->from('chefes_sectores_utilizadores');
        $this->db->join('utilizadores', 'chefes_sectores_utilizadores.utilizadores_id = utilizadores.id');
        $this->db->join('sectores', 'chefes_sectores_utilizadores.sectores_id = sectores.id');
        $this->db->where('utilizadores.uusuario', $user);
        if($this->db->count_all_results() > 0)
          return true;
        else
          return false;
    }

      function mupdate($id,$funcionarios_id,$utilizadores_id,$sectores_id){
            $dados = array('otNome'=>$otNome,'otCodigo'=>$otCodigo);
            if($this->db->update('chefes_sectores_utilizadores', $dados, array('id' => $id))){
                return true;
            }else
                return false;
      }
      
    function minsert($funcionarios_id,$utilizadores_id,$sectores_id){
        if($this->db->insert('chefes_sectores_utilizadores', array('funcionarios_id'=>$funcionarios_id,'utilizadores_id'=>$utilizadores_id,'sectores_id'=>$sectores_id)))
        {
            return true;
        }else{
            return false;
        }
           
    }
    function mdelete($id) {
        if($this->db->delete('chefes_sectores_utilizadores', array('id' => $id)))  
            return true;
        else
            return false;
        
    }       
           
  }
