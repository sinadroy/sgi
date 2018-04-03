<?php
  class Mdocumentos_pendientes extends CI_Model{
      
      function mread(){
          $this->db->select('documentos_pendientes_imprimir.id,
            niveis.nnome, cursos.cnome as curso, periodos.pnome,
            candidatos.cnome, candidatos.cnomes, candidatos.capelido, candidatos.cbi_passaporte,
            candidatos.cBI_Data_Emissao, candidatos.cBI_Lugar_Emissao_Provincia_id,
            estudantes.id as eid, ano_curricular.acnome, motivo.mnome,
            financas_pagamaentos_documentos.tipo_documentos_id');
          $this->db->from('documentos_pendientes_imprimir');
          $this->db->join('estudantes','documentos_pendientes_imprimir.estudantes_id = estudantes.id');
          $this->db->join('niveis_cursos','estudantes.niveis_cursos_id = niveis_cursos.id');
          $this->db->join('niveis','niveis_cursos.niveis_id = niveis.id');
          $this->db->join('cursos','niveis_cursos.cursos_id = cursos.id');
          $this->db->join('periodos','niveis_cursos.periodos_id = periodos.id');
          $this->db->join('candidatos','estudantes.candidatos_id = candidatos.id');
          $this->db->join('ano_curricular','estudantes.ano_curricular_id = ano_curricular.id');
          $this->db->join('financas_pagamaentos_documentos','financas_pagamaentos_documentos.estudantes_id = estudantes.id');
          $this->db->join('motivo','financas_pagamaentos_documentos.motivo_id = motivo.id');
          $this->db->join('tipo_documentos','documentos_pendientes_imprimir.tipo_documentos_id = tipo_documentos.id');
          $this->db->where('tipo_documentos.id',1);
          //$this->db->where('niveis.nnome','Licenciatura');
          $consulta = $this->db->get();
          $ord=1;
          $data = array();
          $this->load->model('mprovincias');
            foreach ($consulta->result() as $row) {
                    $data[] = array(
                        "ord" => $ord,
                        "id" => $row->id,
                        "nnome" => $row->nnome,
                        "curso" => $row->curso,
                        "pnome" => $row->pnome,

                        "cnome" => $row->cnome,
                        "cnomes" => $row->cnomes,
                        "capelido" => $row->capelido,
                        "cbi_passaporte" => $row->cbi_passaporte,

                        "eid" => $row->eid,
                        "cBI_Data_Emissao" => $row->cBI_Data_Emissao,
                        "cBI_Lugar_Emissao_Provincia_id" => $this->mprovincias->mGetNomeXID($row->cBI_Lugar_Emissao_Provincia_id),
                        "acnome"=>$row->acnome,
                        "mnome"=>$row->mnome,
                        "tipo_documentos_id"=>$row->tipo_documentos_id,
                    );
                    $ord++;
            }
            return $data;
      }
      function mread_mestrado(){
          $this->db->select('documentos_pendientes_imprimir.id,
            niveis.nnome, cursos.cnome as curso, periodos.pnome,
            candidatos.cnome, candidatos.cnomes, candidatos.capelido, candidatos.cbi_passaporte,
            candidatos.cBI_Data_Emissao, candidatos.cBI_Lugar_Emissao_Provincia_id,
            estudantes.id as eid, ano_curricular.acnome, motivo.mnome,
            financas_pagamaentos_documentos.tipo_documentos_id');
          $this->db->from('documentos_pendientes_imprimir');
          $this->db->join('estudantes','documentos_pendientes_imprimir.estudantes_id = estudantes.id');
          $this->db->join('niveis_cursos','estudantes.niveis_cursos_id = niveis_cursos.id');
          $this->db->join('niveis','niveis_cursos.niveis_id = niveis.id');
          $this->db->join('cursos','niveis_cursos.cursos_id = cursos.id');
          $this->db->join('periodos','niveis_cursos.periodos_id = periodos.id');
          $this->db->join('candidatos','estudantes.candidatos_id = candidatos.id');
          $this->db->join('ano_curricular','estudantes.ano_curricular_id = ano_curricular.id');
          $this->db->join('financas_pagamaentos_documentos','financas_pagamaentos_documentos.estudantes_id = estudantes.id');
          $this->db->join('motivo','financas_pagamaentos_documentos.motivo_id = motivo.id');
          $this->db->join('tipo_documentos','documentos_pendientes_imprimir.tipo_documentos_id = tipo_documentos.id');
          $this->db->where('tipo_documentos.id',2);
          //$this->db->where('niveis.nnome','Mestrado');
          $consulta = $this->db->get();
          $ord=1;
          $data = array();
          $this->load->model('mprovincias');
            foreach ($consulta->result() as $row) {
                    $data[] = array(
                        "ord" => $ord,
                        "id" => $row->id,
                        "nnome" => $row->nnome,
                        "curso" => $row->curso,
                        "pnome" => $row->pnome,

                        "cnome" => $row->cnome,
                        "cnomes" => $row->cnomes,
                        "capelido" => $row->capelido,
                        "cbi_passaporte" => $row->cbi_passaporte,

                        "eid" => $row->eid,
                        "cBI_Data_Emissao" => $row->cBI_Data_Emissao,
                        "cBI_Lugar_Emissao_Provincia_id" => $this->mprovincias->mGetNomeXID($row->cBI_Lugar_Emissao_Provincia_id),
                        "acnome"=>$row->acnome,
                        "mnome"=>$row->mnome,
                        "tipo_documentos_id"=>$row->tipo_documentos_id,
                    );
                    $ord++;
            }
            return $data;
      }
      function mread_com_notas(){
        $this->db->select('documentos_pendientes_imprimir.id,
          niveis.nnome, cursos.cnome as curso, periodos.pnome,
          candidatos.cnome, candidatos.cnomes, candidatos.capelido, candidatos.cbi_passaporte,
          candidatos.cBI_Data_Emissao, candidatos.cBI_Lugar_Emissao_Provincia_id,
          estudantes.id as eid, ano_curricular.acnome, motivo.mnome,
          financas_pagamaentos_documentos.tipo_documentos_id');
        $this->db->from('documentos_pendientes_imprimir');
        $this->db->join('estudantes','documentos_pendientes_imprimir.estudantes_id = estudantes.id');
        $this->db->join('niveis_cursos','estudantes.niveis_cursos_id = niveis_cursos.id');
        $this->db->join('niveis','niveis_cursos.niveis_id = niveis.id');
        $this->db->join('cursos','niveis_cursos.cursos_id = cursos.id');
        $this->db->join('periodos','niveis_cursos.periodos_id = periodos.id');
        $this->db->join('candidatos','estudantes.candidatos_id = candidatos.id');
        $this->db->join('ano_curricular','estudantes.ano_curricular_id = ano_curricular.id');
        $this->db->join('financas_pagamaentos_documentos','financas_pagamaentos_documentos.estudantes_id = estudantes.id');
        $this->db->join('motivo','financas_pagamaentos_documentos.motivo_id = motivo.id');
        $this->db->join('tipo_documentos','documentos_pendientes_imprimir.tipo_documentos_id = tipo_documentos.id');
        $this->db->where('tipo_documentos.id',3);
        //$this->db->where('niveis.nnome','Licenciatura');
        $consulta = $this->db->get();
        $ord=1;
        $data = array();
        $this->load->model('mprovincias');
          foreach ($consulta->result() as $row) {
                  $data[] = array(
                      "ord" => $ord,
                      "id" => $row->id,
                      "nnome" => $row->nnome,
                      "curso" => $row->curso,
                      "pnome" => $row->pnome,

                      "cnome" => $row->cnome,
                      "cnomes" => $row->cnomes,
                      "capelido" => $row->capelido,
                      "cbi_passaporte" => $row->cbi_passaporte,

                      "eid" => $row->eid,
                      "cBI_Data_Emissao" => $row->cBI_Data_Emissao,
                      "cBI_Lugar_Emissao_Provincia_id" => $this->mprovincias->mGetNomeXID($row->cBI_Lugar_Emissao_Provincia_id),
                      "acnome"=>$row->acnome,
                      "mnome"=>$row->mnome,
                      "tipo_documentos_id"=>$row->tipo_documentos_id,
                  );
                  $ord++;
          }
          return $data;
    }
      /*
      function mupdate($id,$tdnome,$tdvalor){
            $dados = array('tdnome'=>$tdnome,'tdvalor'=>$tdvalor);
            if($this->db->update('tipo_documentos', $dados, array('id' => $id))){
                return true;
            }else
                return false;
      }
      */
    function minsert($tipo_documentos_id,$estudantes_id){
        if($this->db->insert('documentos_pendientes_imprimir', array('tipo_documentos_id'=>$tipo_documentos_id,'estudantes_id'=>$estudantes_id)))
        {
            return true;
        }else{
            return false;
        }
           
    }
    function mdelete($id_td,$id_e) {
        if($this->db->delete('documentos_pendientes_imprimir', array('tipo_documentos_id' => $id_td, 'Estudantes_id' => $id_e)))  
            return true;
        else
            return false;
        
    }       
           
  }
