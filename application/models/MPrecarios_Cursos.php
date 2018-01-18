<?php
  class MPrecarios_Cursos extends CI_Model{
      
    function mread(){
        $ord = 1;
        $this->db->select('niveis_cursos_precario.id, ncp_preco, ncp_precou,
            precnome,preccodigo,precdescricao,
            niveis.nNome,
            cursos.cNome,
            periodos.pNome,
            anos_lectivos.alAno');
        $this->db->from('niveis_cursos_precario');
        $this->db->join('precario', 'niveis_cursos_precario.precario_id = precario.id');
        $this->db->join('niveis_cursos', 'niveis_cursos_precario.niveis_cursos_id = niveis_cursos.id');
        $this->db->join('niveis', 'niveis_cursos.niveis_id = niveis.id');
        $this->db->join('cursos', 'niveis_cursos.cursos_id = cursos.id');
        $this->db->join('periodos', 'niveis_cursos.periodos_id = periodos.id');
        $this->db->join('anos_lectivos', 'niveis_cursos_precario.anos_lectivos_id = anos_lectivos.id');
        $consulta = $this->db->get();
        foreach($consulta->result() as $row){
            $al[] = array(
                "ord"=>$ord,
                "id"=>$row->id,
                "value"=>$row->precnome,
                "precnome"=>$row->precnome,
                "preccodigo"=>$row->preccodigo,
                "precdescricao"=>$row->precdescricao,
                "ncp_preco"=>$row->ncp_preco,
                "ncp_precou"=>$row->ncp_precou,
                "nNome"=>$row->nNome,
                "cNome"=>$row->cNome,
                "pNome"=>$row->pNome,
                "alAno"=>$row->alAno,
            );
            $ord++;
        }
        return $al;
    }
    
    public function mexiste($nid,$cid,$pid,$precid,$al){
        $this->load->model('MNiveisCursos');
        $ncp_id = $this->MNiveisCursos->mreadXncp($nid,$cid,$pid);
        $this->db->select('id');
        $this->db->from('niveis_cursos_precario');
        $this->db->where('niveis_cursos_id', $ncp_id);
        $this->db->where('precario_id', $precid);
        $this->db->where('anos_lectivos_id', $al);
        return $this->db->count_all_results();
    }
      
    function mupdate($id,$al,$n,$c,$p,$prec,$ncp_preco,$ncp_precou){
        $this->load->model('MNiveisCursos');
        $ncp_id = $this->MNiveisCursos->mreadXncp($n,$c,$p);
        $d = array('niveis_cursos_id' => $ncp_id, 'precario_id' => $prec, 'ncp_preco' => $ncp_preco, 'ncp_precou' => $ncp_precou, 'anos_lectivos_id' => $al);
        if($this->db->update('niveis_cursos_precario', $d, array('id' => $id))){
            return true;
        }else
            return false;
    }
      
    function minsert($al,$n,$c,$p,$prec,$ncp_preco,$ncp_precou){
        $this->load->model('MNiveisCursos');
        $ncp_id = $this->MNiveisCursos->mreadXncp($n,$c,$p);
        $d = array('niveis_cursos_id' => $ncp_id, 'precario_id' => $prec, 'ncp_preco' => $ncp_preco, 'ncp_precou' => $ncp_precou, 'anos_lectivos_id' => $al);
        if($this->db->insert('niveis_cursos_precario', $d))
        {
            return true;
        }else{
            return false;
        }
           
    }
    function mdelete($id) {
        if($this->db->delete('niveis_cursos_precario', array('id' => $id)))  
            return true;
        else
            return false;
        
    }
       
           
  }
?>
