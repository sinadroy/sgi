<?php
class MFinancas_Bancos extends CI_Model {

    /*
     * Datos Personales
    */
    function mread() {
        $this->db->select('id,bancNome,bancCodigo,bancDescricao');
        $this->db->from('Financas_Bancos');
        $consulta = $this->db->get();
        $ord=1;
        $data = array();
        foreach ($consulta->result() as $row) {
            if($row->bancNome != "Sistema"){
                $data[] = array(
                    "id" => $row->id,
                    "ord" => $ord,
                    "bancNome" => $row->bancNome,
                    "value" => $row->bancNome,
                    "bancCodigo" => $row->bancCodigo,
                    "bancDescricao" => $row->bancDescricao,
                );
                $ord++;
            }
        }
        return $data;
    }
    function mreadXnome($bancNome) {
        $this->db->select('id');
        $this->db->from('Financas_Bancos');
        $this->db->where('Financas_Bancos.bancNome', $bancNome);
        $consulta = $this->db->get();
        $data = array();
        foreach ($consulta->result() as $row) {
            return $row->id;
        }
    }
    function mupdate($id,$bancNome, $bancCodigo, $bancDescricao){
            $dados = array('bancNome'=>$bancNome,'bancCodigo'=>$bancCodigo,'bancDescricao'=>$bancDescricao);
            if($this->db->update('Financas_Bancos', $dados, array('id' => $id))){
                return true;
            }else
                return false;
      }
      
    function minsert($bancNome, $bancCodigo, $bancDescricao){
        if($this->db->insert('Financas_Bancos', array('bancNome'=>$bancNome,'bancCodigo'=>$bancCodigo,'bancDescricao'=>$bancDescricao)))
        {
            return true;
        }else{
            return false;
        }
           
    }
    function mdelete($id) {
        if($this->db->delete('Financas_Bancos', array('id' => $id)))  
            return true;
        else
            return false;
        
    }
}

?>
