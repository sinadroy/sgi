<?php
class CAnos_Lectivos extends CI_Controller {
    
    public function read(){
        $this->load->model('mAnos_Lectivos');
        $ord = 1;
        foreach($this->mAnos_Lectivos->mread() as $row){
            $al[] = array(
                "ord"=>$ord,
                "id"=>$row->id,
                "value"=>$row->alAno,
                "alAno"=>$row->alAno
            );
            $ord++;
        }
        $data = json_encode($al);
        $response = $data;
        echo $response;
    }
    public function ano_lectivo_actual(){
        $this->load->model('mAnos_Lectivos');
        echo $this->mAnos_Lectivos->mGetID(date('Y'));
    }
    public function GetID() {
        $ano = $this->input->post('alAno');
        $this->load->model('mAnos_Lectivos');
        //echo $this->mAnos_Lectivos->mGetID($ano);
        if($this->mAnos_Lectivos->mGetID($ano) != "")
            echo $this->mAnos_Lectivos->mGetID($ano);
        else
            echo "false";
    }
    
    public function crud(){
        $request = $_POST;
        $id = @$request['id'];
        $alAno = $request["alAno"];
        //webix_operation
        $webix_operation = $request["webix_operation"];
        $this->load->model('MAnos_Lectivos');

        if ($webix_operation == "insert"){
            if($this->MAnos_Lectivos->minsert($alAno))
                echo "true";
            else
                echo "false";

        } else if ($webix_operation == "update"){
            if($this->MAnos_Lectivos->mupdate($id,$alAno))
                echo "true"; 
            else
                echo "false";
        } else if ($webix_operation == "delete"){
            if($this->MAnos_Lectivos->mdelete($id))
                echo "true"; 
            else
               echo "false";
        } else 
            echo "false";
    }
     
}
?>