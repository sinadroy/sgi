<?php
class MFinancas_Contas extends CI_Model {

    /*
     * Datos Personales
    */
    function mread() {
        $this->db->select('Financas_Contas.id,Financas_Contas.contNome,
            Financas_Contas.contNumero,Financas_Contas.contNatureza,
            Financas_Contas.contDescricao,
            Financas_Contas.Financas_Bancos_id,Financas_Bancos.bancNome');
        $this->db->from('Financas_Contas');
        $this->db->join('Financas_Bancos', 'Financas_Contas.Financas_Bancos_id = Financas_Bancos.id');
        $consulta = $this->db->get();
        $ord=1;
        $data = array();
        foreach ($consulta->result() as $row) {
            if($row->contNome != "Sistema"){
                $data[] = array(
                    "id" => $row->id,
                    "ord" => $ord,
                    "contNome" => $row->contNome,
                    "contNumero" => $row->contNumero,
                    "value" => $row->contNumero,
                    "contNatureza" => $row->contNatureza,
                    "contDescricao" => $row->contDescricao,
                    "bancNome"=> $row->bancNome
                );
                $ord++;
            }
        }
        return $data;
    }
    /*
        determinar lista de contas por banco
    */
    function mreadXbanco($id) {
        $this->db->select('Financas_Contas.id,Financas_Contas.contNome,
            Financas_Contas.contNumero,Financas_Contas.contNatureza,
            Financas_Contas.contDescricao,
            Financas_Contas.Financas_Bancos_id,Financas_Bancos.bancNome');
        $this->db->from('Financas_Contas');
        $this->db->join('Financas_Bancos', 'Financas_Contas.Financas_Bancos_id = Financas_Bancos.id');
        $this->db->where('Financas_Contas.Financas_Bancos_id', $id);
        $consulta = $this->db->get();
        $data = array();
        foreach ($consulta->result() as $row) {
            if($row->contNome != "Sistema"){
                $data[] = array(
                    "id" => $row->id,
                    "contNome" => $row->contNome,
                    "contNumero" => $row->contNumero,
                    "value" => $row->contNumero,
                    "contNatureza" => $row->contNatureza,
                    "contDescricao" => $row->contDescricao,
                    "bancNome"=> $row->bancNome
                );
            }
        }
        return $data;
    }
    function mreadIDXNome($contaNome) {
        $this->db->select('Financas_Contas.id');
        $this->db->from('Financas_Contas');
        $this->db->where('Financas_Contas.contNome', $contaNome);
        //$this->db->join('Financas_Bancos', 'Financas_Contas.Financas_Bancos_id = Financas_Bancos.id');
        $consulta = $this->db->get();
        foreach ($consulta->result() as $row) {
            return $row->id;
        }
    }
    function mupdate($id,$contNome, $contNumero, $contNatureza, $contDescricao,$bancNome){
            
            if(!is_numeric($bancNome)){
                $this->load->model("MFinancas_Bancos");
                $bancNome = $this->MFinancas_Bancos->mreadXnome($bancNome);
            }
            $dados = array('contNome'=>$contNome,'contNumero'=>$contNumero,'contNatureza'=>$contNatureza,'contDescricao'=>$contDescricao,
                'Financas_Bancos_id'=>$bancNome);
            if($this->db->update('Financas_Contas', $dados, array('id' => $id))){
                return true;
            }else
                return false;
      }
      
    function minsert($contNome, $contNumero, $contNatureza, $contDescricao,$bancNome){
        if($this->db->insert('Financas_Contas', array('contNome'=>$contNome,'contNumero'=>$contNumero,'contNatureza'=>$contNatureza,
            'contDescricao'=>$contDescricao, 'Financas_Bancos_id'=>$bancNome)))
        {
            return true;
        }else{
            return false;
        }
           
    }
    function mdelete($id) {
        if($this->db->delete('Financas_Contas', array('id' => $id)))  
            return true;
        else
            return false;
        
    }
}

?>
