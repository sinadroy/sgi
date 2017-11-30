<?php
class Ctemposaulas extends CI_Controller {
    
    public function read(){
        $ord=1;
        $this->load->model('mtemposaulas');
        foreach($this->mtemposaulas->mread() as $row){
            $al[] = array(
                "ord"=>$ord,
                "id"=>$row->id,
                "value"=>$row->taNome,
                "taNome"=>$row->taNome,
                "taCodigo"=>$row->taCodigo,
                "taHoraInicio"=>$row->taHoraInicio,
                "taHoraFim"=>$row->taHoraFim,
                "sesNome"=>$row->sesNome,
                "sessao_id"=>$row->sessao_id
            ); 
            $ord++;
        }
        $data = json_encode($al);
        $response = $data;
        echo $response;
    }
    public function GetID() {
        $Codigo = $this->input->post('taCodigo');
        $this->load->model('mtemposaulas');
        echo $this->mtemposaulas->mGetID($Codigo);
    }
    public function update(){                       
        $id = $this->input->post('id');
        $taNome = $this->input->post('taNome');
        $taCodigo = $this->input->post('taCodigo');
        $taHoraInicio = $this->input->post('taHoraInicio');
        $taHoraFim = $this->input->post('taHoraFim');
        $sessao_id = $this->input->post('sessao_id');
        $this->load->model('mtemposaulas');
        if($this->mtemposaulas->mupdate($id,$taNome,$taCodigo,$taHoraInicio,$taHoraFim,$sessao_id))
            echo "true"; 
        else
            echo "false";
    }
     
    public function insert(){
        $taNome = $this->input->post('taNome');
        $taCodigo = $this->input->post('taCodigo');
        
        $taHoraInicio = $this->input->post('taHoraInicio');
        $dateI=date_create($taHoraInicio);
        $horaInicioOK = date_format($dateI,"H:i:s");
        $taHoraFim = $this->input->post('taHoraFim');
        $dateF=date_create($taHoraFim);
        $horaFimOK = date_format($dateF,"H:i:s");
        $sessao_id = $this->input->post('sesNome');
        $this->load->model('mtemposaulas');
        if($this->mtemposaulas->minsert($taNome,$taCodigo,$horaInicioOK,$horaFimOK,$sessao_id))
           echo "true";
        else
           echo "false";    
    }
    public function delete(){
        $id = $this->input->post('id');
        if($id !== "")
        {
            $this->load->model('mtemposaulas');
            if($this->mtemposaulas->mdelete($id))
                echo "true"; 
            else
               echo "false";           
        }
    }
     
}
?>