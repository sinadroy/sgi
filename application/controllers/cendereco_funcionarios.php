<?php
class Cendereco_funcionarios extends CI_Controller {
    
    public function read_pais() {
        $id = $this->input->post('id');
        $this->load->model('MEnderecos_Funcionarios');
        echo $this->MEnderecos_Funcionarios->mread_pais($id);
    }

    public function read_provincia() {
        $id = $this->input->post('id');
        $this->load->model('MEnderecos_Funcionarios');
        echo $this->MEnderecos_Funcionarios->mread_provincia($id);
    }

    public function read_municipio() {
        $id = $this->input->post('id');
        $this->load->model('MEnderecos_Funcionarios');
        echo $this->MEnderecos_Funcionarios->mread_municipio($id);
    }

    public function read_bairro() {
        $id = $this->input->post('id');
        $this->load->model('MEnderecos_Funcionarios');
        echo $this->MEnderecos_Funcionarios->mread_bairro($id);
    }

    public function read_telefone1() {
        $id = $this->input->post('id');
        $this->load->model('MEnderecos_Funcionarios');
        echo $this->MEnderecos_Funcionarios->mread_telefone1($id);
    }
    public function read_telefone2() {
        $id = $this->input->post('id');
        $this->load->model('MEnderecos_Funcionarios');
        echo $this->MEnderecos_Funcionarios->mread_telefone2($id);
    }
    public function read_mail() {
        $id = $this->input->post('id');
        $this->load->model('MEnderecos_Funcionarios');
        echo $this->MEnderecos_Funcionarios->mread_mail($id);
    }

    public function update_contacto() {
        $Funcionarios_id = $this->input->post('Funcionarios_id');
        $fTelefone = $this->input->post('fTelefone');
        $fTelefone1 = $this->input->post('fTelefone1');
        $fEmail = $this->input->post('fEmail');

        $this->load->model('MEnderecos_Funcionarios');
        if($this->MEnderecos_Funcionarios->mupdate_contacto($fTelefone,$fTelefone1,$fEmail,$Funcionarios_id))
            echo "true";
        else
            echo "false";
    }
    
    public function update() {
        $Funcionarios_id = $this->input->post('Funcionarios_id');
        $Pais_id = $this->input->post('EnderecoPais');
        $Provincias_id = $this->input->post('EnderecoProvincia');
        $Municipios_id = $this->input->post('EnderecoMunicipio');
        $Bairros_id = $this->input->post('EnderecoBairro');

        $fTelefone = $this->input->post('fTelefone');
        $fTelefone1 = $this->input->post('fTelefone1');
        $fEmail = $this->input->post('fEmail');

        $this->load->model('MEnderecos_Funcionarios');
        if($this->MEnderecos_Funcionarios->mupdate($Pais_id,$Provincias_id,$Municipios_id,$Bairros_id,$Funcionarios_id))
            echo "true";
        else
            echo "false";
    }
    
}