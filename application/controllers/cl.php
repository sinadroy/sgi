<?php
class Cl extends CI_Controller {

function lic(){
    $this->load->model('mlogo');
    $titulo = $this->mlogo->mread_logo_documentos_titulo();
    echo base64_encode($titulo);
}

function pertenece_sesion($data,$data_inicio,$data_fin){

        list($m, $d, $a) = preg_split('[-]', $data);
        list($mesi, $diai, $anoi) = preg_split('[-]', $data_inicio);
        list($mesf, $diaf, $anof) = preg_split('[-]', $data_fin);

        $data = mktime(0, 0, 0, $m, $d, $a);
        $ri = mktime(0 ,0 ,0 ,$mesi ,$diai , $anoi);
        $rf = mktime(0 ,0 ,0 ,$mesf ,$diaf ,$anof);
        if($data >= $ri && $data <= $rf)
            echo "true";
        else
            echo "false";
}

public function compare(){
     date_default_timezone_set("America/Havana");
     //echo "America/Havana".time();
     $d_act = date('d'); $m_act = date('m'); $a_act = date('Y');
     
     $f_act = mktime(0, 0, 0, $m_act, $d_act, $a_act);
     $f_est = mktime(0, 0, 0, 1, 1, 2018); //fecha limite establecida
     //print ($f_est - $f_act);
     if($f_est > $f_act){
        print round((((($f_est - $f_act)/60)/60)/24),0); //para saver cuantos dias faltan para vencer la lic.
     }else{
        print "false";
     }
     //print ($f_est - $f_act)/60/60/24; //para saver cuantos dias faltan para vencer la lic.
     
}

public function ext_mac(){
    $output = shell_exec('ifconfig');
    echo "<pre>$output</pre>";
}

public function send_email(){
    
}
/*    
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
    
    public function update(){                       
            $id = $this->input->post('id');
            //$idCurso = $this->input->post('idCurso');
            $cNome = $this->input->post('cNome');
            $cCodigo = $this->input->post('cCodigo');
            $cDescricao = $this->input->post('cDescricao');
            //$nNome = $this->input->post('nNome');
            //$ncPreco_Inscricao = $this->input->post('ncPreco_Inscricao');
            //$ncPreco_Matricula = $this->input->post('ncPreco_Matricula');
            //$ncPreco_Propina = $this->input->post('ncPreco_Propina');
            $this->load->model('mCursos');
            if($this->mCursos->mupdate($id,$cNome,$cCodigo,$cDescricao)){//$idCurso,$cNome,$cCodigo,$ncDuracao,$nNome,$ncPreco_Inscricao,$ncPreco_Matricula,$ncPreco_Propina))
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
            //$nNome = $this->input->post('nNome');
            //$ncDuracao = $this->input->post('ncDuracao');
            //$ncPreco_Inscricao = $this->input->post('ncPreco_Inscricao');
            //$ncPreco_Matricula = $this->input->post('ncPreco_Matricula');
            //$ncPreco_Propina = $this->input->post('ncPreco_Propina');
           $this->load->model('mCursos');
           if($this->mCursos->minsert($cNome,$cCodigo,$cDescricao))
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