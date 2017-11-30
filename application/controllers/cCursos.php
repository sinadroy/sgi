<?php
class CCursos extends CI_Controller {
    
    public function read(){
        $this->load->model('mcursos');
        $ord = 1;
        foreach($this->mcursos->mread() as $row){
            $al[] = array(
                "ord"=>$ord,
                    "id"=>$row->id,
                    "value"=>$row->cNome,
                    "cNome"=>$row->cNome,
                    "cCodigo"=>$row->cCodigo,
                    "cDescricao"=>$row->cDescricao,
                    "cCodigoNome"=>$row->cCodigoNome
                    //"ncDuracao"=>$row->ncDuracao,
                    //"nNome"=>$row->nNome,
                    //"ncPreco_Inscricao"=>$row->ncPreco_Inscricao,
                    //"ncPreco_Matricula"=>$row->ncPreco_Matricula,
                    //"ncPreco_Propina"=>$row->ncPreco_Propina,
            );
            $ord++; 
        }
        $data = json_encode($al);
        $response = $data;
        echo $response;
    }

    public function read_dpto() {
        $dpto = $this->input->get('dpto');
        $this->load->model('mcursos');
        echo json_encode($this->mcursos->mread_dpto($dpto));
    }

    public function readXn() {
        $n = $this->input->get('nNome');
		$this->load->model('mcursos');
		echo json_encode($this->mcursos->mreadXn($n));
	}
   
    public function GetID() {
        $cCodigo = $this->input->post('cNome');
        $this->load->model('mcursos');
        echo $this->mcursos->mGetID($cCodigo);
    }
    public function Get_total_X_curso_estadistica() {
        $al = $this->input->get('al');
        $n = $this->input->get('n');
        $c = $this->input->get('c');
        $p = $this->input->get('p');
        $ac = $this->input->get('ac');
        $this->load->model('mcursos');
        echo json_encode($this->mcursos->mGet_total_X_curso_estadistica($al,$n,$c,$p,$ac));
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
            //$idCurso = $this->input->post('idCurso');
            $cNome = $this->input->post('cNome');
            $cCodigo = $this->input->post('cCodigo');
            $cDescricao = $this->input->post('cDescricao');
            $cCodigoNome = $this->input->post('cCodigoNome');
            //$nNome = $this->input->post('nNome');
            //$ncPreco_Inscricao = $this->input->post('ncPreco_Inscricao');
            //$ncPreco_Matricula = $this->input->post('ncPreco_Matricula');
            //$ncPreco_Propina = $this->input->post('ncPreco_Propina');
            $this->load->model('mCursos');
            if($this->mCursos->mupdate($id,$cNome,$cCodigo,$cDescricao,$cCodigoNome)){//$idCurso,$cNome,$cCodigo,$ncDuracao,$nNome,$ncPreco_Inscricao,$ncPreco_Matricula,$ncPreco_Propina))
                echo "true"; 
            }
            else{
               echo "false";
            }
    }
     
    public function insert(){
           $cNome = $this->input->post('cNome');
            $cCodigo = $this->input->post('cCodigo');
            $cDescricao = $this->input->post('cDescricao');
            $cCodigoNome = $this->input->post('cCodigoNome');
            //$nNome = $this->input->post('nNome');
            //$ncDuracao = $this->input->post('ncDuracao');
            //$ncPreco_Inscricao = $this->input->post('ncPreco_Inscricao');
            //$ncPreco_Matricula = $this->input->post('ncPreco_Matricula');
            //$ncPreco_Propina = $this->input->post('ncPreco_Propina');
           $this->load->model('mCursos');
           if($this->mCursos->minsert($cNome,$cCodigo,$cDescricao,$cCodigoNome))
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
     
}
?>