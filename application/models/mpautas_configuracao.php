<?php
  class Mpautas_configuracao extends CI_Model{
      
      //var $id = '';
      var $depNome = '';
      var $depCodigo = '';
      //var $Provincias_id = '';
      
      function mread(){
          $this->db->select('formulas_pautas.id,
                             d_geracao.id as dgid,
                             d_geracao.dgnome,
                             formulas_pautas.td,
                             formulas_pautas.pp1,
                             formulas_pautas.pp2,
                             formulas_pautas.pp3,
                             formulas_pautas.ef,
                             formulas_pautas.recurso, 
                             formulas_pautas.especial
                             ');
          $this->db->from('formulas_pautas');
          $this->db->join('d_geracao', 'formulas_pautas.d_geracao_id = d_geracao.id');
          //$this->db->join('Disciplinas', 'Disciplinas.d_geracao_id = d_geracao.id');
          //$this->db->join('Disciplinas_Duracao', 'Disciplinas.Disciplinas_Duracao_id = Disciplinas_Duracao.id');
          $consulta = $this->db->get();
          $ord=1;
          $data = array();
          $this->load->model('mDisciplinas_Duracao');
            foreach ($consulta->result() as $row) {
                $data[] = array(
                        "id" => $row->id,
                        "ord" => $ord,
                        "dgid" => $row->dgid,
                        "dgnome" => $row->dgnome,
                        "td" => $row->td,
                        "pp1" => $row->pp1,
                        "pp2" => $row->pp2,
                        "pp3" => $row->pp3,
                        "ef" => $row->ef,
                        "recurso" => $row->recurso,
                        "especial" => $row->especial,
                    );
                $ord++;
            }
            return $data;
      }
      function mGet_Porcento_pp1($d_geracao_id, $td){
          $this->db->select('formulas_pautas.pp1');
          $this->db->from('formulas_pautas');
          //$this->db->join('Disciplinas', 'Disciplinas.d_geracao_id = d_geracao.id');
          $this->db->where('formulas_pautas.td', $td);
          $this->db->where('formulas_pautas.d_geracao_id', $d_geracao_id);
          $consulta = $this->db->get();
          foreach($consulta->result() as $value) {
              return $value->pp1;
          }
      }
      function mGet_Porcento_pp2($d_geracao_id, $td){
          $this->db->select('formulas_pautas.pp2');
          $this->db->from('formulas_pautas');
          $this->db->where('formulas_pautas.td', $td);
          $this->db->where('formulas_pautas.d_geracao_id', $d_geracao_id);
          $consulta = $this->db->get();
          foreach($consulta->result() as $value) {
              return $value->pp2;
          }
      }
      function mGet_Porcento_pp3($d_geracao_id, $td){
          $this->db->select('formulas_pautas.pp3');
          $this->db->from('formulas_pautas');
          $this->db->where('formulas_pautas.td', $td);
          $this->db->where('formulas_pautas.d_geracao_id', $d_geracao_id);
          $consulta = $this->db->get();
          foreach($consulta->result() as $value) {
              return $value->pp3;
          }
      }
      function mGet_Porcento_ef($d_geracao_id, $td){
          $this->db->select('formulas_pautas.ef');
          $this->db->from('formulas_pautas');
          $this->db->where('formulas_pautas.td', $td);
          $this->db->where('formulas_pautas.d_geracao_id', $d_geracao_id);
          $consulta = $this->db->get();
          foreach($consulta->result() as $value) {
              return $value->ef;
          }
      }
      function mGet_Porcento_recurso($d_geracao_id, $td){
          $this->db->select('formulas_pautas.recurso');
          $this->db->from('formulas_pautas');
          $this->db->where('formulas_pautas.td', $td);
          $this->db->where('formulas_pautas.d_geracao_id', $d_geracao_id);
          $consulta = $this->db->get();
          foreach($consulta->result() as $value) {
              return $value->recurso;
          }
      }
      function mGet_Porcento_especial($d_geracao_id, $td){
          $this->db->select('formulas_pautas.especial');
          $this->db->from('formulas_pautas');
          $this->db->where('formulas_pautas.td', $td);
          $this->db->where('formulas_pautas.d_geracao_id', $d_geracao_id);
          $consulta = $this->db->get();
          foreach($consulta->result() as $value) {
              return $value->especial;
          }
      }
    /*
      function mGetIDXCodigo($Codigo){
          $this->db->select('Departamentos.id');
          $this->db->from('Departamentos');
          $this->db->where('Departamentos.depCodigo', $Codigo);
          $consulta = $this->db->get();
          foreach($consulta->result() as $value) {
              return $value->id;
          }
      }
      public function totalDepartamentos(){
        $this->db->select('Departamentos.id,Departamentos.depNome,Departamentos.depCodigo');
          $this->db->from('Departamentos');
        return $this->db->count_all_results();
      }
      */
      function mupdate($id,$dgnome,$td,$pp1,$pp2,$pp3,$ef,$recurso,$especial){
            $dados = array('pp1' => $pp1,'pp2' => $pp2,'pp3' => $pp3,'ef' => $ef,'recurso' => $recurso,'especial' => $especial,
                            'd_geracao_id' => $dgnome, 'td' => $td);
            if($this->db->update('formulas_pautas', $dados, array('id' => $id))){
                return true;
            }else
                return false;
      }
      
    function minsert($dgnome,$td,$pp1,$pp2,$pp3,$ef,$recurso,$especial){
        if($this->db->insert('formulas_pautas', array('pp1' => $pp1,'pp2' => $pp2,'pp3' => $pp3,'ef' => $ef,
                                                    'recurso' => $recurso,'especial' => $especial,
                                                    'd_geracao_id' => $dgnome, 'td' => $td)))
        {
            return true;
        }else{
            return false;
        }
           
    }
    function mdelete($id) {
        if($this->db->delete('formulas_pautas', array('id' => $id)))  
            return true;
        else
            return false;
        
    }       
  }
?>
