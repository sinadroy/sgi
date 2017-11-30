<?php

class CFinancas_Propina_Comprovativo extends CI_Controller {
    /*
    Retornar candidatos_id
    */
    function getCandidatos_id($id){
        $this->db->select('Cursos_Pretendidos.Candidatos_id');
        $this->db->from('Cursos_Pretendidos');
        $this->db->join('Candidatos', 'Cursos_Pretendidos.Candidatos_id = Candidatos.id');
        $this->db->where('Cursos_Pretendidos.id', $id);
        $consulta = $this->db->get();
        $data = array();
        foreach ($consulta->result() as $row) {
            $cid = $row->Candidatos_id;
        }
        return $cid;
    }

    public function imprimir(){
        $request = $_POST;
        $id = $request['Estudantes_id'];
        $total_pagar = $request['ppValor'];
        $bancNome = $request['bancNome'];
        $contNumero = $request['Financas_Contas_id'];
        $ffpNome = $request['Financas_Forma_Pagamento_id'];
        $fpcRefPagamento = @$request['fpcRefPagamento'];
        $utilizadores_id = $request['utilizadores_id'];
        $anos_lectivos_id = $request['anos_lectivos_id'];
        $this->load->model("MAnos_Lectivos");
        $ano_lectivo = $this->MAnos_Lectivos->mreadX($anos_lectivos_id);
        $mesNome = $request['mesNome'];
        //determinar id del candidato
        //$cid = $th
        
        $this->load->model('MFinancas_Propina_Comprovativo');
        $this->MFinancas_Propina_Comprovativo->criarPdf($id,$ano_lectivo,$total_pagar,$bancNome,$contNumero,$ffpNome,$fpcRefPagamento,$utilizadores_id,$mesNome);
    }
}
