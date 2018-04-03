<?php

class Csecretaria_declaracao_com_notas extends CI_Controller {
    public function imprimir(){
        $id = $this->input->post('id');
        $eid = $this->input->post('eid');
        $cnome = $this->input->post('cnome');
        $cnomes = $this->input->post('cnomes');
        $capelido = $this->input->post('capelido');
        $cbi_passaporte = $this->input->post('cbi_passaporte');
        $cBI_Data_Emissao = $this->input->post('cBI_Data_Emissao');
        $cBI_Lugar_Emissao_Provincia_id = $this->input->post('cBI_Lugar_Emissao_Provincia_id');
        $acnome = $this->input->post('acnome');
        $nnome = $this->input->post('nnome');
        $curso = $this->input->post('curso');
        $pnome = $this->input->post('pnome');
        $mnome = $this->input->post('mnome');
        $tipo_documentos_id = $this->input->post('tipo_documentos_id');

        $this->load->model('Msecretaria_declaracao_com_notas');
        $this->Msecretaria_declaracao_com_notas->criarPdf($id,$eid,$cnome,$cnomes,$capelido,$cbi_passaporte,$cBI_Data_Emissao,
            $cBI_Lugar_Emissao_Provincia_id, $acnome, $nnome, $curso, $pnome, $mnome, $tipo_documentos_id);
    }  
}