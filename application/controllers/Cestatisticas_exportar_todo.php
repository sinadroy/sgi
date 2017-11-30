<?php

class Cestatisticas_exportar_todo extends CI_Controller {
    
    public function imprimir(){
        //$request = $_POST;
        //$bi = $request['bi'];
        //$data = $request['data'];
        //$hora = $request['hora'];

        $this->load->model('Mestatisticas_exportar_todo');
        $this->Mestatisticas_exportar_todo->criarExcel();
    }
}
