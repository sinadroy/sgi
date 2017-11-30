<?php
class CNiveisCursos extends CI_Controller {
    
    public function read(){
        $this->load->model('mniveiscursos');
        $ord = 1;
        foreach($this->mniveiscursos->mread() as $row){
            $al[] = array(
                "ord"=>$ord,
                    "id"=>$row->id,
                    "cursos_id"=>$row->cursos_id,
                    "cNome"=>$row->cNome,
                    "cCodigo"=>$row->cCodigo,
                    "niveis_id"=>$row->niveis_id,
                    "nNome"=>$row->nNome,
                    "nCodigo"=>$row->nCodigo,
                    "ncDuracao"=>$row->ncDuracao,
                    "ncPreco_Inscricao"=>$row->ncPreco_Inscricao,
                    "ncPreco_Matricula"=>$row->ncPreco_Matricula,
                    "ncPreco_Propina"=>$row->ncPreco_Propina,
                    "pNome"=>$row->pNome
            ); 
            $ord++;
        }
        //$total = count($al);
        $data = json_encode($al);
        $response = $data;
        echo $response;
    }
    
    public function update(){                       
            $id = $this->input->post('id');
            $cursos_id = $this->input->post('cursos_id');
            $niveis_id = $this->input->post('niveis_id');
            $ncDuracao = $this->input->post('ncDuracao');
            $ncPreco_Inscricao = $this->input->post('ncPreco_Inscricao');
            $ncPreco_Matricula = $this->input->post('ncPreco_Matricula');
            $ncPreco_Propina = $this->input->post('ncPreco_Propina');
            $pNome = $this->input->post('pNome');
            $this->load->model('mniveiscursos');
            if($this->mniveiscursos->mupdate($id,$cursos_id,$niveis_id,$ncPreco_Inscricao,$ncPreco_Matricula,$ncPreco_Propina,$ncDuracao,$pNome))
                echo "true"; 
            else
               echo "false";
    }
     
    public function insert(){
        $cursos_id = $this->input->post('cursos_id');
        $niveis_id = $this->input->post('niveis_id');
        $ncDuracao = $this->input->post('ncDuracao');
        $ncPreco_Inscricao = $this->input->post('ncPreco_Inscricao');
        $ncPreco_Matricula = $this->input->post('ncPreco_Matricula');
        $ncPreco_Propina = $this->input->post('ncPreco_Propina');
        $pNome = $this->input->post('pNome');
        $this->load->model('mNiveisCursos');
        if($this->mNiveisCursos->minsert($cursos_id,$niveis_id,$ncPreco_Inscricao,$ncPreco_Matricula,$ncPreco_Propina,$ncDuracao,$pNome))
           echo "true";
        else
           echo "false";
            
    }
    public function delete(){
        $id = $this->input->post('id');
        if($id !== "")
        {
            $this->load->model('mNiveisCursos');
            if($this->mNiveisCursos->mdelete($id))
                echo "true"; 
            else
               echo "false";           
        }
    }
    
     
}