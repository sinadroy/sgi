<?php
class CSectores extends CI_Controller {
    
    public function read(){
        $ord=1;
        $this->load->model('mSectores');
        foreach($this->mSectores->mread() as $row){
            if($row->secCodigo != "0" || $row->secCodigo != "00" || $row->secCodigo != "000")
            {
                $al[] = array(
                    "ord"=>$ord,
                    "id"=>$row->id,
                    "value"=>$row->secNome,
                    "secNome"=>$row->secNome,
                    "secCodigo"=>$row->secCodigo,
                    "Departamentos_id"=>$row->Departamentos_id,
                    "depNome"=>$row->depNome
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
        $this->load->model('mSectores');
        foreach($this->mSectores->mread() as $row){
                $al[] = array(
                    "ord"=>$ord,
                    "id"=>$row->id,
                    "value"=>$row->secNome,
                    "secNome"=>$row->secNome,
                    "secCodigo"=>$row->secCodigo,
                    "Departamentos_id"=>$row->Departamentos_id,
                    "depNome"=>$row->depNome
                ); 
                $ord++;
        }
        $data = json_encode($al);
        $response = $data;
        echo $response;
    }
    public function GetID() {
        $Nome = $this->input->post('secNome');
        $this->load->model('mSectores');
        echo $this->mSectores->mGetID($Nome);
    }
    
    public function read_x_dep() {
        $id = $this->input->get('id');
        $this->load->model('mSectores');
        echo json_encode($this->mSectores->mread_x_dep($id));
    }
    
    public function update(){                       
        $id = $this->input->post('id');
        $secNome = $this->input->post('secNome');
        $secCodigo = $this->input->post('secCodigo');
        $Departamentos_id = $this->input->post('Departamentos_id');
        $this->load->model('mSectores');
        if($this->mSectores->mupdate($id,$secNome,$secCodigo,$Departamentos_id))
            echo "true"; 
        else
            echo "false";
    }
     
    public function insert(){
        $secNome = $this->input->post('secNome');
        $secCodigo = $this->input->post('secCodigo');
        $Departamentos_id = $this->input->post('Departamentos_id');
        $this->load->model('mSectores');
        if($this->mSectores->minsert($secNome,$secCodigo,$Departamentos_id))
           echo "true";
        else
           echo "false";    
    }
    public function delete(){
        $id = $this->input->post('id');
        if($id !== "")
        {
            $this->load->model('mSectores');
            if($this->mSectores->mdelete($id))
                echo "true"; 
            else
               echo "false";           
        }
    }
     
}
?>