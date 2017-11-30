<?php
class CAno_Curricular extends CI_Controller {
    
    public function read(){
        $ord=1;
        $this->load->model('mAno_Curricular');
        foreach($this->mAno_Curricular->mread() as $row){
            $al[] = array(
                "ord"=>$ord,
                "id"=>$row->id,
                "value"=>$row->acNome,
                "acNome"=>$row->acNome,
                "acCodigo"=>$row->acCodigo
            ); 
            $ord++;
        }
        $data = json_encode($al);
        $response = $data;
        echo $response;
    }
    public function GetID() {
        $Nome = $this->input->post('acNome');
        $this->load->model('mAno_Curricular');
        echo $this->mAno_Curricular->mGetID($Nome);
    }

    public function dt_semestres() {
        $ac = $this->input->get('ac');
        switch($ac){
            case '1': $x = 1; break;
            case '2': $x = 3; break;
            case '3': $x = 5; break;
            case '4': $x = 7; break;
            case '5': $x = 9; break;
        }
        for($i=$x;$i<=$x+1;$i++){
            $s1[] = array(
                "id"=>$i,
                "sNome"=>$i,
                "value"=>$i,
            );
        }
        echo json_encode($s1);
    }
    /*
    public function GetIDXCodigo() {
        $cCodigo = $this->input->post('cCodigo');
        $this->load->model('mcursos');
        echo $this->mcursos->mGetIDXCodigo($cCodigo);
    }
    */
    public function update(){                       
        $id = $this->input->post('id');
        $Nome = $this->input->post('acNome');
        $Codigo = $this->input->post('acCodigo');
        $this->load->model('mAno_Curricular');
        if($this->mAno_Curricular->mupdate($id,$Nome,$Codigo))
            echo "true"; 
        else
            echo "false";
    }
     
    public function insert(){
        $Nome = $this->input->post('acNome');
        $Codigo = $this->input->post('acCodigo');
        $this->load->model('mAno_Curricular');
        if($this->mAno_Curricular->minsert($Nome,$Codigo))
           echo "true";
        else
           echo "false";    
    }
    public function delete(){
        $id = $this->input->post('id');
        if($id !== "")
        {
            $this->load->model('mAno_Curricular');
            if($this->mAno_Curricular->mdelete($id))
                echo "true"; 
            else
               echo "false";           
        }
    }
     
}
?>