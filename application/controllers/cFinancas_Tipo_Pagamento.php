<?php
class CFinancas_Tipo_Pagamento extends CI_Controller {
    
    public function read(){
        $this->load->model('MFinancas_Tipo_Pagamento');
        echo json_encode($this->MFinancas_Tipo_Pagamento->mread());
    }
     /*
        carregar id a partir do tipo
    */
    public function readXtipo(){
        $request = $_POST;
        $tipo = @$request['tipo'];
        $this->load->model('MFinancas_Tipo_Pagamento');
        echo json_encode($this->MFinancas_Tipo_Pagamento->mreadXtipo($tipo));
    }
   
/*
    public function crud(){
        $request = $_POST;
        // get id and data 
        $id = @$request['id'];
        //Dados Pessoais
        $cNome = @$request['cNome'];

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
*/
}