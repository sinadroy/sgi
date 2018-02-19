<?php
class MAcademica_Matricula extends CI_Model {
/*
    public function mread(){
        $this->load->model('mEstudantes');
        $this->load->model('MNiveisCursos');
        //$niveis_cursos_id = $this->MNiveisCursos->mreadXncp($nNome,$cNome,$pNome);
        $this->db->select('Candidatos.id,Candidatos.cNome,Candidatos.cNomes,Candidatos.cApelido,Candidatos.cBI_Passaporte, 
            Academica_Planificacao_Exame_Candidatos.apecNota, Academica_Planificacao_Exame_Candidatos.apecCodigoBarra,
            Academica_Planificacao_Exame_Candidatos.condicionado,
            niveis.nNome,niveis.id as nid,
            cursos.cNome as curso, cursos.id as cursoid,
            periodos.pNome, periodos.id as pid');
        $this->db->from('Candidatos');
        $this->db->join('anos_lectivos','Candidatos.anos_lectivos_id = anos_lectivos.id');
        $this->db->join('Cursos_Pretendidos','Cursos_Pretendidos.Candidatos_id = Candidatos.id');
        $this->db->join('niveis_cursos','Cursos_Pretendidos.niveis_cursos_id = niveis_cursos.id');
        $this->db->join('niveis','niveis_cursos.niveis_id = niveis.id');
        $this->db->join('cursos','niveis_cursos.cursos_id = cursos.id');
        $this->db->join('periodos','niveis_cursos.periodos_id = periodos.id');
        $this->db->join('Academica_Planificacao_Exame_Candidatos','Academica_Planificacao_Exame_Candidatos.Candidatos_id = Candidatos.id');
        $this->db->join('Academica_Planificacao_Exame_Ingreso','Academica_Planificacao_Exame_Candidatos.Academica_Planificacao_Exame_Ingreso_id = Academica_Planificacao_Exame_Ingreso.id');
        $this->db->join('Academica_Turmas_Ingreso','Academica_Planificacao_Exame_Ingreso.Academica_Turmas_Ingreso_id = Academica_Turmas_Ingreso.id');
        $this->db->where('anos_lectivos.alAno',date('Y'));
        $this->db->order_by("cNome","ASC");
        $consulta = $this->db->get();
        $this->load->model('mDados_Academicos');
        $orden = 1;
        $data = array();
        foreach($consulta->result() as $row){
            //obtener estado de matricula
            $nota_minima = $this->MNiveisCursos->mread_nota_minima($row->nid,$row->cursoid,$row->pid);
            $estado_matricula = $this->mEstudantes->read_estado($row->id,$row->nid,$row->cursoid,$row->pid);
            if($row->apecNota >= $nota_minima || $row->condicionado == "on"){
                $data[] = array(
                    "orden"=>$orden,
                    "cid"=>$row->id,
                    "cNome"=>$row->cNome,
                    "cNomes"=>$row->cNomes,
                    "cApelido"=>$row->cApelido,
                    "cBI_Passaporte"=>$row->cBI_Passaporte,
                    "apecNota"=>$row->apecNota,
                    "apecCodigoBarra"=>$row->apecCodigoBarra,
                    "provNome"=>$this->mDados_Academicos->mreadProvinciaXcandidato($row->id),
                    "nNome"=>$row->nNome,
                    "nid"=>$row->nid,
                    "curso"=>$row->curso,
                    "cursoid"=>$row->cursoid,
                    "pNome"=>$row->pNome,
                    "pid"=>$row->pid,
                    "emEstado"=>($estado_matricula == "Mat.Esp.Pag" || $estado_matricula == "Mat.Aceite")?$estado_matricula:"Não Matriculado",
                    "condicionado"=>($row->condicionado == "on")?"Sim":"Não",
                    "estado"=>($row->apecNota >= $nota_minima || $row->condicionado == "on")?"Admitido":"Não Admitido",
                );
                $orden++;
            }
        }
            return $data;
      }
      */
/*
      public function mread(){
        $this->load->model('mEstudantes');
        $this->load->model('MNiveisCursos');
        //$niveis_cursos_id = $this->MNiveisCursos->mreadXncp($nNome,$cNome,$pNome);
        //1ra sessao
        $this->db->select('Candidatos.id,Candidatos.cNome,Candidatos.cNomes,Candidatos.cApelido,Candidatos.cBI_Passaporte, 
            Academica_Planificacao_Exame_Candidatos.apecNota, Academica_Planificacao_Exame_Candidatos.apecCodigoBarra,
            Academica_Planificacao_Exame_Candidatos.condicionado,
            niveis.nNome,niveis.id as nid,
            cursos.cNome as curso, cursos.id as cursoid,
            periodos.pNome, periodos.id as pid');
        $this->db->from('Candidatos');
        $this->db->join('anos_lectivos','Candidatos.anos_lectivos_id = anos_lectivos.id');
        $this->db->join('Cursos_Pretendidos','Cursos_Pretendidos.Candidatos_id = Candidatos.id');
        $this->db->join('niveis_cursos','Cursos_Pretendidos.niveis_cursos_id = niveis_cursos.id');
        $this->db->join('niveis','niveis_cursos.niveis_id = niveis.id');
        $this->db->join('cursos','niveis_cursos.cursos_id = cursos.id');
        $this->db->join('periodos','niveis_cursos.periodos_id = periodos.id');
        $this->db->join('Academica_Planificacao_Exame_Candidatos','Academica_Planificacao_Exame_Candidatos.Candidatos_id = Candidatos.id');
        $this->db->join('Academica_Planificacao_Exame_Ingreso','Academica_Planificacao_Exame_Candidatos.Academica_Planificacao_Exame_Ingreso_id = Academica_Planificacao_Exame_Ingreso.id');
        $this->db->join('Academica_Turmas_Ingreso','Academica_Planificacao_Exame_Ingreso.Academica_Turmas_Ingreso_id = Academica_Turmas_Ingreso.id');
        //$this->db->where('Academica_Planificacao_Exame_Ingreso.niveis_cursos_id','niveis_cursos.id');
        //$this->db->where('Academica_Planificacao_Exame_Ingreso.niveis_cursos_id', 'niveis_cursos.id');
        $this->db->where('anos_lectivos.alAno',date('Y'));
        $this->db->order_by("cNome","ASC");
        $consulta = $this->db->get();
        $this->load->model('mDados_Academicos');
        $orden = 1;
        $data = array();
        foreach($consulta->result() as $row){
            //obtener estado de matricula
            $nota_minima = $this->MNiveisCursos->mread_nota_minima($row->nid,$row->cursoid,$row->pid);
            $estado_matricula = $this->mEstudantes->read_estado($row->id,$row->nid,$row->cursoid,$row->pid);
            if($row->apecNota >= $nota_minima || $row->condicionado == "on"){
                $data[] = array(
                    "orden"=>$orden,
                    "cid"=>$row->id,
                    "cNome"=>$row->cNome,
                    "cNomes"=>$row->cNomes,
                    "cApelido"=>$row->cApelido,
                    "cBI_Passaporte"=>$row->cBI_Passaporte,
                    "apecNota"=>$row->apecNota,
                    "apecCodigoBarra"=>$row->apecCodigoBarra,
                    "provNome"=>$this->mDados_Academicos->mreadProvinciaXcandidato($row->id),
                    "nNome"=>$row->nNome,
                    "nid"=>$row->nid,
                    "curso"=>$row->curso,
                    "cursoid"=>$row->cursoid,
                    "pNome"=>$row->pNome,
                    "pid"=>$row->pid,
                    "emEstado"=>($estado_matricula == "Mat.Esp.Pag" || $estado_matricula == "Mat.Aceite")?$estado_matricula:"Não Matriculado",
                    "condicionado"=>($row->condicionado == "on")?"Sim":"Não",
                    "estado"=>($row->apecNota >= $nota_minima || $row->condicionado == "on")?"Admitido":"Não Admitido",
                );
                $orden++;
            }
        }
        //2da sessao
        $this->db->select('Candidatos.id,Candidatos.cNome,Candidatos.cNomes,Candidatos.cApelido,Candidatos.cBI_Passaporte, 
            Academica_Planificacao_Exame_Candidatos_2S.apecNota, Academica_Planificacao_Exame_Candidatos_2S.apecCodigoBarra,
            Academica_Planificacao_Exame_Candidatos_2S.condicionado,
            niveis.nNome,niveis.id as nid,
            cursos.cNome as curso, cursos.id as cursoid,
            periodos.pNome, periodos.id as pid');
        $this->db->from('Candidatos');
        $this->db->join('anos_lectivos','Candidatos.anos_lectivos_id = anos_lectivos.id');
        $this->db->join('Cursos_Pretendidos_2S','Cursos_Pretendidos_2S.Candidatos_id = Candidatos.id');
        $this->db->join('niveis_cursos','Cursos_Pretendidos_2S.niveis_cursos_id = niveis_cursos.id');
        $this->db->join('niveis','niveis_cursos.niveis_id = niveis.id');
        $this->db->join('cursos','niveis_cursos.cursos_id = cursos.id');
        $this->db->join('periodos','niveis_cursos.periodos_id = periodos.id');
        $this->db->join('Academica_Planificacao_Exame_Candidatos_2S','Academica_Planificacao_Exame_Candidatos_2S.Candidatos_id = Candidatos.id');
        $this->db->join('Academica_Planificacao_Exame_Ingreso_2S','Academica_Planificacao_Exame_Candidatos_2S.Academica_Planificacao_Exame_Ingreso_2S_id = Academica_Planificacao_Exame_Ingreso_2S.id');
        $this->db->join('Academica_Turmas_Ingreso_2S','Academica_Planificacao_Exame_Ingreso_2S.Academica_Turmas_Ingreso_2S_id = Academica_Turmas_Ingreso_2S.id');
        $this->db->where('anos_lectivos.alAno',date('Y'));
        //$this->db->where('Academica_Planificacao_Exame_Ingreso_2S.niveis_cursos_id', 'niveis_cursos.id');
        $this->db->order_by("cNome","ASC");
        $consulta = $this->db->get();
        //$this->load->model('mDados_Academicos');
        $orden = 1;
        $data2 = array();
        foreach($consulta->result() as $row){
            //obtener estado de matricula
            $nota_minima = $this->MNiveisCursos->mread_nota_minima($row->nid,$row->cursoid,$row->pid);
            $estado_matricula = $this->mEstudantes->read_estado($row->id,$row->nid,$row->cursoid,$row->pid);
            if($row->apecNota >= $nota_minima || $row->condicionado == "on"){
                $data2[] = array(
                    "orden"=>$orden,
                    "cid"=>$row->id,
                    "cNome"=>$row->cNome,
                    "cNomes"=>$row->cNomes,
                    "cApelido"=>$row->cApelido,
                    "cBI_Passaporte"=>$row->cBI_Passaporte,
                    "apecNota"=>$row->apecNota,
                    "apecCodigoBarra"=>$row->apecCodigoBarra,
                    "provNome"=>$this->mDados_Academicos->mreadProvinciaXcandidato($row->id),
                    "nNome"=>$row->nNome,
                    "nid"=>$row->nid,
                    "curso"=>$row->curso,
                    "cursoid"=>$row->cursoid,
                    "pNome"=>$row->pNome,
                    "pid"=>$row->pid,
                    "emEstado"=>($estado_matricula == "Mat.Esp.Pag" || $estado_matricula == "Mat.Aceite")?$estado_matricula:"Não Matriculado",
                    "condicionado"=>($row->condicionado == "on")?"Sim":"Não",
                    "estado"=>($row->apecNota >= $nota_minima || $row->condicionado == "on")?"Admitido":"Não Admitido",
                );
                $orden++;
            }
        }
            return array_merge($data, $data2);
      }
      */

