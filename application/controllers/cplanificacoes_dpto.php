<?php
class Cplanificacoes_dpto extends CI_Controller {
    
    public function read_x_idd(){
        $request = $_GET;
        $idd = $request["idd"];
        $this->load->model('Mplanificacoes_dpto');
        echo json_encode($this->Mplanificacoes_dpto->mread_x_idd($idd));
    }
    

    public function insert(){
        $request = $_POST;
        $temnome = $request["temnome"];
        $temhoras = $request["temhoras"];
        $disciplinas_id = $request["disciplinas_id"];
        
        $this->load->model('Mplanificacoes_dpto');
        echo json_encode($this->Mplanificacoes_dpto->minsert($temnome,$temhoras,$disciplinas_id));
    }

    public function update(){
        $request = $_POST;
        $id = $request["id"];
        $request = $_POST;
        $temnome = $request["temnome"];
        $temhoras = $request["temhoras"];
        $disciplinas_id = $request["disciplinas_id"];
        
        $this->load->model('Mplanificacoes_dpto');
        echo json_encode($this->Mplanificacoes_dpto->mupdate($id,$temnome,$temhoras,$disciplinas_id));
    }

    public function delete(){
        $request = $_POST;
        $id = $request["id"];
        $this->load->model('Mplanificacoes_dpto');
        echo json_encode($this->Mplanificacoes_dpto->mdelete($id));
    }
}