<?php
class COutras_Formacoes extends CI_Controller {
    
    public function read(){
        $this->load->model('mOutras_Formacoes');
        foreach($this->mOutras_Formacoes->mread() as $row){
            $al[] = array(
                "id"=>$row->id,
                "Funcionarios_id"=>$row->Funcionarios_id,
                "fNome"=>$row->fNome,
                "fNomes"=>$row->fNomes,
                "fApelido"=>$row->fApelido,
                "fBI_Passaporte"=>$row->fBI_Passaporte,
                
                "ofCurso"=>$row->ofCurso,
                "ofData_Inicio"=>$row->ofData_Inicio,
                "ofData_Fim"=>$row->ofData_Fim,
                
                "ofInstituicao"=>$row->ofInstituicao,
                "ofTipo_Formacao"=>$row->ofTipo_Formacao,
                
                "Pais_id"=>$row->Pais_id,
                "paNome"=>$row->paNome,
                
            ); 
        }
        $data = json_encode($al);
        $response = $data;
        echo $response;
    }
    public function read_x_id(){
        $id = $this->input->get('id');

        $this->load->model('mOutras_Formacoes');
        foreach($this->mOutras_Formacoes->mreadXid($id) as $row){
            $al[] = array(
                "id"=>$row->id,
                "Funcionarios_id"=>$row->Funcionarios_id,
                "fNome"=>$row->fNome,
                "fNomes"=>$row->fNomes,
                "fApelido"=>$row->fApelido,
                "fBI_Passaporte"=>$row->fBI_Passaporte,
                
                "ofCurso"=>$row->ofCurso,
                "ofData_Inicio"=>$row->ofData_Inicio,
                "ofData_Fim"=>$row->ofData_Fim,
                
                "ofInstituicao"=>$row->ofInstituicao,
                "ofTipo_Formacao"=>$row->ofTipo_Formacao,
                
                "Pais_id"=>$row->Pais_id,
                "paNome"=>$row->paNome,
                
            ); 
        }
        $data = json_encode($al);
        $response = $data;
        echo $response;
    }
    public function update(){                       
        $id = $this->input->post('id');
        $Funcionarios_id= $this->input->post('Funcionarios_id');
        $ofCurso = $this->input->post('ofCurso');
        $ofData_Inicio = $this->input->post('ofData_Inicio');
        $ofData_Fin = $this->input->post('ofData_Fim');
        $ofInstituicao = $this->input->post('ofInstituicao');
        $ofTipo_Formacao = $this->input->post('ofTipo_Formacao');
        $paNome = $this->input->post('paNome');
        
        $this->load->model('mOutras_Formacoes');
        if($this->mOutras_Formacoes->mupdate($id,$Funcionarios_id,$ofCurso,$ofData_Inicio,
                $ofData_Fin,$ofInstituicao,$ofTipo_Formacao,$paNome))
        {
            echo "true";
        }
        else{
            echo "false";
        }
    } 
    public function insert(){
        $Funcionarios_id= $this->input->post('Funcionarios_id');
        $ofCurso = $this->input->post('ofCurso');
        $ofData_Inicio = $this->input->post('ofData_Inicio');
        $ofData_Fin = $this->input->post('ofData_Fim');
        $ofInstituicao = $this->input->post('ofInstituicao');
        $ofTipo_Formacao = $this->input->post('ofTipo_Formacao');
        $paNome = $this->input->post('paNome');
        
        $this->load->model('mOutras_Formacoes');
        if($this->mOutras_Formacoes->minsert($Funcionarios_id,$ofCurso,$ofData_Inicio,
                $ofData_Fin,$ofInstituicao,$ofTipo_Formacao,$paNome))
           echo "true";
        else
           echo "false";    
    }
    public function delete(){
        $id = $this->input->post('id');
        if($id !== "")
        {
            $this->load->model('mOutras_Formacoes');
            if($this->mOutras_Formacoes->mdelete($id))
                echo "true"; 
            else
               echo "false";           
        }
    }
     
}