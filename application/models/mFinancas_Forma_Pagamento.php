<?php
class MFinancas_Forma_Pagamento extends CI_Model {

    /*
     * Datos Personales
    */
    function mread() {
        $this->db->select('id,ffpNome,ffpCodigo');
        $this->db->from('Financas_Forma_Pagamento');
        $consulta = $this->db->get();
        $data = array();
        foreach ($consulta->result() as $row) {
            $data[] = array(
                "id" => $row->id,
                "ffpNome" => $row->ffpNome,
                "value" => $row->ffpNome,
                "ffpCodigo" => $row->ffpCodigo,
            );
        }
        return $data;
    }
}

?>
