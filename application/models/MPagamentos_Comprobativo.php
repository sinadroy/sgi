<?php
  class MPagamentos_Comprobativo extends CI_Model{
      
      function mread(){
          $this->db->select('id, pc_nome, pc_descricao');
          $this->db->from('pagamentos_comprobativo');
          // $this->db->join('Financas_Forma_Pagamento', 'financas_cartao.Financas_Forma_Pagamento_id = Financas_Forma_Pagamento.id');
          $consulta = $this->db->get();
          $ord=1;
          $data = array();
            foreach ($consulta->result() as $row) {
                    $data[] = array(
                        "ord" => $ord,
                        "id" => $row->id,
                        "pc_nome" => $row->pc_nome,
                        "value" => $row->pc_nome,
                        "pc_descricao" => $row->pc_descricao
                    );
                    $ord++;
            }
            return $data;
      }

      function mupdate($id,$pc_nome,$pc_descricao){
            $dados = array('pc_nome'=>$pc_nome, 'pc_descricao'=>$pc_descricao);
            if($this->db->update('pagamentos_comprobativo', $dados, array('id' => $id))){
                return true;
            }else
                return false;
      }
      
    function minsert($pc_nome,$pc_descricao){
        $dados = array('pc_nome'=>$pc_nome, 'pc_descricao'=>$pc_descricao);
        if($this->db->insert('pagamentos_comprobativo', $dados))
        {
            return true;
        }else{
            return false;
        }
           
    }
    function mdelete($id) {
        if($this->db->delete('pagamentos_comprobativo', array('id' => $id)))  
            return true;
        else
            return false;
        
    }       
           
  }
