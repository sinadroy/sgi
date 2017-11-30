<?php
class CTurmas extends CI_Controller {
    
    public function read(){
        $ord=1;
        $this->load->model('mTurmas');
        foreach($this->mTurmas->mread() as $row){
            $al[] = array(
                "ord"=>$ord,
                "id"=>$row->id,
                "value"=>$row->tNome,
                "tNome"=>$row->tNome,
                "tCodigo"=>$row->tCodigo,
                "tDescricao"=>$row->tDescricao,
                "Ano_Curricular_id"=>$row->Ano_Curricular_id,
                "acNome"=>$row->acNome,
                //"periodos_id"=>$row->periodos_id,
                "pNome"=>$row->pNome,
                "niveis_cursos_id"=>$row->niveis_cursos_id,
                "nNome"=>$row->nNome,
                "cNome"=>$row->cNome,
                "sesNome"=>$row->sesNome,
                "tCapacidade"=>$row->tCapacidade
            ); 
        }
        $data = json_encode($al);
        $response = $data;
        echo $response;
    }
    public function readXncp() {
        $request = $_GET;
		$n = $request['nNome'];
		$c = $request['cNome'];
        $p = $request['pNome'];
        $ac = @$request['ac'];
		$this->load->model('mTurmas');
		echo json_encode($this->mTurmas->mreadXncp($n,$c,$p,$ac));
	}
    public function GetID() {
        $Nome = $this->input->post('tNome');
        $this->load->model('mTurmas');
        echo $this->mTurmas->mGetID($Nome);
    }
    
    public function update(){                       
        $id = $this->input->post('id');
        $tNome = $this->input->post('tNome');
        $tCodigo = $this->input->post('tCodigo');
        $tDescricao = $this->input->post('tDescricao');
        $acNome = $this->input->post('acNome');
        $pNome = $this->input->post('pNome');
        $nNome = $this->input->post('nNome');
        $cNome = $this->input->post('cNome');
        $sesNome = $this->input->post('sesNome');
        $tCapacidade = $this->input->post('tCapacidade');
        //consultar niveis_cursos para copiar id
        $this->load->model('mNiveisCursos');
        $niveis_cursos_id = $this->mNiveisCursos->mreadXncp($nNome,$cNome,$pNome);
        
        $this->load->model('mTurmas');
        if($this->mTurmas->mupdate($id,$tNome,$tCodigo,$tDescricao,$acNome,$niveis_cursos_id,$sesNome,$tCapacidade))
            echo "true"; 
        else
            echo "false";
    }
     
    public function insert(){
        $tNome = $this->input->post('tNome');
        $tCodigo = $this->input->post('tCodigo');
        $tDescricao = $this->input->post('tDescricao');
        $acNome = $this->input->post('acNome');
        $pNome = $this->input->post('pNome');
        $nNome = $this->input->post('nNome');
        $cNome = $this->input->post('cNome');
        $sesNome = $this->input->post('sesNome');
        $tCapacidade = $this->input->post('tCapacidade');
        //consultar niveis_cursos para copiar id
        $this->load->model('mNiveisCursos');
        $niveis_cursos_id = $this->mNiveisCursos->mreadXncp($nNome,$cNome,$pNome);
        $this->load->model('mTurmas');
        if($this->mTurmas->minsert($tNome,$tCodigo,$tDescricao,$acNome,$niveis_cursos_id,$sesNome,$tCapacidade))
           echo "true";
        else
           echo "false";    
    }
    public function delete(){
        $id = $this->input->post('id');
        if($id !== "")
        {
            $this->load->model('mTurmas');
            if($this->mTurmas->mdelete($id))
                echo "true"; 
            else
               echo "false";           
        }
    }
     
}
?>