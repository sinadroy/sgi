<?php
  class MPagamentos_Comprobativo_Prec extends CI_Model{
      
      function mread(){
          $this->db->select('pagamentos_comprobativos_niveis_cursos_precario.id, pc_nome, precnome');
          $this->db->from('pagamentos_comprobativos_niveis_cursos_precario');
          $this->db->join('pagamentos_comprobativo', 'pagamentos_comprobativos_niveis_cursos_precario.pagamentos_comprobativo_id = pagamentos_comprobativo.id');
          $this->db->join('precario', 'pagamentos_comprobativos_niveis_cursos_precario.precario_id = precario.id');
          $consulta = $this->db->get();
          $ord=1;
          $data = array();
            foreach ($consulta->result() as $row) {
                    $data[] = array(
                        "ord" => $ord,
                        "id" => $row->id,
                        "pc_nome" => $row->pc_nome,
                        "precnome" => $row->precnome
                    );
                    $ord++;
            }
            return $data;
      }
      // ver preco de um pag comprobativo
      function mread_precario($pc_nome,$id_ncp){
        $this->db->select('ncp_preco');
        $this->db->from('pagamentos_comprobativos_niveis_cursos_precario');
        $this->db->join('pagamentos_comprobativo', 'pagamentos_comprobativos_niveis_cursos_precario.pagamentos_comprobativo_id = pagamentos_comprobativo.id');
        $this->db->join('precario', 'pagamentos_comprobativos_niveis_cursos_precario.precario_id = precario.id');
        $this->db->join('niveis_cursos_precario', 'niveis_cursos_precario.precario_id = precario.id');
        $this->db->where('pagamentos_comprobativos_niveis_cursos_precario.pagamentos_comprobativo_id', $pc_nome);
        $this->db->where('niveis_cursos_precario.niveis_cursos_id', $id_ncp);
        $consulta = $this->db->get();
        $data = array();
          foreach ($consulta->result() as $row) {
                  return $row->ncp_preco;
          }
    }

    function existe($id){
        $this->db->select('id');
        $this->db->from('pagamentos_comprobativos_niveis_cursos_precario');
        $this->db->where('id', $id);
        if($this->db->count_all_results() > 0)
            return true;
        else
            return false;
    }

      function mupdate($id,$pagamentos_comprobativo_id,$precario_id){
            $dados = array('pagamentos_comprobativo_id'=>$pagamentos_comprobativo_id, 'precario_id'=>$precario_id);
            if($this->db->update('pagamentos_comprobativos_niveis_cursos_precario', $dados, array('id' => $id))){
                return true;
            }else
                return false;
      }
      
    function minsert($pagamentos_comprobativo_id,$precario_id){
        // echo "test: ".$this->existe($pagamentos_comprobativo_id);
        if($this->existe($pagamentos_comprobativo_id)){
            return false;
        }else{
            $dados = array('pagamentos_comprobativo_id'=>$pagamentos_comprobativo_id, 'precario_id'=>$precario_id);
            if($this->db->insert('pagamentos_comprobativos_niveis_cursos_precario', $dados))
            {
                return true;
            }else{
                return false;
            }
        } 
    }

    function mdelete($id) {
        if($this->db->delete('pagamentos_comprobativos_niveis_cursos_precario', array('id' => $id)))  
            return true;
        else
            return false;
        
    }       
           
  }
