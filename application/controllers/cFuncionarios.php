<?php
class CFuncionarios extends CI_Controller {
    
    public function getnome() {
        $id = $this->input->post('id');
        $this->load->model('mfuncionarios');
        echo $this->mfuncionarios->mGetNome($id);
        
    }
    public function getnomes() {
        $id = $this->input->post('id');
        $this->load->model('mfuncionarios');
        echo $this->mfuncionarios->mGetNomes($id);
        
    }
    public function getapelido() {
        $id = $this->input->post('id');
        $this->load->model('mfuncionarios');
        echo $this->mfuncionarios->mGetApelido($id);
        
    }

    public function getbi() {
        $id = $this->input->post('id');
        $this->load->model('mfuncionarios');
        echo $this->mfuncionarios->mGetBI($id);
        
    }
    public function getbi_data_emissao() {
        $id = $this->input->post('id');
        $this->load->model('mfuncionarios');
        echo $this->mfuncionarios->mGetBI_Data_Emissao($id);
    }
    public function getbi_provincia_emissao() {
        $id = $this->input->post('id');
        $this->load->model('mfuncionarios');
        echo $this->mfuncionarios->mgetbi_provincia_emissao($id);
        
    }
    public function get_data_nacimiento() {
        $id = $this->input->post('id');
        $this->load->model('mfuncionarios');
        echo $this->mfuncionarios->mget_data_nacimiento($id);
    }
    public function get_genero() {
        $id = $this->input->post('id');
        $this->load->model('mfuncionarios');
        echo $this->mfuncionarios->mget_genero($id);
    }
    public function get_estado_civil() {
        $id = $this->input->post('id');
        $this->load->model('mfuncionarios');
        echo $this->mfuncionarios->mget_estado_civil($id);
    }
    public function get_nacionalidade() {
        $id = $this->input->post('id');
        $this->load->model('mfuncionarios');
        echo $this->mfuncionarios->mget_nacionalidade($id);
    }
    public function get_nascimento_provincia() {
        $id = $this->input->post('id');
        $this->load->model('mfuncionarios');
        echo $this->mfuncionarios->mget_nascimento_provincia($id);
    }
    public function get_nascimento_municipio() {
        $id = $this->input->post('id');
        $this->load->model('mfuncionarios');
        echo $this->mfuncionarios->mget_nascimento_municipio($id);
    }
    public function get_habilitacao_literaria() {
        $id = $this->input->post('id');
        $this->load->model('mfuncionarios');
        echo $this->mfuncionarios->mget_habilitacao_literaria($id);
    }
    public function get_experiencias_profissionais() {
        $id = $this->input->post('id');
        $this->load->model('mfuncionarios');
        echo $this->mfuncionarios->mget_experiencias_profissionais($id);
    }


