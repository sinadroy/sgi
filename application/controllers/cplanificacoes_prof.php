<?php
class Cplanificacoes_prof extends CI_Controller {
    
    public function read(){
        $this->load->model('Mplanificacoes_prof');
        echo json_encode($this->Mplanificacoes_prof->mread());
    }
    public function read_x(){
        $idd = $this->input->get('idd');
        $tema_id = $this->input->get('tema_id')?$this->input->get('tema_id'):"";
        $this->load->model('Mplanificacoes_prof');
        echo json_encode($this->Mplanificacoes_prof->mread_x($idd,$tema_id));
    }
    public function read_temas(){
        $get = $this->input->get('idd');
        $idd = $get?$get:"";
        $this->load->model('Mplanificacoes_prof');
        echo json_encode($this->Mplanificacoes_prof->mread_temas($idd));
    }
    public function read_tipo_aulas(){
        $this->load->model('Mplanificacoes_prof');
        echo json_encode($this->Mplanificacoes_prof->mread_tipo_aulas());
    }

    public function insert_subtema(){
        $request = $_POST;
        $stnome = $request["stnome"];
        $stobservacao = $request["stobservacao"];
        $temas_id = $request["temas_id"];
        $tipo_aulas_id = $request["tipo_aulas_id"];
        
        $this->load->model('Mplanificacoes_prof');
        echo json_encode($this->Mplanificacoes_prof->minsert_subtema($stnome,$stobservacao,$temas_id,$tipo_aulas_id));
    }

    public function update_subtema(){
        $request = $_POST;
        $id = $request["id"];
        $request = $_POST;
        $stnome = $request["stnome"];
        $stobservacao = $request["stobservacao"];
        $temas_id = $request["temas_id"];
        $tipo_aulas_id = $request["tipo_aulas_id"];
        
        $this->load->model('Mplanificacoes_prof');
        echo json_encode($this->Mplanificacoes_prof->mupdate_subtema($id,$stnome,$stobservacao,$temas_id,$tipo_aulas_id));
    }

    public function delete_subtema(){
        $request = $_POST;
        $id = $request["id"];
        $this->load->model('Mplanificacoes_prof');
        echo json_encode($this->Mplanificacoes_prof->mdelete_subtema($id));
    }
}