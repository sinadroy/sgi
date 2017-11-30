<?php
class CEm_Formacao_Funcionarios_IMP extends CI_Controller {
    
   public function imprimir(){
       $response = "";
        $this->load->model('mEm_Formacao_Funcionarios');
        if($this->mEm_Formacao_Funcionarios->mread()){
            foreach($this->mEm_Formacao_Funcionarios->mread() as $row){
                $al[] = array(
                    "id"=>$row->id,
                    "Funcionarios_id"=>$row->Funcionarios_id,
                    "fNome"=>$row->fNome,
                    "fNomes"=>$row->fNomes,
                    "fApelido"=>$row->fApelido,
                    "fBI_Passaporte"=>$row->fBI_Passaporte,

                    "ffCurso"=>$row->ffCurso,
                    "ffOpcao"=>$row->ffOpcao,
                    "ffWeb_Site_Univ"=>$row->ffWeb_Site_Univ,
                    "ffEmail_Secretaria"=>$row->ffEmail_Secretaria,
                    "ffAno_Inicio"=>$row->ffAno_Inicio,
                    "ffAno_Fin"=>$row->ffAno_Fin,

                    "bolNome"=>$row->bolNome,
                    "ffTema_Tese"=>$row->ffTema_Tese,

                    "Graus_Pretendidos_id"=>$row->Graus_Pretendidos_id,
                    "gpNome"=>$row->gpNome,

                    "Universidades_id"=>$row->Universidades_id,
                    "univNome"=>$row->univNome,

                    "Orgao_Provendor_Bolsas_id"=>$row->Orgao_Provendor_Bolsas_id,
                    "opbNome"=>$row->opbNome,

                    "Modalidades_Formacao_id"=>$row->Modalidades_Formacao_id,
                    "mfNome"=>$row->mfNome,

                    "Pais_id"=>$row->Pais_id,
                    "paNome"=>$row->paNome,

                    //"Provincias_id"=>$row->Provincias_id,
                    "ffCidade"=>$row->ffCidade,
                ); 
            }
            $this->load->model('mEm_Formacao_Funcionarios_IMP');
            $this->mEm_Formacao_Funcionarios_IMP->criarPdf($al);
        }else
            $response =  "{success:true, total: 0, data:''}";
        echo $response;
    }
     
}