    public function getIDFunc() {
        $nome = $this->input->get('nome');
        $this->load->model('mfuncionarios');
        echo $this->mfuncionarios->mGetID($nome);
        
    }
    public function readDP(){
        $this->load->model('mFuncionarios');
        foreach($this->mFuncionarios->mreadDP() as $row){
            $Provincia_Emissao = $this->mFuncionarios->mReadProvinciaEmissao($row->id);
            $al[] = array(
                "id"=>$row->id,
                "festado"=>$row->festado,
                "fNome"=>$row->fNome,
                "fNomes"=>$row->fNomes,
                "fApelido"=>$row->fApelido,
                "fBI_Passaporte"=>$row->fBI_Passaporte,
                "fBI_Data_Emissao"=>$row->fBI_Data_Emissao,
                "fBI_Provincia_Emissao"=>$Provincia_Emissao,
                "fData_Nascimento"=>$row->fData_Nascimento,
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
        $data = json_encode($al);
        $response = $data;
        echo $response;
    }
    public function readDPRO(){
        $this->load->model('mFuncionarios');
        foreach($this->mFuncionarios->mreadDPRO() as $row){
            //$Endereco_Pais = $this->mFuncionarios->mReadPaisEndereco($row->Endereco_Bairros_id);
            //$Endereco_Municipio = $this->mFuncionarios->mReadMunicipioEndereco($row->Endereco_Bairros_id);
            //$Endereco_Provincia = $this->mFuncionarios->mReadProvinciaEndereco($row->Endereco_Bairros_id);
            $Provincia_Emissao = $this->mFuncionarios->mReadProvinciaEmissao($row->id);
            $al[] = array(
                "id"=>$row->id,
                "fNome"=>$row->fNome,
                "fNomes"=>$row->fNomes,
                "fApelido"=>$row->fApelido,
                "fBI_Passaporte"=>$row->fBI_Passaporte,
                //"fBI_Data_Emissao"=>$row->fBI_Data_Emissao,
                //"fBI_Provincia_Emissao"=>$Provincia_Emissao,
                //"fData_Nascimento"=>$row->fData_Nascimento,
                //"Nascimento_Provincias_id"=>$row->Nascimento_Provincias_id,
                //"provNome"=>$row->provNome,
                //"Nascimento_Municipios_id"=>$row->Nascimento_Municipios_id,
                //"munNome"=>$row->munNome,
                "fNumero_Agente"=>$row->fNumero_Agente,
                "fNumero_NIF"=>$row->fNumero_NIF,
                //"fTelefone"=>$row->fTelefone,
                //"fTelefone1"=>$row->fTelefone1,
                "fExperiencias_Profissionais"=>$row->fExperiencias_Profissionais,
                //"Habilitacoes_Literarias_Funcionarios_id"=>$row->Habilitacoes_Literarias_Funcionarios_id,
                //"hlfNome"=>$row->hlfNome,
                //"Generos_id"=>$row->Generos_id,
                //"gNome"=>$row->gNome,
                //"Estado_Civil_id"=>$row->Estado_Civil_id,
                //"ecNome"=>$row->ecNome,
                //"Nacionalidade_Pais_id"=>$row->Nacionalidade_Pais_id,
                //"paNome"=>$row->paNome,
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
                //"Endereco_Pais_Nome"=>$Endereco_Pais,
                //"Endereco_Provincia_Nome"=>$Endereco_Provincia,
                //"Endereco_Municipio_Nome"=>$Endereco_Municipio,
                //"Endereco_Bairros_id"=>$row->Endereco_Bairros_id,
                //"baiNome"=>$row->baiNome,
                "Cargos_id"=>$row->Cargos_id,
                "carNome"=>$row->carNome,
                "funcNome"=>$row->funcNome,
                "fData_Funcao"=>$row->fData_Funcao,
                "fData_Admissao"=>$row->fData_Admissao,
                "fSalario_Basico"=>$row->fSalario_Basico
            );
        }
        $data = json_encode($al);
        $response = $data;
        echo $response;
    }
    public function readDO(){
        $this->load->model('mFuncionarios');
        foreach($this->mFuncionarios->mreadDO() as $row){
            //$Endereco_Pais = $this->mFuncionarios->mReadEnderecoPais($row->id);
            //$Endereco_Provincia = $this->mFuncionarios->mReadEnderecoProvincia($row->id);
            //$Endereco_Municipio = $this->mFuncionarios->mReadEnderecoMunicipio($row->id);
            //$Endereco_Bairro = $this->mFuncionarios->mReadEnderecoBairro($row->id);
            $al[] = array(
                "id"=>$row->id,
                "fNome"=>$row->fNome,
                "fNomes"=>$row->fNomes,
                "fApelido"=>$row->fApelido,
                "fBI_Passaporte"=>$row->fBI_Passaporte,
                //"Endereco_Bairros_id"=>$row->Endereco_Bairros_id,
                "baiNome"=>$row->baiNome,
                "munNome"=>$row->munNome,
                "provNome"=>$row->provNome,
                "paNome"=>$row->paNome
            );
        }
        $data = json_encode($al);
        $response = $data;
        echo $response;
    }
    
    public function readBI(){
        $this->load->model('mFuncionarios');
        foreach($this->mFuncionarios->mreadDP() as $row){
            $al[] = array(
                "id"=>$row->id,
                "fNome"=>$row->fNome,
                "fNomes"=>$row->fNomes,
                "fApelido"=>$row->fApelido,
                "value"=>$row->fBI_Passaporte,
                "fBI_Passaporte"=>$row->fBI_Passaporte
            );
        }
        $data = json_encode($al);
        $response = $data;
        echo $response;
    }
    public function readXbi() {
        $bi = $this->input->post('bi');
        $this->load->model('mfuncionarios');
        echo $this->mfuncionarios->mreadXbi($bi);
    }
    public function GetID() {
        $Nome = $this->input->post('gNome');
        $this->load->model('mGeneros');
        echo $this->mGeneros->mGetID($Nome);
    }
    public function GetID2($bi) {
        //$bi = $this->input->get('bi');
        $this->load->model('mFuncionarios');
        return $this->mFuncionarios->mGetID2($bi);
    }
    public function readIDXBI() {
        $bi = $this->input->post('bi');
        $this->load->model('mFuncionarios');
        echo $this->mFuncionarios->mreadIDXBI($bi);
    }
    public function readNomeXID() {
        $id = $this->input->post('id');
        $this->load->model('mFuncionarios');
        echo $this->mFuncionarios->mreadNomeXID($id);
    }
    public function readNomesXID() {
        $id = $this->input->post('id');
        $this->load->model('mFuncionarios');
        echo $this->mFuncionarios->mreadNomesXID($id);
    }
    public function readApelidoXID() {
        $id = $this->input->post('id');
        $this->load->model('mFuncionarios');
        echo $this->mFuncionarios->mreadApelidoXID($id);
    }
    public function readNomeXBI() {
        $id = $this->input->post('id');
        $this->load->model('mFuncionarios');
        echo $this->mFuncionarios->mreadNomeXBI($id);
    }
    public function readApelidoXBI() {
        $id = $this->input->post('id');
        $this->load->model('mFuncionarios');
        echo $this->mFuncionarios->mreadApelidoXBI($id);
    }
    public function read_professores(){
        $this->load->model('mFuncionarios');
        foreach($this->mFuncionarios->mread_professores() as $row){
            $al[] = array(
                "id"=>$row->id,
                "fNome"=>$row->fNome,
                "fNomes"=>$row->fNomes,
                "fApelido"=>$row->fApelido,
                "fBI_Passaporte"=>$row->fBI_Passaporte,
                "value"=>$row->fNome.' '.$row->fApelido,
                "p_nome_completo"=>$row->fNome.' '.$row->fApelido,
                "Grupos_Funcionarios_id"=>$row->Grupos_Funcionarios_id,
                "gfNome"=>$row->gfNome
            );
        }
        $data = json_encode($al);
        $response = $data;
        echo $response;
    }
    /*
    public function GetIDXCodigo() {
        $cCodigo = $this->input->post('cCodigo');
        $this->load->model('mcursos');
        echo $this->mcursos->mGetIDXCodigo($cCodigo);
    }
    */
    public function updateDO(){                       
        $id = $this->input->post('id');
        $fNome= $this->input->post('fNome');
        $fNomes = $this->input->post('fNomes');
        $fApelido = $this->input->post('fApelido');
        $fBI_Passaporte = $this->input->post('fBI_Passaporte');
        $paNome = $this->input->post('paNome');
        $provNome = $this->input->post('provNome');
        $munNome = $this->input->post('munNome');
        $baiNome = $this->input->post('baiNome');
        $fTelefone = $this->input->post('fTelefone');
        $fTelefone1 = $this->input->post('fTelefone1');
        $fEmail = $this->input->post('fEmail');
        
        $this->load->model('mFuncionarios');
        if($this->mFuncionarios->mupdateDO($id,$fNome,$fNomes,$fApelido,$fBI_Passaporte,$fTelefone,$fTelefone1,$fEmail))
        {
            $this->load->model('mEnderecos_Funcionarios');
            if($this->mEnderecos_Funcionarios->mupdate($paNome,$provNome,$munNome,$baiNome,$id)){
                echo "true";
            }else
                echo "false";
        }
        else
            echo "false";
    }
    public function updateDPRO(){                       
        $id = $this->input->post('id');
        $fNome= $this->input->post('fNome');
        $fNomes = $this->input->post('fNomes');
        $fApelido = $this->input->post('fApelido');
        $fBI_Passaporte = $this->input->post('fBI_Passaporte');
        $gfNome = $this->input->post('gfNome');
        $cfNome= $this->input->post('cfNome');
        $depNome = $this->input->post('depNome');
        $secNome = $this->input->post('secNome');
        $carNome = $this->input->post('carNome');

        $funcNome = $this->input->post('funcNome');
        $fData_Funcao = $this->input->post('fData_Funcao');
        $fData_Admissao = $this->input->post('fData_Admissao');
        $fSalario_Basico = $this->input->post('fSalario_Basico');
       
        $vlNome = $this->input->post('vlNome');
        $fNumero_Agente = $this->input->post('fNumero_Agente');
        $fNumero_NIF = $this->input->post('fNumero_NIF');
        $fExperiencias_Profissionais = $this->input->post('fExperiencias_Profissionais');
        $this->load->model('mFuncionarios');
        if($this->mFuncionarios->mupdateDPRO($id,$fNome,$fNomes,$fApelido,$fBI_Passaporte,$gfNome,$cfNome,$depNome,$secNome,$carNome,
            $vlNome,$fNumero_Agente,$fNumero_NIF,$fExperiencias_Profissionais,$funcNome,$fData_Funcao,$fData_Admissao, $fSalario_Basico))
        {
            echo "true";
        }
        else
            echo "false";
    }
    public function updateDP(){                       
        $id = $this->input->post('id');
        $festado = $this->input->post('festado');
        $fNome= $this->input->post('fNome');
        $fNomes = $this->input->post('fNomes');
        $fApelido = $this->input->post('fApelido');
        $gNome = $this->input->post('gNome');
        $ecNome= $this->input->post('ecNome');
        $paNome = $this->input->post('paNome');
        $fBI_Passaporte = $this->input->post('fBI_Passaporte');
        $fBI_Data_Emissao = $this->input->post('fBI_Data_Emissao');
        $fBI_Data_Emissao = ($fBI_Data_Emissao == '0000-00-00')?'2016-01-01':$fBI_Data_Emissao;
        $BI_Lugar_Emissao_Provincias = $this->input->post('BI_Lugar_Emissao_Provincias');
        $fData_Nascimento = $this->input->post('fData_Nascimento');
        $fData_Nascimento = ($fData_Nascimento == '0000-00-00')?'2016-01-01':$fData_Nascimento;
        $Nascimento_Provincias_id = $this->input->post('Nascimento_Provincias_id');
        $Nascimento_Municipios_id = $this->input->post('Nascimento_Municipios_id');
        $hlfNome = $this->input->post('hlfNome');
        
        $this->load->model('mFuncionarios');
        if($this->mFuncionarios->mupdateDP($id,$festado,$fNome,$fNomes,$fApelido,$gNome,$ecNome,$paNome,$fBI_Passaporte,$fBI_Data_Emissao,
                $fData_Nascimento,$Nascimento_Provincias_id,$Nascimento_Municipios_id,$hlfNome/*,$fTelefone,$fTelefone1,$fEmail*/))
        {
            $this->load->model('mBI_Lugar_Emissao_Provincias');
            if($this->mBI_Lugar_Emissao_Provincias->mupdate($BI_Lugar_Emissao_Provincias,$id)){
                echo "true";
            }else
                echo "false";
        }
        else
            echo "false";
    }
     
    public function insertDP(){
        $festado = $this->input->post('festado');
        $fNome= $this->input->post('fNome');
        $fNomes = $this->input->post('fNomes');
        $fApelido = $this->input->post('fApelido');
        $gNome = $this->input->post('gNome');
        $ecNome= $this->input->post('ecNome');
        $paNome = $this->input->post('paNome');
        $fBI_Passaporte = $this->input->post('fBI_Passaporte');
        $fBI_Data_Emissao = $this->input->post('fBI_Data_Emissao');
        $BI_Lugar_Emissao_Provincias = $this->input->post('BI_Lugar_Emissao_Provincias');
        $fData_Nascimento = $this->input->post('fData_Nascimento');
        $Nascimento_Provincias_id = $this->input->post('Nascimento_Provincias_id');
        $Nascimento_Municipios_id = $this->input->post('Nascimento_Municipios_id');
        $fTelefone= $this->input->post('fTelefone');
        $fTelefone1 = $this->input->post('fTelefone1');
        $fEmail = $this->input->post('fEmail');
        
        $Grupos_Funcionarios_id = $this->input->post('Grupos_Funcionarios_id');
        $Categorias_Funcionarios_id = $this->input->post('Categorias_Funcionarios_id');
        $Cargos_id = $this->input->post('Cargos_id');
        $Vinculos_Laborais_id = $this->input->post('Vinculos_Laborais_id');
        $fNumero_Agente= $this->input->post('fNumero_Agente');
        $fNumero_NIF = $this->input->post('fNumero_NIF');
        $Habilitacoes_Literarias_Funcionarios_id = $this->input->post('Habilitacoes_Literarias_Funcionarios_id');
        $Departamentos_id = $this->input->post('Departamentos_id');
        $Sectores_id = $this->input->post('Sectores_id');
        $fExperiencias_Profissionais = $this->input->post('fExperiencias_Profissionais');

        $funcNome = $this->input->post('funcNome');
        $fData_Funcao = $this->input->post('fData_Funcao');
        $fData_Admissao = $this->input->post('fData_Admissao');
        $fSalario_Basico = $this->input->post('fSalario_Basico');
        
        $EnderecoPais = $this->input->post('EnderecoPais');
        $EnderecoProvincia = $this->input->post('EnderecoProvincia');
        $EnderecoMunicipio = $this->input->post('EnderecoMunicipio');
        $EnderecoBairro = $this->input->post('EnderecoBairro');
        
        $this->load->model('mFuncionarios');
        $this->load->model('mBI_Lugar_Emissao_Provincias');
        $this->load->model('mEnderecos_Funcionarios');
        if($this->mFuncionarios->minsertDP($festado,$fNome,$fNomes,$fApelido,$gNome,$ecNome,$paNome,$fBI_Passaporte,$fBI_Data_Emissao,
                $fData_Nascimento,$Nascimento_Provincias_id,$Nascimento_Municipios_id,$fTelefone,$fTelefone1,$fEmail,
                $Grupos_Funcionarios_id,$Categorias_Funcionarios_id,$Cargos_id,$Vinculos_Laborais_id,$fNumero_Agente,$fNumero_NIF,$Habilitacoes_Literarias_Funcionarios_id,$Departamentos_id,$Sectores_id,$fExperiencias_Profissionais,
                $EnderecoPais,$EnderecoProvincia,$EnderecoMunicipio,$EnderecoBairro,
                $funcNome,$fData_Funcao,$fData_Admissao,$fSalario_Basico))
        {
           $idF = $this->GetID2($fBI_Passaporte);
           if($this->mBI_Lugar_Emissao_Provincias->minsert($BI_Lugar_Emissao_Provincias,$idF) && $this->mEnderecos_Funcionarios->minsert($EnderecoPais,$EnderecoProvincia,$EnderecoMunicipio,$EnderecoBairro,$idF))
           {
               echo "true";
           }
        }
        else{
           echo "false";
        }
    }
    public function delete(){
        $id = $this->input->post('id');
        if($id !== "")
        {
            $this->load->model('mFuncionarios');
            if($this->mFuncionarios->mdelete($id))
            {
                $this->load->model('mBI_Lugar_Emissao_Provincias');
                $this->load->model('mEnderecos_Funcionarios');
                if($this->mBI_Lugar_Emissao_Provincias->mdelete($id) && $this->mEnderecos_Funcionarios->mdelete($id)){
                   echo "true"; 
                }
            }
            else
               echo "false";           
        }
    }
    //salvar la foto que se tira en funcionarios
    public function salvarFoto(){
        //id del funcionario selecionado
        $id = $this->input->get('id');
        $foto_codigo = md5(time()).rand(383,1000);
        //upload photo
        $estado = false;
        if(move_uploaded_file($_FILES['webcam']['tmp_name'], 'Fotos/Funcionarios/'.$foto_codigo.'.jpg')){
            $estado = true;
        }
        //salvar codigo en la BD
        $this->load->model('mFuncionarios');
        if($estado == true && $this->mFuncionarios->msalvarFoto($id,$foto_codigo))
        {
            echo "true";
        }
    }
    //cargar el codigo de la foto guardada para mostrar foto
    public function cargarFoto() {
        $id = $this->input->post('id');
        $this->load->model('mfuncionarios');
        echo $this->mfuncionarios->mcargarFoto($id);
    }
    public function cargarFotoCB() {
        $id = $this->input->post('id');
        $this->load->model('mfuncionarios');
        echo $this->mfuncionarios->mcargarFotoCB($id);
    }

    //curriculum
    public function update_curriculum_dp(){                       
        $id = $this->input->post('id');
        $fBI_Data_Emissao = $this->input->post('fBI_Data_Emissao');
        $fBI_Provincia_Emissao = $this->input->post('fBI_Provincia_Emissao');
        $fData_Nascimento = $this->input->post('fData_Nascimento');
        $Generos_id = $this->input->post('Generos_id');
        $Estado_Civil_id= $this->input->post('Estado_Civil_id');
        $Nacionalidade_Pais_id = $this->input->post('Nacionalidade_Pais_id');
        $Nascimento_Provincias_id = $this->input->post('Nascimento_Provincias_id');
        $Nascimento_Municipios_id = $this->input->post('Nascimento_Municipios_id');
        $Habilitacoes_Literarias_Funcionarios_id = $this->input->post('Habilitacoes_Literarias_Funcionarios_id');
        $fExperiencias_Profissionais = $this->input->post('fExperiencias_Profissionais');
        //$EnderecoBairro = $this->input->post('EnderecoBairro');

        $this->load->model('mFuncionarios');
        if($this->mFuncionarios->mupdate_curriculum_dp($id,$fBI_Data_Emissao,$fBI_Provincia_Emissao,$fData_Nascimento,$Generos_id,$Estado_Civil_id,
        $Nacionalidade_Pais_id,$Nascimento_Provincias_id,$Nascimento_Municipios_id,$Habilitacoes_Literarias_Funcionarios_id,
        $fExperiencias_Profissionais))
        {
            echo "true";
        }else
            echo "false";
    }
     
}