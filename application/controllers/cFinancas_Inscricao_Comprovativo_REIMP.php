<?php

class CFinancas_Inscricao_Comprovativo_REIMP extends CI_Controller {
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
        $utilizadores_id = $request['utilizadores_id'];

        //determinar id del candidato
        //$cid = $this->getCandidatos_id($id);

        //cambiar estado do candidato
        //$this->load->model('MCandidatos');
        //$this->MCandidatos->cambiar_estado($id,"Inscrição aceite");
        
        $this->load->model('MFinancas_Inscricao_Comprovativo_REIMP');
        $this->MFinancas_Inscricao_Comprovativo_REIMP->criarPdf($id,$utilizadores_id);
    }
}
