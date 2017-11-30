<?php

class CFinancas_Inscricao_2S_Comprovativo_REIMP extends CI_Controller {
    /*
    Retornar candidatos_id
    */
    function getCandidatos_id($id){
        $this->db->select('Cursos_Pretendidos_2S.Candidatos_id');
        $this->db->from('Cursos_Pretendidos_2S');
        $this->db->join('Candidatos', 'Cursos_Pretendidos_2S.Candidatos_id = Candidatos.id');
        $this->db->where('Cursos_Pretendidos_2S.id', $id);
        $consulta = $this->db->get();
        $data = array();
        foreach ($consulta->result() as $row) {
            $cid = $row->Candidatos_id;
        }
        return $cid;
    }

    public function imprimir(){
        $request = $_POST;
        $id = $request['id'];
        $total_pagar = $request['total_pagar'];
        $bancNome = @$request['bancNome'];
        $contNumero = @$request['contNumero'];
        $ffpNome = @$request['ffpNome'];
        $fpcRefPagamento = @$request['fpcRefPagamento'];
        $utilizadores_id = $request['utilizadores_id'];

        //determinar id del candidato
        //$cid = $this->getCandidatos_id($id);

        //cambiar estado do candidato
        $this->load->model('MCandidatos');
        $this->MCandidatos->cambiar_estado($id,"Inscrição aceite");
        
        $this->load->model('MFinancas_Inscricao_2S_Comprovativo_REIMP');
        $this->MFinancas_Inscricao_2S_Comprovativo_REIMP->criarPdf($id,$total_pagar,$bancNome,$contNumero,$ffpNome,$fpcRefPagamento,$utilizadores_id);
    }
}
