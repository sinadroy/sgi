<?php
class MFinancas_Tipo_Pagamento extends CI_Model {

    /*
     * Datos Personales
    */
    function mread() {
        $this->db->select('id,ftpNome,ftpCodigo');
        $this->db->from('Financas_Tipo_Pagamento');
        $consulta = $this->db->get();
        $data = array();
        foreach ($consulta->result() as $row) {
            $data[] = array(
                "id" => $row->id,
                "ftpNome" => $row->ftpNome,
                "value" => $row->ftpNome,
                "ftpCodigo" => $row->ftpCodigo,
            );
        }
        return $data;
    }
    /*
        carregar id a partir do tipo
    */
    function mreadXtipo($tipo) {
        $this->db->select('id,ftpNome,ftpCodigo');
        $this->db->from('Financas_Tipo_Pagamento');
        $this->db->where('ftpNome',$tipo);
        $consulta = $this->db->get();
        foreach ($consulta->result() as $row) {
                $id = $row->id;
        }
        return $id;
    }
}

?>
