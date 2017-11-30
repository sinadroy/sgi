<?php
  class MRegistro_Funcionarios extends CI_Model{
      
      function mread(){
          $this->db->select('Registro_Funcionarios.id,
          Registro_Funcionarios.Funcionarios_id,Funcionarios.fBI_Passaporte,Funcionarios.fNome,Funcionarios.fApelido, 
          Registro_Funcionarios.rfData,
          Registro_Funcionarios.rfEntrada,Registro_Funcionarios.rfEstado_Entrada,
          Registro_Funcionarios.rfSaida,Registro_Funcionarios.rfEstado_Saida,
          Registro_Funcionarios.Sessao_Trabalho_Administrativos_id,Sessao_Trabalho_Administrativos.stNome
          ');
          $this->db->from('Registro_Funcionarios');
          $this->db->join('Funcionarios', 'Registro_Funcionarios.Funcionarios_id = Funcionarios.id');
          $this->db->join('Sessao_Trabalho_Administrativos', 'Registro_Funcionarios.Sessao_Trabalho_Administrativos_id = Sessao_Trabalho_Administrativos.id');
          $consulta = $this->db->get();
          $data = array();
          foreach($consulta->result() as $row){
              //$data[] = $row;
              $data[] = array(
                  "id"=>$row->id,
                  "Funcionarios_id"=>$row->Funcionarios_id,
                  "fNome"=>$row->fNome,
                  "value"=>$row->fNome,
                  //"fNomes"=>$row->fNomes,
                  "fApelido"=>$row->fApelido,
                  "fBI_Passaporte"=>$row->fBI_Passaporte,
                  //"Horario_Tipo_id"=>$row->Horario_Tipo_id,
                  //"htNome"=>$row->htNome
                  "rfData"=>$row->rfData,
                  "rfEntrada"=>$row->rfEntrada,
                  "rfEstado_Entrada"=>$row->rfEstado_Entrada,
                  "rfSaida"=>$row->rfSaida,
                  "rfEstado_Saida"=>$row->rfEstado_Saida,
              );
          }
        return $data;
      }
/*
      function mGetID($Nome){
          $this->db->select('periodos.id');
          $this->db->from('periodos');
          $this->db->where('periodos.pNome', $Nome);
          $consulta = $this->db->get();
          foreach($consulta->result() as $value) {
              return $value->id;
          }
      }
      function mGetIDXCodigo($Codigo){
          $this->db->select('Periodos.id');
          $this->db->from('Periodos');
          $this->db->where('Periodos.pCodigo', $Codigo);
          $consulta = $this->db->get();
          foreach($consulta->result() as $value) {
              return $value->id;
          }
      }
      public function total(){
        $this->db->select('Periodos.id');
          $this->db->from('Periodos');
        return $this->db->count_all_results();
      }
      function mupdate($id,$Nome,$Codigo){
            $dados = array('pNome' => $Nome,'pCodigo' => $Codigo);
            if($this->db->update('Periodos', $dados, array('id' => $id))){
                return true;
            }else
                return false;
      }
      
    function minsert($Nome,$Codigo){
        if($this->db->insert('Periodos', array('pNome' => $Nome,'pCodigo' => $Codigo)))
        {
            return true;
        }else{
            return false;
        }
           
    }
    function mdelete($id) {
        if($this->db->delete('Periodos', array('id' => $id)))  
            return true;
        else
            return false;
        
    }
*/   
           
  }
?>
