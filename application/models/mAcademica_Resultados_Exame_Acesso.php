<?php
    header('Content-Type: text/html; charset=UTF-8');
  class MAcademica_Resultados_Exame_Acesso extends CI_Model{
      /*
        determinar total de candidatos colocados na turma utilizando para busca os IDs
      */
      public function mreadNome($nivel_acesso,$cb/*,$c,$p,$s*/){
            $this->db->select('Candidatos.cNome');
            $this->db->from('Academica_Planificacao_Exame_Candidatos'); 
            $this->db->join('Candidatos', 'Academica_Planificacao_Exame_Candidatos.Candidatos_id = Candidatos.id');
            //$this->db->join('academica_planificacao_exame_ingreso', 'academica_planificacao_exame_candidatos.Academica_Planificacao_Exame_Ingreso_id = academica_planificacao_exame_ingreso.id');
            //$this->db->join('niveis_cursos', 'Academica_Planificacao_Exame_Ingreso.niveis_cursos_id = niveis_cursos.id');
            //$this->db->join('niveis', 'niveis_cursos.niveis_id = niveis.id');
            //$this->db->join('cursos', 'niveis_cursos.cursos_id = cursos.id');
            //$this->db->join('periodos', 'niveis_cursos.Periodos_id = periodos.id');

            $this->db->where('Academica_Planificacao_Exame_Candidatos.apecCodigoBarra', $cb);
            //$this->db->where('cursos.id', $c);
            //$this->db->where('periodos.id', $p);
            //$this->db->where('Academica_Planificacao_Exame_Ingreso.Academica_Turmas_Ingreso_id', $s);
            $consulta = $this->db->get();
            $data = array();
            foreach($consulta->result() as $row){
                return ($nivel_acesso == "Administradores")?$row->cNome:md5($row->cNome);
            }
      }
      public function mreadNomes($nivel_acesso,$cb/*,$c,$p,$s*/){
            $this->db->select('Candidatos.cNomes');
            $this->db->from('Academica_Planificacao_Exame_Candidatos'); 
            $this->db->join('Candidatos', 'Academica_Planificacao_Exame_Candidatos.Candidatos_id = Candidatos.id');

            // $this->db->join('academica_planificacao_exame_ingreso', 'academica_planificacao_exame_candidatos.Academica_Planificacao_Exame_Ingreso_id = academica_planificacao_exame_ingreso.id');
            // $this->db->join('niveis_cursos', 'Academica_Planificacao_Exame_Ingreso.niveis_cursos_id = niveis_cursos.id');
            // $this->db->join('niveis', 'niveis_cursos.niveis_id = niveis.id');
            // $this->db->join('cursos', 'niveis_cursos.cursos_id = cursos.id');
            // $this->db->join('periodos', 'niveis_cursos.Periodos_id = periodos.id');

            $this->db->where('Academica_Planificacao_Exame_Candidatos.apecCodigoBarra', $cb);
            //$this->db->where('cursos.id', $c);
            //$this->db->where('periodos.id', $p);
            //$this->db->where('Academica_Planificacao_Exame_Ingreso.Academica_Turmas_Ingreso_id', $s);
            $consulta = $this->db->get();
            $data = array();
            foreach($consulta->result() as $row){
                return ($nivel_acesso == "Administradores")?$row->cNomes:md5($row->cNomes);
            }
      }
      public function mreadApelido($nivel_acesso,$cb/*,$c,$p,$s*/){
            $this->db->select('Candidatos.cApelido');
            $this->db->from('Academica_Planificacao_Exame_Candidatos'); 
            $this->db->join('Candidatos', 'Academica_Planificacao_Exame_Candidatos.Candidatos_id = Candidatos.id');

            // $this->db->join('academica_planificacao_exame_ingreso', 'academica_planificacao_exame_candidatos.Academica_Planificacao_Exame_Ingreso_id= academica_planificacao_exame_ingreso.id');
            // $this->db->join('niveis_cursos', 'Academica_Planificacao_Exame_Ingreso.niveis_cursos_id = niveis_cursos.id');
            // $this->db->join('niveis', 'niveis_cursos.niveis_id = niveis.id');
            // $this->db->join('cursos', 'niveis_cursos.cursos_id = cursos.id');
            // $this->db->join('periodos', 'niveis_cursos.Periodos_id = periodos.id');

            $this->db->where('Academica_Planificacao_Exame_Candidatos.apecCodigoBarra', $cb);
            // $this->db->where('cursos.id', $c);
            // $this->db->where('periodos.id', $p);
            // $this->db->where('Academica_Planificacao_Exame_Ingreso.Academica_Turmas_Ingreso_id', $s);
            $consulta = $this->db->get();
            $data = array();
            foreach($consulta->result() as $row){
                return ($nivel_acesso == "Administradores")?$row->cApelido:md5($row->cApelido);
            }
      }
      public function mreadBI($nivel_acesso,$cb/*,$c,$p,$s*/){
            $this->db->select('Candidatos.cBI_Passaporte');
            $this->db->from('Academica_Planificacao_Exame_Candidatos'); 
            $this->db->join('Candidatos', 'Academica_Planificacao_Exame_Candidatos.Candidatos_id = Candidatos.id');

            // $this->db->join('academica_planificacao_exame_ingreso', 'academica_planificacao_exame_candidatos.Academica_Planificacao_Exame_Ingreso_id= academica_planificacao_exame_ingreso.id');
            // $this->db->join('niveis_cursos', 'Academica_Planificacao_Exame_Ingreso.niveis_cursos_id = niveis_cursos.id');
            // $this->db->join('niveis', 'niveis_cursos.niveis_id = niveis.id');
            // $this->db->join('cursos', 'niveis_cursos.cursos_id = cursos.id');
            // $this->db->join('periodos', 'niveis_cursos.Periodos_id = periodos.id');

            $this->db->where('Academica_Planificacao_Exame_Candidatos.apecCodigoBarra', $cb);
            // $this->db->where('cursos.id', $c);
            // $this->db->where('periodos.id', $p);
            // $this->db->where('Academica_Planificacao_Exame_Ingreso.Academica_Turmas_Ingreso_id', $s);
            $consulta = $this->db->get();
            $data = array();
            foreach($consulta->result() as $row){
                return ($nivel_acesso == "Administradores")?$row->cBI_Passaporte:base64_encode($row->cBI_Passaporte);
            }
      }
      /*
      select Academica_Turmas_Ingreso.atcNome
from Academica_Planificacao_Exame_Candidatos inner join Candidatos on (Academica_Planificacao_Exame_Candidatos.Candidatos_id = Candidatos.id)
inner join Academica_Planificacao_Exame_Ingreso on (Academica_Planificacao_Exame_Ingreso.id = Academica_Planificacao_Exame_Candidatos.Academica_Planificacao_Exame_Ingreso_id)
inner join niveis_cursos on(Academica_Planificacao_Exame_Ingreso.niveis_cursos_id = niveis_cursos.id)
inner join niveis on(niveis_cursos.niveis_id = niveis.id)
inner join cursos on(niveis_cursos.cursos_id = cursos.id)
inner join periodos on(niveis_cursos.Periodos_id = periodos.id)
inner join Academica_Turmas_Ingreso on(Academica_Planificacao_Exame_Ingreso.Academica_Turmas_Ingreso_id = Academica_Turmas_Ingreso.id)
where Academica_Planificacao_Exame_Candidatos.apecCodigoBarra = 'X0E9H3'
      */
      public function mreadNivel($cb/*,$c,$p,$s*/){
            $this->db->select('niveis.nNome');
            $this->db->from('Academica_Planificacao_Exame_Candidatos'); 
            $this->db->join('Academica_Planificacao_Exame_Ingreso', 'Academica_Planificacao_Exame_Ingreso.id = Academica_Planificacao_Exame_Candidatos.Academica_Planificacao_Exame_Ingreso_id');
            $this->db->join('niveis_cursos', 'Academica_Planificacao_Exame_Ingreso.niveis_cursos_id = niveis_cursos.id');
            $this->db->join('niveis', 'niveis_cursos.niveis_id = niveis.id');
            $this->db->join('cursos', 'niveis_cursos.cursos_id = cursos.id');
            $this->db->join('periodos', 'niveis_cursos.Periodos_id = periodos.id');
            $this->db->join('Academica_Turmas_Ingreso', 'Academica_Planificacao_Exame_Ingreso.Academica_Turmas_Ingreso_id = Academica_Turmas_Ingreso.id');
            $this->db->where('Academica_Planificacao_Exame_Candidatos.apecCodigoBarra', $cb);
            // $this->db->where('cursos.id', $c);
            // $this->db->where('periodos.id', $p);
            // $this->db->where('Academica_Planificacao_Exame_Ingreso.Academica_Turmas_Ingreso_id', $s);
            $consulta = $this->db->get();
            $data = array();
            foreach($consulta->result() as $row){
                return $row->nNome;
            }
      }
      public function mreadCurso($cb/*,$c,$p,$s*/){
            $this->db->select('cursos.cNome');
            $this->db->from('Academica_Planificacao_Exame_Candidatos'); 
            $this->db->join('Academica_Planificacao_Exame_Ingreso', 'Academica_Planificacao_Exame_Ingreso.id = Academica_Planificacao_Exame_Candidatos.Academica_Planificacao_Exame_Ingreso_id');
            $this->db->join('niveis_cursos', 'Academica_Planificacao_Exame_Ingreso.niveis_cursos_id = niveis_cursos.id');
            $this->db->join('niveis', 'niveis_cursos.niveis_id = niveis.id');
            $this->db->join('cursos', 'niveis_cursos.cursos_id = cursos.id');
            $this->db->join('periodos', 'niveis_cursos.Periodos_id = periodos.id');
            $this->db->join('Academica_Turmas_Ingreso', 'Academica_Planificacao_Exame_Ingreso.Academica_Turmas_Ingreso_id = Academica_Turmas_Ingreso.id');
            $this->db->where('Academica_Planificacao_Exame_Candidatos.apecCodigoBarra', $cb);
            // $this->db->where('cursos.id', $c);
            // $this->db->where('periodos.id', $p);
            // $this->db->where('Academica_Planificacao_Exame_Ingreso.Academica_Turmas_Ingreso_id', $s);
            $consulta = $this->db->get();
            $data = array();
            foreach($consulta->result() as $row){
                return $row->cNome;
            }
      }
      public function mreadPeriodo($cb/*,$c,$p,$s*/){
            $this->db->select('periodos.pNome');
            $this->db->from('Academica_Planificacao_Exame_Candidatos'); 
            $this->db->join('Academica_Planificacao_Exame_Ingreso', 'Academica_Planificacao_Exame_Ingreso.id = Academica_Planificacao_Exame_Candidatos.Academica_Planificacao_Exame_Ingreso_id');
            $this->db->join('niveis_cursos', 'Academica_Planificacao_Exame_Ingreso.niveis_cursos_id = niveis_cursos.id');
            $this->db->join('niveis', 'niveis_cursos.niveis_id = niveis.id');
            $this->db->join('cursos', 'niveis_cursos.cursos_id = cursos.id');
            $this->db->join('periodos', 'niveis_cursos.Periodos_id = periodos.id');
            $this->db->join('Academica_Turmas_Ingreso', 'Academica_Planificacao_Exame_Ingreso.Academica_Turmas_Ingreso_id = Academica_Turmas_Ingreso.id');
            $this->db->where('Academica_Planificacao_Exame_Candidatos.apecCodigoBarra', $cb);
            // $this->db->where('cursos.id', $c);
            // $this->db->where('periodos.id', $p);
            // $this->db->where('Academica_Planificacao_Exame_Ingreso.Academica_Turmas_Ingreso_id', $s);
            $consulta = $this->db->get();
            $data = array();
            foreach($consulta->result() as $row){
                return $row->pNome;
            }
      }
      public function mreadTurma($nivel_acesso,$cb/*,$c,$p,$s*/){
            $this->db->select('Academica_Turmas_Ingreso.atcNome');
            $this->db->from('Academica_Planificacao_Exame_Candidatos'); 
            $this->db->join('Academica_Planificacao_Exame_Ingreso', 'Academica_Planificacao_Exame_Ingreso.id = Academica_Planificacao_Exame_Candidatos.Academica_Planificacao_Exame_Ingreso_id');
            $this->db->join('niveis_cursos', 'Academica_Planificacao_Exame_Ingreso.niveis_cursos_id = niveis_cursos.id');
            $this->db->join('niveis', 'niveis_cursos.niveis_id = niveis.id');
            $this->db->join('cursos', 'niveis_cursos.cursos_id = cursos.id');
            $this->db->join('periodos', 'niveis_cursos.Periodos_id = periodos.id');
            $this->db->join('Academica_Turmas_Ingreso', 'Academica_Planificacao_Exame_Ingreso.Academica_Turmas_Ingreso_id = Academica_Turmas_Ingreso.id');
            $this->db->where('Academica_Planificacao_Exame_Candidatos.apecCodigoBarra', $cb);
            // $this->db->where('cursos.id', $c);
            // $this->db->where('periodos.id', $p);
            // $this->db->where('Academica_Planificacao_Exame_Ingreso.Academica_Turmas_Ingreso_id', $s);
            $consulta = $this->db->get();
            $data = array();
            foreach($consulta->result() as $row){
                return ($nivel_acesso == "Administradores")?$row->atcNome:md5($row->atcNome);
            }
      }

      public function mreadNota($cb/*,$c,$p,$s*/){
            $this->db->select('Academica_Planificacao_Exame_Candidatos.apecNota');
            $this->db->from('Academica_Planificacao_Exame_Candidatos'); 
            $this->db->join('Academica_Planificacao_Exame_Ingreso', 'Academica_Planificacao_Exame_Ingreso.id = Academica_Planificacao_Exame_Candidatos.Academica_Planificacao_Exame_Ingreso_id');
            $this->db->join('niveis_cursos', 'Academica_Planificacao_Exame_Ingreso.niveis_cursos_id = niveis_cursos.id');
            $this->db->join('niveis', 'niveis_cursos.niveis_id = niveis.id');
            $this->db->join('cursos', 'niveis_cursos.cursos_id = cursos.id');
            $this->db->join('periodos', 'niveis_cursos.Periodos_id = periodos.id');
            $this->db->join('Academica_Turmas_Ingreso', 'Academica_Planificacao_Exame_Ingreso.Academica_Turmas_Ingreso_id = Academica_Turmas_Ingreso.id');
            $this->db->where('Academica_Planificacao_Exame_Candidatos.apecCodigoBarra', $cb);
            // $this->db->where('cursos.id', $c);
            // $this->db->where('periodos.id', $p);
            // $this->db->where('Academica_Planificacao_Exame_Ingreso.Academica_Turmas_Ingreso_id', $s);
            $consulta = $this->db->get();
            $data = array();
            foreach($consulta->result() as $row){
                return $row->apecNota;
            }
      }
      /*
        opter o dados do candidato para registrar auditoria
      */
      public function mreadBIXCB($cb){
            $this->db->select('Candidatos.cBI_Passaporte');
            $this->db->from('Academica_Planificacao_Exame_Candidatos'); 
            $this->db->join('Candidatos', 'Academica_Planificacao_Exame_Candidatos.Candidatos_id = Candidatos.id');
            $this->db->where('Academica_Planificacao_Exame_Candidatos.apecCodigoBarra', $cb);
            $consulta = $this->db->get();
            $data = array();
            foreach($consulta->result() as $row){
                return $row->cBI_Passaporte;
            }
      }

      public function get_id_upd($cb,$bi/*,$c,$p,$s*/){
            $this->db->select('academica_planificacao_exame_candidatos.id');
            $this->db->from('academica_planificacao_exame_candidatos'); 
            $this->db->join('academica_planificacao_exame_ingreso', 'academica_planificacao_exame_candidatos.Academica_Planificacao_Exame_Ingreso_id = academica_planificacao_exame_ingreso.id');
            //$this->db->join('niveis_cursos', 'niveis_cursos.id = academica_planificacao_exame_ingreso.niveis_cursos_id');
            //$this->db->join('cursos', 'niveis_cursos.cursos_id = cursos.id');
            $this->db->join('candidatos', 'academica_planificacao_exame_candidatos.Candidatos_id = candidatos.id');
            //$this->db->join('periodos', 'niveis_cursos.periodos_id = periodos.id');

            $this->db->where('Academica_Planificacao_Exame_Candidatos.apecCodigoBarra', $cb);
            // $this->db->where('cursos.id', $c);
            // $this->db->where('periodos.id', $p);
            // $this->db->where('Academica_Planificacao_Exame_Ingreso.Academica_Turmas_Ingreso_id', $s);
            $this->db->where('candidatos.cBI_Passaporte', $bi);

            $consulta = $this->db->get();
            foreach($consulta->result() as $row){
                return $row->id;
            }
      }

      function mupdate($cb,$apecNota,$user_sessao,$bi,/*$c,$p,$s,*/$na){
          $bi_decod = ($na == "Administradores")?$bi:base64_decode($bi);
        $id_apec = $this->get_id_upd($cb,$bi_decod/*,$c,$p,$s*/);
        
        echo $na.'</br>';
        echo $bi_decod.'</br>';
        echo $id_apec.'</br>';

            $dados = array('apecNota'=>$apecNota);
            //if($this->db->update('Academica_Planificacao_Exame_Candidatos', $dados, array('apecCodigoBarra' => $cb))){
            if($this->db->update('Academica_Planificacao_Exame_Candidatos', $dados, array('id' => $id_apec))){
                //$bi_candidato = $this->mreadBIXCB($cb);
                $bi_candidato = $bi_decod;
                $this->load->model('MAuditorias_Academicas');
                $this->MAuditorias_Academicas->minsert("Inserir:Nota Ex. Acesso","Academica","Res. Exame Acesso",$user_sessao,"Estudante BI: ".$bi_candidato.' Nota: '.$apecNota.' Inserido com sucesso');
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
