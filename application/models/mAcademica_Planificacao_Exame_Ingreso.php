<?php
  class MAcademica_Planificacao_Exame_Ingreso extends CI_Model{
      
      function mread($al){
          //Academica_Turmas_Ingreso.atcNome,Academica_Turmas_Ingreso.atcLocalizacao,
          $this->db->select('Academica_Planificacao_Exame_Ingreso.id,Academica_Planificacao_Exame_Ingreso.apeiData,Academica_Planificacao_Exame_Ingreso.apeiHora,
          anos_lectivos.alAno,
          Academica_Turmas_Ingreso.atcNome,Academica_Turmas_Ingreso.atcLocalizacao,
          niveis.nNome,cursos.cNome,periodos.pNome');
          $this->db->from('Academica_Planificacao_Exame_Ingreso');
          $this->db->join('anos_lectivos','Academica_Planificacao_Exame_Ingreso.anos_lectivos_id = anos_lectivos.id');
          $this->db->join('Academica_Turmas_Ingreso','Academica_Planificacao_Exame_Ingreso.Academica_Turmas_Ingreso_id = Academica_Turmas_Ingreso.id');
          $this->db->join('niveis_cursos','Academica_Planificacao_Exame_Ingreso.niveis_cursos_id = niveis_cursos.id');
          $this->db->join('niveis','niveis_cursos.niveis_id = niveis.id');
          $this->db->join('cursos','niveis_cursos.cursos_id = cursos.id');
          $this->db->join('periodos','niveis_cursos.periodos_id = periodos.id');

          $this->db->where('Academica_Planificacao_Exame_Ingreso.anos_lectivos_id',$al);
          
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

          //return $consulta->result();
      }
      
      function mreadX($alAno,$niveis_cursos_id,$atcNome,$apeiData,$apeiHora){
          $this->db->select('Academica_Planificacao_Exame_Ingreso.id');
          $this->db->from('Academica_Planificacao_Exame_Ingreso');
          $this->db->where('anos_lectivos_id',$alAno);
          $this->db->where('Academica_Turmas_Ingreso_id',$atcNome);
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
            'Academica_Turmas_Ingreso_id'=>$atcNome,'apeiData'=>$apeiData,'apeiHora'=>$apeiHora);
            if($this->db->update('Academica_Planificacao_Exame_Ingreso', $dados, array('id' => $id))){
                return true;
            }else
                return false;
      }
      
    function minsert($alAno,$nNome,$cNome,$pNome,$atcNome,$apeiData,$apeiHora){
        //determinar niveis_cursos_id mediante niveis,curso e periodo
        $this->load->model('MNiveisCursos');
        $niveis_cursos_id = $this->MNiveisCursos->mreadXncp($nNome,$cNome,$pNome);
        if($this->db->insert('Academica_Planificacao_Exame_Ingreso', array('anos_lectivos_id'=>$alAno,'niveis_cursos_id'=>$niveis_cursos_id,
            'Academica_Turmas_Ingreso_id'=>$atcNome,'apeiData'=>$apeiData,'apeiHora'=>$apeiHora)))
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
}
