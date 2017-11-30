<?php
class Cestatisticas extends CI_Controller {
    
    public function estudantes_x_ef() {
        $al = $this->input->get('al');
        $n = $this->input->get('n');
        $c = $this->input->get('c');
        $p = $this->input->get('p');
        //$ac = $this->input->get('ac');
        $this->load->model('Mestatisticas');
        echo json_encode($this->Mestatisticas->mestudantes_x_ef($al,$al,$n,$c,$p));
    }

    public function estudantes_x_pf() {
        $al = $this->input->get('al');
        $n = $this->input->get('n');
        $c = $this->input->get('c');
        $p = $this->input->get('p');
        //$ac = $this->input->get('ac');
        $this->load->model('Mestatisticas');
        echo json_encode($this->Mestatisticas->mestudantes_x_pf($al,$al,$n,$c,$p));
    }

    // estatisticas matricula
    public function get_total_x_periodo_estadistica_mat() {
        $al = $this->input->get('al');
        $n = $this->input->get('n');
        $c = $this->input->get('c');
        $p = $this->input->get('p');
        $ac = $this->input->get('ac');
        $this->load->model('Mestatisticas');
        echo json_encode($this->Mestatisticas->mGet_total_X_periodo_estadistica_mat($al,$n,$c,$p,$ac));
    }
    public function get_total_x_curso_estatisticas_mat() {
        $al = $this->input->get('al');
        $n = $this->input->get('n');
        $c = $this->input->get('c');
        $p = $this->input->get('p');
        $ac = $this->input->get('ac');
        $this->load->model('Mestatisticas');
        echo json_encode($this->Mestatisticas->mget_total_x_curso_estatisticas_mat($al,$n,$c,$p,$ac));
    }

    public function estudantes_x_ef_mat() {
        $al = $this->input->get('al');
        $n = $this->input->get('n');
        $c = $this->input->get('c');
        $p = $this->input->get('p');
        //$ac = $this->input->get('ac');
        $this->load->model('Mestatisticas');
        echo json_encode($this->Mestatisticas->mestudantes_x_ef_mat($al,$al,$n,$c,$p));
    }

    public function estudantes_x_sexo_mat() {
        $al = $this->input->get('al');
        $n = $this->input->get('n');
        $c = $this->input->get('c');
        $p = $this->input->get('p');
        //$ac = $this->input->get('ac');
        $this->load->model('Mestatisticas');
        echo json_encode($this->Mestatisticas->mestudantes_x_sexo_mat($al,$n,$c,$p));
    }

    public function estudantes_x_pf_mat() {
        $al = $this->input->get('al');
        $n = $this->input->get('n');
        $c = $this->input->get('c');
        $p = $this->input->get('p');
        //$ac = $this->input->get('ac');
        $this->load->model('Mestatisticas');
        echo json_encode($this->Mestatisticas->mestudantes_x_pf_mat($al,$al,$n,$c,$p));
    }

    //

    public function aproveitamento() {
        
        $n = $this->input->get('n');
        $c = $this->input->get('c');
        $p = $this->input->get('p');
        $al = $this->input->get('al');
        $d = $this->input->get('d');
        $g = $this->input->get('g');
        
        $this->load->model('Mestatisticas');
        echo json_encode($this->Mestatisticas->maproveitamento($n,$c,$p,$al,$d,$g));
    }

    //relatorios
    public function get_disciplinas_relatorio() {
        $al = $this->input->get('al');
        $n = $this->input->get('n');
        $c = $this->input->get('c');
        $p = $this->input->get('p');
        $ac = $this->input->get('ac');
        $g = $this->input->get('g');
        
        $this->load->model('Mestatisticas');
        echo json_encode($this->Mestatisticas->mget_disciplinas_relatorio($al,$n,$c,$p,$ac,$g));
    }

    public function read_ii() {
        $al = $this->input->get('al');
        $n = $this->input->get('n');
        $c = $this->input->get('c');
        $p = $this->input->get('p');
        
        $this->load->model('Mestatisticas');
        echo json_encode($this->Mestatisticas->mread_ii($al,$n,$c,$p));
    }

    public function read_ii_matriculados() {
        $al = $this->input->get('al');
        $n = $this->input->get('n');
        $c = $this->input->get('c');
        $p = $this->input->get('p');
        
        $this->load->model('Mestatisticas');
        echo json_encode($this->Mestatisticas->mread_ii_matriculados($al,$n,$c,$p));
    }

}
?>