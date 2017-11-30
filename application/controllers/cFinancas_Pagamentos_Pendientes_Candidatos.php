<?php
class CFinancas_Pagamentos_Pendientes_Candidatos extends CI_Controller {
    
    public function existe_pag() {
        $request = $_POST;
        $cid = $request['cid'];
        $tpag = $request['tpag'];
        $this->load->model('MFinancas_Pagamentos_Pendientes_Candidatos');
        if($this->MFinancas_Pagamentos_Pendientes_Candidatos->mExiste_Pag($cid,$tpag))
            echo "true";
        else
            echo "false";
    }
    public function readXcb() {
        $request = $_GET;
        $cb = @$request['cb'];
        $this->load->model('MFinancas_Pagamentos_Pendientes_Candidatos');
        echo json_encode($this->MFinancas_Pagamentos_Pendientes_Candidatos->mreadXcb($cb));
    }
    public function read_ncpXid() {
        $request = $_GET;
        $id = @$request['id'];
        $this->load->model('MFinancas_Pagamentos_Pendientes_Candidatos');
        echo json_encode($this->MFinancas_Pagamentos_Pendientes_Candidatos->mread_ncpXid($id));
    }
    public function read_ncpXid2() {
        $request = $_GET;
        $id = @$request['id'];
        $this->load->model('MFinancas_Pagamentos_Pendientes_Candidatos');
        echo json_encode($this->MFinancas_Pagamentos_Pendientes_Candidatos->mread_ncpXid2($id));
    }
    public function read_ncpXid3() {
        $request = $_GET;
        $id = @$request['id'];
        $this->load->model('MFinancas_Pagamentos_Pendientes_Candidatos');
        echo json_encode($this->MFinancas_Pagamentos_Pendientes_Candidatos->mread_ncpXid3($id));
    }
    public function read_ncpXid_CM() {
        $request = $_GET;
        $id = @$request['id'];
        $this->load->model('MFinancas_Pagamentos_Pendientes_Candidatos');
        echo json_encode($this->MFinancas_Pagamentos_Pendientes_Candidatos->mread_ncpXid_CM($id));
    }
    public function read_ncpXid_M() {
        $request = $_GET;
        $id = @$request['id'];
        $this->load->model('MFinancas_Pagamentos_Pendientes_Candidatos');
        echo json_encode($this->MFinancas_Pagamentos_Pendientes_Candidatos->mread_ncpXid_M($id));
    }
    public function read_estado_pagamento() {
        $request = $_POST;
        $id = @$request['id'];
        $this->load->model('MFinancas_Pagamentos_Pendientes_Candidatos');
        echo $this->MFinancas_Pagamentos_Pendientes_Candidatos->mread_estado_pagamento($id);
    }
    //mread_estado_pagamento_estudantes
    public function read_estado_pagamento_estudantes() {
        $request = $_POST;
        $id = @$request['id'];
        $this->load->model('MFinancas_Pagamentos_Pendientes_Candidatos');
        echo $this->MFinancas_Pagamentos_Pendientes_Candidatos->mread_estado_pagamento_estudantes($id);
    }
    public function read_estado_pagamento_estudantes_matricula() {
        $request = $_POST;
        $id = @$request['id'];
        $this->load->model('MFinancas_Pagamentos_Pendientes_Candidatos');
        echo $this->MFinancas_Pagamentos_Pendientes_Candidatos->mread_estado_pagamento_estudantes_matricula($id);
    }
    //mExiste_Pag_Pendiente($Candidatos_id, $Financas_Tipo_Pagamento_id)
    public function Existe_Pag_Pendiente() {
        $request = $_POST;
        $Candidatos_id = $request['id'];
        $Financas_Tipo_Pagamento_id = $request['tipo_pag']; // 1 Insc e 2 Insc 2 sessao
        $this->load->model('MFinancas_Pagamentos_Pendientes_Candidatos');
        if($this->MFinancas_Pagamentos_Pendientes_Candidatos->mExiste_Pag_Pendiente($Candidatos_id, $Financas_Tipo_Pagamento_id))
            echo "true";
        else
            echo "false";
     }

