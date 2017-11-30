<?php

class Cacademica_matricula_comprobativo extends CI_Controller {
    
    public function imprimir(){
        $request = $_POST;
        $bi = $request['bi'];
        $data = $request['data'];
        $hora = $request['hora'];
        $utilizadores_id = $request['utilizadores_id'];
        //crear codigo de barra unico para cada comprobativo
        //Formato CB "I Data Hora"
        $codigo = "M ".$data." ".$hora;
        $this->load->model('mGerar_Codigo_Barra');
        $codigo_barra = $this->mGerar_Codigo_Barra->criarCB($codigo);
        //registrar pago pendiente


        $this->load->model('Macademica_matricula_comprobativo');
        $this->Macademica_matricula_comprobativo->criarPdf($bi,$codigo_barra,$codigo,$utilizadores_id);
    }
}
