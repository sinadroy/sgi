<?php
  class MHorario_Funcionarios extends CI_Model{
      
      function mread(){
          $this->db->select('Horario_Funcionarios.id,
          Horario_Funcionarios.Funcionarios_id,Funcionarios.fNome,Funcionarios.fNomes,Funcionarios.fApelido,Funcionarios.fBI_Passaporte,
          Horario_Funcionarios.Horario_Tipo_id,Horario_Tipo.htNome');
          $this->db->from('Horario_Funcionarios');
          $this->db->join('Funcionarios', 'Horario_Funcionarios.Funcionarios_id = Funcionarios.id');
          $this->db->join('Horario_Tipo', 'Horario_Funcionarios.Horario_Tipo_id = Horario_Tipo.id');
          $consulta = $this->db->get();
          $data = array();
          foreach($consulta->result() as $row){
              //$data[] = $row;
              $data[] = array(
                  "id"=>$row->id,
                  "Funcionarios_id"=>$row->Funcionarios_id,
                  "fNome"=>$row->fNome,
                  "value"=>$row->fNome,
                  "fNomes"=>$row->fNomes,
                  "fApelido"=>$row->fApelido,
                  "fBI_Passaporte"=>$row->fBI_Passaporte,
                  "Horario_Tipo_id"=>$row->Horario_Tipo_id,
                  "htNome"=>$row->htNome
              );
          }
        return $data;
      }
      function mupdate($id,$idf,$htNome){
            $dados = array('Funcionarios_id' => $idf,'Horario_Tipo_id' => $htNome);
            if($this->db->update('Horario_Funcionarios', $dados, array('id' => $id))){
                return true;
            }else
                return false;
      }
      
    function minsert($idf,$htNome){
        if($this->db->insert('Horario_Funcionarios', array('Funcionarios_id' => $idf,'Horario_Tipo_id' => $htNome)))
        {
            return true;
        }else{
            return false;
        }
           
    }
    function mdelete($id) {
        if($this->db->delete('Horario_Funcionarios', array('id' => $id)))  
            return true;
        else
            return false;
        
    }
    function mgetHoraEntrada($bi,$ses){
        $this->db->select('Tipo_Horario_Sessao.Entrada');
        $this->db->from('Horario_Funcionarios');
        $this->db->join('Funcionarios', 'Horario_Funcionarios.Funcionarios_id = Funcionarios.id');
        $this->db->join('Horario_Tipo', 'Horario_Funcionarios.Horario_Tipo_id = Horario_Tipo.id');
        $this->db->join('Tipo_Horario_Sessao', 'Tipo_Horario_Sessao.Horario_Tipo_id = Horario_Tipo.id');
        $this->db->join('Sessao_Trabalho_Administrativos', 'Tipo_Horario_Sessao.Sessao_Trabalho_Administrativos_id = Sessao_Trabalho_Administrativos.id');
        $this->db->where('Funcionarios.fBI_Passaporte', $bi);
        $this->db->where('Sessao_Trabalho_Administrativos.stCodigo', $ses);
        $consulta = $this->db->get();
        $data = array();
        foreach($consulta->result() as $row){
                return $row->Entrada;
        }
    } 
    function mgetHoraSaida($bi,$ses){
        $this->db->select('Tipo_Horario_Sessao.Saida');
        $this->db->from('Horario_Funcionarios');
        $this->db->join('Funcionarios', 'Horario_Funcionarios.Funcionarios_id = Funcionarios.id');
        $this->db->join('Horario_Tipo', 'Horario_Funcionarios.Horario_Tipo_id = Horario_Tipo.id');
        $this->db->join('Tipo_Horario_Sessao', 'Tipo_Horario_Sessao.Horario_Tipo_id = Horario_Tipo.id');
        $this->db->join('Sessao_Trabalho_Administrativos', 'Tipo_Horario_Sessao.Sessao_Trabalho_Administrativos_id = Sessao_Trabalho_Administrativos.id');
        $this->db->where('Funcionarios.fBI_Passaporte', $bi);
        $this->db->where('Sessao_Trabalho_Administrativos.stCodigo', $ses);
        $consulta = $this->db->get();
        $data = array();
        foreach($consulta->result() as $row){
                return $row->Saida;
        }
    }
    /*
    ver si un funcionarios tiene que trabajar en una session para saber si puede marcar
    */
    function mExiste_Funcionario_Sessao($bi,$ses){
        $this->db->select('Tipo_Horario_Sessao.Entrada');
        $this->db->from('Horario_Funcionarios');
        $this->db->join('Funcionarios', 'Horario_Funcionarios.Funcionarios_id = Funcionarios.id');
        $this->db->join('Horario_Tipo', 'Horario_Funcionarios.Horario_Tipo_id = Horario_Tipo.id');
        $this->db->join('Tipo_Horario_Sessao', 'Tipo_Horario_Sessao.Horario_Tipo_id = Horario_Tipo.id');
        $this->db->join('Sessao_Trabalho_Administrativos', 'Tipo_Horario_Sessao.Sessao_Trabalho_Administrativos_id = Sessao_Trabalho_Administrativos.id');
        $this->db->where('Funcionarios.fBI_Passaporte', $bi);
        $this->db->where('Sessao_Trabalho_Administrativos.stCodigo', $ses);
        if($this->db->count_all_results() > 0){
              return true;
        }else
            return false;
    }
    /*
    ver si un funcionarios tiene que trabajar en una session para saber si puede marcar
    lo mismo que la funcion anterior pero por el id de la sesion, no por el codigo
    */
    function mExiste_Funcionario_SessaoXid($bi,$ses_id){
        $this->db->select('Tipo_Horario_Sessao.Entrada');
        $this->db->from('Horario_Funcionarios');
        $this->db->join('Funcionarios', 'Horario_Funcionarios.Funcionarios_id = Funcionarios.id');
        $this->db->join('Horario_Tipo', 'Horario_Funcionarios.Horario_Tipo_id = Horario_Tipo.id');
        $this->db->join('Tipo_Horario_Sessao', 'Tipo_Horario_Sessao.Horario_Tipo_id = Horario_Tipo.id');
        $this->db->join('Sessao_Trabalho_Administrativos', 'Tipo_Horario_Sessao.Sessao_Trabalho_Administrativos_id = Sessao_Trabalho_Administrativos.id');
        $this->db->where('Funcionarios.fBI_Passaporte', $bi);
        $this->db->where('Sessao_Trabalho_Administrativos.id', $ses_id);
        if($this->db->count_all_results() > 0){
              return true;
        }else
            return false;
    }
    /*
    Ver si existe una entrada sin salida
    */
    function mgetMarca_sin_Salida($data,$bi){
        $query = $this->db->query("select Registro_Funcionarios.id,
                Registro_Funcionarios.Funcionarios_id,Funcionarios.fBI_Passaporte,
                Registro_Funcionarios.rfData,
                Registro_Funcionarios.rfEntrada,Registro_Funcionarios.rfEstado_Entrada,
                Registro_Funcionarios.rfSaida,Registro_Funcionarios.rfEstado_Saida,
                Registro_Funcionarios.Sessao_Trabalho_Administrativos_id,Sessao_Trabalho_Administrativos.stNome
            from Registro_Funcionarios INNER JOIN  Funcionarios ON(Registro_Funcionarios.Funcionarios_id = Funcionarios.id)
            INNER JOIN Sessao_Trabalho_Administrativos ON(Registro_Funcionarios.Sessao_Trabalho_Administrativos_id = Sessao_Trabalho_Administrativos.id)
            WHERE Funcionarios.fBI_Passaporte = '$bi' AND
            Registro_Funcionarios.rfData = '$data' AND
            Registro_Funcionarios.rfSaida IS NULL"); 
        //$result = $query->result_array(); 
        //return $result;
        if($this->db->count_all_results() == 0){
              return 0;
        }else{
            //$consulta = $this->db->get();
            $data = array();
            foreach($query->result() as $row){
                    return $row->id;
            }
        }
    }
    /*
    Determinar el ultimo estado insertado en registro para un bi
    */
    function mget_ultimo_estado($bi){
        $query = $this->db->query("select Registro_Funcionarios.id, rfEstado_Entrada,rfEstado_Saida
            from Registro_Funcionarios INNER JOIN  Funcionarios ON(Registro_Funcionarios.Funcionarios_id = Funcionarios.id)
            WHERE Registro_Funcionarios.id IN (SELECT MAX(Registro_Funcionarios.id) FROM Registro_Funcionarios)
            AND Funcionarios.fBI_Passaporte = '$bi'");
        foreach($query->result() as $row){
            //if(strlen($row->rfEstado_Saida) > 4)
            if($row->rfEstado_Saida)
                return $row->rfEstado_Saida;
            else
                return $row->rfEstado_Entrada;
            break;
        }
        
    }
    /*
    Ver si existe una marca completada ya hoy para este funcionario
    */
    function mgetMarca_completada($data,$bi,$ses){
        $this->db->select('Registro_Funcionarios.id,
          Registro_Funcionarios.Funcionarios_id,Fincionarios.fBI_Passaporte,
          Registro_Funcionarios.rfData,
          Registro_Funcionarios.rfEntrada,Registro_Funcionarios.rfEstado_Entrada,
          Registro_Funcionarios.rfSaida,Registro_Funcionarios.rfEstado_Saida,
          Registro_Funcionarios.Sessao_Trabalho_Administrativos_id,Sessao_Trabalho_Administrativos.stNome
          ');
          $this->db->from('Registro_Funcionarios');
          $this->db->join('Funcionarios', 'Registro_Funcionarios.Funcionarios_id = Funcionarios.id');
          $this->db->join('Sessao_Trabalho_Administrativos', 'Registro_Funcionarios.Sessao_Trabalho_Administrativos_id = Sessao_Trabalho_Administrativos.id');
          $this->db->where('Funcionarios.fBI_Passaporte', $bi);
          $this->db->where('Registro_Funcionarios.rfData', $data);
          $this->db->where('Sessao_Trabalho_Administrativos.id',$ses);
          if($this->db->count_all_results() > 0){
              return true;
          }else{
              return false;
          }
    }
    /*
    DETERMINAR SESION MEDIANTE EL ID DE REGISTRO FUNCIONARIOS
    */
    function mdt_Sessao_rfid($rfid){
        $this->db->select('Sessao_Trabalho_Administrativos_id');
        $this->db->from('Registro_Funcionarios');
        $this->db->where('id', $rfid);
        $consulta = $this->db->get();
        //$data = array();
        foreach($consulta->result() as $row){
            return $row->Sessao_Trabalho_Administrativos_id;
        }
    }
    /*
    Actualizar Marca existente
    */
    function mActualizar_Marca($rfid,$horaActual,$estado){
            $dados = array('rfSaida'=>$horaActual,'rfEstado_Saida'=>$estado);
            if($this->db->update('Registro_Funcionarios', $dados, array('id' => $rfid))){
                return true;
            }else
                return false;
    }
    function mRegistrar_Marca($data,$sessao_act_id,$fid,$horaActual,$estado){
        
        $dados = array('Funcionarios_id' => $fid,'rfData' => $data,'Sessao_Trabalho_Administrativos_id' => $sessao_act_id,'rfEntrada' => $horaActual,'rfEstado_Entrada'=>$estado);
        if($this->db->insert('Registro_Funcionarios', $dados))
        {
            return true;
        }else{
            return false;
        }
    }
}
