<?php

class CCursos_Pretendidos_Comprobativo extends CI_Controller {
    
    public function imprimir(){
        $request = $_POST;
        $id = $request['id'];
        $data = $request['data'];
        $hora = $request['hora'];
        $utilizadores_id = $request['utilizadores_id'];
        $al = $request['al'];
        //crear codigo de barra unico para cada comprobativo
        //Formato CB "I Data Hora"
        $codigo = "I ".$data." ".$hora;
        $this->load->model('mGerar_Codigo_Barra');
        $codigo_barra = $this->mGerar_Codigo_Barra->criarCB($codigo);
        //registrar pago pendiente


        $this->load->model('mCursos_Pretendidos_Comprobativo');
        $this->mCursos_Pretendidos_Comprobativo->criarPdf($id,$codigo_barra,$codigo,$utilizadores_id,$al);
    }
}
