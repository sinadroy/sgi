<?php
class CEventos extends CI_Controller {
    
    public function read(){
        $this->load->model('mEventos');
        foreach($this->mEventos->mread() as $row){
            $al[] = array(
                "id"=>$row->id,
                "Funcionarios_id"=>$row->Funcionarios_id,
                "fNome"=>$row->fNome,
                "fNomes"=>$row->fNomes,
                "fApelido"=>$row->fApelido,
                "fBI_Passaporte"=>$row->fBI_Passaporte,
                
                "evTitulo"=>$row->evTitulo,
                "evInstituicao"=>$row->evInstituicao,
                "evAno"=>$row->evAno,
                
                "Pais_id"=>$row->Pais_id,
                "paNome"=>$row->paNome,
                
                "Tipo_Evento_id"=>$row->Tipo_Evento_id,
                "teNome"=>$row->teNome,
            ); 
        }
        $data = json_encode($al);
        $response = $data;
        echo $response;
    }

    public function read_x_id(){
        $id = $this->input->get('id');
        $this->load->model('mEventos');
        foreach($this->mEventos->mreadXid($id) as $row){
            $al[] = array(
                "id"=>$row->id,
                "Funcionarios_id"=>$row->Funcionarios_id,
                "fNome"=>$row->fNome,
                "fNomes"=>$row->fNomes,
                "fApelido"=>$row->fApelido,
                "fBI_Passaporte"=>$row->fBI_Passaporte,
                
                "evTitulo"=>$row->evTitulo,
                "evInstituicao"=>$row->evInstituicao,
                "evAno"=>$row->evAno,
                
                "Pais_id"=>$row->Pais_id,
                "paNome"=>$row->paNome,
                
                "Tipo_Evento_id"=>$row->Tipo_Evento_id,
                "teNome"=>$row->teNome,
            ); 
        }
        $data = json_encode($al);
        $response = $data;
        echo $response;
    }

    public function update(){                       
        $id = $this->input->post('id');
        $Funcionarios_id= $this->input->post('Funcionarios_id');
        $evTitulo = $this->input->post('evTitulo');
        $evInstituicao = $this->input->post('evInstituicao');
        $evAno = $this->input->post('evAno');
        $Pais_id= $this->input->post('paNome');
        $Tipo_Evento_id = $this->input->post('Tipo_Evento_id');
        
        $this->load->model('mEventos');
        if($this->mEventos->mupdate($id,$Funcionarios_id,$evTitulo,$evInstituicao,$evAno,
                $Pais_id,$Tipo_Evento_id))
        {
            echo "true";
        }
        else{
            echo "false";
        }
    }
    public function insert(){
        $Funcionarios_id= $this->input->post('Funcionarios_id');
        $evTitulo = $this->input->post('evTitulo');
        $evInstituicao = $this->input->post('evInstituicao');
        $evAno = $this->input->post('evAno');
        $Pais_id= $this->input->post('paNome');
        $Tipo_Evento_id = $this->input->post('teNome');
        $this->load->model('mEventos');
        if($this->mEventos->minsert($Funcionarios_id,$evTitulo,$evInstituicao,$evAno,
                $Pais_id,$Tipo_Evento_id))
           echo "true";
        else
           echo "false";    
    }
    public function delete(){
        $id = $this->input->post('id');
        if($id !== "")
        {
            $this->load->model('mEventos');
            if($this->mEventos->mdelete($id))
                echo "true"; 
            else
               echo "false";           
        }
    }
     
}