<?php
class CPublicacoes extends CI_Controller {
    
    public function read(){
        $this->load->model('mPublicacoes');
        foreach($this->mPublicacoes->mread() as $row){
            $al[] = array(
                "id"=>$row->id,
                "Funcionarios_id"=>$row->Funcionarios_id,
                "fNome"=>$row->fNome,
                "fNomes"=>$row->fNomes,
                "fApelido"=>$row->fApelido,
                "fBI_Passaporte"=>$row->fBI_Passaporte,
                
                "pubTitulo"=>$row->pubTitulo,
                "pubAno"=>$row->pubAno,
                "pubEditora_Revista"=>$row->pubEditora_Revista,
                "pubISBN_ISSN"=>$row->pubISBN_ISSN,
                
                "Pais_id"=>$row->Pais_id,
                "paNome"=>$row->paNome,
                
                "Tipo_Publicacoes_id"=>$row->Tipo_Publicacoes_id,
                "tpubNome"=>$row->tpubNome,
            ); 
        }
        $data = json_encode($al);
        $response = $data;
        echo $response;
    }
    public function read_x_id(){
        $id = $this->input->get('id');
        $this->load->model('mPublicacoes');
        foreach($this->mPublicacoes->mreadXid($id) as $row){
            $al[] = array(
                "id"=>$row->id,
                "Funcionarios_id"=>$row->Funcionarios_id,
                "fNome"=>$row->fNome,
                "fNomes"=>$row->fNomes,
                "fApelido"=>$row->fApelido,
                "fBI_Passaporte"=>$row->fBI_Passaporte,
                
                "pubTitulo"=>$row->pubTitulo,
                "pubAno"=>$row->pubAno,
                "pubEditora_Revista"=>$row->pubEditora_Revista,
                "pubISBN_ISSN"=>$row->pubISBN_ISSN,
                
                "Pais_id"=>$row->Pais_id,
                "paNome"=>$row->paNome,
                
                "Tipo_Publicacoes_id"=>$row->Tipo_Publicacoes_id,
                "tpubNome"=>$row->tpubNome,
            ); 
        }
        $data = json_encode($al);
        $response = $data;
        echo $response;
    }
    public function update(){                       
        $id = $this->input->post('id');
        $Funcionarios_id= $this->input->post('Funcionarios_id');
        $pubTitulo = $this->input->post('pubTitulo');
        $pubAno = $this->input->post('pubAno');
        $pubEditora_Revista = $this->input->post('pubEditora_Revista');
        $pubISBN_ISSN = $this->input->post('pubISBN_ISSN');
        $Pais_id= $this->input->post('paNome');
        $Tipo_Publicacoes_id = $this->input->post('tpubNome');
        
        $this->load->model('mPublicacoes');
        if($this->mPublicacoes->mupdate($id,$Funcionarios_id,$pubTitulo,$pubAno,
                $pubEditora_Revista,$pubISBN_ISSN,$Pais_id,$Tipo_Publicacoes_id))
        {
            echo "true";
        }
        else{
            echo "false";
        }
    }
    /*
    Funcionarios_id:6
    pubTitulo:asd
    pubAno:2014
    pubEditora_Revista:asd
    pubISBN_ISSN:1234
    tpubNome:2
    paNome:2
     */
    public function insert(){
        $Funcionarios_id = $this->input->post('Funcionarios_id');
        $pubTitulo = $this->input->post('pubTitulo');
        $pubAno = $this->input->post('pubAno');
        $pubEditora_Revista = $this->input->post('pubEditora_Revista');
        $pubISBN_ISSN = $this->input->post('pubISBN_ISSN');
        $Pais_id= $this->input->post('paNome');
        $Tipo_Publicacoes_id = $this->input->post('tpubNome');
        $this->load->model('mPublicacoes');
        if($this->mPublicacoes->minsert($Funcionarios_id,$pubTitulo,$pubAno,
                $pubEditora_Revista,$pubISBN_ISSN,$Pais_id,$Tipo_Publicacoes_id))
           echo "true";
        else
           echo "false";    
    }
    public function delete(){
        $id = $this->input->post('id');
        if($id !== "")
        {
            $this->load->model('mPublicacoes');
            if($this->mPublicacoes->mdelete($id))
                echo "true"; 
            else
               echo "false";           
        }
    }
     
}