      public function mread(){
        $this->load->model('mEstudantes');
        $this->load->model('MNiveisCursos');
        //$niveis_cursos_id = $this->MNiveisCursos->mreadXncp($nNome,$cNome,$pNome);
        //1ra sessao
        $query = $this->db->query("select Candidatos.id,Candidatos.cNome,Candidatos.cNomes,Candidatos.cApelido,Candidatos.cBI_Passaporte, 
            Academica_Planificacao_Exame_Candidatos.apecNota, Academica_Planificacao_Exame_Candidatos.apecCodigoBarra,
            Academica_Planificacao_Exame_Candidatos.condicionado,
            niveis.nNome,niveis.id as nid,
            cursos.cNome as curso, cursos.id as cursoid,
            periodos.pNome, periodos.id as pid
        from Candidatos
        join anos_lectivos on(Candidatos.anos_lectivos_id = anos_lectivos.id)
        join Cursos_Pretendidos on(Cursos_Pretendidos.Candidatos_id = Candidatos.id)
        join niveis_cursos on(Cursos_Pretendidos.niveis_cursos_id = niveis_cursos.id)
        join niveis on(niveis_cursos.niveis_id = niveis.id)
        join cursos on(niveis_cursos.cursos_id = cursos.id)
        join periodos on(niveis_cursos.periodos_id = periodos.id)
        join Academica_Planificacao_Exame_Candidatos on(Academica_Planificacao_Exame_Candidatos.Candidatos_id = Candidatos.id)
        join Academica_Planificacao_Exame_Ingreso on(Academica_Planificacao_Exame_Candidatos.Academica_Planificacao_Exame_Ingreso_id = Academica_Planificacao_Exame_Ingreso.id)
        join Academica_Turmas_Ingreso on(Academica_Planificacao_Exame_Ingreso.Academica_Turmas_Ingreso_id = Academica_Turmas_Ingreso.id)
        
        where anos_lectivos.alAno = ".date('Y')."
        and cursos_pretendidos.cp_ano_lec_insc = ".date('Y')."
        and Academica_Planificacao_Exame_Ingreso.niveis_cursos_id = niveis_cursos.id
        order by cNome
        ");
        
        $this->load->model('mDados_Academicos');
        $orden = 1;
        $data = array();
        foreach($query->result() as $row){
            //obtener estado de matricula
            $nota_minima = $this->MNiveisCursos->mread_nota_minima($row->nid,$row->cursoid,$row->pid);
            $estado_matricula = $this->mEstudantes->read_estado($row->id,$row->nid,$row->cursoid,$row->pid);
            if($row->apecNota >= $nota_minima || $row->condicionado == "on"){
                $data[] = array(
                    "orden"=>$orden,
                    "cid"=>$row->id,
                    "cNome"=>$row->cNome,
                    "cNomes"=>$row->cNomes,
                    "cApelido"=>$row->cApelido,
                    "cBI_Passaporte"=>$row->cBI_Passaporte,
                    "apecNota"=>$row->apecNota,
                    "apecCodigoBarra"=>$row->apecCodigoBarra,
                    "provNome"=>$this->mDados_Academicos->mreadProvinciaXcandidato($row->id),
                    "nNome"=>$row->nNome,
                    "nid"=>$row->nid,
                    "curso"=>$row->curso,
                    "cursoid"=>$row->cursoid,
                    "pNome"=>$row->pNome,
                    "pid"=>$row->pid,
                    "emEstado"=>($estado_matricula == "Mat.Esp.Pag" || $estado_matricula == "Mat.Aceite")?$estado_matricula:"Não Matriculado",
                    "condicionado"=>($row->condicionado == "on")?"Sim":"Não",
                    "estado"=>($row->apecNota >= $nota_minima || $row->condicionado == "on")?"Admitido":"Não Admitido",
                );
                $orden++;
            }
        }

        $query = $this->db->query("select Candidatos.id,Candidatos.cNome,Candidatos.cNomes,Candidatos.cApelido,Candidatos.cBI_Passaporte, 
            Academica_Planificacao_Exame_Candidatos_2S.apecNota, Academica_Planificacao_Exame_Candidatos_2S.apecCodigoBarra,
            Academica_Planificacao_Exame_Candidatos_2S.condicionado,
            niveis.nNome,niveis.id as nid,
            cursos.cNome as curso, cursos.id as cursoid,
            periodos.pNome, periodos.id as pid
        from Candidatos
        join anos_lectivos on(Candidatos.anos_lectivos_id = anos_lectivos.id)
        join Cursos_Pretendidos_2S on(Cursos_Pretendidos_2S.Candidatos_id = Candidatos.id)
        join niveis_cursos on(Cursos_Pretendidos_2S.niveis_cursos_id = niveis_cursos.id)
        join niveis on(niveis_cursos.niveis_id = niveis.id)
        join cursos on(niveis_cursos.cursos_id = cursos.id)
        join periodos on(niveis_cursos.periodos_id = periodos.id)
        join Academica_Planificacao_Exame_Candidatos_2S on(Academica_Planificacao_Exame_Candidatos_2S.Candidatos_id = Candidatos.id)
        join Academica_Planificacao_Exame_Ingreso_2S on(Academica_Planificacao_Exame_Candidatos_2S.Academica_Planificacao_Exame_Ingreso_2S_id = Academica_Planificacao_Exame_Ingreso_2S.id)
        join Academica_Turmas_Ingreso_2S on(Academica_Planificacao_Exame_Ingreso_2S.Academica_Turmas_Ingreso_2S_id = Academica_Turmas_Ingreso_2S.id)
        
        where anos_lectivos.alAno = ".date('Y')."
        and Academica_Planificacao_Exame_Ingreso_2S.niveis_cursos_id = niveis_cursos.id
        order by cNome
        ");
        
        //$this->load->model('mDados_Academicos');
        $orden = 1;
        $data2 = array();
        foreach($query->result() as $row){
            //obtener estado de matricula
            $nota_minima = $this->MNiveisCursos->mread_nota_minima($row->nid,$row->cursoid,$row->pid);
            $estado_matricula = $this->mEstudantes->read_estado($row->id,$row->nid,$row->cursoid,$row->pid);
            if($row->apecNota >= $nota_minima || $row->condicionado == "on"){
                $data2[] = array(
                    "orden"=>$orden,
                    "cid"=>$row->id,
                    "cNome"=>$row->cNome,
                    "cNomes"=>$row->cNomes,
                    "cApelido"=>$row->cApelido,
                    "cBI_Passaporte"=>$row->cBI_Passaporte,
                    "apecNota"=>$row->apecNota,
                    "apecCodigoBarra"=>$row->apecCodigoBarra,
                    "provNome"=>$this->mDados_Academicos->mreadProvinciaXcandidato($row->id),
                    "nNome"=>$row->nNome,
                    "nid"=>$row->nid,
                    "curso"=>$row->curso,
                    "cursoid"=>$row->cursoid,
                    "pNome"=>$row->pNome,
                    "pid"=>$row->pid,
                    "emEstado"=>($estado_matricula == "Mat.Esp.Pag" || $estado_matricula == "Mat.Aceite")?$estado_matricula:"Não Matriculado",
                    "condicionado"=>($row->condicionado == "on")?"Sim":"Não",
                    "estado"=>($row->apecNota >= $nota_minima || $row->condicionado == "on")?"Admitido":"Não Admitido",
                );
                $orden++;
            }
        }
            return array_merge($data, $data2);
      }

      public function mreadXancp($alAno,$nNome,$cNome,$pNome){
            $this->load->model('mEstudantes');
            $this->load->model('MNiveisCursos');
            //$niveis_cursos_id = $this->MNiveisCursos->mreadXncp($nNome,$cNome,$pNome);
            $this->db->select('Candidatos.id,Candidatos.cNome,Candidatos.cNomes,Candidatos.cApelido,Candidatos.cBI_Passaporte');
            $this->db->from('Candidatos');
            $this->db->join('Estudantes','Estudantes.Candidatos_id = Candidatos.id');
            $this->db->join('anos_lectivos','Candidatos.anos_lectivos_id = anos_lectivos.id');
            //$this->db->join('Cursos_Pretendidos','Cursos_Pretendidos.Candidatos_id = Candidatos.id');
            $this->db->join('niveis_cursos','Estudantes.niveis_cursos_id = niveis_cursos.id');
            $this->db->join('niveis','niveis_cursos.niveis_id = niveis.id');
            $this->db->join('cursos','niveis_cursos.cursos_id = cursos.id');
            $this->db->join('periodos','niveis_cursos.periodos_id = periodos.id');
            //$this->db->join('Academica_Planificacao_Exame_Candidatos','Academica_Planificacao_Exame_Candidatos.Candidatos_id = Candidatos.id');
            //$this->db->join('Academica_Planificacao_Exame_Ingreso','Academica_Planificacao_Exame_Candidatos.Academica_Planificacao_Exame_Ingreso_id = Academica_Planificacao_Exame_Ingreso.id');
            //$this->db->join('Academica_Turmas_Ingreso','Academica_Planificacao_Exame_Ingreso.Academica_Turmas_Ingreso_id = Academica_Turmas_Ingreso.id');
            $this->db->where('anos_lectivos.alAno',$alAno);
            //$this->db->where('Academica_Planificacao_Exame_Candidatos.apecNota >=',10);
            $this->db->where('niveis.id',$nNome);
            $this->db->where('cursos.id',$cNome);
            $this->db->where('periodos.id',$pNome);
            //$this->db->where('Academica_Planificacao_Exame_Ingreso.niveis_cursos_id',$niveis_cursos_id);
            $this->db->order_by("cNome,cApelido","ASC");
            $consulta = $this->db->get();
            //$this->load->model('mDados_Academicos');
            $orden = 1;
            $data = array();
            foreach($consulta->result() as $row){
                //obtener estado de matricula
                //$estado_matricula = $this->mEstudantes->read_estado($row->id,$row->nid,$row->cursoid,$row->pid);
                $data[] = array(
                    "orden"=>$orden,
                    "cid"=>$row->id,
                    "cNome"=>$row->cNome,
                    "cNomes"=>$row->cNomes,
                    "cApelido"=>$row->cApelido,
                    "cBI_Passaporte"=>$row->cBI_Passaporte
                );
                $orden++;
            }
            return $data;
      }
    /*  
    public function mreadXancp($alAno,$nNome,$cNome,$pNome){
            $this->load->model('MNiveisCursos');
            $niveis_cursos_id = $this->MNiveisCursos->mreadXncp($nNome,$cNome,$pNome);

            $this->db->select('Candidatos.id,Candidatos.cNome,Candidatos.cNomes,Candidatos.cApelido,Candidatos.cBI_Passaporte,
            Academica_Planificacao_Exame_Candidatos.apecNota, Academica_Planificacao_Exame_Candidatos.apecCodigoBarra');
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
            //$this->db->order_by("cNome");
            $consulta = $this->db->get();
            $this->load->model('mDados_Academicos');
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
                    "apecNota"=>$row->apecNota,
                    "apecCodigoBarra"=>$row->apecCodigoBarra,
                    "provNome"=>$this->mDados_Academicos->mreadProvinciaXcandidato($row->id)
                );
                $orden++;
            }
            return $data;
      }
      */
/*
      function get_ncp_id($n,$c,$p){
            $this->db->select('niveis_cursos.id');
            $this->db->from('niveis_cursos');
            $this->db->where('niveis_cursos.niveis_id', $n);
            $this->db->where('niveis_cursos.cursos_id', $c);
            $this->db->where('niveis_cursos.periodos_id', $p);
            $consulta = $this->db->get();
            foreach ($consulta->result() as $row) {
                return $row->id;
            }
      }
      
      function cambiar_estado_matricula($Candidatos_id,$niveis_cursos_id,$cpEstado_Matricula){
        
        $Candidatos = array('cpEstado_Matricula'=>$cpEstado_Matricula);
        
        if ($this->db->update('Cursos_Pretendidos', $Candidatos, array('Candidatos_id' => $Candidatos_id,'niveis_cursos_id' => $niveis_cursos_id))) {
            return true;
        } else
            return false;
     }
     */
}

?>
