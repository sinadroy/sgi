<?php
class CAuditorias_Intranet extends CI_Controller {
    
    public function read(){
        $this->load->model('mAuditorias_Intranet');
        echo json_encode($this->mAuditorias_Intranet->mread());
    }
   /* 
    public function crud(){
        $request = $_POST;
        $id = @$request['id'];
        $audOperacao = $request["audOperacao"];
        $mNome = $request["mNome"];
        $smNome = $request["smNome"];
        $uUsuario = $request["uUsuario"];
        $audData = $request["audData"];
        $audHora = $request["audHora"];
        //webix_operation
        $webix_operation = $request["webix_operation"];
        $this->load->model('mAuditorias');

        if ($webix_operation == "insert"){
            if($this->mAuditorias->minsert($audOperacao,$mNome,$smNome,$uUsuario,$audData,$audHora))
                echo "true";
            else
                echo "false";
        } else if ($webix_operation == "update"){
            if($this->mAuditorias->mupdate($id,$audOperacao,$mNome,$smNome,$uUsuario,$audData,$audHora))
                echo "true"; 
            else
                echo "false";
        } else if ($webix_operation == "delete"){
            if($this->mAuditorias->mdelete($id))
                echo "true"; 
            else
               echo "false";
        } else 
            echo "false";
    }
    */
}