<?php

class CCurriculum extends CI_Controller {
    public function imprimir(){
        $id = $this->input->post('id');
        
        $this->load->model('mFuncionarios');
        $this->load->model('mFormacao_Funcionarios');
        $this->load->model('mOutras_Formacoes');
        $response = '';
        if ($this->mFuncionarios->mreadDPXid($id)){
            foreach($this->mFuncionarios->mreadDPXid($id) as $row){
                //$Provincia_Emissao = $this->mFuncionarios->mReadProvinciaEmissao($row->id);
                $idade = $this->mFuncionarios->calculaEdad($row->fData_Nascimento);
                $aDP[] = array(
                    "id"=>$row->id,
                    "fNome"=>$row->fNome,
                    "fNomes"=>$row->fNomes,
                    "fApelido"=>$row->fApelido,
                    "fBI_Passaporte"=>$row->fBI_Passaporte,
                    "fBI_Data_Emissao"=>$row->fBI_Data_Emissao,
                    //"fBI_Provincia_Emissao"=>$Provincia_Emissao,
                    "fData_Nascimento"=>$row->fData_Nascimento,
                    "fidade"=>$idade,
                    "Nascimento_Provincias_id"=>$row->Nascimento_Provincias_id,
                    "provNome"=>$row->provNome,
                    "Nascimento_Municipios_id"=>$row->Nascimento_Municipios_id,
                    "munNome"=>$row->munNome,
                    "fTelefone"=>$row->fTelefone,
                    "fTelefone1"=>$row->fTelefone1,
                    "Habilitacoes_Literarias_Funcionarios_id"=>$row->Habilitacoes_Literarias_Funcionarios_id,
                    "hlfNome"=>$row->hlfNome,
                    "Generos_id"=>$row->Generos_id,
                    "gNome"=>$row->gNome,
                    "Estado_Civil_id"=>$row->Estado_Civil_id,
                    "ecNome"=>$row->ecNome,
                    "Nacionalidade_Pais_id"=>$row->Nacionalidade_Pais_id,
                    "paNome"=>$row->paNome,
                    "fEmail"=>$row->fEmail,
                ); 
            }
            //DADOS PROFISSIONAIS
            $aDPRO = array();
            foreach($this->mFuncionarios->mreadDPROXid($id) as $row){
                $aDPRO[] = array(
                    "fNumero_Agente"=>$row->fNumero_Agente,
                    "fNumero_NIF"=>$row->fNumero_NIF,
                    "fExperiencias_Profissionais"=>$row->fExperiencias_Profissionais,
                    "Grupos_Funcionarios_id"=>$row->Grupos_Funcionarios_id,
                    "gfNome"=>$row->gfNome,
                    "Categorias_Funcionarios_id"=>$row->Categorias_Funcionarios_id,
                    "cfNome"=>$row->cfNome,
                    "Vinculos_Laborais_id"=>$row->Vinculos_Laborais_id,
                    "vlNome"=>$row->vlNome,
                    "Departamentos_id"=>$row->Departamentos_id,
                    "depNome"=>$row->depNome,
                    "Sectores_id"=>$row->Sectores_id,
                    "secNome"=>$row->secNome,
                    "Cargos_id"=>$row->Cargos_id,
                    "carNome"=>$row->carNome
                ); 
            }
            //DATOS OUTROS
            $aDO = array();
            foreach($this->mFuncionarios->mreadDOXid($id) as $row){
            $aDO[] = array(
                    "baiNome"=>$row->baiNome,
                    "munNome"=>$row->munNome,
                    "provNome"=>$row->provNome,
                    "paNome"=>$row->paNome
                ); 
            }
            //formacao funcionarios
            $aFF = array();
            foreach($this->mFormacao_Funcionarios->mreadXid($id) as $row2){
                $aFF[] = array(
                    "fofuAno_Inicio"=>$row2->fofuAno_Inicio,
                    "fofuAno_Fin"=>$row2->fofuAno_Fin,
                    "fofuCurso"=>$row2->fofuCurso,
                    "univNome"=>$row2->univNome,
                    "paNome"=>$row2->paNome
                );
            }
            //Outras Formacoes
            $aOF = array();
            foreach($this->mOutras_Formacoes->mreadXid($id) as $row3){
                $aOF[] = array(
                    "ofCurso"=>$row3->ofCurso,
                    "ofData_Inicio"=>$row3->ofData_Inicio,
                    "ofData_Fim"=>$row3->ofData_Fim,
                    "ofInstituicao"=>$row3->ofInstituicao,
                    "ofTipo_Formacao"=>$row3->ofTipo_Formacao,
                    "paNome"=>$row3->paNome,
                );
            }
            //publicacoes
            $aPUB = array();
            $this->load->model('mPublicacoes');
            foreach($this->mPublicacoes->mreadXid($id) as $row){
                $aPUB[] = array(
                    "pubTitulo"=>$row->pubTitulo,
                    "pubAno"=>$row->pubAno,
                    "pubEditora_Revista"=>$row->pubEditora_Revista,
                    "pubISBN_ISSN"=>$row->pubISBN_ISSN,
                    "paNome"=>$row->paNome,
                    "tpubNome"=>$row->tpubNome
                ); 
            }
            //Eventos
            $aEV = array();
            $this->load->model('mEventos');
            foreach($this->mEventos->mreadXid($id) as $row){
                $aEV[] = array(
                    "evTitulo"=>$row->evTitulo,
                    "evInstituicao"=>$row->evInstituicao,
                    "evAno"=>$row->evAno,
                    "paNome"=>$row->paNome,
                    "teNome"=>$row->teNome
                ); 
            }
            //Linguas
            $aLin = array();
            $this->load->model('mLinguas_Funcionarios');
            foreach($this->mLinguas_Funcionarios->mreadXid($id) as $row){
                $aLin[] = array(
                    "linguas_id"=>$row->linguas_id,
                    "linNome"=>$row->linNome,
                    "linguas_nivel_id"=>$row->linguas_nivel_id,
                    "lnNome"=>$row->lnNome
                ); 
            }
            
            $this->load->model('mCurriculum');
            $this->mCurriculum->criarPdf($aDP,$aDPRO,$aDO,$aFF,$aOF, $aPUB, $aEV, $aLin);
        }else
            $response =  "{success:true, total: 0, data:''}";
        echo $response;
        
    }  
}