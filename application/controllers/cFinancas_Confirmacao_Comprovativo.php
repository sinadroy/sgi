<?php

class CFinancas_Confirmacao_Comprovativo extends CI_Controller {
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
        $id = $request['id'];
        $total_pagar = $request['total_pagar'];
        $bancNome = $request['bancNome'];
        $contNumero = $request['contNumero'];
        $ffpNome = $request['ffpNome'];
        $fpcRefPagamento = @$request['fpcRefPagamento'];
        $utilizadores_id = $request['utilizadores_id'];

       // $anoLectivoIngresso = $request['anoLectivoIngresso'];

        //determinar id del candidato
        //$cid = $this->getCandidatos_id($id);

        //cambiar estado do candidato
        $this->load->model('MEstudantes');
        $this->MEstudantes->cambiar_estado($id,"Conf.Mat.Aceite");
        
        $this->load->model('MFinancas_Confirmacao_Comprovativo');
        $this->MFinancas_Confirmacao_Comprovativo->criarPdf($id,$total_pagar,$bancNome,$contNumero,$ffpNome,$fpcRefPagamento,$utilizadores_id);
    }
}
