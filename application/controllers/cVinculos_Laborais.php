<?php
class CVinculos_Laborais extends CI_Controller {
    
    public function read(){
        $ord=1;
        $this->load->model('mVinculos_Laborais');
        foreach($this->mVinculos_Laborais->mread() as $row){
            if($row->vlCodigo != '0' || $row->vlCodigo != '00' || $row->vlCodigo != '000')
            {
                $al[] = array(
                    "id"=>$row->id,
                    "ord"=>$ord,
                    "value"=>$row->vlNome,
                    "vlNome"=>$row->vlNome,
                    "vlCodigo"=>$row->vlCodigo
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
        $this->load->model('mVinculos_Laborais');
        foreach($this->mVinculos_Laborais->mread() as $row){
            $al[] = array(
                "id"=>$row->id,
                "ord"=>$ord,
                "value"=>$row->vlNome,
                "vlNome"=>$row->vlNome,
                "vlCodigo"=>$row->vlCodigo
            ); 
            $ord++;
        }
        $data = json_encode($al);
        $response = $data;
        echo $response;
    }
    public function GetID() {
        $Nome = $this->input->post('vlNome');
        $this->load->model('mVinculos_Laborais');
        echo $this->mVinculos_Laborais->mGetID($Nome);
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
        $vlNome = $this->input->post('vlNome');
        $vlCodigo = $this->input->post('vlCodigo');
        $this->load->model('mVinculos_Laborais');
        if($this->mVinculos_Laborais->mupdate($id,$vlNome,$vlCodigo))
            echo "true"; 
        else
            echo "false";
    }
     
    public function insert(){
        $vlNome = $this->input->post('vlNome');
        $vlCodigo = $this->input->post('vlCodigo');
        $this->load->model('mVinculos_Laborais');
        if($this->mVinculos_Laborais->minsert($vlNome,$vlCodigo))
           echo "true";
        else
           echo "false";    
    }
    public function delete(){
        $id = $this->input->post('id');
        if($id !== "")
        {
            $this->load->model('mVinculos_Laborais');
            if($this->mVinculos_Laborais->mdelete($id))
                echo "true"; 
            else
               echo "false";           
        }
    }
     
}
?>