<?php

class CDisciplinas_IMP extends CI_Controller {

    public function imprimir() {
        $response = "";
        $nNome = $this->input->post('nNome');
        $cNome = $this->input->post('cNome');
        $pNome = $this->input->post('pNome');
        $acNome = $this->input->post('acNome');
        $this->load->model('mProfessores_Disciplinas');
        if ($this->mProfessores_Disciplinas->mreadXncpac($nNome,$cNome,$pNome,$acNome)) {
            foreach ($this->mProfessores_Disciplinas->mreadXncpac($nNome,$cNome,$pNome,$acNome) as $row) {
                $ProfessorPP = $this->mProfessores_Disciplinas->mreadX($row->ProfessorP_id);
                $ProfessorA1 = $this->mProfessores_Disciplinas->mreadX($row->ProfessorA1_id);
                $ProfessorA2 = $this->mProfessores_Disciplinas->mreadX($row->ProfessorA2_id);
                $al[] = array(
                    "id" => $row->id,
                    //"alAno"=>$row->alAno,
                    "nNome" => $row->nNome,
                    "cNome" => $row->cNome,
                    "pNome" => $row->pNome,
                    "tNome" => $row->tNome,
                    "dNome" => $row->dNome,
                    "dCodigo" => $row->dCodigo,
                    "ProfessorP_id" => $row->ProfessorP_id,
                    "ProfessorP" => ($ProfessorPP) ? $ProfessorPP : "-",
                    "ProfessorA1_id" => $row->ProfessorA1_id,
                    "ProfessorA1" => ($ProfessorA1) ? $ProfessorA1 : "-",
                    "ProfessorA2_id" => $row->ProfessorA2_id,
                    "ProfessorA2" => ($ProfessorA2) ? $ProfessorA2 : "-",
                );
            }

            $this->load->model('mProfessores_Disciplinas_IMP');
            $this->mProfessores_Disciplinas_IMP->criarPdf($al,$acNome);
        } else
            $response = "{success:true, total: 0, data:''}";
        echo $response;
    }

}
