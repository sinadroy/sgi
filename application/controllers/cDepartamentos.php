<?php
class CDepartamentos extends CI_Controller {
    
    public function read(){
        $ord=1;
        $this->load->model('mDepartamentos');
        foreach($this->mDepartamentos->mread() as $row){
            if($row->depCodigo != "0" || $row->depCodigo != "00" || $row->depCodigo != "000")
            {
                $al[] = array(
                    "ord"=>$ord,
                    "id"=>$row->id,
                    "value"=>$row->depNome,
                    "depNome"=>$row->depNome,
                    "depCodigo"=>$row->depCodigo
                );
                $ord++;
            } 
        }
        $data = json_encode($al);
        $response = $data;
        echo $response;
    }
    public function read_combos(){
        $ord=1;
        $this->load->model('mDepartamentos');
        foreach($this->mDepartamentos->mread() as $row){
                $al[] = array(
                    "ord"=>$ord,
                    "id"=>$row->id,
                    "value"=>$row->depNome,
                    "depNome"=>$row->depNome,
                    "depCodigo"=>$row->depCodigo
                );
                $ord++;
        }
        $data = json_encode($al);
        $response = $data;
        echo $response;
    }
    public function GetID() {
        $gfNome = $this->input->post('depNome');
        $this->load->model('mDepartamentos');
        echo $this->mDepartamentos->mGetID($gfNome);
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
        $depNome = $this->input->post('depNome');
        $depCodigo = $this->input->post('depCodigo');
        $this->load->model('mDepartamentos');
        if($this->mDepartamentos->mupdate($id,$depNome,$depCodigo))
            echo "true"; 
        else
            echo "false";
    }
     
    public function insert(){
        $Nome = $this->input->post('depNome');
        $Codigo = $this->input->post('depCodigo');
        $this->load->model('mDepartamentos');
        if($this->mDepartamentos->minsert($Nome,$Codigo))
           echo "true";
        else
           echo "false";    
    }
    public function delete(){
        $id = $this->input->post('id');
        if($id !== "")
        {
            $this->load->model('mDepartamentos');
            if($this->mDepartamentos->mdelete($id))
                echo "true"; 
            else
               echo "false";           
        }
    }
     
}
?>