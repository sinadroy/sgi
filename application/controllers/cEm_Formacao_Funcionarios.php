<?php
class CEm_Formacao_Funcionarios extends CI_Controller {
    
    public function read(){
        $this->load->model('mEm_Formacao_Funcionarios');
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
                //"value"=>$row->ffBolsa,
                
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
        $data = json_encode($al);
        $response = $data;
        echo $response;
    }
    public function update(){                       
        $id = $this->input->get('id');
        $Funcionarios_id= $this->input->get('Funcionarios_id');
        //$fNome= $this->input->post('fNome');
        //$fNomes = $this->input->post('fNomes');
        //$fApelido = $this->input->post('fApelido');
        //$fBI_Passaporte = $this->input->post('fBI_Passaporte');
        $Universidades_id = $this->input->get('Universidades_id');
        $ffCurso = $this->input->get('ffCurso');
        $ffOpcao = $this->input->get('ffOpcao');
        $ffWeb_Site_Univ = $this->input->get('ffWeb_Site_Univ');
        $ffEmail_Secretaria = $this->input->get('ffEmail_Secretaria');
        $ffAno_Inicio = $this->input->get('ffAno_Inicio');
        $ffAno_Fin = $this->input->get('ffAno_Fin');
        $bolNome = $this->input->get('bolNome');
        $ffTema_Tese = $this->input->get('ffTema_Tese');
        $gpNome = $this->input->get('gpNome');
        $opbNome = $this->input->get('opbNome');
        $mfNome = $this->input->get('mfNome');
        $paNome = $this->input->get('paNome');
        $ffCidade = $this->input->get('ffCidade');
        
        $this->load->model('mEm_Formacao_Funcionarios');
        if($this->mEm_Formacao_Funcionarios->mupdateEF($id,$Funcionarios_id,$Universidades_id,$ffCurso,
                $ffOpcao,$ffWeb_Site_Univ,$ffEmail_Secretaria,$ffAno_Inicio,$ffAno_Fin,$bolNome,$ffTema_Tese,
                $gpNome,$opbNome,$mfNome,$paNome,$ffCidade))
        {
            echo "true";
        }
        else{
            echo "false";
        }
    } 
    public function insert(){
        $id = $this->input->post('id');
        $Funcionarios_id= $this->input->post('Funcionarios_id');
        //$fNome= $this->input->post('fNome');
        //$fNomes = $this->input->post('fNomes');
        //$fApelido = $this->input->post('fApelido');
        //$fBI_Passaporte = $this->input->post('fBI_Passaporte');
        $univNome = $this->input->post('univNome');
        $ffCurso = $this->input->post('ffCurso');
        $ffOpcao = $this->input->post('ffOpcao');
        $ffWeb_Site_Univ = $this->input->post('ffWeb_Site_Univ');
        $ffEmail_Secretaria = $this->input->post('ffEmail_Secretaria');
        $ffAno_Inicio = $this->input->post('ffAno_Inicio');
        $ffAno_Fin = $this->input->post('ffAno_Fin');
        $bolNome = $this->input->post('bolNome');
        $ffTema_Tese = $this->input->post('ffTema_Tese');
        $gpNome = $this->input->post('gpNome');
        $opbNome = $this->input->post('opbNome');
        $mfNome = $this->input->post('mfNome');
        $paNome = $this->input->post('paNome');
        $ffCidade = $this->input->post('ffCidade');
        $this->load->model('mEm_Formacao_Funcionarios');
        if($this->mEm_Formacao_Funcionarios->minsert($Funcionarios_id,$univNome,$ffCurso,$ffOpcao,$ffWeb_Site_Univ,$ffEmail_Secretaria,$ffAno_Inicio,
            $ffAno_Fin,$bolNome,$ffTema_Tese,$gpNome,$opbNome,$mfNome,$paNome,$ffCidade))
           echo "true";
        else
           echo "false";    
    }
    public function delete(){
        $id = $this->input->post('id');
        if($id !== "")
        {
            $this->load->model('mEm_Formacao_Funcionarios');
            if($this->mEm_Formacao_Funcionarios->mdelete($id))
                echo "true"; 
            else
               echo "false";           
        }
    }
     
}