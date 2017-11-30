<?php
class MFinancas_Pagamentos_Pendientes_Documentos extends CI_Model {
    
    function mread_preco_documento($id)
    {
        $this->db->select('tdvalor');
        $this->db->from('tipo_documentos');
        $this->db->where('id', $id);
        $consulta = $this->db->get();
        foreach ($consulta->result() as $row) {
              return $row->tdvalor;
        }
    }
    /*
        para interface de pagamento de confirmacao de matricula em financas
    */
    function mread_ncpXid_fd($id)
    {
        $this->db->select('niveis_cursos.id,niveis.nNome,cursos.cNome,periodos.pNome');
        $this->db->from('Candidatos');
        $this->db->join('Estudantes', 'Estudantes.Candidatos_id = Candidatos.id');
        $this->db->join('niveis_cursos', 'Estudantes.niveis_cursos_id = niveis_cursos.id');
        $this->db->join('niveis', 'niveis_cursos.niveis_id = niveis.id');
        $this->db->join('cursos', 'niveis_cursos.cursos_id = cursos.id');
        $this->db->join('periodos', 'niveis_cursos.periodos_id = periodos.id');
        //$this->db->where('Estudantes.eEstado_Matricula', "Conf.Mat.Esp.Pag");
        if($id != ""){
            $this->db->where('Candidatos.id', $id);
        }
        $consulta = $this->db->get();
        $data = array();
        foreach ($consulta->result() as $row) {
            $data[] = array(
                "id" => $row->id,
                "nNome" => $row->nNome,
                "cNome" => $row->cNome,
                "pNome" => $row->pNome,
                //"tdvalor" => $this->mread_preco_documento($id_td) 
            );
        }
        return $data;
    }
    
    /*
        Inserir pagamento pendiente
        fppcData,fppcCodigoBarra,Financas_Tipo_Pagamento_id,Candidatos_id,
    */
    function minsert($fppcData,$fppcCodigoBarra,$Financas_Tipo_Pagamento_id,$Candidatos_id){
        //Tabla Candidato
        $pag = array('fppcData'=>$fppcData,'fppcCodigoBarra'=>$fppcCodigoBarra,'Financas_Tipo_Pagamento_id'=>$Financas_Tipo_Pagamento_id,'Candidatos_id'=>$Candidatos_id);
        
        if ($this->db->insert('Financas_Pagamentos_Pendientes_Candidatos', $pag)) {
            return true;
        } else {
            return false;
        }
    }

    
    /*
        APAGAR PAGAMENTO PENDIENTE
    */
    function mdelete($id){
        //$cid = $this->getCandidatos_id($id);
        if($this->db->delete('Financas_Pagamentos_Pendientes_Candidatos', array('Candidatos_id' => $id)))
            return true;
        else
            return false;
    }
}

?>
