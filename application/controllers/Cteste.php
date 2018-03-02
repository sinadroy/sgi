<?php
class Cteste extends CI_Controller {
    
  /*  public function teste(){
        $apecCodigoBarra = "I290120170740";
        $this->load->model('MGerar_Codigo_Barra1');
        echo '<div align="center">'.$this->MGerar_Codigo_Barra1->criarCB($apecCodigoBarra).'</div>';
    }*/
    //<!-- <div align="center"><img align="center" border="0" height="30" width="150" src="data:image/png;base64,' . base64_encode($codigo_barra_generado) . '"></div> -->
    //<!-- <div align="center"><img align="center" border="0" height="30" width="150" src="data:image/png;base64,' . base64_encode($this->MGerar_Codigo_Barra->criarCB($apecCodigoBarra)) . '"></div> -->
    //<!-- <div align="center">' . $codigo_barra_generado . '</div> -->
    public function explorar(){
        $data = array();
        $directorio = opendir("./videos/"); //ruta actual
        //header("Access-Control-Allow-Origin", "*");
        //header("Access-Control-Allow-Headers", "Origin, X-Requested-With, Content-Type, Accept");
        while ($archivo = readdir($directorio)) //obtenemos un archivo y luego otro sucesivamente
        {
        /* if (is_dir($archivo))//verificamos si es o no un directorio
            {
                echo "[".$archivo . "]<br />"; //de ser un directorio lo envolvemos entre corchetes
            }
            else 
            {
                echo $archivo . "<br />";
            }
            */
            
            if (!is_dir($archivo))//verificamos si es o no un directorio
                //echo $archivo . "<br />";
                $data[] = array("title" => $archivo);
        }
        header("Access-Control-Allow-Origin: *");
        echo json_encode($data);
    }

    //para reparar problema de las turmas.

    function get_turma($Ano_Curricular_id, $niveis_cursos_id, $periodos_id){
        $ses = ($periodos_id == 1)?1:3;
        $this->db->select('id, tNome');
        $this->db->from('turmas');
        $this->db->where('Ano_Curricular_id', $Ano_Curricular_id);
        $this->db->where('niveis_cursos_id', $niveis_cursos_id);
        $this->db->where('sessao_id', $ses);
        $consulta = $this->db->get();
		foreach ($consulta->result() as $row) {
            return $row->id;
        }
    }

    function update_turma($tid, $eid){
        $dados = array('turmas_id' => $tid);
        
        if ($this->db->update('Estudantes', $dados, array('id' => $eid))) {
            return true;
        } else
            return false;
    }

    public function reparar_turmas(){
        $contador = 0;
        $contador_error = 0;
        $this->db->select('candidatos.cNome, candidatos.cApelido, candidatos.cBI_Passaporte, 
        turmas.tNome,
        turmas.id as tid,
        estudantes.id as eid, 
        estudantes.Ano_Curricular_id, 
        estudantes.Semestres_id,
        estudantes.niveis_cursos_id,
        niveis_cursos.periodos_id');
        $this->db->from('candidatos');
        $this->db->join('estudantes', 'estudantes.Candidatos_id = candidatos.id');
        $this->db->join('turmas', 'estudantes.turmas_id = turmas.id');
        $this->db->join('niveis_cursos', 'estudantes.niveis_cursos_id = niveis_cursos.id');
        // $this->db->join('periodos', 'niveis_cursos.periodos_id = periodos.id');

        // $this->db->where('estudantes.Ano_Curricular_id', 2);
        // $this->db->where('estudantes.Semestres_id', 3);
        $this->db->order_by('tNome','ASC');
        $consulta = $this->db->get();
		foreach ($consulta->result() as $row) {
            $tid = $this->get_turma($row->Ano_Curricular_id, $row->niveis_cursos_id, $row->periodos_id);
            if($tid != $row->tid){
                // corregir
                if($this->update_turma($tid, $row->eid)){
                    echo "OK".'<br>';
                } else{
                    echo "Error".'<br>';
                    $contador_error++;
                }
                // imprimit arreglado
                echo $row->cNome.' ... '.$row->cApelido.' ... '.$row->cBI_Passaporte.' ... '.$row->tNome.' ... '.$row->Ano_Curricular_id.' ... '.$row->Semestres_id.'<br>';
                echo $row->tid.' > '.$tid.'<br>';
                $contador++;
            }
        }
        echo 'total: '.$contador.'  errores: '.$contador_error;
    }
}
?>