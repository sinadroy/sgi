<?php
class CSessao_Trabalho_Administrativos extends CI_Controller {
    
    public function read(){
        $this->load->model('mSessao_Trabalho_Administrativos');
        echo json_encode($this->mSessao_Trabalho_Administrativos->mread());
    }

    public function crud(){
        
        /*$method = $_SERVER['REQUEST_METHOD'];

        if ($method == "PUT" || $method == "DELETE")
            parse_str(file_get_contents('php://input'), $request);
        else*/
            $request = $_POST;

        // get id and data 
        //  !!! you need to escape data in real app, to prevent SQL injection !!!
        $id = @$request['id'];
        $stNome = $request["stNome"];
        $stCodigo = $request["stCodigo"];
        //webix_operation
        $webix_operation = $request["webix_operation"];

        $this->load->model('mSessao_Trabalho_Administrativos');

        if ($webix_operation == "insert"){
            //adding new record
            //$db->query("INSERT INTO films(rank, title, year, votes) VALUES('$rank', '$title', '$year', '$votes')");
            //echo '{ "id":"'.$id.'", "status":"success", "newid":"'.$db->lastInsertRowID().'" }';
            
            if($this->mSessao_Trabalho_Administrativos->minsert($stNome,$stCodigo))
                echo "true";
            else
                echo "false";

        } else if ($webix_operation == "update"){
            //updating record
            //$db->query("UPDATE films SET rank='$rank', title='$title', year='$year', votes='$votes' WHERE id='$id'");
            //echo '{ "id":"'.$id.'", "status":"success" }';
            if($this->mSessao_Trabalho_Administrativos->mupdate($id,$stNome,$stCodigo))
                echo "true"; 
            else
                echo "false";
        } else if ($webix_operation == "delete"){
            //deleting record
            //$db->query("DELETE FROM films WHERE id='$id'");
            //echo '{ "id":"'.$id.'", "status":"success" }';
            if($this->mSessao_Trabalho_Administrativos->mdelete($id))
                echo "true"; 
            else
               echo "false";
        } else 
            echo "false";
    }
}