    public function readXcb_valor_total_inscricao() {
        $request = $_POST;
        $cb = $request['cb'];
        $this->load->model('MFinancas_Pagamentos_Pendientes_Candidatos');
        echo $this->MFinancas_Pagamentos_Pendientes_Candidatos->mreadXcb_valor_total_inscricao($cb);
    }
    public function readXcb_valor_total_inscricao_2S() {
        $request = $_POST;
        $cb = $request['cb'];
        $this->load->model('MFinancas_Pagamentos_Pendientes_Candidatos');
        echo $this->MFinancas_Pagamentos_Pendientes_Candidatos->mreadXcb_valor_total_inscricao_2S($cb);
    }
    /*
    para pagamento de inscricao segunda sessao
    mreadXcb_valor_total_inscricao_2S1
    */
    public function readXcb_valor_total_inscricao_2S1() {
        $request = $_POST;
        $id = $request['id'];
        $this->load->model('MFinancas_Pagamentos_Pendientes_Candidatos');
        echo $this->MFinancas_Pagamentos_Pendientes_Candidatos->mreadXcb_valor_total_inscricao_2S1($id);
    }
    public function readXcb_valor_total_inscricao_2S_REIMP() {
        $request = $_POST;
        $id = $request['id'];
        $this->load->model('MFinancas_Pagamentos_Pendientes_Candidatos');
        echo $this->MFinancas_Pagamentos_Pendientes_Candidatos->mreadXcb_valor_total_inscricao_2S_REIMP($id);
    }
    //mreadXcb_valor_total_confirmacao($cb)
    public function readXcb_valor_total_confirmacao() {
        $request = $_POST;
        $cb = $request['cb'];
        $this->load->model('MFinancas_Pagamentos_Pendientes_Candidatos');
        echo $this->MFinancas_Pagamentos_Pendientes_Candidatos->mreadXcb_valor_total_confirmacao($cb);
    }
    
