<?php
  class MAcademica_Presencas_Exame_Acesso extends CI_Model{
      /*
        determinar total de candidatos colocados na turma utilizando para busca os IDs
      */
      public function mreadX($alAno,$nNome,$cNome,$pNome){
        $this->load->model('MNiveisCursos');
        $niveis_cursos_id = $this->MNiveisCursos->mreadXncp($nNome,$cNome,$pNome);

        $this->db->select('Candidatos.id,Candidatos.cNome,Candidatos.cNomes,Candidatos.cApelido,Candidatos.cBI_Passaporte,
        Academica_Planificacao_Exame_Candidatos.apecEstado, Academica_Planificacao_Exame_Candidatos.apecCodigoBarra');
        $this->db->from('Candidatos');
        $this->db->join('Cursos_Pretendidos','Cursos_Pretendidos.Candidatos_id = Candidatos.id');
        $this->db->join('niveis_cursos','Cursos_Pretendidos.niveis_cursos_id = niveis_cursos.id');
        $this->db->join('niveis','niveis_cursos.niveis_id = niveis.id');
        $this->db->join('cursos','niveis_cursos.cursos_id = cursos.id');
        $this->db->join('periodos','niveis_cursos.periodos_id = periodos.id');
        $this->db->join('Academica_Planificacao_Exame_Candidatos','Academica_Planificacao_Exame_Candidatos.Candidatos_id = Candidatos.id');
        $this->db->join('Academica_Planificacao_Exame_Ingreso','Academica_Planificacao_Exame_Candidatos.Academica_Planificacao_Exame_Ingreso_id = Academica_Planificacao_Exame_Ingreso.id');
        $this->db->join('Academica_Turmas_Ingreso','Academica_Planificacao_Exame_Ingreso.Academica_Turmas_Ingreso_id = Academica_Turmas_Ingreso.id');
        $this->db->where('Candidatos.anos_lectivos_id',$alAno);
        $this->db->where('niveis.id',$nNome);
        $this->db->where('cursos.id',$cNome);
        $this->db->where('periodos.id',$pNome);
        $this->db->where('Academica_Planificacao_Exame_Ingreso.niveis_cursos_id',$niveis_cursos_id);
        $consulta = $this->db->get();
        $orden = 1;
        $data = array();
        foreach($consulta->result() as $row){
              $data[] = array(
                  "orden"=>$orden,
                  "id"=>$row->id,
                  "cNome"=>$row->cNome,
                  "cNomes"=>$row->cNomes,
                  "cApelido"=>$row->cApelido,
                  "cBI_Passaporte"=>$row->cBI_Passaporte,
                  "apecEstado"=>$row->apecEstado,
                  "apecCodigoBarra"=>$row->apecCodigoBarra
              );
              $orden++;
        }
        return $data;
      }
      public function mreadXpresente($codigo_barra/*,$c,$p,$s*/){
        $this->db->select('Academica_Planificacao_Exame_Candidatos.apecEstado');
        $this->db->from('Academica_Planificacao_Exame_Candidatos');

        // $this->db->join('academica_planificacao_exame_ingreso', 'academica_planificacao_exame_candidatos.Academica_Planificacao_Exame_Ingreso_id= academica_planificacao_exame_ingreso.id');
            // $this->db->join('niveis_cursos', 'Academica_Planificacao_Exame_Ingreso.niveis_cursos_id = niveis_cursos.id');
            // $this->db->join('niveis', 'niveis_cursos.niveis_id = niveis.id');
            // $this->db->join('cursos', 'niveis_cursos.cursos_id = cursos.id');
            // $this->db->join('periodos', 'niveis_cursos.Periodos_id = periodos.id');

        $this->db->where('Academica_Planificacao_Exame_Candidatos.apecCodigoBarra',$codigo_barra);

        $consulta = $this->db->get();
        $data = array();
        foreach($consulta->result() as $row){
              $Estado = $row->apecEstado;
        }
        if($Estado != "on")
            return true;
        else
            return false;
      }
      function mupdate($apecCodigoBarra,$apecEstado){
            $dados = array('apecEstado'=>$apecEstado);
            if($this->db->update('Academica_Planificacao_Exame_Candidatos', $dados, array('apecCodigoBarra' => $apecCodigoBarra))){
                return true;
            }else
                return false;
      }
    /*  
    function minsert($candidatos_id,$planificacao_id,$CodigoBarra){
        if($this->db->insert('Academica_Planificacao_Exame_Candidatos', array('Candidatos_id'=>$candidatos_id,
        'Academica_Planificacao_Exame_Ingreso_id'=>$planificacao_id,'apecCodigoBarra'=>$CodigoBarra)))
        {
            return true;
        }else{
            return false;
        }
           
    }
    
    function mdelete($id) {
        if($this->db->delete('Academica_Planificacao_Exame_Ingreso', array('id' => $id)))  
            return true;
        else
            return false;
        
    }
    */        
}
