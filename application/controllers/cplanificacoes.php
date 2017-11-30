<?php
class Cplanificacoes extends CI_Controller {
    
    public function read(){
        $this->load->model('Mplanificacoes');
        echo json_encode($this->Mplanificacoes->mread());
       /* $res[] = array(
            "total" => count($this->Mplanificacao_administrativa->mread()),
            "data" => $this->Mplanificacao_administrativa->mread()
        );
        echo json_encode($res);
        */
    }

    public function read_x_chefe(){
        $chefe = $this->input->get('chefe');
        $this->load->model('Mplanificacoes');
        echo json_encode($this->Mplanificacoes->mread_x_chefe($chefe));
    }
    
    public function readID() {
        $Nome = $this->input->post('id');
        $this->load->model('Mplanificacoes');
        echo json_encode($this->Mplanificacoes->mreadID($Nome));
    }

    public function search(){
        $s = $this->input->get('t');
        $this->load->model('Mplanificacoes');
        echo json_encode($this->Mplanificacoes->msearch($s));
    }

    public function insert(){
        $request = $_GET;
        $pactividade = $request["pactividade"];
        $pdescricao = $request["pdescricao"];
        $psupervisor = $request["psupervisor"];
        $pdatainicio = $request["pdatainicio"];
        $pdatafim = $request["pdatafim"];
        $presposta = $request["presposta"];
        $pestado = $request["pestado"];
        $cduid = $request["cduid"];
        $alid = $request["alid"];
        
        $this->load->model('Mplanificacoes');
        echo json_encode($this->Mplanificacoes->minsert($pactividade,$pdescricao,$psupervisor,$pdatainicio,$pdatafim,
                                                        $presposta,$pestado,$cduid,$alid));
    }

    public function update(){
        $request = $_GET;
        $id = $request["id"];
        $pactividade = $request["pactividade"];
        $pdescricao = $request["pdescricao"];
        $psupervisor = $request["psupervisor"];
        $pdatainicio = $request["pdatainicio"];
        $pdatafim = $request["pdatafim"];
        $presposta = $request["presposta"];
        $pestado = $request["pestado"];
        $cduid = $request["cduid"];
        $alid = $request["alid"];
        
        $this->load->model('Mplanificacoes');
        echo json_encode($this->Mplanificacoes->mupdate($id,$pactividade,$pdescricao,$psupervisor,$pdatainicio,$pdatafim,
                                                        $presposta,$pestado,$cduid,$alid));
    }

    public function delete(){
        $request = $_GET;
        $id = $request["id"];
        $this->load->model('Mplanificacoes');
        echo json_encode($this->Mplanificacoes->mdelete($id));
    }

    public function crud(){
        $request = $_POST;
        $id = @$request['id'];
        $presposta = $request["presposta"];
        //webix_operation
        $webix_operation = $request["webix_operation"];
        $this->load->model('Mplanificacoes');

        if ($webix_operation == "update"){
            if($this->Mplanificacoes->mupdate_crud($id,$presposta))
                echo "true"; 
            else
                echo "false";
        } elseif($webix_operation == "insert"){
            if($this->Mplanificacoes->mupdate_crud($id,$presposta))
                echo "true"; 
            else
                echo "false";
        }else 
            echo "false";
    } 
}