    public function readXcb_valor_total_matricula() {
        $request = $_POST;
        $cb = $request['cb'];
        $this->load->model('MFinancas_Pagamentos_Pendientes_Candidatos');
        echo $this->MFinancas_Pagamentos_Pendientes_Candidatos->mreadXcb_valor_total_matricula($cb);
    }
    /*
    public function crud(){
        $request = $_POST;
        // get id and data 
        $id = @$request['id'];
        //Dados Pessoais
        $cNome = @$request['cNome'];
        $cNomes = @$request['cNomes'];
        $cApelido = @$request['cApelido'];
        $gNome = @$request['gNome'];
        $ngNome = @$request['ngNome'];
        $cNome_Pai = @$request['cNome_Pai']; 
        $cNome_Mae = @$request['cNome_Mae'];
        $cBI_Passaporte = @$request['cBI_Passaporte'];
        $cBI_Data_Emissao = @$request['cBI_Data_Emissao'];
        $cBI_Lugar_Emissao_Provincia_id = @$request['provEmissao'];
        $ecNome = @$request['ecNome'];
        $cData_Nascimento = @$request['cData_Nascimento'];
        //Nascimento_Provincias_id
        $Nascimento_Provincias_id = @$request['provNascimento'];
        //$provNome = @$request['provNome'];
        $Nascimento_Municipios_id = @$request['munNascimento'];
        $Necessita_Educacao_Especial_id = @$request['neeNome'];
        //dados profissionais
        $trabNome = @$request['trabNome']; 
        $proNome = @$request['proNome'];
        $tilNome = @$request['tilNome'];
        $dlLocal_Trabalho = @$request['dlLocal_Trabalho'];
        $otNome = @$request['otNome'];
        $dlCargo = @$request['dlCargo'];
        //dados academicos
        $Formacao_Pais_id = @$request['paFormacao'];
        $Formacao_Provincias_id = @$request['provFormacao'];
        $hlfNome = @$request['hlfNome'];
        $Opcao = @$request['Opcao'];
        $Media = @$request['Media'];
        $Escola = @$request['Escola'];
        $Ano = @$request['Ano'];
        //dados localizacao
        $cTelefone = @$request['cTelefone']; 
        $cEmail = @$request['cEmail'];
        $Pais_id = @$request['paNome'];
        $Provincias_id = @$request['provNome'];
        $Municipios_id = @$request['munNome'];
        $Bairros_id = @$request['baiNome'];
        //outros dados
        $Ano_actual_id = @$request['ano'];

        //webix_operation
        $webix_operation = $request["webix_operation"];

        $this->load->model('MCandidatos');
        if ($webix_operation == "insert"){
            if($this->MCandidatos->minsert($cNome, $cNomes, $cApelido, $gNome, $ngNome, $cNome_Pai, $cNome_Mae, $cBI_Passaporte, $cBI_Data_Emissao, $cBI_Lugar_Emissao_Provincia_id,
                                            $ecNome, $cData_Nascimento, $Nascimento_Provincias_id, $Nascimento_Municipios_id, $Necessita_Educacao_Especial_id,
                                            //dados profissionais
                                            $trabNome, $proNome, $tilNome, $dlLocal_Trabalho, $otNome, $dlCargo,
                                            //dados academicos
                                            $Formacao_Pais_id, $Formacao_Provincias_id, $hlfNome, $Opcao, $Media, $Escola, $Ano,
                                            //dados localizacao
                                            $cTelefone, $cEmail, $Pais_id, $Provincias_id, $Municipios_id, $Bairros_id, $Ano_actual_id))
                echo "true";
            else
                echo "false";
        } else if ($webix_operation == "update"){
            $request = $_GET; 
            $tipo_update = @$request['tu'];
            if($tipo_update == "DP"){
                if($this->MCandidatos->mupdateDP($id,$cNome, $cNomes, $cApelido, $gNome, $ngNome, $cNome_Pai, $cNome_Mae, $cBI_Passaporte, $cBI_Data_Emissao, $cBI_Lugar_Emissao_Provincia_id,
                                            $ecNome, $cData_Nascimento, $Nascimento_Provincias_id, $Nascimento_Municipios_id, $Necessita_Educacao_Especial_id))
                    echo "true"; 
                else
                    echo "false";    
            }elseif($tipo_update == "DPRO"){
                if($this->MCandidatos->mupdateDPRO($id, $trabNome, $proNome, $tilNome, $dlLocal_Trabalho, $otNome, $dlCargo))
                    echo "true"; 
                else
                    echo "false";  
            }elseif($tipo_update == "DACA"){
                if($this->MCandidatos->mupdateDACA($id,$Formacao_Pais_id,$Formacao_Provincias_id,$hlfNome,$Opcao,$Media,$Escola, $Ano))
                    echo "true"; 
                else
                    echo "false";  
            }elseif($tipo_update == "DLOC"){
                if($this->MCandidatos->mupdateDLOC($id,$cTelefone, $cEmail, $Pais_id, $Provincias_id, $Municipios_id, $Bairros_id))
                    echo "true"; 
                else
                    echo "false";  
            }
        } else if ($webix_operation == "delete"){
            if($this->MCandidatos->mdelete($id))
                echo "true"; 
            else
               echo "false";
        } else 
            echo "false";
    }

    //salvar la foto que se tira en funcionarios
    public function salvarFoto(){
        //id del funcionario selecionado
        $id = $this->input->get('id');
        $foto_codigo = md5(time()).rand(383,1000);
        //upload photo
        $estado = false;
        if(move_uploaded_file($_FILES['webcam']['tmp_name'], 'Fotos/Candidatos/'.$foto_codigo.'.jpg')){
            $estado = true;
        }
        //salvar codigo en la BD
        $this->load->model('mCandidatos');
        if($estado == true && $this->mCandidatos->msalvarFoto($id,$foto_codigo))
        {
            echo "true";
        }
    }
    //cargar el codigo de la foto guardada para mostrar foto
    public function cargarFoto() {
        $id = $this->input->post('id');
        $this->load->model('mCandidatos');
        echo $this->mCandidatos->mcargarFoto($id);
    }
    public function cargarFotoCB() {
        $id = $this->input->post('id');
        $this->load->model('mCandidatos');
        echo $this->mCandidatos->mcargarFotoCB($id);
    }
    */
    /*
        apagar pagamentos pendientes
    */
    public function delete(){
        $id = $this->input->post('bi');
        $this->load->model('MFinancas_Pagamentos_Pendientes_Candidatos');
        if($this->MFinancas_Pagamentos_Pendientes_Candidatos->mdelete($id))
                echo "true";
            else
               echo "false";
    }
}