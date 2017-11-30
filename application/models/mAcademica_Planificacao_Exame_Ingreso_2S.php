<?php
  class MAcademica_Planificacao_Exame_Ingreso_2S extends CI_Model{
      
      function mread(){
          $this->db->select('Academica_Planificacao_Exame_Ingreso_2S.id,Academica_Planificacao_Exame_Ingreso_2S.apeiData,Academica_Planificacao_Exame_Ingreso_2S.apeiHora,
          anos_lectivos.alAno,
          Academica_Turmas_Ingreso_2S.atcNome,Academica_Turmas_Ingreso_2S.atcLocalizacao,
          niveis.nNome,cursos.cNome,periodos.pNome');
          $this->db->from('Academica_Planificacao_Exame_Ingreso_2S');
          $this->db->join('anos_lectivos','Academica_Planificacao_Exame_Ingreso_2S.anos_lectivos_id = anos_lectivos.id');
          $this->db->join('Academica_Turmas_Ingreso_2S','Academica_Planificacao_Exame_Ingreso_2S.Academica_Turmas_Ingreso_2S_id = Academica_Turmas_Ingreso_2S.id');
          $this->db->join('niveis_cursos','Academica_Planificacao_Exame_Ingreso_2S.niveis_cursos_id = niveis_cursos.id');
          $this->db->join('niveis','niveis_cursos.niveis_id = niveis.id');
          $this->db->join('cursos','niveis_cursos.cursos_id = cursos.id');
          $this->db->join('periodos','niveis_cursos.periodos_id = periodos.id');
          $consulta = $this->db->get();
          $orden = 1;
          foreach($consulta->result() as $row){
              $data[] = array(
                  "orden"=>$orden,
                  "id"=>$row->id,
                  "alAno"=>$row->alAno,
                  "apeiData"=>$row->apeiData,
                  "apeiHora"=>$row->apeiHora,
                  "nNome"=>$row->nNome,
                  "cNome"=>$row->cNome,
                  "pNome"=>$row->pNome,
                  "atcNome"=>$row->atcNome,
                  "atcLocalizacao"=>$row->atcLocalizacao
              );
              $orden++;
          }
        return $data;
      }
      
      function mreadX($alAno,$niveis_cursos_id,$atcNome,$apeiData,$apeiHora){
          $this->db->select('Academica_Planificacao_Exame_Ingreso_2S.id');
          $this->db->from('Academica_Planificacao_Exame_Ingreso_2S');
          $this->db->where('anos_lectivos_id',$alAno);
          $this->db->where('Academica_Turmas_Ingreso_2S_id',$atcNome);
          $this->db->where('niveis_cursos_id',$niveis_cursos_id);
          $this->db->where('apeiData',$apeiData);
          $this->db->where('apeiHora',$apeiHora);
          $consulta = $this->db->get();
          foreach($consulta->result() as $row){
              return $row->id;
          }
      }

      function mupdate($id,$alAno,$nNome,$cNome,$pNome,$atcNome,$apeiData,$apeiHora){
            $dados = array('anos_lectivos_id'=>$alAno,'niveis_cursos_id'=>$niveis_cursos_id,
            'Academica_Turmas_Ingreso_2S_id'=>$atcNome,'apeiData'=>$apeiData,'apeiHora'=>$apeiHora);
            if($this->db->update('Academica_Planificacao_Exame_Ingreso_2S', $dados, array('id' => $id))){
                return true;
            }else
                return false;
      }
      
    function minsert($alAno,$nNome,$cNome,$pNome,$atcNome,$apeiData,$apeiHora){
        //determinar niveis_cursos_id mediante niveis,curso e periodo
        $this->load->model('MNiveisCursos');
        $niveis_cursos_id = $this->MNiveisCursos->mreadXncp($nNome,$cNome,$pNome);
        if($this->db->insert('Academica_Planificacao_Exame_Ingreso_2S', array('anos_lectivos_id'=>$alAno,'niveis_cursos_id'=>$niveis_cursos_id,
            'Academica_Turmas_Ingreso_2S_id'=>$atcNome,'apeiData'=>$apeiData,'apeiHora'=>$apeiHora)))
        {
            return true;
        }else{
            return false;
        }
           
    }
    function mdelete($id) {
        if($this->db->delete('Academica_Planificacao_Exame_Ingreso_2S', array('id' => $id)))  
            return true;
        else
            return false;
        
    }         
}
