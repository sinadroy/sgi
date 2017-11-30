<?php
class CCargos extends CI_Controller {
    
    public function read(){
        $this->load->model('mCargos');
        foreach($this->mCargos->mread() as $row){
            $al[] = array(
                    "id"=>$row->id,
                    "value"=>$row->carNome,
                    "carNome"=>$row->carNome,
                    "carCodigo"=>$row->carCodigo,
            ); 
        }
        $data = json_encode($al);
        $response = $data;
        echo $response;
    }
   
    public function GetID() {
        $nome = $this->input->post('carNome');
        $this->load->model('mcargos');
        echo $this->mcargos->mGetID($nome);
    }
     /*
    public function update(){                       
            $id = $this->input->post('id');
            $idCurso = $this->input->post('idCurso');
            $cNome = $this->input->post('cNome');
            $cCodigo = $this->input->post('cCodigo');
            $ncDuracao = $this->input->post('ncDuracao');
            $nNome = $this->input->post('nNome');
            $ncPreco_Inscricao = $this->input->post('ncPreco_Inscricao');
            $ncPreco_Matricula = $this->input->post('ncPreco_Matricula');
            $ncPreco_Propina = $this->input->post('ncPreco_Propina');
            $this->load->model('mCursos');
            if($this->mCursos->mupdate($id,$idCurso,$cNome,$cCodigo,$ncDuracao,$nNome,$ncPreco_Inscricao,$ncPreco_Matricula,$ncPreco_Propina))
                echo "true"; 
            else
               echo "false";
    }
     
    public function insert(){
           $cNome = $this->input->post('cNome');
            $cCodigo = $this->input->post('cCodigo');
            $nNome = $this->input->post('nNome');
            $ncDuracao = $this->input->post('ncDuracao');
            $ncPreco_Inscricao = $this->input->post('ncPreco_Inscricao');
            $ncPreco_Matricula = $this->input->post('ncPreco_Matricula');
            $ncPreco_Propina = $this->input->post('ncPreco_Propina');
           $this->load->model('mCursos');
           if($this->mCursos->minsert($cNome,$cCodigo,$nNome,$ncDuracao,$ncPreco_Inscricao,$ncPreco_Matricula,$ncPreco_Propina))
               echo "true";
           else
               echo "false";
            
    }
    public function delete(){
        $id = $this->input->post('id');
        if($id !== "")
        {
            $this->load->model('mCursos');
            if($this->mCursos->mdelete($id))
                echo "true"; 
            else
               echo "false";           
        }
    }
     */
     
}
?>