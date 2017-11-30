<?php
  class Mdeclaracao_mestrado_configuracao extends CI_Model{
      
      function mread(){
          $this->db->select('declaracao_mestrado_configuracao.id,
            declaracao_mestrado_configuracao.titulo_visto, 
            declaracao_mestrado_configuracao.nome_visto,
            declaracao_mestrado_configuracao.nome_asignatura,
            niveis.nnome, cursos.cnome');
          $this->db->from('declaracao_mestrado_configuracao');
          $this->db->join('niveis_cursos', 'declaracao_mestrado_configuracao.niveis_cursos_id = niveis_cursos.id');
          $this->db->join('niveis', 'niveis_cursos.niveis_id = niveis.id');
          $this->db->join('cursos', 'niveis_cursos.cursos_id = cursos.id');
          $consulta = $this->db->get();
          $ord=1;
          $data = array();
            foreach ($consulta->result() as $row) {
                    $data[] = array(
                        "ord" => $ord,
                        "id" => $row->id,
                        "titulo_visto" => $row->titulo_visto,
                        "nome_visto" => $row->nome_visto,
                        "nome_asignatura" => $row->nome_asignatura,
                        "nnome" => $row->nnome,
                        "cnome" => $row->cnome
                    );
                    $ord++;
            }
            return $data;
      }

      function mread_titulo_visto($nid,$cid){
          $this->db->select('titulo_visto');
          $this->db->from('declaracao_mestrado_configuracao');
          $this->db->join('niveis_cursos', 'declaracao_mestrado_configuracao.niveis_cursos_id = niveis_cursos.id');
          $this->db->join('niveis', 'niveis_cursos.niveis_id = niveis.id');
          $this->db->join('cursos', 'niveis_cursos.cursos_id = cursos.id');
          $this->db->where('niveis_cursos.niveis_id', $nid);
          $this->db->where('niveis_cursos.cursos_id', $cid);
          $consulta = $this->db->get();
          $data = array();
            foreach ($consulta->result() as $row) {
                return $row->titulo_visto;    
            }
      }
      function mread_nome_visto($nid,$cid){
          $this->db->select('nome_visto');
          $this->db->from('declaracao_mestrado_configuracao');
          $this->db->join('niveis_cursos', 'declaracao_mestrado_configuracao.niveis_cursos_id = niveis_cursos.id');
          $this->db->join('niveis', 'niveis_cursos.niveis_id = niveis.id');
          $this->db->join('cursos', 'niveis_cursos.cursos_id = cursos.id');
          $this->db->where('niveis_cursos.niveis_id', $nid);
          $this->db->where('niveis_cursos.cursos_id', $cid);
          $consulta = $this->db->get();
          $data = array();
            foreach ($consulta->result() as $row) {
                return $row->nome_visto;    
            }
      }
      function mread_nome_asignatura($nid,$cid){
          $this->db->select('nome_asignatura');
          $this->db->from('declaracao_mestrado_configuracao');
          $this->db->join('niveis_cursos', 'declaracao_mestrado_configuracao.niveis_cursos_id = niveis_cursos.id');
          $this->db->join('niveis', 'niveis_cursos.niveis_id = niveis.id');
          $this->db->join('cursos', 'niveis_cursos.cursos_id = cursos.id');
          $this->db->where('niveis_cursos.niveis_id', $nid);
          $this->db->where('niveis_cursos.cursos_id', $cid);
          $consulta = $this->db->get();
          $data = array();
            foreach ($consulta->result() as $row) {
                return $row->nome_asignatura;    
            }
      }

    function mupdate($id,$nnome,$cnome,$titulo_visto,$nome_visto,$nome_asignatura){
        //get id of niveis_cursos_id for n_id and c_id
        $this->load->model('MNiveisCursos');
        //$niveis_cursos_id = $this->MNiveisCursos->mreadX($nnome,$cnome);
        $dados = array('titulo_visto'=>$titulo_visto,'nome_visto'=>$nome_visto,'nome_asignatura'=>$nome_asignatura);
        if($this->db->update('declaracao_mestrado_configuracao', $dados, array('id' => $id))){
            return true;
        }else
            return false;
    }  
    function minsert($nnome,$cnome,$titulo_visto,$nome_visto,$nome_asignatura){
        //get id of niveis_cursos_id for n_id and c_id
        $this->load->model('MNiveisCursos');
        $niveis_cursos_id = $this->MNiveisCursos->mreadX($nnome,$cnome);
        if($this->db->insert('declaracao_mestrado_configuracao', array('niveis_cursos_id'=>$niveis_cursos_id,'titulo_visto'=>$titulo_visto,'nome_visto'=>$nome_visto,'nome_asignatura'=>$nome_asignatura)))
        {
            return true;
        }else{
            return false;
        }     
    }
    function mdelete($id) {
        if($this->db->delete('declaracao_mestrado_configuracao', array('id' => $id)))  
            return true;
        else
            return false;
        
    }        
  }
