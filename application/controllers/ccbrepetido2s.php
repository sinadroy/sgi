<?php
  class Ccbrepetido2s extends CI_Controller{
      
      function mExiste_CB($cb,$id){
          $this->db->select('id');
          $this->db->from('academica_planificacao_exame_candidatos_2s');
          $this->db->where('apecCodigoBarra', $cb);
          $this->db->where('id <>', $id);
          if($this->db->count_all_results() > 0)
            return true;
          else
            return false;
      }

      public function read(){
        $n = $this->input->get('n');
        $c = $this->input->get('c');
        $p = $this->input->get('p');

        $this->load->model('MNiveisCursos');
        $niveis_cursos_id = $this->MNiveisCursos->mreadXncp($n,$c,$p);

        echo "Lista de candidatos com Codigo de Barra repetido:".'</br>';
        $this->db->select('Academica_Planificacao_Exame_Candidatos_2S.id,Academica_Planificacao_Exame_Candidatos_2S.Candidatos_id, Academica_Planificacao_Exame_Candidatos_2S.apecCodigoBarra');
        $this->db->from('Academica_Planificacao_Exame_Candidatos_2S');
        //$this->db->join('Cursos_Pretendidos_2S','Cursos_Pretendidos_2S.Candidatos_id = Candidatos.id');
        //$this->db->join('niveis_cursos','Cursos_Pretendidos_2S.niveis_cursos_id = niveis_cursos.id');
        //$this->db->join('niveis','niveis_cursos.niveis_id = niveis.id');
        //$this->db->join('cursos','niveis_cursos.cursos_id = cursos.id');
        ///$this->db->join('periodos','niveis_cursos.periodos_id = periodos.id');
        //$this->db->join('Academica_Planificacao_Exame_Candidatos_2S','Academica_Planificacao_Exame_Candidatos_2S.Candidatos_id = Candidatos.id');
        //$this->db->join('Academica_Planificacao_Exame_Ingreso_2S','Academica_Planificacao_Exame_Candidatos_2S.Academica_Planificacao_Exame_Ingreso_2S_id = Academica_Planificacao_Exame_Ingreso_2S.id');
        //$this->db->join('Academica_Turmas_Ingreso_2S','Academica_Planificacao_Exame_Ingreso_2S.Academica_Turmas_Ingreso_2S_id = Academica_Turmas_Ingreso_2S.id');
        //$this->db->where('Candidatos.anos_lectivos_id',2017);
        $consulta = $this->db->get();
        foreach($consulta->result() as $row){
              if($this->mExiste_CB($row->apecCodigoBarra,$row->id))
                //echo $row->cNome.' '.$row->cApelido.' '.$row->cBI_Passaporte.'</br>';
                echo "Candidatos_id: ".$row->Candidatos_id.'</br>';
        }
      }
            
}
//B8Q3H5
//Z9Y1A1
//
