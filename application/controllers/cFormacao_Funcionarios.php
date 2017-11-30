<?php
class CFormacao_Funcionarios extends CI_Controller {
    
    public function read(){
        $this->load->model('mFormacao_Funcionarios');
        foreach($this->mFormacao_Funcionarios->mread() as $row){
            $al[] = array(
                "id"=>$row->id,
                "Funcionarios_id"=>$row->Funcionarios_id,
                "fNome"=>$row->fNome,
                "fNomes"=>$row->fNomes,
                "fApelido"=>$row->fApelido,
                "fBI_Passaporte"=>$row->fBI_Passaporte,
                
                "fofuCurso"=>$row->fofuCurso,
                //"ffOpcao"=>$row->ffOpcao,
                //"ffWeb_Site_Univ"=>$row->ffWeb_Site_Univ,
                //"ffEmail_Secretaria"=>$row->ffEmail_Secretaria,
                "fofuAno_Inicio"=>$row->fofuAno_Inicio,
                "fofuAno_Fin"=>$row->fofuAno_Fin,
                
                //"bolNome"=>$row->bolNome,
                //"value"=>$row->ffBolsa,
                
                "fofuTema_Tese"=>$row->fofuTema_Tese,
                
                "Graus_Pretendidos_id"=>$row->Graus_Pretendidos_id,
                "gpNome"=>$row->gpNome,
                
                "Universidades_id"=>$row->Universidades_id,
                "univNome"=>$row->univNome,
                
                //"Orgao_Provendor_Bolsas_id"=>$row->Orgao_Provendor_Bolsas_id,
                //"opbNome"=>$row->opbNome,
                
                "Modalidades_Formacao_id"=>$row->Modalidades_Formacao_id,
                "mfNome"=>$row->mfNome,
                
                "Pais_id"=>$row->Pais_id,
                "paNome"=>$row->paNome,
                "fofuNota"=>$row->fofuNota
                //"Provincias_id"=>$row->Provincias_id,
                //"ffCidade"=>$row->ffCidade,
            ); 
        }
        $data = json_encode($al);
        $response = $data;
        echo $response;
    }

    public function read_x_idf(){
        $idf = $this->input->get('id');

        $this->load->model('mFormacao_Funcionarios');
        foreach($this->mFormacao_Funcionarios->mreadXid($idf) as $row){
            $al[] = array(
                "id"=>$row->id,
                "Funcionarios_id"=>$row->Funcionarios_id,
                "fNome"=>$row->fNome,
                "fNomes"=>$row->fNomes,
                "fApelido"=>$row->fApelido,
                "fBI_Passaporte"=>$row->fBI_Passaporte,
                
                "fofuCurso"=>$row->fofuCurso,

                "fofuAno_Inicio"=>$row->fofuAno_Inicio,
                "fofuAno_Fin"=>$row->fofuAno_Fin,
                
                "fofuTema_Tese"=>$row->fofuTema_Tese,
                
                "Graus_Pretendidos_id"=>$row->Graus_Pretendidos_id,
                "gpNome"=>$row->gpNome,
                
                "Universidades_id"=>$row->Universidades_id,
                "univNome"=>$row->univNome,
                
                "Modalidades_Formacao_id"=>$row->Modalidades_Formacao_id,
                "mfNome"=>$row->mfNome,
                
                "Pais_id"=>$row->Pais_id,
                "paNome"=>$row->paNome,
                "fofuNota"=>$row->fofuNota
            ); 
        }
        $data = json_encode($al);
        $response = $data;
        echo $response;
    }

    public function update(){                       
        $id = $this->input->get('id');
        $Funcionarios_id= $this->input->get('Funcionarios_id');
        $Universidades_id = $this->input->get('Universidades_id');
        $fofuCurso = $this->input->get('fofuCurso');
        $fofuAno_Inicio = $this->input->get('fofuAno_Inicio');
        $fofuAno_Fin = $this->input->get('fofuAno_Fin');
        $fofuTema_Tese = $this->input->get('fofuTema_Tese');
        $gpNome = $this->input->get('gpNome');
        $mfNome = $this->input->get('mfNome');
        $paNome = $this->input->get('paNome');
        $fofuNota = $this->input->get('fofuNota');
        
        $this->load->model('mFormacao_Funcionarios');
        if($this->mFormacao_Funcionarios->mupdate($id,$Funcionarios_id,$Universidades_id,$fofuCurso,
                $fofuAno_Inicio,$fofuAno_Fin,$fofuTema_Tese,$gpNome,$mfNome,$paNome,$fofuNota))
        {
            echo "true";
        }
        else{
            echo "false";
        }
    } 
    public function insert(){
        //$id = $this->input->post('id');
        $Funcionarios_id= $this->input->post('Funcionarios_id');
        $univNome = $this->input->post('univNome');
        $fofuCurso = $this->input->post('fofuCurso');
        //$ffOpcao = $this->input->post('ffOpcao');
        //$ffWeb_Site_Univ = $this->input->post('ffWeb_Site_Univ');
        //$ffEmail_Secretaria = $this->input->post('ffEmail_Secretaria');
        $fofuAno_Inicio = $this->input->post('fofuAno_Inicio');
        $fofuAno_Fin = $this->input->post('fofuAno_Fin');
        //$bolNome = $this->input->post('bolNome');
        $fofuTema_Tese = $this->input->post('fofuTema_Tese');
        $gpNome = $this->input->post('gpNome');
        //$opbNome = $this->input->post('opbNome');
        $mfNome = $this->input->post('mfNome');
        $paNome = $this->input->post('paNome');
        $fofuNota = $this->input->post('fofuNota');
        $this->load->model('mFormacao_Funcionarios');
        if($this->mFormacao_Funcionarios->minsert($Funcionarios_id,$univNome,$fofuCurso,$fofuAno_Inicio,
            $fofuAno_Fin,$fofuTema_Tese,$gpNome,$mfNome,$paNome,$fofuNota))
           echo "true";
        else
           echo "false";    
    }
    public function delete(){
        $id = $this->input->post('id');
        if($id !== "")
        {
            $this->load->model('mFormacao_Funcionarios');
            if($this->mFormacao_Funcionarios->mdelete($id))
                echo "true"; 
            else
               echo "false";           
        }
    }
     
}