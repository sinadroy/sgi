<?php
class CFinancas_Pagamentos_Pendientes_Documentos extends CI_Controller {
    
    public function read_preco_documento() {
        $request = $_POST;
        $id = @$request['id'];
        $this->load->model('MFinancas_Pagamentos_Pendientes_Documentos');
        echo $this->MFinancas_Pagamentos_Pendientes_Documentos->mread_preco_documento($id);
    }

    public function read_ncpXid_fd() {
        $request = $_GET;
        $id = @$request['id'];
        $this->load->model('MFinancas_Pagamentos_Pendientes_Documentos');
        echo json_encode($this->MFinancas_Pagamentos_Pendientes_Documentos->mread_ncpXid_fd($id));
    }
    
    /*
        apagar pagamentos pendientes
    */
    public function delete(){
        $id = $this->input->post('bi');
        $this->load->model('MFinancas_Pagamentos_Pendientes_Candidatos');
        if($this->MFinancas_Pagamentos_Pendientes_Candidatos->mdelete($id))
                echo "true";
            else
               echo "false";
    }
}